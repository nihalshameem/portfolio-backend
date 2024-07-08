<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MongoDB\Client;

class MongoDBServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            $config = config('database.mongodb');
            $uri = "mongodb://{$config['host']}:{$config['port']}";
            return new Client($uri, [
                'username' => $config['username'],
                'password' => $config['password'],
                'db'       => $config['database'],
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
