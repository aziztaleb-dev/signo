<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewProduct;
use App\Models\News;
use App\Models\Project;
use App\Models\Work;
use App\Models\WorkCategory;
use App\Models\WorkSubcategory;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            [
                'label' => 'Actualités',
                'count' => News::count(),
                'route' => route('admin.news.index'),
                'icon'  => 'news',
            ],
            [
                'label' => 'Nouveaux produits',
                'count' => NewProduct::count(),
                'route' => route('admin.new-products.index'),
                'icon'  => 'box',
            ],
            [
                'label' => 'Projets',
                'count' => Project::count(),
                'route' => route('admin.projects.index'),
                'icon'  => 'briefcase',
            ],
            [
                'label' => 'Catégories de travaux',
                'count' => WorkCategory::count(),
                'route' => route('admin.work-categories.index'),
                'icon'  => 'folder',
            ],
            [
                'label' => 'Sous-catégories',
                'count' => WorkSubcategory::count(),
                'route' => route('admin.work-subcategories.index'),
                'icon'  => 'list',
            ],
            [
                'label' => 'Travaux',
                'count' => Work::count(),
                'route' => route('admin.works.index'),
                'icon'  => 'image',
            ],

            [
                'label' => 'Messages non lus',
                'count' => ContactMessage::whereNull('read_at')->count(),
                'route' => route('admin.contact-messages.index'),
                'icon'  => 'mail',
            ],
        ];

        // Derniers ajouts, tous modules confondus
        $latest = collect()
            ->merge(
                News::latest()->take(5)->get()->map(fn ($item) => [
                    'type'  => 'Actualité',
                    'title' => $item->name,
                    'date'  => $item->created_at,
                    'url'   => route('admin.news.edit', $item),
                ])
            )
            ->merge(
                NewProduct::latest()->take(5)->get()->map(fn ($item) => [
                    'type'  => 'Nouveau produit',
                    'title' => $item->name,
                    'date'  => $item->created_at,
                    'url'   => route('admin.new-products.edit', $item),
                ])
            )
            ->merge(
                Project::latest()->take(5)->get()->map(fn ($item) => [
                    'type'  => 'Projet',
                    'title' => $item->title,
                    'date'  => $item->created_at,
                    'url'   => route('admin.projects.edit', $item),
                ])
            )
            ->merge(
                Work::latest()->take(5)->get()->map(fn ($item) => [
                    'type'  => 'Travail',
                    'title' => $item->title,
                    'date'  => $item->created_at,
                    'url'   => route('admin.works.edit', $item),
                ])
            )
            ->sortByDesc('date')
            ->take(5)
            ->values();

        return view('admin.dashboard', compact('stats', 'latest'));
    }
}
