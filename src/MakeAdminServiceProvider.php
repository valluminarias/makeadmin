<?php

namespace ValLuminarias\MakeAdmin;

use Illuminate\Support\ServiceProvider;
use ValLuminarias\MakeAdmin\Console\Commands\MakeAdmin;

class MakeAdminServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeAdmin::class,
            ]);
        }

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }
}
