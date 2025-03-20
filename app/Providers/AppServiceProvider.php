<?php

namespace App\Providers;

use App\Repositories\Product\CategoryRepository;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use App\Repositories\Product\ProducerRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(ProducerRepositoryInterface::class, ProducerRepository::class);

        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
