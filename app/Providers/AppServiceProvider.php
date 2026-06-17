<?php

namespace App\Providers;

use App\Repositories\AlternativeRepository;
use App\Repositories\CriteriaRepository;
use App\Repositories\Interfaces\AlternativeRepositoryInterface;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind repository interfaces to their implementations
        $this->app->bind(
            CriteriaRepositoryInterface::class,
            CriteriaRepository::class,
        );

        $this->app->bind(
            AlternativeRepositoryInterface::class,
            AlternativeRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
