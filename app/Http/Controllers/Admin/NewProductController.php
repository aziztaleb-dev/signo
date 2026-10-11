<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewProductRequest;
use App\Http\Requests\UpdateNewProductRequest;
use App\Models\NewProduct;
use Illuminate\Support\Facades\Storage;

class NewProductController extends Controller
{
    public function index()
    {
        $newProducts = NewProduct::latest()->paginate(10);

        return view('admin.new-products.index', compact('newProducts'));
    }

    public function create()
    {
        return view('admin.new-products.create');
    }

    public function store(StoreNewProductRequest $request)
    {
        $images = [];

        foreach ($request->file('images', []) as $file) {
            $images[] = $file->store('new-products/images', 'public');
        }

        if ($request->file('pdf')){
            $pdf = $request->file('pdf')->store('new-products/pdf', 'public');
        }

        NewProduct::create([
            'name'        => $request->validated('name'),
            'description' => $request->validated('description'),
            'images'      => $images,
            'pdf'         => $pdf ?? null,
        ]);

        return redirect()
            ->route('admin.new-products.index')
            ->with('success', 'Le nouveau produit a été créé avec succès.');
    }

    public function edit(NewProduct $newProduct)
    {
        return view('admin.new-products.edit', compact('newProduct'));
    }

    public function update(UpdateNewProductRequest $request, NewProduct $newProduct)
    {
        $currentImages = $newProduct->images ?? [];

        // Seules les images appartenant réellement au produit peuvent être supprimées
        $imagesToRemove = array_values(array_intersect(
            $request->input('remove_images', []),
            $currentImages
        ));

        $newFiles = $request->file('images', []);

        $remainingCount = count($currentImages) - count($imagesToRemove) + count($newFiles);

        if ($remainingCount < 1) {
            return back()
                ->withInput()
                ->withErrors(['images' => 'Le produit doit conserver au moins une image.']);
        }

        // Suppression des images cochées
        foreach ($imagesToRemove as $path) {
            Storage::disk('public')->delete($path);
        }

        $images = array_values(array_diff($currentImages, $imagesToRemove));

        // Ajout des nouvelles images
        foreach ($newFiles as $file) {
            $images[] = $file->store('new-products/images', 'public');
        }

        // Remplacement du PDF
        $pdf = $newProduct->pdf;

        if ($request->hasFile('pdf')) {
            if ($newProduct->pdf) {
                Storage::disk('public')->delete($newProduct->pdf);
            }

            $pdf = $request->file('pdf')->store('new-products/pdf', 'public');
        }

        $newProduct->update([
            'name'        => $request->validated('name'),
            'description' => $request->validated('description'),
            'images'      => $images,
            'pdf'         => $pdf,
        ]);

        return redirect()
            ->route('admin.new-products.index')
            ->with('success', 'Le nouveau produit a été modifié avec succès.');
    }

    public function destroy(NewProduct $newProduct)
    {
        foreach ($newProduct->images ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        if ($newProduct->pdf) {
            Storage::disk('public')->delete($newProduct->pdf);
        }

        $newProduct->delete();

        return redirect()
            ->route('admin.new-products.index')
            ->with('success', 'Le nouveau produit a été supprimé avec succès.');
    }
}
