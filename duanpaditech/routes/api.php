<?php

use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/v1/stamp_card', [HomeController::class, 'listStampUser'])->name('list.stamp.user');
Route::post('/v1/stamp_card/add_stamp', [HomeController::class, 'addStampUser'])->name('add.stamp.user');
