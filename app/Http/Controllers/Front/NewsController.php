<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\NewProduct;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $newsItems = News::latest()->get();
        $newProducts = NewProduct::latest()->get();

        return view('front.nouveautes', compact('newsItems', 'newProducts'));
    }
}
