<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::prefix('v1')->group(function () {
    Route::get('/projects', [ApiController::class, 'allProjects']);
    Route::get('/skills', [ApiController::class, 'allSkills']);
    Route::get('/about', [ApiController::class, 'aboutDev']);
    Route::get('/social/links', [ApiController::class, 'socialLinks']);
    Route::get('/projects/project_details/{slug}', [ApiController::class, 'projectDetails']);
    Route::middleware('api.key')->group(function () {
        Route::post('/send/email', [ApiController::class, 'sendEmail']);
    });
});
