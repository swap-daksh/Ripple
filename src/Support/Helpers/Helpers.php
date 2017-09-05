<?php

if (!function_exists('storeFileAs')) {

    /**
     * <b>storeFileAs()</b> refers to the laravel storage.<br>
     * This function equals to following statement<br>
     * <i>request()->file($file)->storeAs($path, $filename)</i>.
     *
     * @param string $file file
     * @param string $name Name of file name to be stored
     * @param string $path Path where file should be stored
     *
     * @return string File path
     */
    function storeFileAs($file, $name = null, $path = null)
    {
        if (request()->hasFile($file)) {
            if (!@$name) {
                $name = request()->file($file)->getClientOriginalName();
            } else {
                $name .= '.'.request()->file($file)->extension();
            }
            if (!@$path) {
                $path = 'public';
            }

            return request()->file($file)->storeAs($path, $name);
        }else{
            return request($file);
        }
    }
}

if (!function_exists('ripple_asset')) {

    /**
     * <b>ripple_asset()</b> locate assets which are moved to via ripple:install command to public directory.
     *
     * @param string $url Specify asset path in public directory.
     *
     * @return string asset full path.
     */
    function ripple_asset($url)
    {
        return url(config('ripple.assets_url', '/vendor/gitlab/ripple/assets').$url);
    }
}

if (!function_exists('ripple_test')) {
//    echo 'this is ripple test function';
}

if (!function_exists('ripple_flash')) {
    function ripple_flash($key, $message)
    {
        dd('asdfasdfasfd');
    }
}


if (!function_exists('DBinsert')) {

    /**
     * Save Request Data to Database 
     * @return boolean or {object}
     * @parems instance, $array, Object
     */
    function DBinsert($model, $properties, $return = "OBJ") {
        foreach ($properties as $column => $value) {
            $model->$column = $value;
        }
        if ($return === "OBJ") {
            $model->save();
            $get = $model;
        } else {
            $get = $model->save();
        }
        return $get;
    }

}