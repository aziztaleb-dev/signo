<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkCategoryRequest;
use App\Http\Requests\UpdateWorkCategoryRequest;
use App\Models\WorkCategory;

class WorkCategoryController extends Controller
{
    public function index()
    {
        $workCategories = WorkCategory::withCount('subcategories')
            ->latest()
            ->paginate(10);

        return view('admin.work-categories.index', compact('workCategories'));
    }

    public function create()
    {
        return view('admin.work-categories.create');
    }

    public function store(StoreWorkCategoryRequest $request)
    {
        WorkCategory::create($request->validated());

        return redirect()
            ->route('admin.work-categories.index')
            ->with('success', 'La catégorie a été créée avec succès.');
    }

    public function edit(WorkCategory $workCategory)
    {
        return view('admin.work-categories.edit', compact('workCategory'));
    }

    public function update(UpdateWorkCategoryRequest $request, WorkCategory $workCategory)
    {
        $workCategory->update($request->validated());

        return redirect()
            ->route('admin.work-categories.index')
            ->with('success', 'La catégorie a été modifiée avec succès.');
    }

    public function destroy(WorkCategory $workCategory)
    {
        if ($workCategory->subcategories()->exists()) {
            return redirect()
                ->route('admin.work-categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie : elle contient des sous-catégories. Supprimez-les d\'abord.');
        }

        $workCategory->delete();

        return redirect()
            ->route('admin.work-categories.index')
            ->with('success', 'La catégorie a été supprimée avec succès.');
    }
}
