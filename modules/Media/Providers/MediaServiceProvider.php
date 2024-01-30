<?php

namespace Media\Providers;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/media_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Media');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->mergeConfigFrom(__DIR__ . '/../Config/mediaFile.php', 'mediaFile');
    }


    public function boot()
    {

    }
}
