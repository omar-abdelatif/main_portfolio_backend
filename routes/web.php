<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PricingItemsController;

Route::view('/', 'auth.login');
Route::get('/register', function () {
    abort(404);
});
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::post('/store', 'store')->name('categories.store');
        Route::post('/update', 'update')->name('categories.update');
        Route::get('/delete/{id}', 'delete')->name('categories.delete');
    });
    Route::controller(ProjectsController::class)->group(function () {
        Route::get('/projects', 'index')->name('projects.index');
        Route::post('/projects/store', 'store')->name('projects.store');
        Route::post('/projects/update', 'update')->name('projects.update');
        Route::get('/projects/delete/{id}', 'delete')->name('projects.destroy');
    });
    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings.index');
        Route::post('/settings/api/update', 'apiRequest')->name('settings.api.update');
        Route::post('/social/update', 'socialUpdate')->name('social.update');
        Route::post('/payment/update', 'paymentUpdate')->name('payment.update');
        Route::post('about/update', 'aboutUpdate')->name('about.update');
    });
    Route::controller(PricingController::class)->group(function () {
        Route::get('/pricing', 'index')->name('pricing.index');
        Route::post('/pricing/store', 'store')->name('pricing.store');
        Route::post('/pricing/update', 'update')->name('pricing.update');
        Route::get('/pricing/delete/{id}', 'destroy')->name('pricing.destroy');
    });
    Route::controller(PricingItemsController::class)->group(function () {
        Route::get('/plan/{pricing_plan_id}/show', 'index')->name('pricing.items.index');
        Route::get('/plan/items/{id}/delete', 'delete')->name('pricing.items.delete');
        Route::post('/plan/{pricing_plan_id}/store', 'store')->name('pricing.items.store');
        Route::post('/plan/{id}/update', 'update')->name('pricing.items.update');
    });
    Route::controller(SkillsController::class)->group(function () {
        Route::get('/skills', 'index')->name('skills.index');
        Route::post('/skills/store', 'store')->name('skills.store');
        Route::post('/skills/update', 'update')->name('skills.update');
        Route::get('/skills/delete/{id}', 'destroy')->name('skills.destroy');
    });
});
Route::middleware('api.key')->prefix('api/v1')->group(function () {
    Route::controller(ApiController::class)->group(function () {
        Route::get('/projects', 'allProjects');
        Route::get('/projects/{slug}', 'projectDetails');
        Route::get('/pricing/plans', 'PricingPlan');
        Route::get('/social/links', 'socialLinks');
        Route::get('/payment/methods', 'paymentMethods');
        Route::get('/about', 'aboutDev');
    });
});
require __DIR__.'/auth.php';
