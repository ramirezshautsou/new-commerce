<?php

namespace App\Providers;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
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
use App\Repositories\UserRole\Interfaces\UserRoleRepositoryInterface;
use App\Repositories\UserRole\UserRoleRepository;
use App\View\Composers\CategoryComposer;
use App\View\Composers\ProducerComposer;
use App\View\Composers\ProductComposer;
use App\View\Composers\ServiceComposer;
use App\View\Composers\UserComposer;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerBindings();
        $this->registerViewComposers();
        $this->registerExternalServices();
    }

    /**
     * @return void
     */
    private function registerBindings(): void
    {
        $bindings = [
            ProductRepositoryInterface::class => ProductRepository::class,
            CategoryRepositoryInterface::class => CategoryRepository::class,
            ProducerRepositoryInterface::class => ProducerRepository::class,
            ServiceRepositoryInterface::class => ServiceRepository::class,
            UserRepositoryInterface::class => UserRepository::class,
            UserRoleRepositoryInterface::class => UserRoleRepository::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * @return void
     */
    private function registerViewComposers(): void
    {
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
     * @return void
     */
    private function registerExternalServices(): void
    {
        $this->app->singleton(S3Client::class, function () {
            return new S3Client([
                'region' => env('AWS_DEFAULT_REGION'),
                'version' => 'latest',
                'endpoint' => env('AWS_ENDPOINT'),
                'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
                'debug' => env('AWS_DEBUG'),
            ]);
        });

        $this->app->singleton(AMQPStreamConnection::class, function () {
            return new AMQPStreamConnection(
                config('rabbitmq.connections.rabbitmq.host'),
                config('queue.connections.rabbitmq.port'),
                config('queue.connections.rabbitmq.user'),
                config('queue.connections.rabbitmq.pass'),
            );
        });
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        Route::middlewareGroup('auth', [
            Authenticate::class,
        ]);

        Route::middlewareGroup('user', [
            RedirectIfAuthenticated::class,
        ]);
    }
}
