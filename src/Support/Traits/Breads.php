<?php

namespace YPC\Ripple\Support\Traits;

use Illuminate\Support\Facades\DB;

/**
 *
 * @author Yash Pal
 */
trait Breads
{

    public function hasEnabledBread($table)
    {
        return intval(DB::table('bread_meta')->where('table', $table)->where('key', 'status')->value('value'));
    }

}
