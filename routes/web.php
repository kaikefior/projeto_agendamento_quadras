<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\InventoryItemController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::resource('courts', CourtController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('inventory', InventoryItemController::class)
     ->parameters (['inventory' => 'inventoryItem']);
});

require __DIR__.'/settings.php';
