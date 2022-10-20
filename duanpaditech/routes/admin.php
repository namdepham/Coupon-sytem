<?php

use App\Http\Controllers\Admin\AppAdminController;
use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\StampController;
use App\Http\Controllers\Admin\StampImageController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserCouponController;
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

Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.showlogin');
Route::post('login', [LoginController::class, 'login'])->name('admin.login');


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    //App setting
    Route::get('/app', [AppController::class, 'index'])->name('app.index');
    Route::get('app/create', [AppController::class, 'create'])->name('app.create');
    Route::post('app/create', [AppController::class, 'store'])->name('app.store');
    Route::get('app/{app}/edit', [AppController::class, 'show'])->name('app.edit');
    Route::put('app/{app}/edit', [AppController::class, 'update'])->name('app.update');
    Route::delete('app/{app}/delete', [AppController::class, 'destroy'])->name('app.destroy');

    //App admin setting
    Route::get('/app-admin', [AppAdminController::class, 'index'])->name('appAdmin.index');
    Route::get('/app-admin/filter', [AppAdminController::class, 'filterAdmins'])->name('filter.admin');
    Route::get('/app-admin/create', [AppAdminController::class, 'create'])->name('appAdmin.create');
    Route::post('/app-admin/create', [AppAdminController::class, 'store'])->name('appAdmin.store');
    Route::get('/app-admin/{id}/edit', [AppAdminController::class, 'show'])->name('appAdmin.edit');
    Route::put('/app-admin/{id}/edit', [AppAdminController::class, 'update'])->name('appAdmin.update');
    Route::delete('/app-admin/{id}/delete', [AppAdminController::class, 'destroy'])->name('appAdmin.destroy');

    //Stamp setting
    Route::get('/stamp', [StampController::class, 'index'])->name('stamp.index');
    Route::get('/stamp/create', [StampController::class, 'create'])->name('stamp.create');
    Route::post('/stamp/create', [StampController::class, 'store'])->name('stamp.store');
    Route::get('/stamp/{stamp}/edit', [StampController::class, 'show'])->name('stamp.edit');
    Route::put('/stamp/{stamp}/edit', [StampController::class, 'update'])->name('stamp.update');
    Route::delete('/stamp/{stamp}/delete', [StampController::class, 'destroy'])->name('stamp.destroy');
    Route::get('admin/image/create', [StampImageController::class, 'create'])->name('stamp.createImage');

    //Stamp Image Setting
    Route::get('/image', [StampImageController::class, 'index'])->name('image.index');
    Route::get('/image/create', [StampImageController::class, 'create'])->name('image.create');
    Route::post('/image/create', [StampImageController::class, 'store'])->name('image.store');
    Route::get('/image/{image}/edit', [StampImageController::class, 'show'])->name('image.edit');
    Route::put('/image/{image}/edit', [StampImageController::class, 'update'])->name('image.update');
    Route::delete('/image/{image}/delete', [StampImageController::class, 'destroy'])->name('image.destroy');

    //Coupon Setting
    Route::get('/coupon', [CouponController::class, 'index'])->name('coupon.index');
    Route::get('/coupon/create', [CouponController::class, 'create'])->name('coupon.create');
    Route::post('/coupon/create', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/coupon/{coupon}/edit', [CouponController::class, 'show'])->name('coupon.edit');
    Route::put('/coupon/{coupon}/edit', [CouponController::class, 'update'])->name('coupon.update');
    Route::delete('/coupon/{coupon}/delete', [CouponController::class, 'destroy'])->name('coupon.destroy');

    //Store Setting
    Route::get('/store/index', [StoreController::class, 'index'])->name('store.index');
    Route::get('/store/import-stores', [StoreController::class, 'importStores'])->name('import.stores');
    Route::post('/store/upload-stores', [StoreController::class, 'uploadStores'])->name('upload.stores');

    //User Coupon Setting
    Route::get('/user/coupon/index', [UserCouponController::class, 'index'])->name('user.coupon.index');
    Route::post('/user/coupon/export-user-coupons', [UserCouponController::class, 'exportFile'])->name('exportFile.user.coupon');
});
