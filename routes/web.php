<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUmrahPackageController;
use App\Http\Controllers\AdminPackageVariantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UmrahPackageReportController;
use App\Http\Controllers\UserDetailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
//     $path = storage_path('app/public/' . $folder . '/' . $filename);

//     if (file_exists($path)) {
//         return response()->file($path);
//     }

//     abort(404);
// });


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'berhasil';
});

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/register', [AuthController::class, 'registerIndex'])->name('register');
Route::post('/register', [AuthController::class, 'registerAuth'])->name('register.auth');
Route::get('/login', [AuthController::class, 'loginIndex'])->name('login');
Route::post('/login', [AuthController::class, 'loginAuth'])->name('login.auth');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/promo-menarik', [HomeController::class, 'promo'])->name('home.promo');
Route::get('/program-umrah', [HomeController::class, 'index'])->name('home.umrahprogram');
Route::get('/umrah-program/{packageId}/variants', [HomeController::class, 'variants'])->name('home.variants');
Route::get('/umrah-program/variants/{variantId}/details', [HomeController::class, 'variantDetail'])->name('home.variantDetail');


Route::middleware(['auth'])->group(function () {
    Route::post('cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::patch('cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::get('cart/checkout', [CartController::class, 'viewCheckout'])->name('cart.checkout');

    Route::get('/cart/{order}/payment', [PaymentController::class, 'paymentPage'])->name('payment.page');
    Route::post('cart/checkout', [PaymentController::class, 'processCheckout'])->name('cart.checkout.process');
    Route::get('/riwayat-pesanan', [PaymentController::class, 'paymentHistory'])->name('payment.history');
    Route::get('/belum-bayar', [PaymentController::class, 'paymentList'])->name('payment.list');
    Route::get('/cart/{order}/download-receipt', [PaymentController::class, 'downloadReceipt'])->name('cart.downloadReceipt');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('user_details', UserDetailController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // dasboard Page
    Route::get('/dashboard', [AdminUmrahPackageController::class, 'dashboard'])->name('dashboard');

    // Pesanan Page
    Route::get('/admin/pesanan', [AdminOrderController::class, 'order'])->name('order');

    // Umrah Paket Page
    Route::resource('admin/umrah-packages', AdminUmrahPackageController::class);

    // Umrah vairiant Page
    Route::resource('admin/package-variants', AdminPackageVariantController::class);
    Route::put('/admin/package-variants/{id}/update-seat', [AdminPackageVariantController::class, 'updateSeat'])->name('package-variants.update-seat');


    // Umrah Galery Page
    Route::resource('/admin/carousels', CarouselController::class);

    //  Testimony Page
    Route::resource('/admin/testimonials', TestimonialController::class);

    //  Team Page
    Route::resource('/admin/teams', TeamController::class);
    Route::get('/admin/report', [UmrahPackageReportController::class, 'index'])->name('report.umrah-packages');
    Route::get('export-umrah-packages', [UmrahPackageReportController::class, 'export'])->name('export.umrah-packages');
});




Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
