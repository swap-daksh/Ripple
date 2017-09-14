<?php

namespace GitLab\Ripple\Schema;

use GitLab\Ripple\Support\Database\Schema\SchemaManager;

class Table
{

    private $table;
    private $columns;

    public function __construct($table)
    {
        return $this->table = SchemaManager::schemaTable($table);
    }

    public function table($table)
    {
        return $this;
    }

    public function columns($columns)
    {
        foreach ($columns as $column)
        {
            $column = $this->column((object) $column);
            $this->addColumn($column)->columns[] = $column;
        }
        return $this;
    }

    public function column($column)
    {
        return (array) [
                    'name' => $column->name,
                    'type' => $column->type,
                    'options' => self::columnOptions($this->columnNullable($this->columnUnsigned((array) $column))),
        ];
    }

    public function addColumn($column)
    {
        $this->table->addColumn($column['name'], $column['type'], $column['options']);
        return $this;
    }

    public function create()
    {
        $this->table->setPrimaryKey(['id']);
        SchemaManager::databaseManager()->createTable($this->table);
    }

    public function columnNullable($columnArray)
    {
        if (!array_key_exists('nullable', $columnArray)):
            $columnArray['nullable'] = false;
        endif;

        return $columnArray;
    }

    public function columnUnsigned($columnArray)
    {
        if (!array_key_exists('unsigned', $columnArray)):
            $columnArray['unsigned'] = false;
        endif;

        return $columnArray;
    }

    public function columnAutoIncrement($columnArray)
    {
        if (!array_key_exists('unsigned', $columnArray)):
            $columnArray['unsigned'] = false;
        endif;

        return $columnArray;
    }

    private static function columnOptions($options)
    {
        $listOptions = array_diff_key($options, collect($options)->only('name', 'type', 'index')->toArray());
        $columnOptions = (array) [];
        foreach ($listOptions as $key => $value)
        {
            if ($value === 'on') {
                $columnOptions[$key] = true;
                continue;
            }
            $columnOptions[$key] = $value;
        }
        return $columnOptions;
    }

}
