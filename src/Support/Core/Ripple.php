<?php

namespace YPC\Ripple\Support\Core;

use Illuminate\Support\Facades\DB;

class Ripple
{

    use \YPC\Ripple\Support\Traits\Posts;
    use \YPC\Ripple\Support\Traits\Breads;
    use \YPC\Ripple\Support\Traits\Categories;
    use \YPC\Ripple\Support\Traits\Settings;
    use \YPC\Ripple\Support\Traits\DatabaseTables;

    public static function settings()
    {
        return DB::table('rpl_settings')->get();
    }

    public static function setting($key, $default = null)
    {
        $setting = DB::table('rpl_settings')->where('key', $key)->first();
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
