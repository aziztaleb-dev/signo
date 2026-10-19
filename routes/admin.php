<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NewProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\WorkCategoryController;
use App\Http\Controllers\Admin\WorkSubcategoryController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\HomePageSectionController;
use App\Http\Controllers\Admin\ServicePageSectionController;
use App\Http\Controllers\Admin\ContactPageSettingController;
use App\Http\Controllers\Admin\ClientLogoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::prefix('home-page')
    ->name('home-page.')
    ->controller(HomePageSectionController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{homePageSection}/edit', 'edit')->name('edit');
        Route::put('/{homePageSection}', 'update')->name('update');
    });

Route::prefix('service-page')
    ->name('service-page.')
    ->controller(ServicePageSectionController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{servicePageSection}/edit', 'edit')->name('edit');
        Route::put('/{servicePageSection}', 'update')->name('update');
    });

Route::prefix('contact-page')
    ->name('contact-page.')
    ->controller(ContactPageSettingController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{contactPageSetting}/edit', 'edit')->name('edit');
        Route::put('/{contactPageSetting}', 'update')->name('update');
    });

Route::resource('client-logos', ClientLogoController::class)
    ->except(['show'])
    ->names('client-logos');

Route::post(
    'client-logos/reorder',
    [ClientLogoController::class, 'reorder']
)->name('client-logos.reorder');

Route::resource('news', NewsController::class)->except(['show']);
Route::resource('new-products', NewProductController::class)
    ->parameters(['new-products' => 'newProduct'])
    ->except(['show']);
Route::resource('projects', ProjectController::class)->except(['show']);
Route::resource('work-categories', WorkCategoryController::class)
    ->parameters(['work-categories' => 'workCategory'])
    ->except(['show']);

Route::resource('work-subcategories', WorkSubcategoryController::class)
    ->parameters(['work-subcategories' => 'workSubcategory'])
    ->except(['show']);


Route::get('work-categories/{workCategory}/subcategories', [WorkController::class, 'subcategories'])
    ->name('works.subcategories');

Route::get('work-subcategories/{workSubcategory}/works', [WorkController::class, 'bySubcategory'])
    ->name('works.by-subcategory');

Route::resource('contact-messages', ContactMessageController::class)
    ->parameters(['contact-messages' => 'contactMessage'])
    ->only(['index', 'show', 'destroy']);

Route::resource('works', WorkController::class)->except(['show']);
