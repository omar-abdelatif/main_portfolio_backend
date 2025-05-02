<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('api.key')->prefix('v1')->group(function () {
    Route::controller(ApiController::class)->group(function () {
        Route::get('/about', 'aboutDev')->name('api.about');
        Route::get('/skills', 'allSkills')->name('api.skills');
        Route::get('/projects', 'allProjects')->name('api.projects');
        Route::post('/send/email', 'sendEmail')->name('api.send.emails');
        Route::get('/social/links', 'socialLinks')->name('api.social.links');
        Route::get('/pricing/plans', 'PricingPlan')->name('api.pricing.plans');
        Route::get('/payment/methods', 'paymentMethods')->name('api.payment.methods');
        Route::get('/projects/project_details/{slug}', 'projectDetails')->name('api.project.details');
    });
});
