<?php

namespace App\Providers;

use App\Repositories\Contracts\IBaseRepository;
use App\Repositories\Eloquent\CreditRepository;
use App\Repositories\Eloquent\ProjectRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IBaseRepository::class,CreditRepository::class);
        $this->app->bind(IBaseRepository::class,ProjectRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
