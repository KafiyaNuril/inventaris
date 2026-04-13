<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/category')->name('category.')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/add', [CategoryController::class, 'create'])->name('create');
    Route::post('/add', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::patch('/edit/{category}', [CategoryController::class, 'update'])->name('update');
});

Route::prefix('/item')->name('item.')->group(function() {
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::get('/add', [ItemController::class, 'create'])->name('create');
    Route::post('/add', [ItemController::class, 'store'])->name('store');
    Route::get('/edit/{item}', [ItemController::class, 'edit'])->name('edit');
    Route::patch('/edit/{item}', [ItemController::class, 'update'])->name('update');
});

Route::prefix('/user')->name('user.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/add', [UserController::class, 'create'])->name('create');
    Route::post('/add', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/edit/{user}', [UserController::class, 'update'])->name('update');
});