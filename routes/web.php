<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\Master\ProductController;
use App\Http\Controllers\Admin\Master\SupplierController;
use App\Http\Controllers\Admin\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'role:admin-supplier-user']], function () {
    Route::prefix('admin')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('product', ProductController::class);
        Route::resource('supplier', SupplierController::class);

        Route::resource('transaksi', TransaksiController::class);

        Route::get('/get-products/{supplier_id}', [TransaksiController::class, 'getProductsBySupplier']);

        Route::get('/export-items-pdf/{transaksi_id}', [TransaksiController::class, 'exportItemsPdf']);
        Route::get('/export-pdf', [TransaksiController::class, 'exportPdf'])->name('export-pdf');

        Route::resource('profile', ProfileController::class);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
