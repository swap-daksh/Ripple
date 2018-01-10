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

    public function table($table, $conversion = 'toArray')
    {
        return collect(DB::table(prefix('breads'))->where('table', $table)->first())->{$conversion}();
    }

    public function getColumns($table, $conversion = 'toArray')
    {
        return collect(
                        DB::table(prefix('bread_columns'))
                                ->join(prefix('breads'), function($breads) use ($table) {
                                    $breads->on(prefix('bread_columns.bread'), '=', prefix('breads.id'))->where(prefix('breads.table'), '=', $table);
                                })->select(prefix('bread_columns.*'))->orderBy('order', 'asc')->get()
                )->mapWithKeys(function($column) {
                    return [$column->column => (array) $column];
                })->{$conversion}();
    }

    public function hasColumns()
    {
        // for later use
    }

}
