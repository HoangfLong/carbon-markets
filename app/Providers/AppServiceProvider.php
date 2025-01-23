<?php

namespace App\Providers;

use App\Interfaces\IProjectRepository;
use App\Repositories\CreditRepository;
use App\Interfaces\ICreditRepository;
use App\Interfaces\IPaymentRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IProjectRepository::class, ProjectRepository::class);
        $this->app->bind(ICreditRepository::class, CreditRepository::class);
        $this->app->bind(IPaymentRepository::class, PaymentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
