<?php

namespace App\Providers;

use App\Services\GitHubService;
use App\Services\GitHubServiceInterface;
use App\Services\MovieService;
use App\Services\MovieServiceInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Services\MovieServiceInterface', function ($app) {
            return new MovieService();
        });

        $this->app->bind('App\Services\GitHubServiceInterface', function ($app) {
            return new GitHubService();
        });
    }
}
