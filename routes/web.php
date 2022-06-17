<?php

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
Route::get('/produksi', [App\Http\Controllers\ProduksiController::class, 'index'])->name('produksi');
Route::get('/produksi/rekap', [App\Http\Controllers\ProduksiController::class, 'rekap'])->name('produksi.rekaps');
Route::get('/produksi/hasil/rekap/harian', [App\Http\Controllers\ProduksiController::class, 'rekap_harian_hasil'])->name('produksi.rekap.hasil.harian');
Route::get('/produksi/rekap/harian', [App\Http\Controllers\ProduksiController::class, 'rekap_harian'])->name('produksi.rekap.harian');
Route::get('/produksi/rekap/bulanan', [App\Http\Controllers\ProduksiController::class, 'rekap_bulanan'])->name('produksi.rekap.bulanan');
Route::get('/produksi/pdf', [App\Http\Controllers\ProduksiEksportController::class, 'displayReportexcel'])->name('produksi.export.pdf');;

Route::post('/produksi/pos', [App\Http\Controllers\ProduksiController::class, 'pos'])->name('produksis.pos');
Route::post('/produksi/pos/update', [App\Http\Controllers\ProduksiController::class, 'update'])->name('produksi.pos.update');
Route::post('/produksi/pos/delete', [App\Http\Controllers\ProduksiController::class, 'destroy'])->name('produksi.pos.destroy');
Route::get('/produksi/create', [App\Http\Controllers\ProduksiController::class, 'create'])->name('produksi.create');
Route::get('/produksi/export', [App\Http\Controllers\ProdukExportController::class, 'export'])->name('produksi.export');
Route::get('/produksi/export/view', [App\Http\Controllers\ProduksiController::class, 'export'])->name('produksi.export.view');
Route::post('/produksi/edit', [App\Http\Controllers\ProduksiController::class, 'edit'])->name('produksi.edit');
Route::get('/produksi/create/cek', [App\Http\Controllers\ProduksiController::class, 'cek'])->name('produksi.create.cek');
Route::post('/produksi/create/cek/update', [App\Http\Controllers\ProduksiController::class, 'update'])->name('produksi.create.cek.update');
Route::get('/produksi/creates', [App\Http\Controllers\ProduksiController::class, 'creates'])->name('produksi.creates');
Route::post('/produksi/creates', [App\Http\Controllers\ProduksiController::class, 'creates'])->name('produksi.creates');
Route::post('/produksi/creates/pos', [App\Http\Controllers\ProduksiController::class, 'pos'])->name('produksi.pos');
Route::post('/produksi/store', [App\Http\Controllers\ProduksiController::class, 'store'])->name('produksi.store');  
Route::post('/produksi/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');  

Route::get('/hasil', [App\Http\Controllers\HasilProduksiController::class, 'index'])->name('produksi.hasil');
Route::get('/hasil/tambah', [App\Http\Controllers\HasilProduksiController::class, 'tambah'])->name('produksi.hasil.tambah');
Route::post('/hasil/tambah/store', [App\Http\Controllers\HasilProduksiController::class, 'store'])->name('produksi.hasil.store');
