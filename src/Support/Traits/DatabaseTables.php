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
        return array_map(function($table) {
            $DB = DB::table('bread_meta')->where('table', $table)->where('key', 'status');
            $columns = array_keys(dbal_db()->listTableColumns($table));
            if ($DB->exists()):
                switch ($DB->first()->value):
                    case true:
                        return ['table' => $table, 'status' => 1, 'columns' => $columns];
                    default:
                        return ['table' => $table, 'status' => 0, 'columns' => $columns];
                endswitch;
            else:
                return ['table' => $table, 'status' => 0, 'columns' => $columns];
            endif;
        }, self::tables());
    }

}
