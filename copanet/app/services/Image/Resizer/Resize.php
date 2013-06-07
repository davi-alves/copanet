<?php

namespace Services\Image\Resizer;

use \Config;
use \Image;
use \File;
use Services\Image\Uploader\Facades\Upload;

class Resize
{

    public function make($url, $width, $height)
    {
        $path = Upload::getPathFromUrl($url);
        if(! File::exists($path)) {
            return '';
        }

        $oldFile = Image::make($path);
        $newName = $oldFile->filename . "-{$width}x{$height}." . $oldFile->extension;
        $newPath = $oldFile->dirname . "/$newName";

        if(!File::exists($newPath)) {
            File::copy($path, $newPath);
            $newFile = Image::make($newPath);
            $newFile->resize($width, $height);
            $newFile->save();
        }

        return Upload::getUrlFromPath($newPath);
    }

}
