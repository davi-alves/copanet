<?php

namespace Services\Image\Uploader\Providers;

use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('upload', function() {
            return new \Services\Image\Uploader\Upload;
        });
    }
}
