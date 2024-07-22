<?php

use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SyllabusController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('syllabus', SyllabusController::class);
Route::resource('batch', BatchController::class);
Route::resource('faculty', FacultyController::class);
Route::resource('semester', SemesterController::class);
Route::resource('section', SectionController::class);
