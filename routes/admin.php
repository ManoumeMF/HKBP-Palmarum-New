<?php

use App\Http\Controllers\admin\BidangPendidikanController;
use App\Http\Controllers\admin\PendidikanController;
use App\Http\Controllers\admin\JenisKegiatanController;
use App\Http\Controllers\admin\JenisMingguController;
use App\Http\Controllers\admin\JenisRegistrasiController;
use App\Http\Controllers\admin\JenisRppController;
use App\Http\Controllers\admin\JenisGerejaController;
use App\Http\Controllers\admin\JenisStatusController;
use App\Http\Controllers\admin\KategoriMataAnggaranController;
use App\Http\Controllers\admin\SetSentralisasiController;
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
