<?php

namespace GitLab\Ripple\Traits;

use Illuminate\Support\Facades\DB;

trait DatabaseTables
{
    private static function tables()
    {
        $dbTables = DB::select('SHOW TABLES');
        $tables = array_map(function ($table) {
            $get_object_vars = get_object_vars($table);

            return reset($get_object_vars);
        }, $dbTables);

        return $tables;
    }
}
