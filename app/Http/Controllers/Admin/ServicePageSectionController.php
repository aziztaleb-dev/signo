<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePageSection;
use App\Http\Requests\UpdateServicePageSectionRequest;
use Illuminate\Support\Facades\Storage;

class ServicePageSectionController extends Controller
{
    /**
     * Liste des sections de la page Nos services.
     */
    public function index()
    {
        $sections = ServicePageSection::orderBy('sort_order')->get();

        return view('admin.service-page.index', compact('sections'));
    }

    /**
     * Formulaire de modification d'une section.
     */
    public function edit(ServicePageSection $servicePageSection)
    {
        return view('admin.service-page.edit', [
            'section' => $servicePageSection,
        ]);
    }
    public function update(

        UpdateServicePageSectionRequest $request,
        ServicePageSection $servicePageSection

    ) {

        $validated = $request->validated();

        $data = collect($validated)
            ->except([
                'image',
                'remove_image',
                'gallery',
                'remove_gallery',
            ])
            ->all();

        /*
         * Image principale.
         */
        if ($request->boolean('remove_image') || $request->hasFile('image')) {
            $this->deleteUploadedFile($servicePageSection->image);

            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('service-page', 'public');
        }

        /*
         * Galerie : supprimer uniquement les images sélectionnées,
         * puis ajouter les nouvelles images.
         */
        $gallery = $servicePageSection->gallery ?? [];

        if (!is_array($gallery)) {
            $gallery = [];
        }

        $removeGallery = $request->input('remove_gallery', []);

        if (!is_array($removeGallery)) {
            $removeGallery = [];
        }

        foreach ($removeGallery as $path) {
            if (in_array($path, $gallery, true)) {
                $this->deleteUploadedFile($path);

                $gallery = array_values(array_filter(
                    $gallery,
                    fn ($image) => $image !== $path
                ));
            }
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('service-page/gallery', 'public');
            }
        }

        if ($request->hasFile('gallery') || count($removeGallery) > 0) {
            $data['gallery'] = array_values($gallery);
        }

        /*
         * Statut.
         */
        //$data['is_active'] = $request->boolean('is_active');

        $servicePageSection->update($data);

        return redirect()
            ->route('admin.service-page.index')
            ->with('success', 'La section a été mise à jour avec succès.');
    }

    private function deleteUploadedFile(?string $path): void
    {
        if (
            $path &&
            str_starts_with($path, 'service-page/') &&
            \Illuminate\Support\Facades\Storage::disk('public')->exists($path)
        ) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
        }
    }
}
