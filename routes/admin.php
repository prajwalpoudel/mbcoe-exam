<?php

use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamTypeController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SyllabusController;
use App\Http\Controllers\Admin\User\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('syllabus', SyllabusController::class);
Route::resource('batch', BatchController::class);
Route::resource('faculty', FacultyController::class);
Route::resource('semester', SemesterController::class);
Route::resource('section', SectionController::class);
Route::resource('subject', SubjectController::class);
Route::resource('exam-type', ExamTypeController::class);
Route::resource('exam', ExamController::class);
Route::get('student/import', [StudentController::class, 'import'])->name('student.import');
Route::get('student/export-sample', [StudentController::class, 'exportSample'])->name('student.export-sample');
Route::post('student/import', [StudentController::class, 'storeImport'])->name('student.store-import');
Route::get('student/{id}/semester', [StudentController::class, 'semester'])->name('student.semester');
Route::get('student/{id}/result', [StudentController::class, 'result'])->name('student.result');
Route::resource('student', StudentController::class);
Route::get('result/import', [ResultController::class, 'import'])->name('result.import');
Route::post('result/import', [ResultController::class, 'storeImport'])->name('result.store-import');
Route::get('result/export', [ResultController::class, 'export'])->name('result.export');
Route::post('result/export', [ResultController::class, 'exportSample'])->name('result.export-sample');
Route::get('result', [ResultController::class, 'index'])->name('result.index');
Route::get('result/{id}', [ResultController::class, 'show'])->name('result.show');


Route::prefix('api')->group(function() {
    Route::get('faculty/{faculty}/semesters', [SemesterController::class, 'getSemestersByFaculty']);
});
