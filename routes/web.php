<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{
    DashboardController,
};

use App\Http\Controllers\admin\{
   
    ProfilPerusahaanController,
    DashboardSuperAdminController,
    BerandaController,
    ProfilAdminController,
    ManageLayananController,
    ManageKategoriController,
    ManageSubKategoriController,
    ManageProdukController,
    ManageSectionController,
    ManageInfoController,
    ManageArtikelController,
    OwnerWhatsappController,
    DaftarRiwayatPesananController,
    ApiWhatsappController,
};
use App\Http\Controllers\auth\{
    LoginController,
    RegisterController,
    GoogleController,
    ForgotPasswordController,
};
use App\Http\Controllers\web\{
    LandingController,
    ProfilWebController,
    AboutController,
    LayananController,
    ShopController,
    KeranjangController,
    PesananController,
    RiwayatPesananController,
    KontakWebController,
};
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

Route::get('/run-superadmin', function () {
    Artisan::call('db:seed', [
        '--class' => 'SuperAdminSeeder'
    ]);

    return "SuperAdminSeeder has been create successfully!";
});
// Manual
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/complete', [GoogleController::class, 'showCompleteForm'])->name('google.complete');
Route::post('/auth/google/complete-register', [GoogleController::class, 'completeRegister'])->name('google.complete.register');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestOtpForm'])->name('forgot-password');
Route::get('/forgot-password/verify', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('forgot-password.verify');
Route::get('/forgot-password/reset', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('forgot-password.reset');

Route::post('/forgot-password/request-otp', [ForgotPasswordController::class, 'requestOtp'])->name('forgot-password.request-otp');
Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot-password.verify-otp');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot-password.reset-password');


Route::group(['middleware' => ['role:superadmin']], function () {
    Route::get('whatsapp-api', [ApiWhatsappController::class, 'index'])->name('whatsapp-api.index');
    Route::post('whatsapp-api', [ApiWhatsappController::class, 'storeorupdate'])->name('whatsapp-api.storeorupdate');
    Route::get('/profil-admin', [ProfilAdminController::class, 'index'])->name('profil-admin');
    Route::put('/profil-admin/update', [ProfilAdminController::class, 'update'])->name('profil-admin.update');
    Route::get('/dashboard-superadmin', [DashboardSuperAdminController::class, 'index'])->name('dashboard-superadmin');
    Route::resource('beranda', BerandaController::class);
    Route::resource('profil-perusahaan', ProfilPerusahaanController::class);
    Route::resource('manage-layanan', ManageLayananController::class);
    Route::resource('manage-kategori', ManageKategoriController::class);
    Route::resource('manage-sub-kategori', ManageSubKategoriController::class);
    Route::resource('manage-produk', ManageProdukController::class);
    Route::get('ajax/sub-kategori', [ManageProdukController::class, 'subKategoriByKategori'])->name('ajax.sub-kategori.by-kategori');
    Route::resource('manage-section', ManageSectionController::class);
    Route::resource('manage-info', ManageInfoController::class);
    Route::resource('manage-artikel', ManageArtikelController::class);
    Route::resource('owner-whatsapp', OwnerWhatsappController::class);
    Route::get('daftar-riwayat-pesanan', [DaftarRiwayatPesananController::class, 'index'])->name('daftar-riwayat-pesanan.index');
    Route::get('daftar-riwayat-pesanan/{id}', [DaftarRiwayatPesananController::class, 'show'])->name('daftar-riwayat-pesanan.show');
    Route::put('daftar-riwayat-pesanan/{id}/update-status', [DaftarRiwayatPesananController::class, 'updateStatus'])->name('daftar-riwayat-pesanan.update-status');
});



// Public routes untuk keranjang (untuk AJAX)
Route::get('/keranjang/get', [KeranjangController::class, 'getCart'])->name('keranjang.get');



Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/layanan/detail/{judul_layanan}', [LayananController::class, 'detail'])->name('layanan.detail');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{slug}', [ShopController::class, 'detail'])->name('shop.detail');
Route::get('/kontak', [KontakWebController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [KontakWebController::class, 'store'])->name('kontak.store');
// Route untuk user
Route::group(['middleware' => ['auth']], function () {
    // Profil routes
    Route::get('/profil', [ProfilWebController::class, 'index'])->name('profil');
    Route::put('/profil/update', [ProfilWebController::class, 'update'])->name('profil.update');
    Route::put('/profil/update-password', [ProfilWebController::class, 'updatePassword'])->name('profil.update-password');
    
    // Keranjang routes
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::put('/keranjang/{keranjang}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    
    // Pesanan routes
    Route::get('/checkout', [PesananController::class, 'checkout'])->name('pesanan.checkout');
    Route::post('/checkout/process', [PesananController::class, 'processCheckout'])->name('pesanan.process');
    
    // Riwayat Pesanan routes
    Route::get('/riwayat-pesanan', [RiwayatPesananController::class, 'index'])->name('riwayat-pesanan.index');
    Route::get('/riwayat-pesanan/{id}', [RiwayatPesananController::class, 'detail'])->name('riwayat-pesanan.detail');
    Route::get('/riwayat-pesanan/{id}/invoice', [RiwayatPesananController::class, 'invoice'])->name('riwayat-pesanan.invoice');
    Route::put('/riwayat-pesanan/{id}/update-status', [RiwayatPesananController::class, 'updateStatus'])->name('riwayat-pesanan.update-status');
});