<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/item', [ItemController::class, 'index'])->name('item.index');

    Route::prefix('/user')->name('user.')->group(function() {
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/edit/{id}', [UserController::class, 'update'])->name('update');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::prefix('/category')->name('category.')->group(function() {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/add', [CategoryController::class, 'create'])->name('create');
            Route::post('/add', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
            Route::patch('/edit/{category}', [CategoryController::class, 'update'])->name('update');
        });
        
        Route::prefix('/item')->name('item.')->group(function() {
            Route::get('/add', [ItemController::class, 'create'])->name('create');
            Route::post('/add', [ItemController::class, 'store'])->name('store');
            Route::get('/edit/{item}', [ItemController::class, 'edit'])->name('edit');
            Route::patch('/edit/{item}', [ItemController::class, 'update'])->name('update');
            Route::get('/export', [ItemController::class, 'export'])->name('export');
        });

        Route::prefix('/user')->name('user.')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/add', [UserController::class, 'create'])->name('create');
            Route::post('/add', [UserController::class, 'store'])->name('store');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
            Route::patch('/reset/{id}', [UserController::class, 'resetPassword'])->name('reset');
        });

        Route::get('/lending/show{item}', [LendingController::class, 'show'])->name('lending.show');
    });

    Route::middleware(['role:operator'])->group(function () {
        Route::prefix('/lending')->name('lending.')->group(function() {
            Route::get('/', [LendingController::class, 'index'])->name('index');
            Route::get('/add', [LendingController::class, 'create'])->name('create');
            Route::post('/add', [LendingController::class, 'store'])->name('store');
            Route::patch('/return/{lending}', [LendingController::class, 'update'])->name('return');
            Route::delete('/delete/{lending}', [LendingController::class, 'destroy'])->name('destroy');
        });
    });



    
});