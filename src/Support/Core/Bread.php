<?php

namespace YPC\Ripple\Support\Core;

use Illuminate\Support\Facades\DB;

/**
 * Description of Bread
 *
 * @author Yash Pal
 */
class Bread
{

    protected $table;

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function getColumns($table, $conversion = 'toArray')
    {
        return DB::table(prefix('bread_columns'))->join(prefix('breads'), function($breads) use ($table) {
                    $breads->on(prefix('bread_columns.bread'), '=', prefix('breads.id'))->where(prefix('breads.table'), '=', $table);
                })->select(prefix('bread_columns.*'))->get()->{$conversion}();
    }

    public function hasColumns()
    {
        // for later use
    }

}
