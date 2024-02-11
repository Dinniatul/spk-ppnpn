<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NilaiTriwulanController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PPNPNController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/prosesLogin', [AuthController::class, 'prosesLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'atasan.langsung'])->group(function () {
    // Rute yang hanya dapat diakses setelah login
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users-create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::get('/users/delete/{id}', [UserController::class, 'destroy']);
    //kriteria
    Route::get('/kriteria', [KriteriaController::class, 'index']);
    Route::post('/kriteria', [KriteriaController::class, 'store']);
    Route::put('/kriteria/{idKr}', [KriteriaController::class, 'update']);
    Route::get('/kriteria/delete/{idKr}', [KriteriaController::class, 'destroy']);
    //ppnpn    
    Route::get('/ppnpn', [PPNPNController::class, 'index']);
    Route::post('/ppnpn', [PPNPNController::class, 'store']);
    Route::put('/ppnpn/{idPPNPN}', [PPNPNController::class, 'update']);
    Route::get('/ppnpn/delete/{idPPNPN}', [PPNPNController::class, 'destroy']);
    //periode
    Route::get('/periode', [PeriodeController::class, 'index']);
    Route::post('/periode', [PeriodeController::class, 'store']);
    Route::put('/periode/{idPr}', [PeriodeController::class, 'update']);
    Route::get('/periode/delete/{idPr}', [PeriodeController::class, 'destroy']);
    //penilaian

    Route::put('/konversi/{idNtr}', [NilaiTriwulanController::class, 'konversi']);
    Route::get('/nilai-triwulan/delete/{idNtr}', [NilaiTriwulanController::class, 'destroy']);
    // Route::put('/konversi/{idNtr}', [NilaiTriwulanController::class, 'konversiNilai']);

    Route::get('/perhitungan', [PerhitunganController::class, 'index']);
    Route::get('/laporan', [LaporanController::class, 'index']);
});

Route::get('/nilai-triwulan', [NilaiTriwulanController::class, 'index']);
Route::get('/nilai-triwulan/create', [NilaiTriwulanController::class, 'create']);
Route::post('/nilai-triwulan', [NilaiTriwulanController::class, 'store']);
Route::put('/nilai-triwulan/{idNtr}', [NilaiTriwulanController::class, 'update']);
