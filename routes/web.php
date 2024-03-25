<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PropductController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Admin All Route 
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier', 'all')->name('supplier.all');
        Route::get('/supplier/add', 'add')->name('supplier.add');
        Route::post('/supplier/store', 'store')->name('supplier.store');
        Route::get('/supplier/edit/{id}', 'edit')->name('supplier.edit');
        Route::post('/supplier/update', 'update')->name('supplier.update');
        Route::get('/supplier/delete/{id}', 'delete')->name('supplier.delete');
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer', 'all')->name('customer.all');
        Route::get('/customer/add', 'add')->name('customer.add');
        Route::post('/customer/store', 'store')->name('customer.store');
        Route::get('/customer/edit/{id}', 'edit')->name('customer.edit');
        Route::post('/customer/update', 'update')->name('customer.update');
        Route::get('/customer/delete/{id}', 'delete')->name('customer.delete');
    });

    Route::controller(PropductController::class)->group(function () {
        Route::get('/product', 'all')->name('product.all');
        Route::get('/product/add', 'add')->name('product.add');
        Route::post('/product/store', 'store')->name('product.store');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::post('/product/update', 'update')->name('product.update');
        Route::get('/product/delete/{id}', 'delete')->name('product.delete');
    });
    Route::controller(UnitController::class)->group(function () {
        Route::get('/unit', 'all')->name('unit.all');
        Route::get('/unit/add', 'add')->name('unit.add');
        Route::post('/unit/store', 'store')->name('unit.store');
        Route::get('/unit/edit/{id}', 'edit')->name('unit.edit');
        Route::post('/unit/update', 'update')->name('unit.update');
        Route::get('/unit/delete/{id}', 'delete')->name('unit.delete');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'all')->name('category.all');
        Route::get('/category/add', 'add')->name('category.add');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::post('/category/update', 'update')->name('category.update');
        Route::get('/category/delete/{id}', 'delete')->name('category.delete');
    });
});

require __DIR__ . '/auth.php';
