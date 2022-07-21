<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});
Route::get('/home', function () {
    return redirect('produksi');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
   Route::get('/produksi', [App\Http\Controllers\ProduksiController::class, 'index'])->name('produksi');
Route::get('/produksi/rekap', [App\Http\Controllers\ProduksiController::class, 'rekap'])->name('produksi.rekaps');
Route::get('/produksi/hasil/rekap/harian', [App\Http\Controllers\ProduksiController::class, 'rekap_harian_hasil'])->name('produksi.rekap.hasil.harian');
Route::get('/p/rekap/harian', [App\Http\Controllers\ProduksiController::class, 'rekap_harian'])->name('produksi.rekap.harian');
Route::get('/p/rekap/bulanan', [App\Http\Controllers\ProduksiController::class, 'rekap_bulanan'])->name('produksi.rekap.bulanan');
Route::get('/produksi/pdf', [App\Http\Controllers\ProduksiEksportController::class, 'displayReport'])->name('produksi.export.pdf');;

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


Route::get('/inventori', [App\Http\Controllers\InventoriController::class, 'index'])->name('inventori');
Route::get('/inventori/rekap', [App\Http\Controllers\InventoriController::class, 'rekap'])->name('inventori.rekaps');
Route::get('/inventori/hasil/rekap/harian', [App\Http\Controllers\InventoriController::class, 'rekap_harian_hasil'])->name('inventori.rekap.hasil.harian');
Route::get('/inventori/rekap/harian', [App\Http\Controllers\InventoriController::class, 'rekap_harian'])->name('inventori.rekap.harian');
Route::get('/inventori/rekap/bulanan', [App\Http\Controllers\InventoriController::class, 'rekap_bulanan'])->name('inventori.rekap.bulanan');
Route::get('/inventori/pdf', [App\Http\Controllers\InventoriController::class, 'displayReport'])->name('inventori.export.pdf');;

Route::post('/inventori/pos', [App\Http\Controllers\InventoriController::class, 'pos'])->name('produksis.pos');
Route::post('/inventori/pos/update', [App\Http\Controllers\InventoriController::class, 'update'])->name('inventori.pos.update');
Route::post('/inventori/pos/delete', [App\Http\Controllers\InventoriController::class, 'destroy'])->name('inventori.pos.destroy');
Route::get('/inventori/create', [App\Http\Controllers\InventoriController::class, 'create'])->name('inventori.create');
Route::get('/i/b/keluar', [App\Http\Controllers\InventoriController::class, 'bkeluar'])->name('inventori.keluar');
Route::get('/i/b/masuk', [App\Http\Controllers\InventoriController::class, 'bmasuk'])->name('inventori.masuk');
Route::get('/i/rekap/harian', [App\Http\Controllers\InventoriController::class, 'rekap_harian'])->name('inventori.rekap.harian');
Route::get('/i/rekap/bulanan', [App\Http\Controllers\InventoriController::class, 'rekap_bulanan'])->name('inventori.rekap.bulanan');
Route::get('/inventori/bs', [App\Http\Controllers\InventoriController::class, 'tambahbs'])->name('inventori.bs');
Route::post('/inventori/bs/store', [App\Http\Controllers\InventoriController::class, 'bs'])->name('inventori.storebs');
Route::get('/inventori/export', [App\Http\Controllers\ProdukExportController::class, 'export'])->name('inventori.export');
Route::get('/inventori/export/view', [App\Http\Controllers\InventoriController::class, 'export'])->name('inventori.export.view');
Route::post('/inventori/edit', [App\Http\Controllers\InventoriController::class, 'edit'])->name('inventori.edit');
Route::get('/inventori/create/cek', [App\Http\Controllers\InventoriController::class, 'cek'])->name('inventori.create.cek');
Route::post('/inventori/create/cek/update', [App\Http\Controllers\InventoriController::class, 'update'])->name('inventori.create.cek.update');
Route::get('/inventori/creates', [App\Http\Controllers\InventoriController::class, 'creates'])->name('inventori.creates');
Route::post('/inventori/creates', [App\Http\Controllers\InventoriController::class, 'creates'])->name('inventori.creates');
Route::post('/inventori/creates/pos', [App\Http\Controllers\InventoriController::class, 'pos'])->name('inventori.pos');
Route::post('/inventori/store', [App\Http\Controllers\InventoriController::class, 'store'])->name('inventori.store');  
Route::post('/inventori/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');  

Route::get('/penjualan', [App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan');
Route::post('/penjualan/store', [App\Http\Controllers\PenjualanController::class, 'store'])->name('penjualan.store');
Route::post('/penjualan/delete/{penjualan}', [App\Http\Controllers\PenjualanController::class, 'delete'])->name('penjualan.delete');
Route::get('/penjualan/edit/b/{penjualan}', [App\Http\Controllers\PenjualanController::class, 'editbahan'])->name('penjualan.editbahan');
Route::post('/penjualan/edit/b/update/{penjualan}', [App\Http\Controllers\PenjualanController::class, 'updatebahan'])->name('penjualan.updatebahan');
Route::get('/penjualan/detail/{penjualan}', [App\Http\Controllers\PenjualanController::class, 'show'])->name('penjualan.show');
Route::get('/penjualan/create', [App\Http\Controllers\PenjualanController::class, 'create'])->name('penjualan.create');
Route::get('/penjualan/rekap/harian', [App\Http\Controllers\PenjualanController::class, 'rekap_harian'])->name('penjualan.rekap.harian');
Route::get('/penjualan/rekap/bulanan', [App\Http\Controllers\PenjualanController::class, 'rekap_bulanan'])->name('penjualan.rekap.bulanan');
Route::get('/penjualan/pdf', [App\Http\Controllers\PenjualanController::class, 'displayReport'])->name('penjualan.export.pdf');;

Route::get('/keuangan', [App\Http\Controllers\KeuanganController::class, 'index'])->name('keuangan');
Route::post('/keuangan/store', [App\Http\Controllers\KeuanganController::class, 'store'])->name('keuangan.store');
Route::post('/keuangan/delete/{keuangan}', [App\Http\Controllers\KeuanganController::class, 'delete'])->name('keuangan.delete');
Route::get('/keuangan/edit/{keuangan}', [App\Http\Controllers\KeuanganController::class, 'edit'])->name('keuangan.edit');
Route::post('/keuangan/edit/update/{keuangan}', [App\Http\Controllers\KeuanganController::class, 'update'])->name('keuangan.update');
Route::get('/keuangan/detail/{keuangan}', [App\Http\Controllers\KeuanganController::class, 'show'])->name('keuangan.show');
Route::get('/keuangan/create', [App\Http\Controllers\KeuanganController::class, 'create'])->name('keuangan.create');
Route::get('/keuangan/rekap/harian', [App\Http\Controllers\KeuanganController::class, 'rekap_harian'])->name('keuangan.rekap.harian');
Route::get('/keuangan/rekap/bulanan', [App\Http\Controllers\KeuanganController::class, 'rekap_bulanan'])->name('keuangan.rekap.bulanan');
Route::get('/keuangan/pdf', [App\Http\Controllers\KeuanganController::class, 'displayReport'])->name('keuangan.export.pdf');;

Route::get('/distributor', [App\Http\Controllers\DistributorController::class, 'index'])->name('distributor');
Route::get('/distributor/create', [App\Http\Controllers\DistributorController::class, 'create'])->name('distributor.create');
Route::post('/distributor/store', [App\Http\Controllers\DistributorController::class, 'store'])->name('distributor.store');
});

