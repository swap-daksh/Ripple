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
        dd(\Doctrine\DBAL\Types\Type::getTypesMap());
        foreach ($columns as $column) {
            $this->columns[] = $this->column((object) $column);
        }
    }

    public function column($column)
    {
        return (array) [
                    'name'    => $column->name,
                    'type'    => $column->type,
                    'options' => self::columnOptions($this->columnNullable($this->columnUnsigned((array) $column))),
        ];
//        $this->column = $column;
//        dd($column['options']);
//        dd($this->column);
//        $this->table->addColumn($column['name'], $column['type'], $column['options']);
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
//        $listOptions = $this->columnNullable($listOptions);
        $columnOptions = (array) [];
        foreach ($listOptions as $key => $value) {
            if ($value === 'on') {
                $columnOptions[$key] = true;
                continue;
            }
            $columnOptions[$key] = $value;
        }
//        $columnOptions = $this->columnNullable($this->columnUnsigned($columnOptions));
//        dd($columnOptions);
        return $columnOptions;
    }
}
