<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', [UserController::class, 'loadUserHome'])->middleware('user');
Route::get('/admin', [AdminController::class, 'loadAdminHome'])->middleware('admin');

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });
