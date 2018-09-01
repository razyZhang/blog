<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Razy\Signature\SignatureManager;
use App\Razy\Signature\Facade\Signature;
use App\Model\Sign as Sign;
use App\Model\User as User;

class SignatureServiceProvider extends ServiceProvider
{
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
        $this->app->bind(SignatureManager::class, function ($app) {
            return new SignatureManager($app);
        });

        $this->app->alias(SignatureManager::class, 'Signature');
    }
}
