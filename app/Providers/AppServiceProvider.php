<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\WorkCategory;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('front.*', function ($view) {
            static $menuCategories = null;

            // Une seule requête par page, même si plusieurs vues front sont rendues
            if ($menuCategories === null) {
                $menuCategories = WorkCategory::with(['subcategories' => function ($query) {
                    $query->orderBy('created_at', 'DESC');
                }])
                    ->orderBy('created_at', 'ASC')
                    ->get();
            }

            $view->with('menuCategories', $menuCategories);
        });
    }
}
