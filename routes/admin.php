<?php

use App\Http\Controllers\admin\BidangPendidikanController;
use App\Http\Controllers\admin\PendidikanController;
use App\Http\Controllers\admin\JenisStatusController;
use App\Http\Controllers\admin\StatusController;
use App\Http\Controllers\admin\PekerjaanController;
use App\Http\Controllers\admin\HubunganKeluargaController;
use App\Http\Controllers\admin\BankController;
use App\Http\Controllers\admin\GolonganDarahController;
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

// Route untuk Pendidikan
Route::get("/pendidikan", [PendidikanController::class, 'index'])->name('Pendidikan.index');
Route::post("/pendidikan/simpan", [PendidikanController::class, 'store'])->name('Pendidikan.store');
Route::get("/pendidikan/tambah", [PendidikanController::class, 'create'])->name('Pendidikan.create');
Route::get("/pendidikan/edit/{id}", [PendidikanController::class, 'edit'])->name('Pendidikan.edit');
Route::post("/pendidikan/update/{id}", [PendidikanController::class, 'update'])->name('Pendidikan.update');
Route::delete('/pendidikan/hapus', [PendidikanController::class, 'delete'])->name('Pendidikan.delete');
Route::get('/pendidikan/detail',[PendidikanController::class, 'detail'])->name('Pendidikan.detail');

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

// Route untuk Pekerjaan
Route::get("/pekerjaan", [PekerjaanController::class, 'index'])->name('Pekerjaan.index');
Route::post("/pekerjaan/simpan", [PekerjaanController::class, 'store'])->name('Pekerjaan.store');
Route::get("/pekerjaan/tambah", [PekerjaanController::class, 'create'])->name('Pekerjaan.create');
Route::get("/pekerjaan/edit/{id}", [PekerjaanController::class, 'edit'])->name('Pekerjaan.edit');
Route::post("/pekerjaan/update/{id}", [PekerjaanController::class, 'update'])->name('Pekerjaan.update');
Route::delete('/pekerjaan/hapus', [PekerjaanController::class, 'delete'])->name('Pekerjaan.delete');
Route::get('/pekerjaan/detail',[PekerjaanController::class, 'detail'])->name('Pekerjaan.detail');

// Route untuk Hubungan Keluarga
Route::get("/hubunganKeluarga", [HubunganKeluargaController::class, 'index'])->name('HubunganKeluarga.index');
Route::post("/hubunganKeluarga/simpan", [HubunganKeluargaController::class, 'store'])->name('HubunganKeluarga.store');
Route::get("/hubunganKeluarga/tambah", [HubunganKeluargaController::class, 'create'])->name('HubunganKeluarga.create');
Route::get("/hubunganKeluarga/edit/{id}", [HubunganKeluargaController::class, 'edit'])->name('HubunganKeluarga.edit');
Route::post("/hubunganKeluarga/update/{id}", [HubunganKeluargaController::class, 'update'])->name('HubunganKeluarga.update');
Route::delete('/hubunganKeluarga/hapus', [HubunganKeluargaController::class, 'delete'])->name('HubunganKeluarga.delete');
Route::get('/hubunganKeluarga/detail',[HubunganKeluargaController::class, 'detail'])->name('HubunganKeluarga.detail');

// Route untuk Bank
Route::get("/bank", [BankController::class, 'index'])->name('Bank.index');
Route::post("/bank/simpan", [BankController::class, 'store'])->name('Bank.store');
Route::get("/bank/tambah", [BankController::class, 'create'])->name('Bank.create');
Route::get("/bank/edit/{id}", [BankController::class, 'edit'])->name('Bank.edit');
Route::post("/bank/update/{id}", [BankController::class, 'update'])->name('Bank.update');
Route::delete('/bank/hapus', [BankController::class, 'delete'])->name('Bank.delete');
Route::get('/bank/detail',[BankController::class, 'detail'])->name('Bank.detail');

// Route untuk Golongan Darah
Route::get("/golonganDarah", [GolonganDarahController::class, 'index'])->name('GolonganDarah.index');
Route::post("/golonganDarah/simpan", [GolonganDarahController::class, 'store'])->name('GolonganDarah.store');
Route::get("/golonganDarah/tambah", [GolonganDarahController::class, 'create'])->name('GolonganDarah.create');
Route::get("/golonganDarah/edit/{id}", [GolonganDarahController::class, 'edit'])->name('GolonganDarah.edit');
Route::post("/golonganDarah/update/{id}", [GolonganDarahController::class, 'update'])->name('GolonganDarah.update');
Route::delete('/golonganDarah/hapus', [GolonganDarahController::class, 'delete'])->name('GolonganDarah.delete');
Route::get('/golonganDarah/detail',[GolonganDarahController::class, 'detail'])->name('GolonganDarah.detail');