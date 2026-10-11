<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkSubcategoryRequest;
use App\Http\Requests\UpdateWorkSubcategoryRequest;
use App\Models\WorkCategory;
use App\Models\WorkSubcategory;

class WorkSubcategoryController extends Controller
{
    public function index()
    {
        $workSubcategories = WorkSubcategory::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.work-subcategories.index', compact('workSubcategories'));
    }

    public function create()
    {
        $categories = WorkCategory::orderBy('name')->get();

        return view('admin.work-subcategories.create', compact('categories'));
    }

    public function store(StoreWorkSubcategoryRequest $request)
    {
        WorkSubcategory::create($request->validated());

        return redirect()
            ->route('admin.work-subcategories.index')
            ->with('success', 'La sous-catégorie a été créée avec succès.');
    }

    public function edit(WorkSubcategory $workSubcategory)
    {
        $categories = WorkCategory::orderBy('name')->get();

        return view('admin.work-subcategories.edit', compact('workSubcategory', 'categories'));
    }

    public function update(UpdateWorkSubcategoryRequest $request, WorkSubcategory $workSubcategory)
    {
        $workSubcategory->update($request->validated());

        return redirect()
            ->route('admin.work-subcategories.index')
            ->with('success', 'La sous-catégorie a été modifiée avec succès.');
    }

    public function destroy(WorkSubcategory $workSubcategory)
    {
        if ($workSubcategory->works()->exists()) {
            return redirect()
                ->route('admin.work-subcategories.index')
                ->with('error', "Impossible de supprimer cette sous-catégorie : elle contient des travaux. Supprimez-les d'abord.");
        }

        $workSubcategory->delete();

        return redirect()
            ->route('admin.work-subcategories.index')
            ->with('success', 'La sous-catégorie a été supprimée avec succès.');
    }
}
