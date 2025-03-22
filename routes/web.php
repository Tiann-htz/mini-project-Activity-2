<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Medicine inventory routes
    Route::get('/inventory', [MedicineController::class, 'index'])->name('inventory');
    Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
    Route::get('/medicines/{medicine}', [MedicineController::class, 'show'])->name('medicines.show');
    Route::put('/medicines/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
    Route::delete('/medicines/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
    
    // Medicine categories routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/medicines-list', [CategoryController::class, 'getAllMedicines'])->name('medicines.list');
    Route::get('/categories/{category}/medicines', [CategoryController::class, 'getMedicines'])->name('categories.medicines');
    Route::post('/categories/{category}/medicines', [CategoryController::class, 'assignMedicines'])->name('categories.assignMedicines');
    
    // Supplier routes
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    
    // Expired Medicines route
    Route::get('/expired', function () {
        return view('expired');
    })->name('expired');
    Route::get('/expired-medicines', [MedicineController::class, 'expiredMedicines'])->name('medicines.expired');
    
    // Staff management routes
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{user}', [StaffController::class, 'show'])->name('staff.show');
    Route::put('/staff/{user}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{user}', [StaffController::class, 'destroy'])->name('staff.destroy');
    
    // Dashboard API routes
    Route::get('/dashboard/medicines/count', [MedicineController::class, 'count']);
    Route::get('/dashboard/categories/count', [CategoryController::class, 'count']);
    Route::get('/dashboard/suppliers/count', [SupplierController::class, 'count']);
    Route::get('/dashboard/staff/count', [StaffController::class, 'count']);
    Route::get('/dashboard/medicines/expiring', [MedicineController::class, 'getExpiringMedicines']);
    Route::get('/dashboard/medicines/low-stock', [MedicineController::class, 'getLowStockMedicines']);
});

require __DIR__.'/auth.php';