<?php

namespace GitLab\Ripple;

use Illuminate\Support\Facades\DB;

class Ripple
{
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
