<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Redirect root to employees list
//Route::get('/', fn() => redirect()->route('employees.index'));
Route::get('/', function () {
    return redirect()->route('employees.index');
});

// Dashboard route (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// All routes protected by auth
Route::middleware('auth')->group(function () {

    // Profile routes (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Employee CRUD
    Route::resource('employees', EmployeeController::class);

    // Departments (list + create)
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');

    // Skills (list + create)
    Route::get('skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('skills', [SkillController::class, 'store'])->name('skills.store');

    // AJAX filter for employees by department
    Route::get('employees/filter/{department}', [EmployeeController::class, 'filter'])
        ->name('employees.filter');


    Route::get('/check-email', [EmployeeController::class, 'checkEmail'])->name('employees.checkEmail');
});

// Include Breeze auth routes
require __DIR__.'/auth.php';
