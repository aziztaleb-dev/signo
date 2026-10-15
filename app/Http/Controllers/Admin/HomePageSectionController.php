<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSection;
use App\Http\Requests\UpdateHomePageSectionRequest;
use Illuminate\Support\Facades\Storage;

class HomePageSectionController extends Controller
{
    private const SECTIONS = [
        'hero' => 'Bannière principale',
        'history' => 'Notre histoire',
        'advice' => 'Notre conseil',
        'studies' => 'Nos études',
        'production' => 'Notre production',
    ];

    public function index()
    {
        $sections = HomePageSection::orderBy('sort_order')->get();

        return view('admin.home-page.index', compact('sections'));
    }

    public function edit(HomePageSection $homePageSection)
    {
        return view('admin.home-page.edit', [
            'section' => $homePageSection,
        ]);
    }

    public function update(
        UpdateHomePageSectionRequest $request,
        HomePageSection $homePageSection
    ) {

        $validated = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | Galerie actuelle
        |--------------------------------------------------------------------------
        */

        $currentGallery = $homePageSection->gallery ?? [];

        if (is_string($currentGallery)) {
            $currentGallery = json_decode($currentGallery, true) ?? [];
        }

        $currentGallery = is_array($currentGallery)
            ? array_values($currentGallery)
            : [];

        /*
        |--------------------------------------------------------------------------
        | Images à supprimer
        |--------------------------------------------------------------------------
        */

        $removeGalleryInput = $request->input('remove_gallery', []);

        if (!is_array($removeGalleryInput)) {
            $removeGalleryInput = [];
        }

        // Ne retenir que les chemins appartenant à la galerie actuelle.
        $galleryToRemove = array_values(array_intersect(
            $removeGalleryInput,
            $currentGallery
        ));

        /*
        |--------------------------------------------------------------------------
        | Validation du nombre total d'images
        |--------------------------------------------------------------------------
        */

        $newGalleryFiles = $request->file('gallery', []);

        if (!is_array($newGalleryFiles)) {
            $newGalleryFiles = [];
        }

        $newGalleryFiles = array_filter($newGalleryFiles);

        $remainingGalleryCount =
            count($currentGallery)
            - count($galleryToRemove)
            + count($newGalleryFiles);

        if ($remainingGalleryCount > 10) {
            return back()
                ->withInput()
                ->withErrors([
                    'gallery' => 'La galerie ne peut pas contenir plus de 10 images au total.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Préparer les nouvelles images
        |--------------------------------------------------------------------------
        |
        | On enregistre d'abord les nouveaux fichiers.
        | Les anciennes images ne seront supprimées qu'après la sauvegarde en base.
        |
        */

        $newImagePath = null;
        $newGalleryPaths = [];

        try {
            // Nouvelle image principale.
            if ($request->hasFile('image')) {
                $newImagePath = $request->file('image')
                    ->store('home-page', 'public');

                if (!$newImagePath) {
                    throw new \RuntimeException(
                        'Impossible d’enregistrer la nouvelle image principale.'
                    );
                }
            }

            // Nouvelles images de galerie.
            foreach ($newGalleryFiles as $file) {
                if (!$file->isValid()) {
                    throw new \RuntimeException(
                        'Une image de la galerie est invalide.'
                    );
                }

                $path = $file->store('home-page/gallery', 'public');

                if (!$path) {
                    throw new \RuntimeException(
                        'Impossible d’enregistrer une image de la galerie.'
                    );
                }

                $newGalleryPaths[] = $path;
            }

            /*
            |--------------------------------------------------------------------------
            | Calculer les nouveaux chemins
            |--------------------------------------------------------------------------
            */

            $oldImagePath = $homePageSection->image;

            $removeMainImage = $request->boolean('remove_image');

            $imagePath = $oldImagePath;

            if ($removeMainImage) {
                $imagePath = null;
            }

            // Une nouvelle image remplace l'ancienne, même si le checkbox
            // de suppression n'est pas coché.
            if ($newImagePath) {
                $imagePath = $newImagePath;
            }

            $gallery = array_values(array_diff(
                $currentGallery,
                $galleryToRemove
            ));

            $gallery = array_merge($gallery, $newGalleryPaths);

            /*
            |--------------------------------------------------------------------------
            | Préparer les paragraphes
            |--------------------------------------------------------------------------
            */

            $paragraphs = collect($validated['paragraphs'] ?? [])
                ->map(fn ($paragraph) => trim($paragraph))
                ->filter(fn ($paragraph) => $paragraph !== '')
                ->values()
                ->all();

            /*
            |--------------------------------------------------------------------------
            | Mettre à jour la base de données
            |--------------------------------------------------------------------------
            */

            $homePageSection->update([
                'title' => $validated['title'] ?? null,
                'subtitle' => $validated['subtitle'] ?? null,
                'paragraphs' => $paragraphs,
                'quote' => $validated['quote'] ?? null,
                'quote_author' => $validated['quote_author'] ?? null,
                'image' => $imagePath,
                'gallery' => $gallery,
                'button_text' => $validated['button_text'] ?? null,
                'button_url' => $validated['button_url'] ?? null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Supprimer les anciens fichiers après la sauvegarde
            |--------------------------------------------------------------------------
            */

            $disk = Storage::disk('public');

            // Supprimer l'ancienne image principale si elle a été retirée
            // ou remplacée par une nouvelle.
            if (
                $oldImagePath
                && $oldImagePath !== $imagePath
                && $disk->exists($oldImagePath)
            ) {
                $disk->delete($oldImagePath);
            }

            // Supprimer les images cochées dans la galerie.
            foreach ($galleryToRemove as $path) {
                // Ne pas supprimer un chemin encore présent dans la galerie.
                if (
                    !in_array($path, $gallery, true)
                    && $disk->exists($path)
                ) {
                    $disk->delete($path);
                }
            }

        } catch (\Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | Nettoyer les nouveaux fichiers en cas d'erreur
            |--------------------------------------------------------------------------
            */

            $disk = Storage::disk('public');

            if ($newImagePath && $disk->exists($newImagePath)) {
                $disk->delete($newImagePath);
            }

            foreach ($newGalleryPaths as $path) {
                if ($disk->exists($path)) {
                    $disk->delete($path);
                }
            }

            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'gallery' => 'Une erreur est survenue lors de l’enregistrement des images. Veuillez réessayer.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Redirection
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.home-page.index')
            ->with('success', 'La section a été mise à jour avec succès.');
    }
}
