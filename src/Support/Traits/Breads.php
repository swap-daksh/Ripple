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
        return intval(DB::table(prefix('breads_meta'))->where('table', $table)->where('key', 'status')->value('value'));
    }

    public function hasBreadSlug()
    {
        return implode('|', collect(DB::table(prefix('breads'))->get())->map(function($bread) {
                    return $bread->slug;
                })->toArray());
    }

}
