<?php

use App\Http\Controllers\admin\BidangPendidikanController;
use App\Http\Controllers\admin\JenisKegiatanController;
use App\Http\Controllers\admin\JenisMingguController;
use App\Http\Controllers\admin\JenisRegistrasiController;
use App\Http\Controllers\admin\JenisRppController;
use App\Http\Controllers\admin\JenisGerejaController;
use App\Http\Controllers\admin\JenisStatusController;
use App\Http\Controllers\admin\KategoriMataAnggaranController;
use App\Http\Controllers\admin\SetSentralisasiController;
use App\Http\Controllers\admin\StatusController;
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

// Route untuk Jenis Kegiatan
Route::get("/jenis-kegiatan", [JenisKegiatanController::class, 'index'])->name('JenisKegiatan.index');
Route::get("/jenis-kegiatan/tambah", [JenisKegiatanController::class, 'create'])->name('JenisKegiatan.create');
Route::post("/jenis-kegiatan/simpan", [JenisKegiatanController::class, 'store'])->name('JenisKegiatan.store');
Route::get("/jenis-kegiatan/edit/{id}", [JenisKegiatanController::class, 'edit'])->name('JenisKegiatan.edit');
Route::post("/jenis-kegiatan/update/{id}", [JenisKegiatanController::class, 'update'])->name('JenisKegiatan.update');
Route::get("/jenis-kegiatan/detail", [JenisKegiatanController::class, 'detail'])->name('JenisKegiatan.detail');
Route::delete('jenis-kegiatan/delete', [JenisKegiatanController::class, 'delete'])->name('JenisKegiatan.delete');

// Route untuk Jenis Minggu
Route::get("/jenis-minggu", [JenisMingguController::class, 'index'])->name('JenisMinggu.index');
Route::get("/jenis-minggu/tambah", [JenisMingguController::class, 'create'])->name('JenisMinggu.create');
Route::post("/jenis-minggu/simpan", [JenisMingguController::class, 'store'])->name('JenisMinggu.store');
Route::get("/jenis-minggu/edit/{id}", [JenisMingguController::class, 'edit'])->name('JenisMinggu.edit');
Route::post("/jenis-minggu/update/{id}", [JenisMingguController::class, 'update'])->name('JenisMinggu.update');
Route::get("/jenis-minggu/detail", [JenisMingguController::class, 'detail'])->name('JenisMinggu.detail');
Route::delete('jenis-minggu/delete', [JenisMingguController::class, 'delete'])->name('JenisMinggu.delete');

// Route untuk Jenis Registrasi
Route::get("/jenis-registrasi", [JenisRegistrasiController::class, 'index'])->name('JenisRegistrasi.index');
Route::get("/jenis-registrasi/tambah", [JenisRegistrasiController::class, 'create'])->name('JenisRegistrasi.create');
Route::post("/jenis-registrasi/simpan", [JenisRegistrasiController::class, 'store'])->name('JenisRegistrasi.store');
Route::get("/jenis-registrasi/edit/{id}", [JenisRegistrasiController::class, 'edit'])->name('JenisRegistrasi.edit');
Route::post("/jenis-registrasi/update/{id}", [JenisRegistrasiController::class, 'update'])->name('JenisRegistrasi.update');
Route::get("/jenis-registrasi/detail", [JenisRegistrasiController::class, 'detail'])->name('JenisRegistrasi.detail');
Route::delete('jenis-registrasi/delete', [JenisRegistrasiController::class, 'delete'])->name('JenisRegistrasi.delete');

// Route untuk Jenis Rpp
Route::get("/jenis-rpp", [JenisRppController::class, 'index'])->name('JenisRpp.index');
Route::get("/jenis-rpp/tambah", [JenisRppController::class, 'create'])->name('JenisRpp.create');
Route::post("/jenis-rpp/simpan", [JenisRppController::class, 'store'])->name('JenisRpp.store');
Route::get("/jenis-rpp/edit/{id}", [JenisRppController::class, 'edit'])->name('JenisRpp.edit');
Route::post("/jenis-rpp/update/{id}", [JenisRppController::class, 'update'])->name('JenisRpp.update');
Route::get("/jenis-rpp/detail", [JenisRppController::class, 'detail'])->name('JenisRpp.detail');
Route::delete('jenis-rpp/delete', [JenisRppController::class, 'delete'])->name('JenisRpp.delete');

// Route Untuk Jenis Gereja
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
