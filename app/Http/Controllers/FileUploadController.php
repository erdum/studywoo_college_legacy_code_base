<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function saveToWebp($src, $destination, $extension)
    {
        $image = null;
        if ($extension == 'webp') {
            $image = imagecreatefromwebp($src);
    	} elseif ($extension == 'jpeg' || $extension == 'jpg') {
    	    $image = imagecreatefromjpeg($src);
    	} elseif ($extension == 'gif') {
    	    $image = imagecreatefromgif($src);
    	} elseif ($extension == 'png') {
    	    $image = imagecreatefrompng($src);
    	}
    	
    	if ($image == null) {
    	    throw new \Exception('File type not supported', 422);
    	}
    	
    	return imagewebp($image, public_path($destination), 75);
    }
    
    public function upload(Request $request)
    {
        if (count($request->files) > 0) {
            
            foreach ($request->files as $file)
            {
                $file_name = explode('.', $file->getClientOriginalName());
                $extension = end($file_name);
                $file_name = $file_name[0];
                
                if (!$this->saveToWebp($file, 'photos/' . $file_name . '.webp', $extension)) {
                    return response()->json(['message' => 'failed to save image']);
                }
            }
            
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'No file found in the request'], 400);
        }
    }
    
    public function pilot_upload(Request $request)
    {
        if ($request->hasFile('images')) {
            $images = $request->allFiles();

            foreach ($images as $img)
            {
                $img_name = explode('.', $img->getClientOriginalName());
                $extension = end($img_name);
                
                array_pop($img_name);
                $img_name = implode('.', $img_name);
                
                try {
                    $this->saveToWebp($img, 'photos/' . $img_name . '.webp', $extension);
                    return response()->json(['message' => 'success']);
                } catch (\Exception $e) {

                    if ($e->getCode() == 422) {
                        return response()->json(['message' => $e->getMessage()], $e->getCode());
                    }
                    
                    return response()->json(['message' => 'Failed to save image on the server'], 500);
                }
            }
        } else {
            return response()->json(['message' => 'No file found in the request'], 400);
        }
    }
}
