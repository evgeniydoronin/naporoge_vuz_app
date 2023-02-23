<?php

use App\Http\Controllers\Admin\CodeController;
use App\Http\Controllers\Admin\ExportDataController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\UniversityController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('/dashboard/universities', UniversityController::class);
Route::resource('/dashboard/groups', GroupController::class);
Route::resource('/dashboard/codes', CodeController::class);
Route::get('/getGroupsByUniversity/{id}', [CodeController::class, 'getGroupsByUniversity']);
Route::get('/getCodesIdByGroupId/{id}', [ExportDataController::class, 'getCodesIdByGroupId'])->name('getCodesIdByGroupId');
