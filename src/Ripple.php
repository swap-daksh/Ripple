<?php

namespace GitLab\Ripple;

use Illuminate\Support\Facades\DB;

class Ripple
{

    use \GitLab\Ripple\Support\Traits\Categories;
    use \GitLab\Ripple\Support\Traits\Posts;
    use \GitLab\Ripple\Support\Traits\DatabaseTables;

    public static function settings()
    {
        return DB::table('settings')->get();
    }

    public static function setting($key, $default = null)
    {
        $setting = DB::table('settings')->where('key', $key)->first();
        if (isset($setting->id)) {
            return $setting->value;
        }

        return $default;
    }

    public function help()
    {
        dd('This is help method');
    }

}
