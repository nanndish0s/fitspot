<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');  

    // Edit Product Route
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');

});

Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/', function () {
    return view('home');  // This will return the 'home' view
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


require __DIR__.'/auth.php';
