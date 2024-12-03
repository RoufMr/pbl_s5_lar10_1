<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\LogAkunController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);

Route::post('regist', [UserController::class, 'insertRegis'])->name('regist');

Route::get('/berita', [HomeController::class, 'berita']);
Route::get('/detail/{slug}', [HomeController::class, 'detail']);
/**
 * socialite auth
 */
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    //akun
    Route::get('/profile', [LogAkunController::class, 'dataprofil'])->name("profile");
    Route::post('/edit-profile', [LogAkunController::class, 'editprofil']);
    Route::post('/edit-pw', [LogAkunController::class, 'editakun']);

    //user/pengguna
    Route::get('/data-user', [UserController::class, 'datauser'])->name('data-user');
    Route::post('/save-user', [UserController::class, 'simpanuser']);
    Route::get('/edit-user/{user_id}', [UserController::class, 'edituser'])->name('edit-user');
    Route::post('/update-user/{user_id}', [UserController::class, 'updateuser'])->name('update-user');
    Route::get('/delete-user/{user_id}', [UserController::class, 'hapususer'])->name('delete-user');

    //divisi
    Route::get('/data-divisi', [DivisiController::class, 'datadivisi'])->name('data-divisi');
    Route::post('/save-divisi', [DivisiController::class, 'simpandivisi']);
    Route::post('/update-divisi/{id_divisi}', [DivisiController::class, 'updatedivisi']);
    Route::get('/delete-divisi/{id_divisi}', [DivisiController::class, 'hapusdivisi']);

    //jadwal
    Route::get('/data-jadwal', [JadwalKegiatanController::class, 'datajadwal'])->name('data-jadwal');
    Route::post('/save-jadwal', [JadwalKegiatanController::class, 'simpanjadwal']);
    Route::post('/update-jadwal/{id}', [JadwalKegiatanController::class, 'updatejadwal']);
    Route::get('/delete-jadwal/{id}', [JadwalKegiatanController::class, 'hapusjadwal']);

    //pendaftaran
    Route::get('/data-registration', [PendaftaranController::class, 'datapendaftaran'])->name('data-registration');
    Route::get('/form-registration', [PendaftaranController::class, 'inputpendaftaran']);
    Route::post('/save-registration', [PendaftaranController::class, 'simpanpendaftaran']);
    Route::get('/edit-registration/{id_pendaftaran}', [PendaftaranController::class, 'editpendaftaran']);
    Route::post('/update-registration/{id_pendaftaran}', [PendaftaranController::class, 'updatependaftaran']);
    Route::get('/delete-registration/{id_pendaftaran}', [PendaftaranController::class, 'hapuspendaftaran']);
    Route::get('/detail-registration/{id_pendaftaran}', [PendaftaranController::class, 'detailpendaftaran']);
    Route::get('/card-registration/{id_pendaftaran}', [PendaftaranController::class, 'kartupendaftaran']);

    Route::get('/verified-registration/{id_pendaftaran}', [PendaftaranController::class, 'verifikasistatuspendaftaran']);
    Route::get('/notverified-registration/{id_pendaftaran}', [PendaftaranController::class, 'notverifikasistatuspendaftaran']);
    Route::get('/invalid-registration/{id_pendaftaran}', [PendaftaranController::class, 'invalidstatuspendaftaran']);
    Route::get('/finish-registration/{id_pendaftaran}', [PendaftaranController::class, 'selesaistatuspendaftaran']);

    //pembayaran
    Route::get('/data-payment', [PembayaranController::class, 'datapembayaran'])->name('data-pembayaran');
    Route::post('/save-payment', [PembayaranController::class, 'simpanpembayaran']);
    Route::post('/update-payment/{id_pembayaran}', [PembayaranController::class, 'updatepembayaran']);
    Route::get('/delete-payment/{id_pembayaran}', [PembayaranController::class, 'hapuspembayaran']);

    Route::post('/upload-payment', [PembayaranController::class, 'updatebuktipembayaran'])->name('upload-payment');
    Route::get('/paid-payment/{id_pembayaran}', [PembayaranController::class, 'verifikasipembayaran']);
    Route::get('/unpaid-payment/{id_pembayaran}', [PembayaranController::class, 'belumbayar']);
    Route::get('/invalid-payment/{id_pembayaran}', [PembayaranController::class, 'invalidbayar']);

    //pengumuman
    Route::get('/data-announcement', [PengumumanController::class, 'datapengumuman'])->name('data-pengumuman');
    Route::get('/view-announcement/{id_pendaftaran}', [PengumumanController::class, 'lihatpengumuman']);
    //Route::get('/view-announcement', [PengumumanController::class, 'lihatpengumuman']);
    Route::post('/save-announcement', [PengumumanController::class, 'simpanpengumuman']);
    Route::post('/update-announcement/{id_pengumuman}', [PengumumanController::class, 'updatepengumuman']);
    Route::get('/delete-announcement/{id_pengumuman}', [PengumumanController::class, 'hapuspengumuman']);

    //buat artikel
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::post('/blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

    Route::get('photo', [PhotoController::class, 'index'])->name('photo');
    Route::post('/photo/store', [PhotoController::class, 'store'])->name('photo.store');
    Route::post('/photo/update/{id}', [PhotoController::class, 'update'])->name('photo.update');
    Route::post('/photo/destroy/{id}', [PhotoController::class, 'destroy'])->name('photo.destroy');

    Route::get('video', [VideoController::class, 'index'])->name('video');
    Route::post('/video/store', [VideoController::class, 'store'])->name('video.store');
    Route::post('/video/update/{id}', [VideoController::class, 'update'])->name('video.update');
    Route::post('/video/destroy/{id}', [VideoController::class, 'destroy'])->name('video.destroy');

    Route::post('/blog/update-status', [BlogController::class, 'updateStatus'])->name('blog.updateStatus');
    Route::post('/photo/update-status', [PhotoController::class, 'updateStatus'])->name('photo.updateStatus');



});

require __DIR__.'/auth.php';
