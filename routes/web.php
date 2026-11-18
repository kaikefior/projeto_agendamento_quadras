<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\ReservationController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::middleware(['admin'])->group(function () {
        Route::resource('categories', CategoriesController::class);

        Route::resource('inventory', InventoryItemController::class)
            ->parameters (['inventory' => 'inventoryItem']);

        Route::resource('courts', CourtController::class)
            ->except (['index', 'show']);
    });

    Route::resource('courts', CourtController::class)
        -> only(['index', 'show']);

        Route::get('reservations/create', [ReservationController::class, 'create'])
            ->name('reservations.create');

        Route::post('reservations', [ReservationController::class, 'store'])
            ->name('reservations.store');
});

require __DIR__.'/settings.php';
