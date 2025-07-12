<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerSegmentationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\DetailTransactionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\KursusMenjahitController;
use App\Http\Controllers\KursusMenjahitController as ControllersKursusMenjahitController;
use App\Http\Controllers\SocialiteController;
use App\Models\KursusMenjahit;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware('isLogin');
    Route::post('/login', 'doLogin')->name('do.login');
    Route::get('/register', 'register')->name('register')->middleware('isLogin');
    Route::post('/register', 'doRegister')->name('do.register');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('auth', 'OnlyAdmin')->group(function () {
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/profile', [DashboardController::class, 'editProfile']);
        Route::match(['put', 'post'], '/profile', [DashboardController::class, 'saveProfile'])->name('admin.profile');

        // Product
        Route::resource('/product', ProductController::class);

        // Transaction
        Route::get('/transaction', [TransactionController::class, 'index']);
        Route::get('/payment', [TransactionController::class, 'payment']);
        Route::get('/transaction/{id}/show', [DetailTransactionController::class, 'show'])->name('admin.transaction.show');
        Route::get('/transaction/{id}/show-payment', [TransactionController::class, 'showPayment'])->name('admin.transaction.payment');;
        Route::get('/transaction/{id}/update-status', [TransactionController::class, 'updateStatus'])->name('admin.transaction.update-status');;
        Route::get('/transaction/{id}/cancel-order', [TransactionController::class, 'cancelOrder'])->name('admin.transaction.cancel');;

        // Customers
        Route::get('/customers', [CustomerController::class, 'index']);

        //jadwal 
       Route::get('/checkout/jam-tersedia', [CheckoutController::class, 'getJamTersedia'])->name('checkout.jam-tersedia');

       Route::resource('kursus-menjahit', KursusMenjahitController::class)->names('admin.kursus-menjahit');
        Route::post('kursus-menjahit/{id}/update-status', [KursusMenjahitController::class, 'updateStatus'])->name('admin.kursus-menjahit.update-status');
        Route::get('kursus-menjahit/{id}/peserta', [KursusMenjahitController::class, 'peserta'])->name('admin.kursus-menjahit.peserta');
        Route::post('kursus-menjahit/{id}/konfirmasi-pembayaran', [KursusMenjahitController::class, 'konfirmasiPembayaran'])->name('admin.kursus-menjahit.konfirmasi-pembayaran');
    });

    Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee.index');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('admin.employee.store');
    Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
    Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('admin.employee.destroy');

    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('index');
        Route::get('/dashboard', [App\Http\Controllers\Admin\LaporanController::class, 'dashboard'])->name('dashboard');
        Route::get('/transaksi', [App\Http\Controllers\Admin\LaporanController::class, 'laporanTransaksi'])->name('transaksi');
        Route::get('/produk', [App\Http\Controllers\Admin\LaporanController::class, 'laporanProduk'])->name('produk');
        Route::get('/kursus', [App\Http\Controllers\Admin\LaporanController::class, 'laporanKursus'])->name('kursus');
    });
});

// Home
Route::middleware('CheckRole')->group(function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/search', [HomeController::class, 'search']);

    Route::get('/product/{id}', [DetailController::class, 'index']);
    Route::post('/product/add-to-cart/{id}', [DetailController::class, 'add']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/{id}', [CartController::class, 'destroy']);

    Route::get('/product/custom/{slug}', [HomeController::class, 'customForm']);
    Route::post('/custom-order', [HomeController::class, 'handleCustomOrder']);


    Route::middleware('Customer')->group(function () {
        // Checkout
        Route::post('/cart/checkout', [CartController::class, 'getCartData']);
        Route::get('/checkout', [CheckoutController::class, 'index']);
        Route::post('/checkout', [CheckoutController::class, 'payNow']);

        Route::get('/product/custom/{slug}', [HomeController::class, 'customForm']);
        Route::post('/custom-order', [HomeController::class, 'handleCustomOrder']);
        Route::post('/checkout/pilih-jadwal', [CheckoutController::class, 'pilihJadwal'])->name('checkout.pilih-jadwal');
    
    // Hapus jadwal pengukuran
    Route::delete('/checkout/hapus-jadwal', [CheckoutController::class, 'hapusJadwal'])->name('checkout.hapus-jadwal');
    
    // Cek waktu tersedia (AJAX endpoint)
    Route::post('/checkout/cek-waktu', [CheckoutController::class, 'cekWaktuTersedia'])->name('checkout.cek-waktu');

        // Success order
        Route::get('/success-order/{id}', [CheckoutController::class, 'successOrder'])->name('success.order');

        // Profile User
        Route::get('/profile/{id}', [ProfileController::class, 'editProfile']);
        Route::match(['put', 'post'], '/user/profile', [ProfileController::class, 'saveProfile'])->name('user.profile');

        Route::get('/history', [HistoryController::class, 'index']);
        Route::get('/history/detail/{id}', [HistoryController::class, 'show']);
        Route::get('/history/confirmOrderStatus/{id}', [HistoryController::class, 'confirmOrderStatus']);
        Route::get('/history/upload/{id}', [PaymentController::class, 'index']);
        Route::post('/history/upload/{id}', [PaymentController::class, 'upload']);
        // Kursus Menjahit (Customer)
        Route::get('/kursus-menjahit', [ControllersKursusMenjahitController::class, 'index'])->name('customer.kursus-menjahit.index');
        Route::get('/kursus-menjahit/{id}', [ControllersKursusMenjahitController::class, 'show'])->name('customer.kursus-menjahit.show');
        Route::post('/kursus-menjahit/{id}/daftar', [ControllersKursusMenjahitController::class, 'daftar'])->name('customer.kursus-menjahit.daftar');
        Route::post('/kursus-menjahit/peserta/{pesertaId}/upload-bukti', [ControllersKursusMenjahitController::class, 'uploadBuktiPembayaran'])->name('customer.kursus-menjahit.upload-bukti');
        Route::get('/kursus-saya', [ControllersKursusMenjahitController::class, 'kursusKu'])->name('customer.kursus-menjahit.kursus-ku');
        Route::delete('/kursus-menjahit/peserta/{pesertaId}/batal', [ControllersKursusMenjahitController::class, 'batalDaftar'])->name('customer.kursus-menjahit.batal-daftar');
    });

    // About Us
    Route::view('/about', 'customer.about.store.index');
    Route::view('/lokasi', 'customer.about.store.lokasi');
    Route::view('/cara-pesan', 'customer.about.store.cara-pesan');
    Route::view('/album', 'customer.about.store.album');

    Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
});
