<?php

namespace YPC\Ripple\Support\Traits;

use Illuminate\Support\Facades\DB;

trait DatabaseTables
{

    public static function tables()
    {
        $dbTables = DB::select('SHOW TABLES');
        $tables = array_map(function ($table) {
            $get_object_vars = get_object_vars($table);

            return reset($get_object_vars);
        }, $dbTables);

        return $tables;
    }

    public function tablesBreadWithStatus()
    {
        return collect(DB::table(prefix('breads'))->get())->map(function($bread) {
                    $columns = array_keys(dbal_db()->listTableColumns($bread->table));
                    return ['table' => $bread->table, 'status' => $bread->status, 'columns' => $columns];
                })->toArray();
    }

    /**
     * Get all tables with columns
     * 
     * @return array
     */
    public function tablesWithColumns($conversion = 'toArray')
    {
        return collect(self::tables())->mapWithKeys(function($table) {
                    return [$table => array_keys(dbal_db()->listTableColumns($table))];
                })->{$conversion}();
    }

    /**
     * 
     */
}
