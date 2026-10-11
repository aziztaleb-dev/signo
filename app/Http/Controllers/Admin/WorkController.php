<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Work;
use App\Models\WorkCategory;
use App\Models\WorkSubcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::with('subcategory.category')
            ->latest()
            ->paginate(10);

        return view('admin.works.index', compact('works'));
    }

    public function create()
    {
        $categories = WorkCategory::orderBy('name')->get();

        return view('admin.works.create', compact('categories'));
    }

    public function store(StoreWorkRequest $request)
    {
        $images = [];

        foreach ($request->file('images', []) as $file) {
            $images[] = $file->store('works', 'public');
        }

        Work::create([
            'work_subcategory_id' => $request->validated('work_subcategory_id'),
            'title'               => $request->validated('title'),
            'title_en'               => $request->validated('title_en'),
            'description'         => $request->validated('description'),
            'images'              => $images,
        ]);

        return redirect()
            ->route('admin.works.index')
            ->with('success', 'Le travail a été créé avec succès.');
    }

    public function edit(Work $work)
    {
        $work->load('subcategory');

        $categories = WorkCategory::orderBy('name')->get();

        $selectedCategoryId = $work->subcategory->work_category_id;

        return view('admin.works.edit', compact('work', 'categories', 'selectedCategoryId'));
    }

    public function update(UpdateWorkRequest $request, Work $work)
    {
        $currentImages = $work->images ?? [];

        // Seules les images appartenant réellement au travail peuvent être supprimées
        $imagesToRemove = array_values(array_intersect(
            $request->input('remove_images', []),
            $currentImages
        ));

        $newFiles = $request->file('images', []);

        $remainingCount = count($currentImages) - count($imagesToRemove) + count($newFiles);

        if ($remainingCount < 1) {
            return back()
                ->withInput()
                ->withErrors(['images' => 'Le travail doit conserver au moins une image.']);
        }

        foreach ($imagesToRemove as $path) {
            Storage::disk('public')->delete($path);
        }

        $images = array_values(array_diff($currentImages, $imagesToRemove));

        foreach ($newFiles as $file) {
            $images[] = $file->store('works', 'public');
        }

        $work->update([
            'work_subcategory_id' => $request->validated('work_subcategory_id'),
            'title'               => $request->validated('title'),
            'title_en'               => $request->validated('title_en'),
            'description'         => $request->validated('description'),
            'images'              => $images,
        ]);

        return redirect()
            ->route('admin.works.index')
            ->with('success', 'Le travail a été modifié avec succès.');
    }

    public function destroy(Work $work)
    {
        foreach ($work->images ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $work->delete();

        return redirect()
            ->route('admin.works.index')
            ->with('success', 'Le travail a été supprimé avec succès.');
    }

    /**
     * JSON : sous-catégories d'une catégorie.
     */
    public function subcategories(WorkCategory $workCategory): JsonResponse
    {
        $subcategories = $workCategory->subcategories()
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($subcategories);
    }

    /**
     * JSON : travaux d'une sous-catégorie.
     */
    public function bySubcategory(WorkSubcategory $workSubcategory): JsonResponse
    {
        $works = $workSubcategory->works()
            ->latest()
            ->get()
            ->map(fn (Work $work) => [
                'id'          => $work->id,
                'title'       => $work->title,
                'title_en'       => $work->title_en,
                'description' => $work->description,
                'images'      => collect($work->images ?? [])
                    ->map(fn ($path) => asset('storage/' . $path))
                    ->values(),
            ]);

        return response()->json($works);
    }
}
