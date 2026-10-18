<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPageSetting;
use App\Http\Requests\UpdateContactPageSettingRequest;
use Illuminate\Support\Facades\Storage;

class ContactPageSettingController extends Controller
{
    public function index()
    {
        $sections = ContactPageSetting::orderBy('sort_order')->get();

        return view('admin.contact-page.index', compact('sections'));
    }

    public function edit(ContactPageSetting $contactPageSetting)
    {
        return view('admin.contact-page.edit', [
            'section' => $contactPageSetting,
        ]);
    }

    public function update(
        UpdateContactPageSettingRequest $request,
        ContactPageSetting $contactPageSetting
    )
    {

        $validated = $request->validated();
        $data = collect($validated)
            ->except(['image', 'remove_image'])
            ->all();

        if ($request->boolean('remove_image') || $request->hasFile('image')) {
            $this->deleteUploadedImage($contactPageSetting->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('contact-page', 'public');
        }

        //$data['is_active'] = $request->boolean('is_active');

        $contactPageSetting->update($data);

        return redirect()
            ->route('admin.contact-page.index')
            ->with('success', 'La section a été mise à jour avec succès.');
    }

    private function deleteUploadedImage(?string $path): void
    {
        // Ne jamais supprimer les images originales du dossier assets.
        if (
            $path &&
            str_starts_with($path, 'contact-page/') &&
            Storage::disk('public')->exists($path)
        ) {
            Storage::disk('public')->delete($path);
        }
    }
}
