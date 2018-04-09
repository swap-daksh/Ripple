<?php

use YPC\Ripple\Support\Database\Schema\SchemaManager;

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
                $name .= '.' . request()->file($file)->extension();
            }
            if (!@$path) {
                $path = 'public';
            }

            return request()->file($file)->storeAs($path, $name);
        } else {
            return request($file);
        }
    }

}

if (!function_exists('dbal_db')) {

    /**
     * returns Doctorine Dbal2 connection
     * @return Object
     */
    function dbal_db()
    {
        return SchemaManager::databaseManager();
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
        return url(config('ripple.assets_url', '/vendor/gitlab/ripple/assets') . $url);
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
     * @parems instance, property array, return type
     */
    function DBinsert($model, $properties, $return = "OBJ")
    {
        foreach ($properties as $column => $value)
        {
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


if (!function_exists('prefix')) {

    function prefix($name)
    {
        return config('ripple.tablePrefix', 'rpl') . '_' . $name;
    }

}


if(!function_exists('storage_file_size')){
    function storage_file_size($file, $return = 'string'){
        $size = \Illuminate\Support\Facades\Storage::size($file);
        $sizeInString = '';
        if ($size >= 1024 && $size < 1048576) {
            $sizeInString = round($size / 1024, 2) . 'KB';
        } else if ($size >= 1048576 && $size < 1073741824) {
            $sizeInString = round($size / 1048576, 2) . 'MB';
        }
        if($return == 'string'){
            return $sizeInString;
        }else{
            return $size;
        }
    }
}