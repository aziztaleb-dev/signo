<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        $clientLogos = ClientLogo::where('is_active', true)
            ->orderBy('position')
            ->orderBy('id')
            ->get();

        return view('front.projets', compact('projects', 'clientLogos'));
    }
}
