<?php

use App\Http\Controllers\ProfilesControlle;
use App\Http\Controllers\UserController;
use App\Mail\EmailConfirm;
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

Route::prefix('/profile')->group(function () {
    Route::get('/index', [ProfilesControlle::class, 'index'])->name('profile.index');
    Route::post('/store', [ProfilesControlle::class, 'store'])->name('profile.store');
});

// categorias

// produtos
