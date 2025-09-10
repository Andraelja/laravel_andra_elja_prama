<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\DokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\JenisController;
use App\Http\Controllers\Admin\KategoriPengeluaranController;
use App\Http\Controllers\Admin\PriceListController;
use App\Http\Controllers\Admin\ResepsionisController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\AntrianController;
use App\Http\Controllers\Admin\DataPengeluaranController;
use App\Http\Controllers\Admin\DataRekamMedisController;
use App\Http\Controllers\Admin\GrafikController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Admin\SuratPengantarRontgenController;
use App\Http\Controllers\Admin\SuratSakitController;
use Illuminate\Support\Facades\Artisan;

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

//Clear All:
Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>Berhasil dibersihkan</h1>';
});

Route::get('/', function () {
    return view('welcome');
});


// Authentication
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// kirim otp
Route::get('/otp', [LoginController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/otp/resend', [LoginController::class, 'resendOtp'])->name('otp.resend.get');

// Dashboard
Route::get('/keluar', [HomeController::class, 'keluar']);
Route::get('/admin/home', [HomeController::class, 'index']);
Route::get('/dokter/home', [HomeController::class, 'index']);
Route::get('/admin/home/filter/{id}', [HomeController::class, 'index']);
Route::get('/admin/change', [HomeController::class, 'change']);
Route::post('/admin/change_password', [HomeController::class, 'change_password']);

// Jenis
Route::prefix('admin/jenis')
    ->name('admin.jenis.')
    ->middleware('cekLevel:1 2 3')
    ->controller(JenisController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Price
Route::prefix('admin/price')
    ->name('admin.Price.')
    ->middleware('cekLevel:1 2 3')
    ->controller(PriceListController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Kategori
Route::prefix('admin/kategori')
    ->name('admin.kategori.')
    ->middleware('cekLevel:1 2 3')
    ->controller(KategoriPengeluaranController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Metode Pembayaran
Route::prefix('admin/metode_pembayaran')
    ->name('admin.metode_pembayaran.')
    ->middleware('cekLevel:1 2 3')
    ->controller(MetodePembayaranController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

//Dokter
Route::prefix('admin/dokter')
    ->name('admin.dokter.')
    ->middleware('cekLevel:1 2 3 4')
    ->controller(DokterController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::post('/updateStatus/{id}', [DokterController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/resetPassword/{id}', [DokterController::class, 'resetPassword'])->name('resetPassword');
    });

//Resepsionis
Route::prefix('admin/resepsionis')
    ->name('admin.resepsionis.')
    ->middleware('cekLevel:1 2 3 4')
    ->controller(ResepsionisController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::post('/updateStatus/{id}', [ResepsionisController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/resetPassword/{id}', [ResepsionisController::class, 'resetPassword'])->name('resetPassword');
    });
Route::post('/resetPassword/{id}', [ResepsionisController::class, 'resetPassword'])->name('resetPassword');

//Pasien
Route::prefix('admin/pasien')
    ->name('admin.pasien.')
    ->middleware('cekLevel:1 2 3 4 5')
    ->controller(PasienController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/kabupaten', 'getKabupaten')->name('getKabupaten');
        Route::get('/kecamatan', 'getkecamatan')->name('getkecamatan');
        Route::get('/kelurahan', 'getkelurahan')->name('getkelurahan');
    });

// Antrian
Route::prefix('admin/antrian')
    ->name('admin.antrian.')
    ->middleware('cekLevel:1 2 3')
    ->controller(AntrianController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/filter/{tgl}', 'read_filter')->name('read_filter');
        Route::get('/add', 'add')->name('add');
        Route::get('/cek', 'cek')->name('cek');
        Route::post('/cek', 'create')->name('create');
        Route::get('/addDokter', 'addDokter')->name('addDokter');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/selesai', 'selesai')->name('selesai');
        Route::get('/tunggu', 'tunggu')->name('tunggu');
        Route::get('/antri', 'antri')->name('antri');
        Route::get('/proses', 'proses')->name('proses');
        Route::get('/belum_bayar', 'belum_bayar')->name('belum_bayar');
        Route::post('/update-status/{id}', 'updateStatus')->name('updateStatus');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/filter/{tanggal}/{page}', 'filter')->name('filter');
        Route::get('/detail/{id_pasien}', 'detail')->name('detail');
        Route::get('/rekam_medis/{id_pasien}', 'rekamMedisIndex')->name('rekamMedisIndex');
        Route::post('/rekam_medis/create', 'create_rekam')->name('create_rekam');
        Route::post('/pembayaran/{id}', 'pembayaran')->name('pembayaran');
    });

//Surat Sakit
Route::prefix('admin/surat/surat_sakit')
    ->name('admin.surat.surat_sakit.')
    ->middleware('cekLevel:1 2 3 4')
    ->controller(SuratSakitController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::post('/cetak/{id_pasien}', 'cetak')->name('cetak');
    });

//surat Pengantar Rontgen
Route::prefix('admin/surat/pengantar_rontgen')
    ->name('admin.surat.pengantar_rontgen.')
    ->middleware('cekLevel:1 2 3')
    ->controller(SuratPengantarRontgenController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::post('/cetak/{id_pasien}', 'cetak')->name('cetak');
    });

//data rekam medis
Route::prefix('admin/rekam_medis/')
    ->name('admin.rekam_medis.')
    ->middleware('cekLevel:1 2 3')
    ->controller(DataRekamMedisController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add/{id}', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/delete/{id_pasien}', 'delete')->name('delete');
        Route::get('/detail/{id_pasien}', 'detail')->name('detail');
    });

// Data Pengeluaran
Route::prefix('admin/pengeluaran')
    ->name('admin.pengeluaran.')
    ->middleware('cekLevel:1 2 3')
    ->controller(DataPengeluaranController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

//Grafik
Route::prefix('admin/grafik')
    ->name('admin.grafik.')
    ->middleware('cekLevel:1 2 3 4 5')
    ->controller(GrafikController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/data', 'data')->name('data');
        Route::get('/data-per-cabang', 'dataPerCabang')->name('dataPerCabang');
    });

// Report routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/report/income-expense', [ReportController::class, 'incomeExpenseReport'])->name('admin.report.income-expense');
});
