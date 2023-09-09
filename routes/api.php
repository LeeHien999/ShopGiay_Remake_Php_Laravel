<?php

use App\Http\Controllers\API\APIAdminController;
use App\Http\Controllers\API\APIDanhMucController;
use App\Http\Controllers\API\APIDanhSachTaiKhoanController;
use App\Http\Controllers\API\APIKichThuocController;
use App\Http\Controllers\API\APILoaiGiayController;
use App\Http\Controllers\API\APIMauSacController;
use App\Http\Controllers\API\APIProductController;
use App\Http\Controllers\API\APIProductVariantController;
use App\Http\Controllers\API\APIQuyenController;
use App\Http\Controllers\API\APIThuongHieuController;
use App\Http\Controllers\APIGioHangController;
use App\Http\Controllers\APIHomePageController;
use App\Http\Controllers\APITrangChuController;
use App\Http\Controllers\GiayController;
use App\Http\Controllers\GioHangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('product/product-detail', [APITrangChuController::class, 'proDetail'])->name('ProductDetail');



Route::group(['prefix'  =>  '/admin'], function() {
    Route::post('/login', [APIAdminController::class, 'Adminlogin'])->name('adminLogin');
    Route::post('/create', [APIAdminController::class, 'store'])->name('adminStore');
    Route::post('/data', [APIAdminController::class, 'data'])->name('adminData');
    Route::post('/del', [APIAdminController::class, 'destroy'])->name('adminDel');
    Route::post('/update', [APIAdminController::class, 'update'])->name('adminUpdate');
    Route::post('/block', [APIAdminController::class, 'block'])->name('taiKhoanAdminBlock');


    Route::group(['prefix'  =>  '/product'], function() {
        Route::post('/create', [APIProductController::class, 'store'])->name('ProductCreate');
        Route::post('/data', [APIProductController::class, 'data'])->name('ProductData');
        Route::post('/status', [APIProductController::class, 'status'])->name('ProductStatus');
        Route::post('/update', [APIProductController::class, 'update'])->name('ProductUpdate');
        Route::post('/delete', [APIProductController::class, 'destroy'])->name('ProductDestroy');

    });

    Route::group(['prefix'  =>  '/product-variants'], function() {
        Route::post('/create', [APIProductVariantController::class, 'store'])->name('OptCreate');
        Route::post('/data', [APIProductVariantController::class, 'data'])->name('OptData');
        Route::post('/update', [APIProductVariantController::class, 'update'])->name('OptUpdate');
        Route::post('/delete', [APIProductVariantController::class, 'destroy'])->name('OptDestroy');
    });

    Route::group(['prefix'  =>  '/thuong-hieu'], function() {
        Route::post('/create', [APIThuongHieuController::class, 'store'])->name('ThuongHieuCreate');
        Route::post('/data', [APIThuongHieuController::class, 'data'])->name('ThuongHieuData');
        Route::post('/status', [APIThuongHieuController::class, 'status'])->name('ThuongHieuStatus');
        Route::post('/update', [APIThuongHieuController::class, 'update'])->name('ThuongHieuUpdate');
        Route::post('/delete', [APIThuongHieuController::class, 'destroy'])->name('ThuongHieuDestroy');

    });

    Route::group(['prefix'  =>  '/mau-sac'], function() {
        Route::post('/create', [APIMauSacController::class, 'store'])->name('MauSacCreate');
        Route::post('/data', [APIMauSacController::class, 'data'])->name('MauSacData');
        Route::post('/status', [APIMauSacController::class, 'status'])->name('MauSacStatus');
        Route::post('/update', [APIMauSacController::class, 'update'])->name('MauSacUpdate');
        Route::post('/delete', [APIMauSacController::class, 'destroy'])->name('MauSacDestroy');

    });

    Route::group(['prefix'  =>  '/kich-thuoc'], function() {
        Route::post('/create', [APIKichThuocController::class, 'store'])->name('KichThuocCreate');
        Route::post('/data', [APIKichThuocController::class, 'data'])->name('KichThuocData');
        Route::post('/status', [APIKichThuocController::class, 'status'])->name('KichThuocStatus');
        Route::post('/update', [APIKichThuocController::class, 'update'])->name('KichThuocUpdate');
        Route::post('/delete', [APIKichThuocController::class, 'destroy'])->name('KichThuocDestroy');

    });

    Route::group(['prefix'  =>  '/danh-muc'], function() {
        Route::post('/create', [APIDanhMucController::class, 'store'])->name('DanhMucCreate');
        Route::post('/data', [APIDanhMucController::class, 'data'])->name('DanhMucData');
        Route::post('/status', [APIDanhMucController::class, 'status'])->name('DanhMucStatus');
        Route::post('/update', [APIDanhMucController::class, 'update'])->name('DanhMucUpdate');
        Route::post('/delete', [APIDanhMucController::class, 'destroy'])->name('DanhMucDestroy');

    });

    Route::group(['prefix'  =>  '/danh-sach-tai-khoan'], function() {
        Route::post('/create', [APIDanhSachTaiKhoanController::class, 'store'])->name('taiKhoanStore');
        Route::post('/data', [APIDanhSachTaiKhoanController::class, 'data'])->name('taiKhoanData');
        Route::post('/status', [APIDanhSachTaiKhoanController::class, 'status'])->name('taiKhoanStatus');
        Route::post('/block', [APIDanhSachTaiKhoanController::class, 'block'])->name('taiKhoanBlock');
        Route::post('/info', [APIDanhSachTaiKhoanController::class, 'info'])->name('taiKhoanInfo');
        Route::post('/del', [APIDanhSachTaiKhoanController::class, 'destroy'])->name('taiKhoanDel');
        Route::post('/update', [APIDanhSachTaiKhoanController::class, 'update'])->name('taiKhoanUpdate');
    });
    Route::group(['prefix'  =>  '/quyen'], function() {
        Route::post('/data-quyen', [APIQuyenController::class, 'dataQuyen'])->name('dataQuyen');
        Route::post('/data-chuc-nang', [APIQuyenController::class, 'dataChucNang'])->name('dataChucNang');
        Route::post('/create', [APIQuyenController::class, 'store'])->name('quyenStore');
        Route::post('/update', [APIQuyenController::class, 'update'])->name('quyenUpdate');
        Route::post('/delete', [APIQuyenController::class, 'destroy'])->name('quyenDelete');
        Route::post('/status', [APIQuyenController::class, 'status'])->name('quyenStatus');
        Route::post('/phan-quyen', [APIQuyenController::class, 'phanQuyen'])->name('phanQuyen');
    });
});

Route::group(['prefix' => '/home'], function(){
    Route::group(['prefix'  =>  '/size'], function() {
        Route::post('/data', [APIProductController::class, 'size'])->name('SizeData');
    });

    Route::group(['prefix'  =>  '/men-products'], function() {
        Route::post('/men', [APITrangChuController::class, 'menProducts'])->name('MenData');
    });

    Route::group(['prefix'  =>  '/women-products'], function() {
        Route::post('/women', [APITrangChuController::class, 'womenProducts'])->name('womenData');
    });

    Route::group(['prefix'  =>  '/unisex-products'], function() {
        Route::post('/unisex', [APITrangChuController::class, 'sortProducts'])->name('sortProducts');
    });

    Route::post('/login', [APIDanhSachTaiKhoanController::class, 'ClientLogin'])->name('clientLogin');

    Route::post('/register', [APIDanhSachTaiKhoanController::class, 'ClientRegister'])->name('clientRegister');

    Route::post('/logout', [APIDanhSachTaiKhoanController::class, 'ClientLogout'])->name('clientLogout');
});


Route::group(['prefix' => '/client'], function(){
    Route::group(['prefix' => '/cart'], function(){
        Route::post('/data', [APIGioHangController::class, 'data'])->name('CartData');
        Route::post('/add-to-cart', [APIGioHangController::class, 'add'])->name('AddToCart');
        Route::post('/count-cart', [APIGioHangController::class, 'count'])->name('CountCart');
    });

    Route::group(['prefix' => '/reset-password'], function(){
        Route::post('/check-mail', [APIDanhSachTaiKhoanController::class, 'checkmail'])->name('CheckMail');
        Route::post('/change-password', [APIDanhSachTaiKhoanController::class, 'changePassword'])->name('ChangePassword');
    });

});

