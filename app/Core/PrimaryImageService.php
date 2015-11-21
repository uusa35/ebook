<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/1/15
 * Time: 12:09 PM
 */

namespace App\Core;


use Illuminate\Support\Str;

class PrimaryImageService
{

    public function CreateImage($currentImage, $folderName, $thumbResize, $largeResize)
    {


        $fileName = $currentImage->getClientOriginalName();

        $fileName = rand(0, 10000) . '' . $fileName;

        $realPath = $currentImage->getRealPath();


        \Image::make($realPath)->resize($thumbResize[0],

            $thumbResize[1])->save(public_path('images/uploads/' . $folderName . '/thumbnail/' . $fileName));

        \Image::make($realPath)->resize($largeResize[0],
            $largeResize[1])->save(public_path('images/uploads/' . $folderName . '/large/' . $fileName));

        return $fileName;

    }

}