<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKambingController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SupplierController;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/', [LoginController::class, 'login'])->name('login-post');
Route::post('/login', [LoginController::class, 'login'])->name('login-post');


//Register
Route::get('/register', function () {
    return view('register');
})->name('registerPage');

Route::post('/register', [LoginController::class, 'register'])->name('register');

//LOGOUT
Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    //DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'], function () {
        return view('admin.dashboard');
    })->name('dashboard');

    //SUPPLIER
    Route::get('/supplier', [SupplierController::class, 'index'], function () {
        return view('admin.supplier');
    })->name('supplier');
    Route::post('/supplier', [SupplierController::class, 'create'])->name('create-supplier');
    Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('update-supplier');
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('delete-supplier');

    //PELANGGAN
    Route::get('/pelanggan', [PelangganController::class, 'index'], function () {
        return view('admin.pelanggan');
    })->name('pelanggan');
    Route::post('/pelanggan', [PelangganController::class, 'create'])->name('create-pelanggan');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('update-pelanggan');
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('delete-pelanggan');


    //PENERIMAAN
    Route::get('/penerimaan_kambing', [PenerimaanController::class, 'index'], function () {
        return view('penerimaan');
    })->name('penerimaan');
    Route::post('/penerimaan_kambing', [PenerimaanController::class, 'create'])->name('create');
    Route::put('/penerimaan_kambing/{id}', [PenerimaanController::class, 'update'])->name('penerimaan_update');
    Route::delete('/penerimaan_kambing/{id}', [PenerimaanController::class, 'destroy'])->name('penerimaan_delete');

    //KATEGORI
    Route::get('/kategori_kambing', [KategoriController::class, 'index'], function () {
        return view('admin.kategori');
    })->name('kategori-view');
    Route::post('/kategori_kambing', [KategoriController::class, 'create'])->name('kategori-create');
    Route::put('/kategori_kambing/{id}', [KategoriController::class, 'update'])->name('kategori-update');
    Route::delete('/kategori_kambing/{id}', [KategoriController::class, 'destroy'])->name('kategori-delete');

    //JENIS
    Route::get('/jenis_kambing', [JenisController::class, 'index'], function () {
        return view('admin.jenis');
    })->name('jenis-view');
    Route::post('/jenis_kambing', [JenisController::class, 'create'])->name('jenis-create');
    Route::put('/jenis_kambing/{id}', [JenisController::class, 'update'])->name('jenis-update');
    Route::delete('/jenis_kambing/{id}', [JenisController::class, 'destroy'])->name('jenis-delete');


    //KAMBING
    Route::get('/form_data_kambing_awal', [DataKambingController::class, 'indexUpdate'], function () {
        return view('admin.penerimaan-update');
    })->name('data-kambing-awal');
    Route::delete('/delete_data_kambing/{id}', [DataKambingController::class, 'destroyDataKambing'])->name('delete-kambings');

    Route::get('/form_data_kambing_akhir', [DataKambingController::class, 'indexUpdateAkhir'], function () {
        return view('admin.form-kambing-akhir');
    })->name('data-kambing-akhir');

    Route::post('/form_data_kambing_akhir', [DataKambingController::class, 'createDataKambingAkhir'])->name('create-kambing-akhir');


    Route::get('/form-kambing-update/{id}', [DataKambingController::class, 'updateView'], function () {
        return view('admin.form-kambing');
    })->name('form-kambing-update');
    Route::get('/form-kambing-update-akhir/{id}', [DataKambingController::class, 'updateAkhirView'], function () {
        return view('admin.form-kambing');
    })->name('form-kambing-update-akhir');
    Route::put('/form-kambing-update/{id}', [DataKambingController::class, 'updateAkhir'])->name('update-kambing-akhir');


    Route::get('/data_kambing', [DataKambingController::class, 'index'], function () {
        return view('admin.data-kambing');
    })->name('data-kambing');


    Route::get('/form-kambing/{id}', [DataKambingController::class, 'showByPenerimaan'], function () {
        return view('admin.form-kambing');
    })->name('form-kambing');
    Route::post('/form-kambing', [DataKambingController::class, 'create'])->name('create-kambing');

    Route::put('/form-kambing-update/{id}', [DataKambingController::class, 'update'])->name('update-kambing');
    Route::put('/form-kambing-update-akhir/{id}', [DataKambingController::class, 'updateAkhir'])->name('update-kambing-akhir');
    Route::delete('/form-kambing/{id}', [DataKambingController::class, 'destroy'])->name('delete-kambing');

    //PENJUALAN
    Route::get('/form_penjualan', [PenjualanController::class, 'form'], function () {
        return view('admin.penjualan');
    })->name('form-penjualan');

    Route::get('/penjualan_kambing', [PenjualanController::class, 'index'], function () {
        return view('admin.penjualan');
    })->name('data-penjualan');


    Route::post('/form_penjualan', [PenjualanController::class, 'create'])->name('create-penjualan');
    Route::delete('/form_penjualan/{id}', [PenjualanController::class, 'destroy'])->name('delete-penjualan');

    Route::get('/checkout/{id}', [CheckoutController::class, 'checkoutView'], function () {
        return view('admin.checkout');
    })->name('checkoutView');
    Route::put('/checkout/{id}', [CheckoutController::class, 'checkout'])->name('checkout');
});
