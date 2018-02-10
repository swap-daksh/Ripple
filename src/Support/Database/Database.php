<?php

namespace YPC\Ripple\Support\Database;

use YPC\Ripple\Support\Traits\DatabaseTables;

class Database
{

    use DatabaseTables;

    protected $table;

    /**
     * Get all table columns
     * @param String $table
     * @return Array
     */
    public function tableColumns($table, $conversion = 'toArray')
    {
        return collect(dbal_db()->listTableColumns($table))->map(function($column) {
                    return [
                        'column' => $column->getName(),
                        'dataType' => (string) $column->getType(),
                        'length' => $column->getLength(),
                        'notnull' => $column->getNotnull(),
                        'default' => $column->getDefault(),
                        'unsigned' => $column->getUnsigned(),
                        'autoincrement' => $column->getAutoincrement(),
                        'fixed' => $column->getFixed(),
                        'definition' => $column->getColumnDefinition(),
                        'comment' => $column->getComment(),
                        'precision' => $column->getPrecision(),
                        'scale' => $column->getScale(),
                    ];
                })->{$conversion}();
    }

    public function table($table)
    {
        return dbal_db()->listTableDetails($table);
    }

}
