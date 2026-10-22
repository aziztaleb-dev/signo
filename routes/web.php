<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ServicePageController;
use App\Http\Controllers\Front\NewsController;
use App\Http\Controllers\Front\ProjectController;
use App\Http\Controllers\Front\WorkController as FrontWorkController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/nos-services', [ServicePageController::class, 'index'])
    ->name('services');

Route::get('nouveautes', [NewsController::class, 'index'])->name('nouveautes');

Route::get('/travaux/{workSubcategory}', [FrontWorkController::class, 'index'])
    ->name('traveaux.index');

Route::get('/travaux/{workSubcategory}/{work:slug}', [FrontWorkController::class, 'show'])
    ->scopeBindings()
    ->name('traveaux.show');

Route::get('nos-projets', [ProjectController::class, 'index'])->name('projets');


Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');


use Illuminate\Support\Facades\Storage;

Route::get('/client-logos/{filename}', function ($filename) {
    $path = 'client-logos/' . $filename;

    abort_unless(Storage::disk('public')->exists($path), 404);

    return response()->file(
        Storage::disk('public')->path($path)
    );
})->where('filename', '[^/]+');


require __DIR__ . '/auth.php';


Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(base_path('routes/admin.php'));
