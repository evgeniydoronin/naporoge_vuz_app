<?php

use App\Http\Controllers\Admin\CodeController;
use App\Http\Controllers\Admin\ExportDataController;
use App\Http\Controllers\Admin\ExportStudentsController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TheoryController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['can:access-admin-manager'])->prefix('dashboard')->group(function () {
        Route::get('/', fn () => view('dashboard'))->name('dashboard');
        Route::resource('/universities', UniversityController::class);
        Route::resource('/groups', GroupController::class);
        Route::resource('/codes', CodeController::class);
        Route::resource('/managers', ManagerController::class)->middleware('can:access-admin');

        // Новый маршрут для обновления студентов из файла
        Route::post('/students/update-from-file', [StudentController::class, 'updateStudents'])->name('students.updateFromFile');
        // Маршруты ресурсов
        Route::resource('/students', StudentController::class);

        Route::resource('/theories', TheoryController::class);
        Route::resource('/exports', ExportStudentsController::class);

        Route::get('/getGroupsByUniversity/{id}', [CodeController::class, 'getGroupsByUniversity'])->name('getGroupsByUniversity');
        Route::get('/getCodesIdByGroupId/{id}', [ExportDataController::class, 'getCodesIdByGroupId'])->name('getCodesIdByGroupId');
        Route::get('/getDatesByUniversity/{id}', [ExportStudentsController::class, 'getDatesByUniversity'])->name('getDatesByUniversity');
    });

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');

    Route::get('/reset-password', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');
});

