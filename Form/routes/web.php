<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardBAKAController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardDEKANController;
use App\Http\Controllers\DashboardDSNController;
use App\Http\Controllers\DashboardKPRController;
use App\Http\Controllers\DashboardPAKAController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPWController;
use App\Http\Controllers\irsController;
use App\Http\Controllers\HerRegController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\getIrsController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\lihatIrsController;
use App\Http\Controllers\PakaController;


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');

Route::get('/home', function(){
    return redirect('/sakura');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/sakura', [AdminController::class, 'halamandashboardadmin'])->name('admindashboard');
    Route::get('/sakura/mhsdb', [AdminController::class, 'dbmhs'])->middleware('userAkses:mahasiswa')->name('mhsdb');
    Route::get('/sakura/kaprodidb', [AdminController::class, 'dbkaprodi'])->middleware('userAkses:kaprodi')->name('kaprodidb');
    Route::get('/sakura/dekandb', [AdminController::class, 'dbdekan'])->middleware('userAkses:dekan')->name('dekandb');
    Route::get('/sakura/bakmdb', [AdminController::class, 'dbbakm'])->middleware('userAkses:bakademik')->name('bakadb');
    Route::get('/sakura/pakmdb', [AdminController::class, 'dbpakm'])->middleware('userAkses:pakademik')->name('pakadb');
    Route::get('/sakura/dosendb', [AdminController::class, 'dbdosen'])->middleware('userAkses:dosen')->name('dosendb');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/sakura/mhsdb/mhsakm', [DashboardController::class, 'akademikmhs'])->middleware('userAkses:mahasiswa')->name('akademikmhs');
    Route::get('/sakura/mhsdb/mhsherreg', [DashboardController::class, 'herregmhs'])->middleware('userAkses:mahasiswa')->name('herregmhs');
    Route::get('/sakura/mhsdb/mhsherreg/konsultasi', [HerRegController::class, 'konsultasimhs'])->middleware('userAkses:mahasiswa')->name('konsultasimhs');
    Route::get('/sakura/mhsdb/mhsherreg/compose', [HerRegController::class, 'konsulcompose'])->middleware('userAkses:mahasiswa')->name('konsulcompose');
    Route::get('/sakura/mhsdb/mhsherreg/read', [HerRegController::class, 'konsulread'])->middleware('userAkses:mahasiswa')->name('konsulread');
    Route::get('/sakura/mhsdb/mhsherreg/profil', [DashboardController::class, 'profilmhs'])->middleware('userAkses:mahasiswa')->name('profilmhs');
    Route::post('/update-status', [HerRegController::class, 'updateStatus'])->middleware('userAkses:mahasiswa')->name('update.status');

    Route::get('/sakura/dosendb/dsnakm', [DashboardDSNController::class, 'akademikdsn'])->middleware('userAkses:dosen')->name('akademikdsn');
    Route::get('/sakura/dosendb/konsultasi', [DashboardDSNController::class, 'konsultasidsn'])->middleware('userAkses:dosen')->name('konsultasidsn');
    Route::get('/sakura/dosendb/compose', [DashboardDSNController::class, 'konsulcomposedsn'])->middleware('userAkses:dosen')->name('dsncompose');
    Route::get('/sakura/dosendb/read', [DashboardDSNController::class, 'konsulreaddsn'])->middleware('userAkses:dosen')->name('dsnread');

    Route::get('/sakura/kaprodidb/kprakm', [DashboardKPRController::class, 'akademikkpr'])->middleware('userAkses:kaprodi')->name('akademikkpr');
    
    // Jadwal
    Route::get('AkademikKAPRODI.jadwalkaprodi', [JadwalController::class, 'buatjadwal'])->middleware('userAkses:kaprodi')->name('jadwal');
    Route::post('AkademikKAPRODI.jadwalkaprodi', [JadwalController::class, 'storejadwal'])->middleware('userAkses:kaprodi')->name('jadwal.store');
    Route::delete('/sakura/jadwal/{id}', [JadwalController::class, 'destroyjadwal'])->name('jadwal.destroy');
    
    //---matkul-----
    Route::post('AkademikKAPRODI.matkulkaprodi', [JadwalController::class, 'storemk'])->middleware('userAkses:kaprodi')->name('matkul.store');
    // Route::get('AkademikKAPRODI.matkulkaprodi', [JadwalController::class, 'buatmatkul'])->middleware('userAkses:kaprodi')->name('matkul');
    Route::get('AkademikKAPRODI.matkulkaprodi', [MataKuliahController::class, 'index'])->middleware('userAkses:kaprodi')->name('programStudis');

   

    Route::get('/sakura/bakmdb/bakaakm', [DashboardBAKAController::class, 'akademikbaka'])->middleware('userAkses:bakademik')->name(('akademikbaka'));
    Route::post('/sakura/bakmdb/store', [DashboardBAKAController::class, 'store'])->name('ruangan.store');
    Route::delete('/sakura/bakmdb/{kode_ruang}/destroy', [DashboardBAKAController::class, 'destroy'])->name('ruangan.destroy');



    Route::get('/sakura/dekandb/dekanakm', [DashboardDEKANController::class, 'akademikdekan'])->middleware('userAkses:dekan')->name('akademikdekan');
    Route::get('/sakura/dekandb/jadwaldekan', [DashboardDEKANController::class, 'jadwaldekan'])->middleware('userAkses:dekan')->name('jadwaldekan');
    Route::get('/sakura/dekandb/ruang', [DashboardDEKANController::class, 'akademikdekan'])->name('dekan.ruang.index');
    Route::post('/sakura/dekandb/{kode_ruang}/setujui', [DashboardDEKANController::class, 'setujui'])->name('dekan.ruang.setujui');
    Route::post('/sakura/dekandb/{kode_ruang}/tolak', [DashboardDEKANController::class, 'tolak'])->name('dekan.ruang.tolak');
    Route::post('/sakura/dekandb/setujui-semua', [DashboardDEKANController::class, 'setujuiSemua'])->name('dekan.ruang.setujuiSemua');


    Route::get('/sakura/pakmdb/pakaakm', [PakaController::class, 'index'])->middleware('userAkses:pakademik')->name('akademikpaka');
    Route::post('/approve/{id}', [PakaController::class, 'approveIrs'])->middleware('userAkses:pakademik')->name('irs.approve');
    Route::patch('/reject/{id}', [PakaController::class, 'rejectIrs'])->middleware('userAkses:pakademik')->name('irs.reject');
    Route::get('/sakura/pakmdb/rekappaka', [DashboardPAKAController::class, 'rekappaka'])->middleware('userAkses:pakademik')->name('rekappaka');



});

Route::get('/register', [RegisterController::class, 'halamanregister'])->name('register');
Route::post('/simpanregister', [LoginController::class, 'simpanregister'])->name('simpanregister');
Route::get('/forgotpw', [ForgotPWController::class, 'halamanforgotpw'])->name('forgotpw');

// Menambah mata kuliah ke IRS
Route::post('/cekSksKumulatif', [irsController::class, 'cekSksKumulatif'])->name('cekSksKumulatif');
Route::post('/simpanirs', [irsController::class, 'simpanirs'])->name('simpanirs');
Route::delete('/irs/{kode_mk}', [irsController::class, 'destroy'])->name('irs.destroy');
// Route::get('/irs/{nim}/{semester}', [irsController::class, 'getIrsBySemester'])->name('getIrsBySemester');


Route::prefix('dekan')->group(function () {
    Route::get('/sakura/dekandb/jadwal', [DashboardDEKANController::class, 'jadwaldekan'])->name('dekan.jadwal.index');
    Route::post('/sakura/dekandb/jadwal/setujui/{id}', [DashboardDEKANController::class, 'setujuiJadwal'])->name('dekan.jadwal.setujui');
    Route::post('/sakura/dekandb/jadwal/tolak/{id}', [DashboardDEKANController::class, 'tolakJadwal'])->name('dekan.jadwal.tolak');
    Route::post('/sakura/dekandb/jadwal/setujui-semua', [DashboardDEKANController::class, 'setujuiSemuaJadwal'])->name('dekan.jadwal.setujuiSemua');
});




// Route::any('/simpanirs', function () {
//     return response()->json(['method' => request()->method()], 200);
// });

// Route::get('/simpanirs', [irsController::class, 'simpanirs'])->name('simpanirs');
// Route::any('/simpanirs', function () {
//     \Log::info('Method: ' . request()->method());
//     return response('Method not allowed', 405);
// });


// routes/web.php


Route::resource('mata_kuliah', JadwalController::class)->only(['index', 'storemk', 'destroymk']);

//Route::resource('mata_kuliah', JadwalController::class)->only(['index', 'store', 'destroy']);
Route::resource('mata_kuliah', MataKuliahController::class);

Route::get('/api/irs/{semester}', [getIrsController::class, 'getIrsBySemester'])->middleware('auth');
Route::get('/irs/history/pdf/{nim}', [getIrsController::class, 'exportIrsHistoryPDF'])->name('irs.history.pdf');
// Route::get('/irs/data', [lihatIrsController::class, 'getIrsData'])->name('irs.data');




