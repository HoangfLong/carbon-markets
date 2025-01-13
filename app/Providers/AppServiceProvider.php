<?php

namespace App\Providers;

use App\Repositories\IProjectRepository;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IProjectRepository::class, ProjectRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
