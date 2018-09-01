<?php

namespace App\Providers;

use Illuminate\Session\FileSessionHandler;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use SCS;
use SCSAdapter;
use Illuminate\Support\ServiceProvider;

class SCSFilesystemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('scs', function($app, $config){ 
           $client = new SCS($config['accessKey'], $config['secretKey']);
            return new Filesystem(new SCSAdapter($client, $config['bucket']));
        });
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
