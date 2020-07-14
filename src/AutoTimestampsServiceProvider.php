<?php

namespace Esign\AutoTimestamps;

use Esign\AutoTimestamps\Database\ExtendedMySqlConnection;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class AutoTimestampsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/auto-timestamps.php' => config_path('auto-timestamps.php')
        ]);

        Blueprint::macro(config('auto-timestamps.migration_helper_name'), function() {
            $this->timestamp('created_at')->useCurrent();
            $this->timestamp('updated_at')->useCurrentUpdate();

            return $this;
        });
    }

    public function register()
    {
        foreach (config('auto-timestamps.connections') as $connectionName) {
            Connection::resolverFor($connectionName, function ($connection, $database, $prefix, $config) {
                return new ExtendedMySqlConnection($connection, $database, $prefix, $config);
            });
        }
    }
}
