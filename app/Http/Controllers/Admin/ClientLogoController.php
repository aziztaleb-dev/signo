<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientLogoRequest;
use App\Http\Requests\UpdateClientLogoRequest;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ClientLogoController extends Controller
{
    public function index()
    {
        $clientLogos = ClientLogo::orderBy('position')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.client-logos.index', compact('clientLogos'));
    }

    public function create()
    {
        return view('admin.client-logos.create');
    }

    public function store(StoreClientLogoRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->file('image')
            ->store('client-logos', 'public');

        $data['position'] = (ClientLogo::max('position') ?? -1) + 1;
        $data['is_active'] = $request->boolean('is_active');

        ClientLogo::create($data);

        return redirect()
            ->route('admin.client-logos.index')
            ->with('success', 'Le logo a été ajouté avec succès.');
    }

    public function edit(ClientLogo $clientLogo)
    {
        return view('admin.client-logos.edit', compact('clientLogo'));
    }

    public function update(
        UpdateClientLogoRequest $request,
        ClientLogo $clientLogo
    ) {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('client-logos', 'public');

            if ($clientLogo->image) {
                Storage::disk('public')->delete($clientLogo->image);
            }

            $data['image'] = $newImage;
        }

        $data['is_active'] = $request->boolean('is_active');

        $clientLogo->update($data);

        return redirect()
            ->route('admin.client-logos.index')
            ->with('success', 'Le logo a été modifié avec succès.');
    }

    public function destroy(ClientLogo $clientLogo)
    {
        if ($clientLogo->image) {
            Storage::disk('public')->delete($clientLogo->image);
        }

        $clientLogo->delete();

        return redirect()
            ->route('admin.client-logos.index')
            ->with('success', 'Le logo a été supprimé avec succès.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'integer', 'distinct', 'exists:client_logos,id'],
        ]);

        $ids = $validated['ids'];

        DB::transaction(function () use ($ids) {
            $logos = ClientLogo::whereIn('id', $ids)->get();

            // Éviter de modifier seulement une partie de la liste.
            if ($logos->count() !== count($ids)) {
                throw ValidationException::withMessages([
                    'ids' => 'La liste des logos est invalide.',
                ]);
            }

            foreach ($ids as $position => $id) {
                ClientLogo::whereKey($id)->update([
                    'position' => $position,
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Ordre des logos enregistré.',
        ]);
    }
}
