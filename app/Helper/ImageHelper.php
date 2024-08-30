<?php

namespace App\Helper;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageHelper {
    public static function createImage($model, $method, $image, $dir = "") {
        $path = Storage::putFile("public/images/$dir", $image);
        $url = Storage::url($path);
        $model->$method()->create([
            'url' => $url
        ]);
    }

    public static function delete(Image $img) {
        //change old url path to laravel file path
        $path = str_replace('/storage/', 'public/', $img->url);

        if(Storage::exists($path)) {
            // Delete Old img in laravel project
            Storage::delete($path);
        }    
        $img->delete();
    }
}