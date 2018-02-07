<?php

namespace YPC\Ripple\Support\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
/**
 *
 * @author Yash Pal
 */
trait Breads
{

    public function hasEnabledBread($table)
    {
        return DB::table(prefix('breads'))->where('id', $table)->where('status', '1')->exists();
    }

    public function hasBreadSlug()
    {
        if(Schema::hasTable(prefix('breads'))){
        $collect = collect(DB::table(prefix('breads'))->get());
        if ($collect->isNotEmpty()) {
            return implode('|', $collect->map(function($bread) {
                        return $bread->slug;
                    })->toArray());
        } else {
            return '.';
        }
    }
    }

}
