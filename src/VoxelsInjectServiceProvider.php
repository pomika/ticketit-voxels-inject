<?php

namespace Voxels\VoxelsInject;

use Illuminate\Support\ServiceProvider;

class VoxelsInjectServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router, \Illuminate\Contracts\Http\Kernel $kernel)
    {
        // Add middleware to app
        $kernel->prependMiddleware(VoxelsInjectMiddleware::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
