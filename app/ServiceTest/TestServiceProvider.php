<?php

namespace App\ServiceTest;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //注册服务，而且是延迟的那种
        $this->app->bind(GenericService::class,GenericService::class);
        $this->app->bind(ServiceContract::class,GenericService::class);
        $instance = new InstanceService();
        $this->app->instance('instanceService',$instance);
    }

    public function provides()
    {
        return [GenericService::class,
            ServiceContract::class,
            'instanceService',
                ];
    }
}
