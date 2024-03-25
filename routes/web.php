<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilesControlle;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
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
            Route::get('/index', 'index')->name('index')->can('user_adm_menu');
            Route::put('/status', 'status')->name('status')->can('user_adm_menu');
            Route::get('/search', 'search')->name('search')->can('user_adm_menu');
        });

    Route::prefix('/comprador')
        ->controller(CompradorController::class)
        ->name('comprador.')
        ->group(function () {
            Route::get('/index', 'index')->name('index')->can('user_adm_menu');
            Route::get('search', 'search')->name('search')->can('user_adm_menu');
        });

    Route::prefix('/produtos')
        ->controller(ProductController::class)
        ->name('product.')
        ->group(function () {
            Route::get('index',  'index')->name('index')->can('user_ven_and_adm');
            Route::get('search', 'search')->name('search')->can('user_ven_and_adm');
            Route::get('create', 'create')->name('create')->can('user_ven_and_adm');
            Route::post('store', 'store')->name('store')->can('user_ven_and_adm');
            Route::prefix('/{product_id}')->group(function () {
                Route::get('edit', 'edit')->name('edit')->can('user_ven_and_adm');
                Route::put('update/', 'update')->name('update')->can('user_ven_and_adm');
                Route::get('show/', 'show')->name('show')->can('user_ven_and_adm');
                Route::post('/img', 'img')->name('img')->can('user_ven_and_adm');
                Route::put('/img/{img_id}/edit', 'imgEdit')->name('imgEdit')->can('user_ven_and_adm');
                Route::get('/img/{img_id}/remove', 'imgRemove')->name('imgRemove')->can('user_ven_and_adm');
            });
        });

    Route::prefix('/compra')
        ->controller(CompraController::class)
        ->name('compra.')
        ->group(function () {
            Route::get('/index', 'index')->name('index')->can('user_all');
            Route::get('/addItem/{product_id}', 'addItem')->name('addItem')->can('user_com_menu');
            Route::get('/carrinho', 'carrinho')->name('carrinho')->can('user_com_menu');
            Route::get('/{user_id}/finalizar', 'finalizar')->name('finalizar')->can('user_com_menu');
            Route::get('search', 'search')->name('search');
        });

    // ***************************************************************************************
    // ***************************************************************************************
    // ***************************************************************************************
    Route::prefix('/service')
        ->controller(ServiceController::class)
        ->name('service.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/service_days_allowed/{id}', 'service_days_allowed')->name('service_days_allowed');
        });


    Route::prefix('/client')
        ->controller(ClientController::class)
        ->name('client.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });


    Route::prefix('/schedule')
        ->controller(ScheduleController::class)
        ->name('schedule.')
        ->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::prefix('/{schedule_id}')->group(function () {
                Route::get('/add_service', 'add_service')->name('add_service');
                Route::post('/add_service_store', 'addServiceStore')->name('addServiceStore');
                Route::get('/show', 'show')->name('show');
            });
        });
});
