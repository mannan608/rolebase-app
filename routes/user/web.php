<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\FrontendController;
use App\SEO\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'landingPage'])->name('home');
Route::get('/about', [FrontendController::class, 'aboutPage'])->name('about');
Route::get('/contact', [FrontendController::class, 'contactPage'])->name('contact');

Route::get('/generate-sitemap', [SitemapController::class, 'generate']);

Route::get('/blogs', [BlogController::class, 'index'])
    ->name('blogs');

Route::get('/blogs/{slug}', [BlogController::class, 'show'])
    ->name('blog-details');

Route::get('/events', [EventController::class, 'index'])
    ->name('events');

Route::get('/events/{slug}', [EventController::class, 'show'])
    ->name('event-details');