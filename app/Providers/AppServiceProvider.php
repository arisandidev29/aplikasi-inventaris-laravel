<?php

namespace App\Providers;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use ImageKit\ImageKit;
use League\Flysystem\Filesystem;
use TaffoVelikoff\ImageKitAdapter\ImagekitAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        Storage::extend('imagekit', function ($app, $config) {
            // 1. Inisialisasi SDK ImageKit murni
            $client = new ImageKit(
                $config['public_key'], // Sesuaikan dengan key di config/filesystems.php
                $config['private_key'],
                $config['endpoint_url']
            );

            // 2. Buat adapter dari package TaffoVelikoff
            $adapter = new ImagekitAdapter($client);

            // 3. Bungkus adapter ke dalam League\Flysystem\Filesystem
            $operator = new Filesystem($adapter);

            // 4. Kembalikan sebagai FilesystemAdapter milik Laravel
            return new FilesystemAdapter($operator, $adapter, $config);
        });
    }
}
