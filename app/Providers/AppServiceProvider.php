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
use App\View\Composers\CategoryComposer;
use App\View\Composers\ProducerComposer;
use App\View\Composers\ProductComposer;
use App\View\Composers\ServiceComposer;
use App\View\Composers\UserComposer;
use Illuminate\Support\Facades\View;
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

        View::composer([
            'products.create',
            'products.edit',
            'products.index',
            'products.show',
        ], ProductComposer::class);

        View::composer([
            'categories.create',
            'categories.index',
            'categories.edit',
        ], CategoryComposer::class);

        View::composer([
            'producers.create',
            'producers.index',
            'producers.edit',
        ], ProducerComposer::class);

        View::composer([
            'services.create',
            'services.index',
            'services.edit',
        ], ServiceComposer::class);

        View::composer([
            'admin.users.create',
            'admin.users.index',
            'admin.users.edit',
        ], UserComposer::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
