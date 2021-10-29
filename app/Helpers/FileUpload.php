<?php

namespace App\Helpers;
use Illuminate\Support\Facades\File;

class FileUpload
{
    public static function fileUpload($image, $model, $path)
    {
        try{
            if(isset($model)) {
                $modelImage = '';
                if($model->image) {
                    $modelImage = public_path($path."{$model->image}");
                }

                if($model->logo) {
                    $modelImage = public_path($path."{$model->logo}");
                }

                if (File::exists($modelImage)) { // unlink or remove previous image
                    unlink($modelImage);
                }
            }

            $img = $image;
            $image_name = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path() . $path, $image_name);
            //dd($image_name);

            return $image_name;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
