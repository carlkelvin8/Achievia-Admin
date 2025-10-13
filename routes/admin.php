<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('admin/register', [AuthAdminController::class, 'showRegister'])->name('admin.showRegister');

Route::post('admin/register', [AuthAdminController::class, 'register'])->name('admin.register');

Route::get('/admin/login', [AuthAdminController::class, 'index'])->name('admin.login');

Route::post('/logout', [AuthAdminController::class, 'logout'])->name('logout');

// Handle login submission (POST)
Route::post('/admin/login', [AuthAdminController::class, 'signin'])->name('admin.login.submit');

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/upload/modules', [ModuleController::class, 'create'])->name('modules.create');

Route::post('/admin/modules', [ModuleController::class, 'store'])->name('modules.store');

Route::get('/admin/modules', [ModuleController::class, 'index'])->name('modules.index');

Route::get('admin/modules/{id}', [ModuleController::class, 'edit'])->name('modules.edit');

Route::put('admin/modules/{id}', [ModuleController::class, 'update'])->name('modules.update');

Route::delete('admin/modules/{id}', [ModuleController::class, 'destroy'])->name('modules.destroy');

Route::get('admin/students', [ManageStudentController::class, 'index'])->name('students.index');

Route::get('admin/students/{id}', [ManageStudentController::class, 'show'])->name('students.show');

Route::delete('admin/students/{id}', [ManageStudentController::class, 'destroy'])->name('students.destroy');

Route::get('admin/students/edit/{id}', [ManageStudentController::class, 'edit'])->name('students.edit');
Route::put('admin/students/edit/{id}', [ManageStudentController::class, 'update'])->name('students.update');

Route::get('admin/teachers', [TeacherController::class, 'index'])->name('teachers.index');

Route::get('admin/teachers/{id}', [TeacherController::class, 'show'])->name('teachers.show');
Route::get('admin/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::put('admin/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
Route::delete('admin/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

Route::get('admin/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
Route::put('admin/settings', [AdminSettingsController::class, 'update'])->name('settings.update');


