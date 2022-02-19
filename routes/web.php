<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailPerjalananDinasController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisAngkutanController;
use App\Http\Controllers\KwintansiController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PerjalananDinasController;
use App\Http\Controllers\PerjalananDinasUserController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SPPDController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Models\PerjalananDinasUser;
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

Route::get('/', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('/login/auth', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'uploadAva'])->name('profile.ava.upload');
    Route::patch('/profile/avatar/delete/{user}', [ProfileController::class, 'deleteAva'])->name('profile.ava.remove');
    Route::patch('/profile/password', [ProfileController::class, 'updatePass'])->name('profile.password.change');

    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');
        Route::patch('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/{id}',[UserController::class,'show'])->name('user.show');

        Route::get('/perjalanan', [PerjalananDinasController::class, 'index'])->name('perjalanan.index');
        Route::get('/perjalanan/{id}/edit', [PerjalananDinasController::class, 'edit'])->name('perjalanan.edit');
        Route::get('/perjalanan/{id}', [PerjalananDinasController::class, 'show'])->name('perjalanan.show');
        Route::delete('/perjalanan/{id}/delete', [PerjalananDinasController::class, 'destroy'])->name('perjalanan.destroy');
        Route::patch('/perjalanan/{id}/update', [PerjalananDinasController::class, 'update'])->name('perjalanan.update');

        Route::get('/user/{id}/riwayat', [RiwayatController::class, 'index'])->name('user.riwayat');

        Route::patch('/admin/jabatan/update', [JabatanController::class, 'update'])->name('admin.jabatan.update');
        Route::patch('/admin/angkutan/update', [JenisAngkutanController::class, 'update'])->name('admin.angkutan.update');
        Route::patch('/admin/pangkat/update', [PangkatController::class, 'update'])->name('admin.pangkat.update');
        Route::patch('/admin/golongan/update', [GolonganController::class, 'update'])->name('admin.golongan.update');

        // Master of All
        Route::resources([
            'golongan' => GolonganController::class,
            'jabatan' => JabatanController::class,
            'angkutan' => JenisAngkutanController::class,
            'pangkat' => PangkatController::class
        ]);

        /*
         * Riwayat pejalanan dinas
         *
         * */
        Route::get('/perjalanan/{id}/riwayat/create', [DetailPerjalananDinasController::class, 'create'])->name('perjalanan.riwayat.create');
        Route::post('/perjalanan/{id}/riwayat', [DetailPerjalananDinasController::class, 'store'])->name('perjalanan.riwayat.store');
        Route::delete('/perjalanan/{perjalananId}/riwayat/{riwayatId}', [DetailPerjalananDinasController::class, 'destroy'])->name('perjalanan.riwayat.destroy');
        Route::patch('/perjalanan/{perjalananId}/riwayat/{riwayatId}/edit', [DetailPerjalananDinasController::class, 'edit'])->name('perjalanan.riwayat.edit');

        Route::post('/perjalanan/store', [PerjalananDinasController::class, 'storeAsAdmin'])->name('admin.perjalanan.store');

        Route::get('/kwitansi/{id}/print', [KwintansiController::class, 'print'])->name('kwitansi.print');
        Route::get('/kwitansi', [KwintansiController::class, 'index'])->name('kwitansi.index');
        Route::get('/kwitansi/{id}/file', [KwintansiController::class, 'showFile'])->name('kwitansi.file');
        Route::get('/kwitansi/{id}/edit', [KwintansiController::class, 'edit'])->name('kwitansi.edit');
        Route::patch('/kwitansi/{id}/update', [KwintansiController::class, 'update'])->name('kwitansi.update');

        Route::post('/perjalanan/kwitansi/store', [KwintansiController::class, 'store'])->name('kwitansi.store');

        Route::get('/surattugas', [SuratTugasController::class, 'getAsAdmin'])->name('admin.surattugas.index');
        Route::get('/sppd', [SPPDController::class, 'getAsAdmin'])->name('admin.sppd.index');
        Route::get('/sppd/rekap', [SPPDController::class, 'getRekap'])->name('admin.rekap.index');
        Route::post('/sppd/rekap/', [SPPDController::class, 'getForRekap'])->name('admin.rekap.pilih');
        Route::get('/sppd/rekap/print/{start}/{end}', [SPPDController::class, 'printRekap'])->name('admin.rekap.print');
    });


    Route::get('/kwitansi', [KwintansiController::class, 'index'])->name('kwitansi.index');
    Route::post('/kwitansi', [KwintansiController::class, 'store'])->name('kwitansi.store');
    Route::patch('/kwitansi/{id}/setuju', [KwintansiController::class, 'updateComplete'])->name('kwitansi.complete');
    Route::patch('/kwitansi/{id}/tolak', [KwintansiController::class, 'tolakBukti'])->name('kwitansi.pengajuan.tolak');

    Route::get('/perjalanan/{id}/print', [PerjalananDinasController::class, 'print'])->name('perjalanan.print');
    Route::post('/perjalanan/{id}/anggota', [PerjalananDinasUserController::class, 'store'])->name('perjalanan.anggota.store');
    Route::delete('/perjalanan/{id}/{userId}', [PerjalananDinasUserController::class, 'destroy'])->name('perjalanan.anggota.destroy');
    Route::get('/perjalanan/{perjalananId}/anggota/{userId}/print', [PerjalananDinasUserController::class, 'print'])->name('perjalanan.anggota.print');
    Route::patch('/perjalanan/{perjalananId}/status/cancel', [PerjalananDinasController::class, 'cancelStatus'])->name('perjalanan.status.cancel');

    Route::prefix('pegawai')->middleware('role:pegawai')->group(function () {
        Route::get('/', [PerjalananDinasUserController::class, 'index'])->name('pegawai.perjalanan');
        Route::get('/perjalanan/{id}', [PerjalananDinasController::class, 'show'])->name('pegawai.perjalanan.show');
        Route::get('/perjalanan/{id}/edit', [PerjalananDinasController::class, 'edit'])->name('pegawai.perjalanan.edit');
        Route::patch('/perjalanan/{perjalananId}/status/createToSub', [PersetujuanController::class, 'statusCreateToSub'])->name('status.st.sub');
        Route::delete('/perjalanan/{id}/delete',[PerjalananDinasController::class,'destroy'])->name('pegawai.perjalanan.destroy');
        Route::delete('/perjalanan/{id}/anggota/{userId}', [PerjalananDinasUserController::class, 'destroy'])->name('pegawai.perjalanan.anggota.destroy');
        Route::post('/perjalanan/{perjalananId}/bukti', [KwintansiController::class, 'store'])->name('bukti.upload');
        Route::post('/perjalanan/store',[PerjalananDinasController::class, 'store'])->name('perjalanan.store');
        Route::patch('/perjalanan/{id}/update',[PerjalananDinasController::class, 'update'])->name('pegawai.perjalanan.update');
        /*
        Route::get('/perjalanan/create', [PerjalananDinasController::class, 'create'])->name('pegawai.perjalanan.create');*/

        Route::get('/surattugas', [SuratTugasController::class, 'getAsUser'])->name('pegawai.surattugas.index');
        Route::get('/sppd', [SPPDController::class, 'getAsUser'])->name('pegawai.spd.index');

    });

    Route::prefix('kakan')->middleware('role:kakan')->group(function () {
        /*Route::get('/', [HomeController::class, 'index'])->name('kakan.dashboard');*/
        Route::get('/persetujuan', [PersetujuanController::class, 'index'])->name('kakan.persetujuan');
        Route::get('/persetujuan/{id}', [PerjalananDinasController::class, 'tampil'])->name('kakan.persetujuan.show');
    });

    Route::prefix('kaur')->middleware('role:kaur')->group(function () {
        Route::get('/persetujuan', [PersetujuanController::class, 'index'])->name('kaur.perjalanan');
        Route::get('/persetujuan/{id}', [PerjalananDinasController::class, 'tampil'])->name('kaur.perjalanan.show');
    });

    Route::prefix('kasubag')->middleware('role:kasubag')->group(function () {
        Route::get('/persetujuan', [PersetujuanController::class, 'index'])->name('kasubag.perjalanan');
        Route::get('/persetujuan/{id}', [PerjalananDinasController::class, 'tampil'])->name('kasubag.perjalanan.show');
    });

   /* Route::post('upload', [UploadController::class, 'buktiUpload']);*/
//    Route::delete('/upload/bukti/delete', [UploadController::class, 'hapusBukti'])->name('bukti.temp.hapus');

    Route::patch('/perjalanan/{perjalananId}/status/subToOn', [PersetujuanController::class, 'statusSubToOn'])->name('status.st.on');
    Route::patch('/perjalanan/{perjalananId}/status/onToSTAcc', [PersetujuanController::class, 'statusOnToSTAcc'])->name('status.st.acc');
    Route::patch('/perjalanan/{perjalananId}/status/stReject', [PersetujuanController::class, 'statusSTReject'])->name('status.st.rej');
    Route::patch('/perjalanan/{perjalananId}/status/stAccToSpdOn', [PersetujuanController::class, 'statusSTAccToOnSPD'])->name('status.spd.on');
    Route::patch('/perjalanan/{perjalananId}/status/spdOnToReview', [PersetujuanController::class, 'statusOnSPDToReview'])->name('status.spd.review');
    Route::patch('/perjalanan/{perjalananId}/status/spdOnToSpdKuAcc', [PersetujuanController::class, 'statusOnSPDToAccKU'])->name('status.spd.acc.ku');
    Route::patch('/perjalanan/{perjalananId}/status/spdKuAccToKsAcc', [PersetujuanController::class, 'statusAccKUToAccKs'])->name('status.spd.acc.ks');
    Route::patch('/perjalanan/{perjalananId}/status/spdAccKk', [PersetujuanController::class, 'statusAccKsToAcc'])->name('status.spd.acc.kk');
    Route::patch('/perjalanan/{perjalananId}/status/spdAcc', [PersetujuanController::class, 'statusAccToCompleteAcc'])->name('status.spd.acc.complete');
    Route::patch('/perjalanan/{perjalananId}/status/complete', [PersetujuanController::class, 'statusCompleteAccToFinish'])->name('status.spd.finish');


    Route::resource('perjalanan', PerjalananDinasController::class);

});
