<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Models\Denda;

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
// Mobil
Route::resource('/mobil', MobilController::class)->except('show')->middleware('auth');

// Customer
Route::resource('/customer', CustomerController::class)->except('show')->middleware('auth');

// Rental
Route::resource('/rental', RentalController::class)->except('show')->middleware('auth');

// Denda
Route::resource('/denda', DendaController::class)->except('show')->middleware('auth');
Route::controller(DendaController::class)->group(function () {
    Route::get('/denda/getData/{kode_rental}', 'getData')->middleware('auth');
});
// login
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'auth');
    Route::get('/login', 'auth')->middleware('guest');

    Route::post('/logout', 'logout');
    Route::get('/logout', 'logout')->middleware('guest');
});
