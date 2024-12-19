<?php

use App\Http\Controllers\SearchProviderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchProviderController::class, 'SearchProvider']);
Route::post('/search/results', [SearchProviderController::class, 'SearchProviderResults']);
Route::get('/apply', [App\Http\Controllers\ApplicationController::class, 'create'])->name('applyForm');
Route::post('/apply', [App\Http\Controllers\ApplicationController::class, 'store'])->name('apply');
