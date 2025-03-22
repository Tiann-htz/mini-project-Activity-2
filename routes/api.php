<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StaffController;

// API Routes for Dashboard
Route::middleware('auth:sanctum')->group(function () {
    // Count routes
    Route::get('/medicines/count', [MedicineController::class, 'count']);
    Route::get('/categories/count', [CategoryController::class, 'count']);
    Route::get('/suppliers/count', [SupplierController::class, 'count']);
    Route::get('/staff/count', [StaffController::class, 'count']);
    
    // Medicine specific routes
    Route::get('/medicines/expiring', [MedicineController::class, 'getExpiringMedicines']);
    Route::get('/medicines/low-stock', [MedicineController::class, 'getLowStockMedicines']);
});