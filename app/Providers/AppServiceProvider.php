<?php

namespace App\Providers;

use App\Repositories\Eloquent\BlogRepository;
use App\Repositories\Eloquent\EventRepository;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\EventRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(
        BlogRepositoryInterface::class,
        BlogRepository::class
    );

    $this->app->bind(
        EventRepositoryInterface::class,
       EventRepository::class
    );
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
         Schema::defaultStringLength(191);
    }
}
