<?php
namespace YPC\Ripple\Support\Faker;

use Illuminate\Http\Testing\FileFactory as AppFileFactory;

class FileFactory extends AppFileFactory
{

        /**
     * Generate a dummy image of the given width and height.
     *
     * @param  int  $width
     * @param  int  $height
     * @return resource
     */
    protected function generateImage($width, $height)
    {
        return tap(tmpfile(), function ($temp) use ($width, $height) {
            ob_start();
            $image = imagecreatetruecolor($width, $height);
            $color = imagecolorallocate($image, 192, 192, 192);
            imagefill($image, 0, 0, $color);
            imagepng($image);

            fwrite($temp, ob_get_clean());
        });
    }
}
