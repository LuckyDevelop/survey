<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\AdminSurveyController;
use App\Http\Controllers\AdminPeriodeController;
use App\Http\Controllers\AdminIsiSurveyController;
use App\Http\Controllers\AdminJenisSurveyController;
use App\Http\Controllers\AdminMahasiswaController;
use App\Http\Controllers\AdminProgramStudiController;
use App\Http\Controllers\AdminUnitKerjaController;
use App\Http\Controllers\AdminTenagaPendidikController;
use App\Http\Controllers\HasilSurveyController;

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
Route::get('/word', [HasilSurveyController::class, 'word']);
Auth::routes();
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => 'CheckRole:admin'], function () {
        Route::resource('/admin/program-studi', AdminProgramStudiController::class);
        Route::resource('/admin/dosen', AdminDosenController::class);
        Route::resource('/admin/mahasiswa', AdminMahasiswaController::class);
        Route::resource('/admin/periode', AdminPeriodeController::class);
        Route::resource('/admin/mahasiswa', AdminMahasiswaController::class);
        Route::resource('/admin/survey', AdminSurveyController::class);
        Route::put('/admin/survey/{id}/update-status', [AdminSurveyController::class, 'updateStatus']);
        Route::resource('/admin/jenis-survey', AdminJenisSurveyController::class);
        Route::resource('/admin/unit-kerja', AdminUnitKerjaController::class);
        Route::resource('/admin/tenaga-pendidik', AdminTenagaPendidikController::class);

        Route::get('/admin/hasil-survey', [HasilSurveyController::class, 'index']);
        Route::get('/admin/hasil-survey/{id}', [HasilSurveyController::class, 'show']);
        Route::get('/admin/hasil-survey/survey-responden/{id}/{survey_id}', [HasilSurveyController::class, 'surveyResponden']);
        Route::get('/admin/hasil-survey/rekap-survey/{id}', [HasilSurveyController::class, 'rekapSurvey']);
        Route::get('/admin/hasil-survey/cetak-pdf/{id}', [HasilSurveyController::class, 'cetakPdf'])->name('cetak_pdf');
        Route::get('/admin/hasil-survey/cetak-word/{id}', [HasilSurveyController::class, 'cetakWord'])->name('cetak_word');
        Route::get('/preview-word', [HasilSurveyController::class, 'showWordPreview'])->name('showWordPreview');
    });

    Route::group(['middleware' => 'CheckRole:dosen,mahasiswa,unit kerja,tenaga pendidik'], function () {
        Route::get('/admin/isi-survey', [AdminIsiSurveyController::class, 'index']);
        Route::get('/admin/isi-survey/{id}', [AdminIsiSurveyController::class, 'create']);
        Route::post('/admin/isi-survey', [AdminIsiSurveyController::class, 'store']);
    });
});