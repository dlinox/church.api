<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/sign-in', [AuthController::class, 'signIn']);
    Route::post('/sign-out', [AuthController::class, 'signOut'])->middleware('auth:sanctum');
    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
});

//positions
Route::group(['prefix' => 'positions'], function () {
    Route::post('/load-data-table', [PositionController::class, 'loadDataTable'])->middleware('auth:sanctum');
    Route::post('/save', [PositionController::class, 'save'])->middleware('auth:sanctum');
    Route::delete('/delete/{id}', [PositionController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/load-select', [PositionController::class, 'loadSelect'])->middleware('auth:sanctum');
});

//branches
Route::group(['prefix' => 'branches'], function () {
    Route::post('/save', [BranchController::class, 'save'])->middleware('auth:sanctum');
    Route::get('/general-information/{id}', [BranchController::class, 'getGeneralInformation'])->middleware('auth:sanctum');
});

//workers
Route::group(['prefix' => 'workers'], function () {
    Route::post('/load-data-table', [WorkerController::class, 'loadDataTable'])->middleware('auth:sanctum');
    Route::post('/save', [WorkerController::class, 'save'])->middleware('auth:sanctum');
    Route::delete('/delete/{id}', [WorkerController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/load-select', [WorkerController::class, 'loadSelect'])->middleware('auth:sanctum');
});

//users
Route::group(['prefix' => 'users'], function () {
    Route::post('/load-data-table', [UserController::class, 'loadDataTable'])->middleware('auth:sanctum');
    Route::post('/save', [UserController::class, 'save'])->middleware('auth:sanctum');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/load-select', [UserController::class, 'loadSelect'])->middleware('auth:sanctum');
    //allPermissions
    Route::get('/all-permissions', [UserController::class, 'allPermissions'])->middleware('auth:sanctum');
    //assignPermissions
    Route::post('/assign-permissions', [UserController::class, 'assignPermissions'])->middleware('auth:sanctum');
});
