<?php

namespace G2A\Integrations\Laravel;

use G2A\Sdk;
use Illuminate\Support\ServiceProvider;

class G2aServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__.'/laravel-config.php' => 'g2a.php']);
    }

    public function register()
    {
        $this->app->bind('G2A', function () {
            $configs = config('g2a');

            return new Sdk(
                $configs['hash'],
                $configs['email'],
                $configs['secret'],
                $configs['environment']
            );
        });
    }
}
