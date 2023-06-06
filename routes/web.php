<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilesControlle;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendedorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('confirm-email', [UserController::class, 'confirm_email']);

Route::middleware('auth')->group(function () {
    Route::prefix('/profile')
        ->controller(ProfilesControlle::class)
        ->group(function () {
            Route::get('/index', 'index')->name('profile.index');
            Route::post('/store',  'store')->name('profile.store');
        });

    Route::prefix('/vendedor')
        ->controller(VendedorController::class)
        ->name('vendedor.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::put('/status', 'status')->name('status');
            Route::get('/search', 'search')->name('search');
        });

    Route::prefix('/comprador')
        ->controller(CompradorController::class)
        ->name('comprador.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('search', 'search')->name('search');
        });

    Route::prefix('/produtos')
        ->controller(ProductController::class)
        ->name('product.')
        ->group(function () {
            Route::get('index',  'index')->name('index');
            Route::get('search', 'search')->name('search');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{product_id}', 'edit')->name('edit');
            Route::put('update/{product_id}', 'update')->name('update');
            Route::get('show/{product_id}', 'show')->name('show');
            Route::post('{product_id}/img', 'img')->name('img');
            Route::put('{product_id}/img/edit/{img_id}', 'imgEdit')->name('imgEdit');
            Route::get('{product_id}/img/remove/{img_id}', 'imgRemove')->name('imgRemove');
        });

    Route::prefix('/compra')
        ->controller(CompraController::class)
        ->name('compra.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/addItem/{product_id}', 'addItem')->name('addItem');
            Route::get('/carrinho', 'carrinho')->name('carrinho');
            Route::get('/finalizar/{user_id}', 'finalizar')->name('finalizar');
            Route::get('search', 'search')->name('search');
        });
});
