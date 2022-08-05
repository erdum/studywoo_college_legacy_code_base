<?php
namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Http\UploadedFile;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Modules\College\Entities\Image as EntitiesImage;

class ImageRepository{
    use RepositoryTrait;
    use ControllerTrait;

    public function uploadImage(UploadedFile $file, $thumb_width, $thumb_height, $path)
    {
        $thumb_path = $path . "/thumb";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if (!file_exists($thumb_path)) {
            mkdir($thumb_path, 0777, true);
        }

        // image filename
        $filename = time() . "." . $file->getClientOriginalExtension();
        $img = Image::make($file);

        // saving original image
        $img->save($path . '/' . $filename);

        // resize the image so that the largest side fits within the limit; the smaller
        // side will be scaled to maintain the original aspect ratio
        $img->resize($thumb_width, $thumb_height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        //      saving thumbnail image
        $img->save($thumb_path . '/' . $filename);

        return EntitiesImage::create([
            'path' => $path,
            'filename' => $filename
        ]);
    }
}
