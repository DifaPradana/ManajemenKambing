<?php

use App\Http\Controllers\DataKambingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PenjualanController;
use App\Models\Penjualan;
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
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    //PENERIMAAN
    Route::get('/penerimaan_kambing', [PenerimaanController::class, 'index'], function () {
        return view('penerimaan');
    })->name('penerimaan');
    Route::post('/penerimaan_kambing', [PenerimaanController::class, 'create'])->name('create');
    Route::put('/penerimaan_kambing/{id}', [PenerimaanController::class, 'update'])->name('penerimaan_update');
    Route::delete('/penerimaan_kambing/{id}', [PenerimaanController::class, 'destroy'])->name('penerimaan_delete');


    //KAMBING
    Route::get('/data_kambing', [DataKambingController::class, 'index'], function () {
        return view('admin.data-kambing');
    })->name('data-kambing');
    Route::get('/form-kambing/{id}', [DataKambingController::class, 'showByPenerimaan'], function () {
        return view('admin.form-kambing');
    })->name('form-kambing');
    Route::post('/form-kambing', [DataKambingController::class, 'create'])->name('create-kambing');
    Route::put('/form-kambing/{id}', [DataKambingController::class, 'update'])->name('update-kambing');
    Route::delete('/form-kambing/{id}', [DataKambingController::class, 'destroy'])->name('delete-kambing');

    //PENJUALAN
    Route::get('/form_penjualan', [PenjualanController::class, 'form'], function () {
        return view('admin.penjualan');
    })->name('form-penjualan');

    Route::get('/penjualan_kambing', [PenjualanController::class, 'index'], function () {
        return view('admin.penjualan');
    })->name('data-penjualan');
});
