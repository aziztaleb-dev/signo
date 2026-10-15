<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ServicePageSection;

class ServicePageController extends Controller
{
    public function index()
    {
        $sections = ServicePageSection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('key');

        return view('front.services', compact('sections'));
    }
}
