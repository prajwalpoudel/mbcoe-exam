<?php

use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamTypeController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SyllabusController;
use App\Http\Controllers\Admin\User\Student\ResultController as StudentResultController;
use App\Http\Controllers\Admin\User\Student\SemesterController as StudentSemesterController;
use App\Http\Controllers\Admin\User\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('syllabus', SyllabusController::class);
    Route::get('batch-result', [BatchController::class, 'result'])->name('batch.result');
    Route::resource('batch', BatchController::class);
    Route::resource('faculty', FacultyController::class);
    Route::resource('semester', SemesterController::class);
    Route::resource('section', SectionController::class);
    Route::get('subject/import', [SubjectController::class, 'import'])->name('subject.import');
    Route::get('subject/export-sample', [SubjectController::class, 'exportSample'])->name('subject.export-sample');
    Route::post('subject/import', [SubjectController::class, 'storeImport'])->name('subject.store-import');
    Route::resource('subject', SubjectController::class);
    Route::resource('exam-type', ExamTypeController::class);
    Route::resource('exam', ExamController::class);
    Route::get('student/import', [StudentController::class, 'import'])->name('student.import');
    Route::get('student/export-sample', [StudentController::class, 'exportSample'])->name('student.export-sample');
    Route::post('student/import', [StudentController::class, 'storeImport'])->name('student.store-import');
    Route::get('student/{id}/semester', [StudentSemesterController::class, 'index'])->name('student.semester');
    Route::get('student/{id}/semester/create', [StudentSemesterController::class, 'create'])->name('student.semester.create');
    Route::delete('student/{id}/semester/delete', [StudentSemesterController::class, 'destroy'])->name('student.semester.destroy');
    Route::get('student/{id}/result', [StudentResultController::class, 'index'])->name('student.result');
    Route::get('student/{id}/result/create', [StudentResultController::class, 'create'])->name('student.result.create');
    Route::get('student//result/{id}/edit', [StudentResultController::class, 'edit'])->name('student.result.edit');
    Route::delete('student/result/{id}/delete', [ResultController::class, 'destroy'])->name('student.result.destroy');
    Route::get('student/{id}/transcript', [StudentResultController::class, 'transcript'])->name('student.transcript');

    Route::resource('student', StudentController::class);
    Route::resource('result', ResultController::class)->except(['show']);
    Route::get('result/import', [ResultController::class, 'import'])->name('result.import');
    Route::post('result/import', [ResultController::class, 'storeImport'])->name('result.store-import');
    Route::get('result/export', [ResultController::class, 'export'])->name('result.export');
    Route::post('result/export', [ResultController::class, 'exportSample'])->name('result.export-sample');
    Route::get('result', [ResultController::class, 'index'])->name('result.index');
    Route::get('result/{id}', [ResultController::class, 'show'])->name('result.show');
    Route::get('setting/semester', [SettingController::class, 'semester'])->name('setting.semester');
    Route::put('setting/semester', [SettingController::class, 'updateSemester'])->name('setting.semester');
    Route::resource('setting', SettingController::class)->only(['index', 'edit', 'update']);
    Route::resource('profile', ProfileController::class)->only(['index', 'edit', 'update']);

    Route::prefix('api')->group(function () {
        Route::get('faculty/{faculty}/semesters', [SemesterController::class, 'getSemestersByFaculty']);
        Route::get('faculty/{faculty}/students', [StudentController::class, 'getStudentsByFaculty']);
        Route::get('semester/{semester}/syllabus/{syllabus}/subjects', [SubjectController::class, 'getSubjectsBySemesterandSyllabus']);
        Route::get('student/{student}/syllabus/', [SyllabusController::class, 'getSyllabusByStudent']);

    });
});
