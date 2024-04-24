<?php

use App\Http\Controllers\admin\BidangPendidikanController;
use App\Http\Controllers\admin\JenisStatusController;
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