<?php

namespace YPC\Ripple\Support\Database;

class Database
{

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
                        'name' => $column->getName(),
                        'type' => (string) $column->getType(),
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
        $this->table = $table;
        return $this;
    }

}
