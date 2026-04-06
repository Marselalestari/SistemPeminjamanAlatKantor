<?php

// Import class Route untuk membuat routing
use Illuminate\Support\Facades\Route;

/* =========================
   IMPORT CONTROLLER
========================= */

// Controller untuk fitur umum
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAlatController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KategoriController;

/* Controller khusus Admin */
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AlatController;

/* Controller khusus Operator */
use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\Operator\PeminjamanController as OperatorPeminjamanController;


/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

// Route halaman utama ("/")
// Ketika user membuka website, akan menampilkan view "welcome"
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT BERDASARKAN ROLE
|--------------------------------------------------------------------------
*/

// Route dashboard yang hanya bisa diakses user login (middleware auth)
Route::middleware('auth')->get('/dashboard', function () {

    // Ambil data user yang sedang login
    $user = auth()->user();

    // Cek role user dan arahkan ke dashboard sesuai role
    return match ($user->role) {
        'admin'    => redirect()->route('admin.dashboard'),     // jika admin
        'operator' => redirect()->route('operator.dashboard'),  // jika operator
        default    => redirect()->route('user.dashboard'),      // selain itu (user biasa)
    };

})->name('dashboard');


/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

// Group route untuk USER
Route::middleware(['auth', 'user']) // harus login & role user
    ->prefix('user') // URL diawali /user
    ->name('user.')  // nama route diawali user.
    ->group(function () {

        // Dashboard user
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');


        /* =========================
           FITUR LIHAT ALAT
        ========================= */

        // Menampilkan daftar alat
        Route::get('/lihat-alat', [UserAlatController::class, 'index'])
            ->name('alat.index');

        // Menampilkan detail alat berdasarkan ID
        Route::get('/lihat-alat/{alat}', [UserAlatController::class, 'show'])
            ->name('alat.show');


        /* =========================
           FITUR PEMINJAMAN
        ========================= */

        // Menampilkan daftar peminjaman user
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        // Form tambah peminjaman
        Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])
            ->name('peminjaman.create');

        // Simpan data peminjaman ke database
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])
            ->name('peminjaman.store');
    });


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

// Group route untuk ADMIN
Route::middleware(['auth', 'admin']) // harus login & role admin
    ->prefix('admin') // URL diawali /admin
    ->name('admin.')  // nama route diawali admin.
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Resource controller untuk CRUD alat
        Route::resource('alat', AlatController::class);

        // Resource controller untuk CRUD pengguna
        Route::resource('pengguna', PenggunaController::class);

        // Resource controller untuk CRUD kategori
        Route::resource('kategori', KategoriController::class);
    });


/*
|--------------------------------------------------------------------------
| OPERATOR ROUTES
|--------------------------------------------------------------------------
*/

// Group route untuk OPERATOR
Route::middleware(['auth', 'operator']) // harus login & role operator
    ->prefix('operator') // URL diawali /operator
    ->name('operator.')  // nama route diawali operator.
    ->group(function () {

        /* =========================
           DASHBOARD
        ========================= */

        // Dashboard operator
        Route::get('/dashboard', [OperatorDashboardController::class, 'index'])
            ->name('dashboard');


        /* =========================
           CETAK STRUK & DENDA
        ========================= */

        // Cetak struk peminjaman
        Route::get('/peminjaman/{peminjaman}/cetak-struk', [OperatorDashboardController::class, 'cetakStruk'])
            ->name('peminjaman.cetak-struk');

        // Simpan denda peminjaman
        Route::post('/peminjaman/{peminjaman}/simpan-denda', [OperatorDashboardController::class, 'simpanDenda'])
            ->name('peminjaman.simpan-denda');

        // Simpan denda manual dari cetak struk (operator)
        Route::post('/peminjaman/{peminjaman}/simpan-denda-struk', [OperatorPeminjamanController::class, 'simpanDendaStruk'])
            ->name('peminjaman.simpan-denda-struk');

        /* =========================
           DATA PEMINJAMAN
        ========================= */

        // Menampilkan semua data peminjaman
        Route::get('/peminjaman', [OperatorPeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        // Form tambah peminjaman
        Route::get('/peminjaman/create', [OperatorPeminjamanController::class, 'create'])
            ->name('peminjaman.create');

        // Simpan peminjaman
        Route::post('/peminjaman', [OperatorPeminjamanController::class, 'store'])
            ->name('peminjaman.store');


        /* =========================
           APPROVAL PEMINJAMAN
        ========================= */

        // Approve peminjaman
        Route::post('/peminjaman/{peminjaman}/approve', [OperatorPeminjamanController::class, 'approve'])
            ->name('peminjaman.approve');

        // Reject peminjaman
        Route::post('/peminjaman/{peminjaman}/reject', [OperatorPeminjamanController::class, 'reject'])
            ->name('peminjaman.reject');


        /* =========================
           PENGEMBALIAN
        ========================= */

        // Proses pengembalian alat
        Route::post('/peminjaman/{peminjaman}/kembalikan', [OperatorPeminjamanController::class, 'kembalikan'])
            ->name('peminjaman.kembalikan');


        /* =========================
           LAPORAN
        ========================= */

        // Laporan bulanan peminjaman
        Route::get('/peminjaman/laporan-bulanan', [OperatorPeminjamanController::class, 'laporanBulanan'])
            ->name('peminjaman.laporan-bulanan'); // pakai kebab-case biar konsisten
    });


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

// Route untuk mengelola profil user (harus login)
Route::middleware('auth')->group(function () {

    // Form edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // Update data profil
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Hapus akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// Memanggil route bawaan Laravel untuk login, register, dll
require __DIR__.'/auth.php';