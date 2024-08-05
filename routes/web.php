<?php

use App\Http\Controllers\admin\BankGerejaController;
use App\Http\Controllers\admin\DistrikController;
use App\Http\Controllers\admin\PelayananIbadahController;
use App\Http\Controllers\admin\RessortController;
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
    return view('welcome');
});

Route::get('/ressort', [RessortController::class, 'index'])->name('Ressort');
Route::get('/ressort/create', [RessortController::class, 'tambah'])->name('Ressort.create');
Route::post('/ressort/store', [RessortController::class, 'store'])->name('Ressort.store');
Route::get('/ressort/detail', [RessortController::class, 'getRessortDetail'])->name('Ressorts.detail');
Route::delete('/ressort/delete', [RessortController::class, 'deleteRessort'])->name('Ressorts.delete');
Route::get('/ressort/{id}/edit', [RessortController::class, 'edit'])->name('Ressort.edit');
Route::post('/ressort/{id}', [RessortController::class, 'update'])->name('Ressort.update');
Route::get('/subdistricts/search', [RessortController::class, 'search'])->name('subdistricts.search');

// ROUTE DISTRIK
Route::get('/distrik', [DistrikController::class, 'index'])->name('Distrik');
Route::get('/distrik/create', [DistrikController::class, 'tambah'])->name('Distrik.create');
Route::post('/distrik/store', [DistrikController::class, 'store'])->name('Distrik.store');
Route::get('/distrik/detail', [DistrikController::class, 'getDistrikDetail'])->name('Distrik.detail');
Route::delete('/distrik/delete', [DistrikController::class, 'deleteDistrik'])->name('Distrik.delete');



// ROUTE BANK
Route::get('/bank', [BankGerejaController::class, 'index'])->name('Bank');
Route::get('/bank/create', [BankGerejaController::class, 'create'])->name('Bank.create');
Route::post('/bank/store', [BankGerejaController::class, 'store'])->name('Bank.store');
Route::get('/bank/detail', [BankGerejaController::class, 'bankDetail'])->name('Bank.detail');
Route::get('/bank/{id}/edit', [BankGerejaController::class, 'edit'])->name('Bank.edit');
Route::post('/bank/{id}', [BankGerejaController::class, 'update'])->name('Bank.update');
Route::delete('/bank/delete', [BankGerejaController::class, 'deleteBank'])->name('Bank.delete');


// ROUTE PELAYANAN IBADAH
Route::get('/pelayanan-ibadah', [PelayananIbadahController::class, 'index'])->name('PelayananIbadah');
Route::get('/pelayanan-ibadah/create', [PelayananIbadahController::class, 'create'])->name('PelayananIbadah.create');
Route::post('/pelayanan-ibadah/store', [PelayananIbadahController::class, 'store'])->name('PelayananIbadah.store');
Route::get('/pelayanan-ibadah/detail', [PelayananIbadahController::class, 'PelayananIbadahDetail'])->name('PelayananIbadah.detail');
Route::get('/pelayanan-ibadah/{id}/edit', [PelayananIbadahController::class, 'edit'])->name('PelayananIbadah.edit');
Route::post('/pelayanan-ibadah/{id}', [PelayananIbadahController::class, 'update'])->name('PelayananIbadah.update');
Route::delete('/pelayanan-ibadah/delete', [PelayananIbadahController::class, 'deletePelayananIbadah'])->name('PelayananIbadah.delete');


