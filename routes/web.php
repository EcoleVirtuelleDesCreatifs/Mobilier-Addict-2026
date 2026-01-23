<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return redirect()->route('login');
});

Route::get('/admin/login', function () {
    return redirect()->route('login');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('ma/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('products', ProductController::class)->names('admin.products');
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');

    Route::get('/home-sections', [HomeSectionController::class, 'index'])->name('admin.home_sections.index');
    Route::get('/home-sections/{home_section}/edit', [HomeSectionController::class, 'edit'])->name('admin.home_sections.edit');
    Route::put('/home-sections/{home_section}', [HomeSectionController::class, 'update'])->name('admin.home_sections.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
