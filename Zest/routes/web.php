<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;

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

Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
});

Route::prefix('/product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    // Route::get('/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    // Route::put('/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
});

Route::prefix('/supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\AuthController::class, 'index'])->name('home');
