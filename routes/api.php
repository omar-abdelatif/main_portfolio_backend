<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::middleware('api.key')->prefix('api/v1')->group(function () {
    Route::controller(ApiController::class)->group(function () {
        Route::get('/projects', 'allProjects')->name('api.projects.all');
        Route::get('/projects/{slug}', 'projectDetails')->name('api.projects.show');
        Route::get('/pricing/plans', 'PricingPlan')->name('api.pricing.plans');
        Route::get('/social/links', 'socialLinks')->name('api.social.links');
        Route::get('/payment/methods', 'paymentMethods')->name('api.payment.methods');
        Route::post('/send/email', 'sendEmail')->name('api.send.email');
    });
});
