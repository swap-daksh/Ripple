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

if (!function_exists('ripple_asset')) {

    function ripple_asset($url) {
        $asset_url = config('ripple.assets_url', '/vendor/etu/ripple/assets');
        return $asset_url . $url;
    }

}

if (!function_exists('ripple_flash')) {

    function ripple_flash($key, $message) {
        dd('asdfasdf');
    }

}

