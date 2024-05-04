<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/create', function() {
    return view('posts.create');
})->name('posts.create');


Route::post('create', [PostController::class, 'store'])->name('create');
Route::get('show/{id}', [PostController::class, 'show'])->name('show');
Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
Route::put('update/{id}', [PostController::class, 'update'])->name('update');
Route::delete('delete/{id}', [PostController::class, 'destroy'])->name('delete');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('home');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});