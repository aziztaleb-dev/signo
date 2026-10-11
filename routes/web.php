<?php

use App\Http\Controllers\Front\NewsController;
use App\Http\Controllers\Front\ProjectController;
use App\Http\Controllers\Front\WorkController as FrontWorkController;
use App\Http\Controllers\Front\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return view('front.home');
})->name('home');


Route::get('nouveautes', [NewsController::class, 'index'])->name('nouveautes');

Route::get('/travaux/{workSubcategory}', [FrontWorkController::class, 'index'])
    ->name('traveaux.index');

Route::get('/travaux/{workSubcategory}/{work:slug}', [FrontWorkController::class, 'show'])
    ->scopeBindings()
    ->name('traveaux.show');

Route::get('nos-services', function () {
    return view('front.services');
})->name('services');

Route::get('nos-projets', [ProjectController::class, 'index'])->name('projets');


Route::get('contact', function () {
    return view('front.contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');


require __DIR__ . '/auth.php';


Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(base_path('routes/admin.php'));
