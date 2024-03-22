<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\AdminMahasiswaController;
use App\Http\Controllers\AdminProgramStudiController;

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
    return view('index');
});

Auth::routes();
Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::resource('/admin/program-studi', AdminProgramStudiController::class);
Route::resource('/admin/dosen', AdminDosenController::class);
Route::resource('/admin/mahasiswa', AdminMahasiswaController::class);
