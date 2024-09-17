<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DayResultApiController;
use App\Http\Controllers\Api\DiaryNoteApiController;
use App\Http\Controllers\Api\StreamApiController;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\TheoryApiController;
use App\Http\Controllers\Api\TwoTargetsApiController;
use App\Http\Controllers\Api\TodoApiController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Authentication
Route::post('code', [AuthApiController::class, 'sendSmsCode']);
Route::post('auth', [AuthApiController::class, 'confirmAuthCode']);

// Create Student
Route::post('create-student', [StudentApiController::class, 'store']);
Route::get('get-student', [StudentApiController::class, 'getStudent']);
Route::post('update-token', [StudentApiController::class, 'updateToken']);

// Stream
Route::post('create-stream', [StreamApiController::class, 'store']);
Route::post('delete-stream', [StreamApiController::class, 'deleteStream']);
Route::post('deactivate-stream', [StreamApiController::class, 'deactivateStream']);
Route::post('create-next-stream', [StreamApiController::class, 'createNextStream']);
Route::post('update-stream', [StreamApiController::class, 'update']);
Route::post('expand-stream', [StreamApiController::class, 'expandStream']);

Route::get('get-streams', [StreamApiController::class, 'getStudentStreams']);
Route::get('get-weeks', [StreamApiController::class, 'getStudentWeeks']);
Route::get('get-days', [StreamApiController::class, 'getStudentDays']);
Route::get('get-days-results', [StreamApiController::class, 'getStudentDaysResults']);
Route::get('get-diary-notes', [StreamApiController::class, 'getStudentDiaryNotes']);
Route::get('get-two-targets', [StreamApiController::class, 'getStudentTwoTargets']);

// Week
Route::post('create-week', [StreamApiController::class, 'createWeek']);
Route::post('update-week', [StreamApiController::class, 'updateWeek']);
Route::post('update-week-progress', [StreamApiController::class, 'updateWeekProgress']);

// Create Day Result
Route::get('day-result', [DayResultApiController::class, 'index']);
Route::post('create-day-result', [DayResultApiController::class, 'store']);

// Diary
Route::get('notes', [DiaryNoteApiController::class, 'index']);
Route::post('create-note', [DiaryNoteApiController::class, 'store']);
Route::post('update-note', [DiaryNoteApiController::class, 'update']);
Route::post('delete-note', [DiaryNoteApiController::class, 'destroy']);

// Delete duplicates
Route::post('delete-duplicates', [StreamApiController::class, 'deleteDuplicates']);

// Two targets
Route::post('create-two-targets', [TwoTargetsApiController::class, 'store']);
Route::post('update-two-targets', [TwoTargetsApiController::class, 'update']);

// Theories
Route::get('theories', [TheoryApiController::class, 'index']);

// Todos
Route::get('get-todos', [TodoApiController::class, 'getTodos']);
Route::post('todos', [TodoApiController::class, 'store']);
Route::post('update-todo', [TodoApiController::class, 'update']);
Route::post('delete-todo', [TodoApiController::class, 'destroy']);

// Push Notify
Route::get('/send-notification', [NotificationController::class, 'sendNotification']);