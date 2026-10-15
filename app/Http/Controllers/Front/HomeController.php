<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\HomePageSection;

class HomeController extends Controller
{
    public function index()
    {
        $sections = HomePageSection::active()
            ->orderBy('sort_order')
            ->get()
            ->keyBy('key');

        return view('front.home', compact('sections'));
    }
}
