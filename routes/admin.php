<?php

use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('buildings', BuildingController::class)->except(['show']);
});
