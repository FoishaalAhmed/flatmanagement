<?php

use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployeeSalaryController;
use App\Http\Controllers\Admin\FlatController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\HelperController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('owners', OwnerController::class)->except(['show']);
    Route::resource('managers', ManagerController::class)->except(['show']);
    Route::resource('buildings', BuildingController::class)->except(['show']);
    Route::resource('floors', FloorController::class)->except(['create', 'show', 'edit']);
    Route::resource('designations', DesignationController::class)->except(['create', 'show', 'edit']);
    Route::resource('flats', FlatController::class)->except(['show']);
    Route::resource('tenants', TenantController::class)->except(['show']);
    Route::resource('employees', EmployeeController::class)->except(['show']);
    Route::resource('rents', RentController::class)->except(['edit', 'update']);
    Route::resource('employee-salaries', EmployeeSalaryController::class)->except(['show', 'edit', 'update']);

    /** Helper Route Start Here **/
    Route::post('get-floor', [HelperController::class, 'floor'])->name('get.floor');
    Route::post('get-flat', [HelperController::class, 'flat'])->name('get.flat');
    Route::post('get-flats', [HelperController::class, 'flats'])->name('get.flats');
    Route::post('get-tenant', [HelperController::class, 'tenant'])->name('get.tenant');
    /** Helper Route End Here **/
});
