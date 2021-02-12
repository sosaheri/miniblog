<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AppController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AppController::class, 'index'])->name('welcome');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {


    Route::get('/dashboard', [AppController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => '/posts/'], function () {
        Route::get('index', [PostController::class, 'index'])->name('posts');
        Route::get('create', [PostController::class, 'create'])->name('posts.create');
        Route::post('store', [PostController::class, 'store'])->name('posts.store');
        Route::get('show/{id}', [PostController::class, 'show'])->name('posts.show');
        Route::get('single/{id}', [PostController::class, 'showSinglePost'])->name('posts.single');
        Route::post('like/', [PostController::class, 'likeSinglePost'])->name('posts.like');
        Route::get('update/', [PostController::class, 'update'])->name('posts.update');
        Route::get('destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

});




