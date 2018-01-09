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
    public function tableColumns($table)
    {
        return collect(dbal_db()->listTableColumns($table))->mapWithKeys(function($column) {
                    return [
                        'name' => $column->getName(),
                        'type' => $column->getType(),
                        'notnull' => $column->getNotnull()
                    ];
                });
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

}
