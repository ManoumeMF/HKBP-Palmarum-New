<?php

use App\Http\Controllers\admin\BidangPendidikanController;
use App\Http\Controllers\admin\JenisGerejaController;
use App\Http\Controllers\admin\JenisStatusController;
use App\Http\Controllers\admin\KategoriMataAnggaranController;
use App\Http\Controllers\admin\SetSentralisasiController;
use App\Http\Controllers\admin\StatusController;
//use Illuminate\Routing\Route;
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

// Route untuk Bidang Pendidikan
Route::get("/bidang-pendidikan", [BidangPendidikanController::class, 'index'])->name('BidangPendidikan.index');
Route::post("/bidang-pendidikan/simpan", [BidangPendidikanController::class, 'store'])->name('BidangPendidikan.store');
Route::get("/bidang-pendidikan/tambah", [BidangPendidikanController::class, 'create'])->name('BidangPendidikan.create');
Route::get("/bidang-pendidikan/edit/{id}", [BidangPendidikanController::class, 'edit'])->name('BidangPendidikan.edit');
Route::post("/bidang-pendidikan/update/{id}", [BidangPendidikanController::class, 'update'])->name('BidangPendidikan.update');
Route::delete('/bidang-pendidikan/hapus', [BidangPendidikanController::class, 'delete'])->name('BidangPendidikan.delete');
Route::get('/bidang-pendidikan/detail',[BidangPendidikanController::class,'detail'])->name('BidangPendidikan.detail');

// Route untuk Jenis Status
Route::get("/jenis-status", [JenisStatusController::class, 'index'])->name('JenisStatus.index');
Route::post("/jenis-status/simpan", [JenisStatusController::class, 'store'])->name('JenisStatus.store');
Route::get("/jenis-status/edit", [JenisStatusController::class, 'edit'])->name('JenisStatus.edit');
Route::put("/jenis-status/update", [JenisStatusController::class, 'update'])->name('JenisStatus.update');
Route::get("/jenis-status/detail", [JenisStatusController::class, 'detail'])->name('JenisStatus.detail');
Route::delete("/jenis-status/hapus", [JenisStatusController::class, 'delete'])->name('JenisStatus.delete');

// Route untuk Status
Route::get("/status", [StatusController::class, 'index'])->name('Status.index');
Route::get("/status/tambah", [StatusController::class, 'create'])->name('Status.create');
Route::post("/status/simpan", [StatusController::class, 'store'])->name('Status.store');
Route::get("/status/edit/{id}", [StatusController::class, 'edit'])->name('Status.edit');
Route::post("/status/update/{id}", [StatusController::class, 'update'])->name('Status.update');
Route::get("/status/detail", [StatusController::class, 'detail'])->name('Status.detail');
Route::delete("/status/hapus", [StatusController::class, 'delete'])->name('Status.delete');
Route::post("/status/simpan-jenis-status", [StatusController::class, 'storeStatusType'])->name('Status.storeStatusType');
//Route::get("/status/combo-jenis-status", [StatusController::class, 'getComboJenisStatus'])->name('Status.getComboJenisStatus');

Route::get("/jenis-gereja", [JenisGerejaController::class, 'index'])->name('JenisGereja.index');
Route::get("/jenis-gereja/tambah", [JenisGerejaController::class, 'create'])->name('JenisGereja.create');
Route::post("/jenis-gereja/simpan", [JenisGerejaController::class, 'store'])->name('JenisGereja.store');
Route::get("/jenis-gereja/edit/{id}", [JenisGerejaController::class, 'edit'])->name('JenisGereja.edit');
Route::post("/jenis-gereja/update/{id}", [JenisGerejaController::class, 'update'])->name('JenisGereja.update');
Route::delete("/jenis-gereja/hapus", [JenisGerejaController::class, 'delete'])->name('JenisGereja.delete');
Route::get("/jenis-gereja/detail", [JenisGerejaController::class, 'detail'])->name('JenisGereja.detail');

Route::get("/kategori-mata-anggaran", [KategoriMataAnggaranController::class, 'index'])->name('KategoriMataAnggaran.index');
Route::get("/kategori-mata-anggaran/tambah", [KategoriMataAnggaranController::class, 'create'])->name('KategoriMataAnggaran.create');
Route::post("/kategori-mata-anggaran/simpan", [KategoriMataAnggaranController::class, 'store'])->name('KategoriMataAnggaran.store');
Route::get("/kategori-mata-anggaran/edit/{id}", [KategoriMataAnggaranController::class, 'edit'])->name('KategoriMataAnggaran.edit');
Route::post("/kategori-mata-anggaran/update/{id}", [KategoriMataAnggaranController::class, 'update'])->name('KategoriMataAnggaran.update');
Route::delete("/kategori-mata-anggaran/hapus", [KategoriMataAnggaranController::class, 'delete'])->name('KategoriMataAnggaran.delete');
Route::get("/kategori-mata-anggaran/detail", [KategoriMataAnggaranController::class, 'detail'])->name('KategoriMataAnggaran.detail');

Route::get("/sentralisasi", [SetSentralisasiController::class, 'index'])->name('Sentralisasi.index');
Route::get("/sentralisasi/tambah", [SetSentralisasiController::class, 'create'])->name('Sentralisasi.create');
Route::post("/sentralisasi/simpan", [SetSentralisasiController::class, 'store'])->name('Sentralisasi.store');
Route::get("/sentralisasi/edit/{id}", [SetSentralisasiController::class, 'edit'])->name('Sentralisasi.edit');
Route::post("/sentralisasi/update/{id}", [SetSentralisasiController::class, 'update'])->name('Sentralisasi.update');
Route::delete("/sentralisasi/hapus", [SetSentralisasiController::class, 'delete'])->name('Sentralisasi.delete');
Route::get("/sentralisasi/detail", [SetSentralisasiController::class, 'detail'])->name('Sentralisasi.detail');
