<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NewProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\WorkCategoryController;
use App\Http\Controllers\Admin\WorkSubcategoryController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

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
