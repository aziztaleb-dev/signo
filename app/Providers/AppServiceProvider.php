<?php

namespace App\Providers;

use App\Models\ContactPageSetting;
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
            static $contacts = null;

            if ($menuCategories === null) {
                $menuCategories = WorkCategory::with(['subcategories' => function ($query) {
                    $query->orderBy('created_at', 'DESC');
                }])
                    ->orderBy('created_at', 'ASC')
                    ->get();
            }

            if ($contacts === null) {
                $contacts = ContactPageSetting::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get()
                    ->keyBy('key');
            }

            $view->with([
                'menuCategories' => $menuCategories,
                'contacts' => $contacts,
            ]);
        });
    }
}
