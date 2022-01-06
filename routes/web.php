<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use \App\Http\Controllers\DirectionsController;
use \App\Http\Controllers\FoodsController;
use \App\Http\Controllers\IngredientsController;
use \Illuminate\Support\Facades\App;
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
Auth::routes();
Route::redirect('/food/{id}', '/en/food/{id}');

Route::prefix("{language?}")->group(function(){
    Route::get('/', [SiteController::class, 'index'])->name('index');
    Route::get('/desserts', [SiteController::class, 'desserts'])->name('desserts');
    Route::get('/cookies', [SiteController::class, 'cookies'])->name('cookies');
    Route::get('/about', [SiteController::class, 'about'])->name('about');
    Route::get('/food/{id}', [SiteController::class, 'food'])->name('food');
    Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
});
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function(){
    Route::resource('/directions', DirectionsController::class);
    Route::resource('/foods', FoodsController::class);
    Route::resource('/ingredients', IngredientsController::class);
});
