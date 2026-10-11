<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        Project::create([
            'title'   => $request->validated('title'),
            'image'   => $request->file('image')->store('projects', 'public'),
            'clients' => $this->cleanClients($request->input('clients', [])),
        ]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Le projet a été créé avec succès.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $image = $project->image;

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            $image = $request->file('image')->store('projects', 'public');
        }

        $project->update([
            'title'   => $request->validated('title'),
            'image'   => $image,
            'clients' => $this->cleanClients($request->input('clients', [])),
        ]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Le projet a été modifié avec succès.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Le projet a été supprimé avec succès.');
    }

    /**
     * Nettoie la liste des références clients :
     * supprime les lignes vides et les doublons.
     */
    private function cleanClients(array $clients): array
    {
        $clients = array_map(fn ($client) => trim((string) $client), $clients);
        $clients = array_filter($clients, fn ($client) => $client !== '');

        return array_values(array_unique($clients));
    }
}
