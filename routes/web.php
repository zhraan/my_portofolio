<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// ─── Public ─────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ─── Admin Auth ──────────────────────────────────────────────────────────────
Route::get('/admin',                         fn() => redirect()->route('admin.profile'));
Route::get('/admin/login',                   [AdminController::class, 'showLogin'])->name('admin.login');
Route::get('/admin/auth/google',             [AdminController::class, 'redirectToGoogle'])->name('admin.google');
Route::get('/admin/auth/google/callback',    [AdminController::class, 'handleGoogleCallback'])->name('admin.google.callback');
Route::post('/admin/logout',                 [AdminController::class, 'logout'])->name('admin.logout');

// ─── Admin Protected ─────────────────────────────────────────────────────────
Route::middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {
    // Profile & Skills
    Route::get('/admin/profile',             [AdminController::class, 'showProfile'])->name('admin.profile');
    Route::post('/admin/profile',            [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/admin/profile/upload-photo', [AdminController::class, 'uploadPhoto'])->name('admin.profile.upload-photo');
    Route::post('/admin/skills',             [AdminController::class, 'storeSkill'])->name('admin.skills.store');
    Route::patch('/admin/skills/{skill}',    [AdminController::class, 'updateSkill'])->name('admin.skills.update');
    Route::delete('/admin/skills/{skill}',   [AdminController::class, 'destroySkill'])->name('admin.skills.destroy');

    // Career
    Route::get('/admin/career',              [AdminController::class, 'showCareer'])->name('admin.career');
    Route::post('/admin/career',             [AdminController::class, 'storeCareer'])->name('admin.career.store');
    Route::put('/admin/career/{career}',     [AdminController::class, 'updateCareer'])->name('admin.career.update');
    Route::delete('/admin/career/{career}',  [AdminController::class, 'destroyCareer'])->name('admin.career.destroy');

    // Activities
    Route::get('/admin/activities',             [AdminController::class, 'showActivities'])->name('admin.activities');
    Route::post('/admin/activities',            [AdminController::class, 'storeActivity'])->name('admin.activities.store');
    Route::put('/admin/activities/{activity}',  [AdminController::class, 'updateActivity'])->name('admin.activities.update');
    Route::delete('/admin/activities/{activity}', [AdminController::class, 'destroyActivity'])->name('admin.activities.destroy');
});
