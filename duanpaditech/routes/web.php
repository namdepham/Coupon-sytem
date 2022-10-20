<?php

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', [UserController::class, 'showLoginForm'])->name('user.login');
Route::get('/register', [UserController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('checkRegister')->group(function (){
    Route::get('/stamp/app/{app}/store/{store}', [HomeController::class, 'index'])->name('user.home');
    Route::get('/coupon/detail/{id}', [HomeController::class, 'couponDetail'])->name('user.coupon.detail');
    Route::put('/coupon/use/{id}', [HomeController::class, 'couponUse'])->name('user.coupon.use');
});

