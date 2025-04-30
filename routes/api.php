<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::middleware('api.key')->prefix('api/v1')->group(function () {
    Route::controller(ApiController::class)->group(function () {
        Route::get('/projects', 'allProjects')->;
        Route::get('/projects/project_details/{slug}', 'projectDetails')->;
        Route::get('/pricing/plans', 'PricingPlan')->;
        Route::get('/social/links', 'socialLinks')->;
        Route::get('/payment/methods', 'paymentMethods')->;
        Route::get('/about', 'aboutDev')->       Route::get('skills', 'allSkills');
        // Route::post('/send/email', 'sendEmail')->;
    });
});
