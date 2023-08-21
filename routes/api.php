<?php

use App\Models\societies;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplySocietiesController;
use App\Http\Controllers\JobVacanciesController;
use App\Http\Controllers\ValidationsController;
use App\Models\job_vacancies;
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

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {

        Route::post('/login', [AuthController::class, 'login']);

        Route::post('/logout', [AuthController::class, 'logout']);

    });

    Route::middleware('verifyToken')->group(function () {
        Route::post('/validation',[ValidationsController::class, 'requestValidation']);

        Route::get('/validations',[ValidationsController::class, 'index']);

        Route::get('/job_vacancies',[JobVacanciesController::class, 'index']);

        Route::get('/job_vacancies/{id}',[JobVacanciesController::class, 'show']);

        Route::post('/applications',[JobApplySocietiesController::class, 'apply']);

        Route::get('/applications',[JobApplySocietiesController::class, 'index']);
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
