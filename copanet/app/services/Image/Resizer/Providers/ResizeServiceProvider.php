<?php

namespace Services\Image\Resizer\Providers;

use Illuminate\Support\ServiceProvider;

class ResizeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('resize', function() {
            return new \Services\Image\Resizer\Resize;
        });
    }
}
