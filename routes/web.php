<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PekerjaProyekController;

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

// home
// Route::get('/', function () {
//     return view('dashboard');
// })->middleware('auth');

// Login
Route::get('/loginpage', function () {
    return view('login');
})->name('login')->middleware('guest');

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

// Pekerja Proyek
Route::resource('/pekerjaProyek', PekerjaProyekController::class)->except('create', 'edit', 'update', 'show')->middleware('auth');
Route::controller(PekerjaProyekController::class)->group(function () {
    Route::get('pekerjaProyek/create/{proyek}', 'customCreate')->middleware('auth');
});

// Pegawai
Route::resource('/pegawai', PegawaiController::class)->except('show')->middleware('auth');

// Proyek
Route::resource('/proyek', ProyekController::class)->middleware('auth');


// Bidang
Route::resource('/bidang', BidangController::class)->except('show')->middleware('auth');

// Denda
// Route::resource('/denda', DendaController::class)->except('show')->middleware('auth');
// Route::controller(DendaController::class)->group(function () {
//     Route::get('/denda/getData/{kode_rental}', 'getData')->middleware('auth');
// });
// login
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'auth');
    Route::get('/login', 'auth')->middleware('guest');

    Route::post('/logout', 'logout');
    Route::get('/logout', 'logout')->middleware('guest');
});
