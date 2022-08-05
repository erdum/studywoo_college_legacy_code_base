<?php

namespace Modules\College\Http\Controllers;

use Faker\Provider\Uuid;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Modules\College\Entities\Image as EntitiesImage;


class ImageController extends Controller
{
    public static function uploadImage(UploadedFile $file, $thumb_width, $thumb_height, $path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        // image filename
        $filename = random_int(10, 99).time() . "." . $file->getClientOriginalExtension();
        $img = Image::make($file);

        // saving original image
        $img->save($path . '/' . $filename);

        self::createThumbnail($img, $thumb_width, $thumb_height, $path . "/thumb", $filename);

        self::createThumbnail($img, 1086, 450, $path . "/feature", $filename , true);
        return EntitiesImage::create([
            'path' => $path,
            'filename' => $filename
        ]);
    }


    public static function createThumbnail(\Intervention\Image\Image $img, $thumb_width, $thumb_height, $path, $filename , $absolute =false )
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        // resize the image so that the largest side fits within the limit; the smaller
        // side will be scaled to maintain the original aspect ratio
        if($absolute){
            $img->resize($thumb_width, $thumb_height);
        }
        $img->resize($thumb_width, $thumb_height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        //      saving thumbnail image
        $img->save($path . '/' . $filename);
    }
}
