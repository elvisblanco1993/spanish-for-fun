<?php

use App\Livewire\Billing\SelectPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('request.index');
    } else {
        return redirect()->route('register');
    }
})->name('website.home');

// Route::get('/', [WebsiteController::class, 'home'])->name('website.home');
// Route::get('/contact', [WebsiteController::class, 'contact'])->name('website.contact');
// Route::get('/services', [WebsiteController::class, 'services'])->name('website.services');
// Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/requests', App\Livewire\Request\Index::class)->name('request.index');
    Route::get('/requests/{request}', App\Livewire\Request\Edit::class)->name('request.show');

    Route::get('/services', App\Livewire\Service\Index::class)->name('service.index');
    Route::get('/services/{service}', App\Livewire\Service\Edit::class)->name('service.show');

    Route::get('/products', App\Livewire\Product\Index::class)->name('product.index');
    Route::get('/products/{product}', App\Livewire\Product\Edit::class)->name('product.show');

    // Checkout and Billing
    Route::get('/checkout/request/{request}', [CheckoutController::class, 'checkoutService'])->name('checkout.service');
    Route::get('/checkout/product/{product}', [CheckoutController::class, 'checkoutProduct'])->name('checkout.product');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/billing/signup', SelectPlan::class)->name('billing.select-plan');
    Route::get('/billing-portal', BillingController::class)->name('billing');
});
