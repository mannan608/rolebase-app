<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\SEO\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');

Route::prefix('role.admin,active.user')->name('admin.')->middleware(['auth', 'role:admin', 'active.user'])->group(function () {

    Route::get('/dashboard', function () {
        return view('backend.pages.dashboard.index', [
            'title' => 'Admin Dashboard'
        ]);
    })->name('dashboard');
    // Route::resource('seo', SeoController::class);

    // Route::resource('blogs', BlogController::class);

    // Route::resource('events', EventController::class);

    Route::resource('roles-permissions', RolePermissionController::class);

});
