<?php

if (!function_exists('storeFileAs')) {

    /**
     * <b>storeFileAs()</b> refers to the laravel storage.<br>
     * This function equals to following statement<br>
     * <i>request()->file($file)->storeAs($path, $filename)</i>
     * @param String $file file
     * @param String $name Name of file name to be stored
     * @param String $path Path where file should be stored
     * @return string File path
     */
    function storeFileAs($file, $name = null, $path = null) {
        if (request()->hasFile($file)) {
            if (!@$name) {
                $name = request()->file($file)->getClientOriginalName();
            } else {
                $name .= '.' . request()->file($file)->extension();
            }
            if (!@$path) {
                $path = 'public';
            }
            return request()->file($file)->storeAs($path, $name);
        }
    }

}
//i KNOW SOME PEOPLE NOT HAPPY WITH ME BECAUSE I AM NOT SO GOOD BUT FEW PEOPLE SURELY LOVE ME BECAUSE THEY KNOW THAT MY LITTLE GOODNESS IS NOT FAKE

if (!function_exists('ripple_asset')) {

    /**
     * <b>ripple_asset()</b> locate assets which are moved to via ripple:install command to public directory
     * @param String $url Specify asset path in public directory.
     * @return String asset full path.
     */
    function ripple_asset($url) {
        return url(config('ripple.assets_url', '/vendor/gitlab/ripple/assets') . $url);
    }

}

if (!function_exists('ripple_test')) {
//    echo 'this is ripple test function';
}

if (!function_exists('ripple_flash')) {

    /**
     * 
     */
    function ripple_flash($key, $message) {
        dd('asdfasdfasfd');
    }

}

