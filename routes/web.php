<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PanganController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PasarController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\Setting;
use App\Models\User;
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

// _________________Users Views_______________


Route::resource('/', FrontendController::class);
Route::get('/komoditas',[FrontendController::class ,'komoditas']);
Route::get('/komoditas/{nama}',[FrontendController::class ,'showkomoditas']);
Route::resource('/aduan-pasar', AduanController::class);






// ________________Dashboard admin & Operator__________________
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [PanganController::class, 'dashboard'])->middleware('auth','verified');
Route::resource('/dashboard/master-data', PanganController::class)->middleware('auth');
Route::resource('/dashboard/komoditas', KomoditasController::class)->middleware('admin','auth');
Route::resource('/dashboard/barang', BarangController::class)->middleware('admin','auth');
Route::resource('/dashboard/pasar', PasarController::class)->middleware('auth');
Route::resource('/dashboard/satuan', SatuanController::class)->middleware('admin','auth');
Route::resource('/dashboard/buat-akun', UserController::class)->middleware('admin','auth');
// download export excel
Route::get('/export',[PanganController::class ,'export'])->middleware('auth')->name('exportByDate');

// update keterangan
// Route::put('/dashboard/master-data/keterangan/{pangan:id}' ,[PanganController::class,'updateketerangan'])->middleware('auth')->name('updateketerangan');

// settings app resource
Route::resource('/dashboard/setting-app', SettingController::class)->middleware('auth');



Route::put('/dashboard/setting-app/updatetext/{setting:id}' ,[SettingController::class, 'updatetext'])->middleware('auth')->name('update-text');

require __DIR__.'/auth.php';
