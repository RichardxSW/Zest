<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TotalPurchaseController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('homepage');

// Category routes for Stock Manager
Route::middleware(['role:Stock_Manager'])->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        Route::get('/search', [CategoryController::class, 'search'])->name('categories.search');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('/search', [ProductController::class, 'search'])->name('products.search');
    });
});

// Supplier routes for Purchasing Staff
// Supplier routes for Purchasing Staff
Route::middleware(['role:Purchasing_Staff'])->group(function () {
    Route::prefix('supplier')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
        Route::get('/exportPdf', [SupplierController::class, 'exportPdf'])->name('supplier.exportPdf');
        Route::get('/exportXls', [SupplierController::class, 'exportXls'])->name('supplier.exportXls');
        Route::post('/importXls', [SupplierController::class, 'import'])->name('supplier.import');
        Route::get('/{id}', [SupplierController::class, 'show'])->name('supplier.show');
    });

    Route::prefix('/totalpurchase')->group(function () {
        Route::get('/', [TotalPurchaseController::class, 'index'])->name('totalpurchase.index');
        Route::get('/create', [TotalPurchaseController::class, 'create'])->name('totalpurchase.create');
        Route::post('/store', [TotalPurchaseController::class, 'store'])->name('totalpurchase.store');
        Route::get('/edit/{id}', [TotalPurchaseController::class, 'edit'])->name('totalpurchase.edit');
        Route::put('/update/{id}', [TotalPurchaseController::class, 'update'])->name('totalpurchase.update');
        Route::delete('/delete/{id}', [TotalPurchaseController::class, 'delete'])->name('totalpurchase.delete');
        Route::get('/exportPdf', [TotalPurchaseController::class, 'exportPdf'])->name('totalpurchase.exportPdf');
        Route::get('/exportXls', [TotalPurchaseController::class, 'exportXls'])->name('totalpurchase.exportXls');
        Route::get('/exportInv/{id}', [TotalPurchaseController::class, 'exportInv'])->name('totalpurchase.exportInv');
        Route::get('show/{id}', [TotalPurchaseController::class, 'show'])->name('totalpurchase.show');
    });
});

// Assuming you have CustomerController and OutgoingProductController
// Customer routes for Marketing Staff
Route::middleware(['role:Marketing_Staff'])->group(function () {
    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');
        Route::get('/exportPdf', [CustomerController::class, 'exportPdf'])->name('customers.exportPdf');
        Route::get('/exportXls', [CustomerController::class, 'exportXls'])->name('customers.exportXls');
        Route::post('/importXls', [CustomerController::class, 'import'])->name('customers.import');
        Route::get('/{id}', [CustomerController::class, 'show'])->name('customers.show');
    });
});

Route::prefix('users')->group( function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/search', [UserController::class, 'search'])->name('users.search');
});

// User management routes
Route::middleware(['role:Super_Admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// Route::prefix('/customer')->group(function () {
//     Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
//     Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
//     Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
//     Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
//     Route::put('/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
//     Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');
//     Route::get('/exportPdf', [CustomerController::class, 'exportPdf'])->name('customers.exportPdf');
//     Route::get('/exportXls', [CustomerController::class, 'exportXls'])->name('customers.exportXls');
//     Route::post('/importXls', [CustomerController::class, 'import'])->name('customers.import');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\AuthController::class, 'index'])->name('home');
