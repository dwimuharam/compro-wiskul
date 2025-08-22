<?php

use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompanyAboutController;
use App\Http\Controllers\CompanyStatisticController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\OurPrincipleController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectClientController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\ShopItemController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/team', [FrontController::class, 'team'])->name('front.team');
Route::get('/about', [FrontController::class, 'about'])->name('front.about');
Route::get('/appointment', [FrontController::class, 'appointment'])->name('front.appointment');
Route::post('/appointment/store', [FrontController::class, 'appointment_store'])->name('front.appointment_store');
Route::get('/shop', [FrontController::class, 'shop'])->name('front.shop');
Route::get('/shop/{item}', [FrontController::class, 'shop_show'])->name('front.shop.show');
Route::post('/cart/add/{id}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/sales-report', [SalesReportController::class, 'index'])
    ->middleware(['auth'])   // optional, sesuaikan kebutuhan
    ->name('sales.report');

// Checkout dan pembayaran (butuh login user)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/upload', [CheckoutController::class, 'paymentUpload'])->name('checkout.upload');
    Route::view('/checkout/success', 'front.checkout.success')->name('payment.success');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function (){
        Route::get('/transactions/{transaction}', [\App\Http\Controllers\AdminTransactionController::class, 'show'])->name('transactions.show');
        
        Route::middleware('can:manage statistics')->group(function () {
            Route::resource('statistics', CompanyStatisticController::class);
        });
    
        Route::middleware('can:manage products')->group(function () {
            Route::resource('products', ProductController::class);
        });
        
        Route::middleware('can:manage principles')->group(function () {
            Route::resource('principles', OurPrincipleController::class);
        });
        
        Route::middleware('can:manage testimonials')->group(function () {
            Route::resource('testimonials', TestimonialController::class);
        });
        
        Route::middleware('can:manage clients')->group(function () {
            Route::resource('clients', ProjectClientController::class);
        });
        
        Route::middleware('can:manage teams')->group(function () {
            Route::resource('teams', OurTeamController::class);
        });
        
        Route::middleware('can:manage abouts')->group(function () {
            Route::resource('abouts', CompanyAboutController::class);
        });
        
        Route::middleware('can:manage appointments')->group(function () {
            Route::resource('appointments', AppointmentController::class);
        });      

        Route::middleware('can:manage hero sections')->group(function () {
            Route::resource('hero_sections', HeroSectionController::class);
        });
        
        Route::middleware('can:manage shop items')->group(function () {
            Route::resource('shop_items', ShopItemController::class);
        });

        Route::middleware('can:manage transactions')->group(function () {
            Route::get('transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
        });
        
        
    });

});

require __DIR__.'/auth.php';
