<?php

use Illuminate\Support\Facades\Route;
use Modules\HRM\Http\Controllers\HRMController;

Route::middleware(['auth', 'prevent.back'])->prefix('hrm')->group(function () {
    Route::get('/', [HRMController::class, 'dashboard'])->name('hrm.dashboard');
    Route::get('/employees', [HRMController::class, 'employees'])->name('hrm.employees');
    Route::get('/departments', [HRMController::class, 'departments'])->name('hrm.departments');
    Route::get('/attendance', [HRMController::class, 'attendance'])->name('hrm.attendance');
    Route::get('/payroll', [HRMController::class, 'payroll'])->name('hrm.payroll');
    
    // User Management Routes
    Route::get('/users/create', [HRMController::class, 'createUser'])->name('hrm.users.create');
    Route::post('/users', [HRMController::class, 'storeUser'])->name('hrm.users.store');
    Route::get('/users', [HRMController::class, 'users'])->name('hrm.users.index');
});
