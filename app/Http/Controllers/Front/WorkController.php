<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\WorkSubcategory;

class WorkController extends Controller
{
    public function index(WorkSubcategory $workSubcategory)
    {
        $workSubcategory->load('category');

        $works = $workSubcategory->works()
            ->latest()
            ->paginate(9);

        return view('front.traveaux.index', [
            'subcategory' => $workSubcategory,
            'works'       => $works,
        ]);
    }

    public function show(WorkSubcategory $workSubcategory, Work $work)
    {
        $workSubcategory->load('category');

        return view('front.traveaux.show', [
            'subcategory' => $workSubcategory,
            'work'        => $work,
        ]);
    }
}
