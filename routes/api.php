<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::middleware('api.key')->prefix('api/v1')->group(function () {
    Route::controller(ApiController::class)->group(function () {
        Route::get('/about', 'aboutDev');
        Route::get('/skills', 'allSkills');
        Route::get('/projects', 'allProjects');
        Route::post('/send/email', 'sendEmail');
        Route::get('/social/links', 'socialLinks');
        Route::get('/pricing/plans', 'PricingPlan');
        Route::get('/payment/methods', 'paymentMethods');
        Route::get('/projects/project_details/{slug}', 'projectDetails');
    });
});
