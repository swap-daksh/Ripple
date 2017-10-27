<?php

namespace GitLab\Ripple\Schema;

use Doctrine\DBAL\Schema\Table as DoctrineTable;
use GitLab\Ripple\Support\Database\Schema\SchemaManager;
use GitLab\Ripple\Schema\Column;
use GitLab\Ripple\Schema\Index;

class Table
{

    private $table;

    public function make($table)
    {
        $name = (string) $table['table'];
        $columns = [];
        $indexes = [];
        foreach (json_decode($table['columns'], true) as $column):
            if (strlen($column['index']) >= 1):
                $index = (new Index())->make($column);
                $indexes[$index->getName()] = $index;
            endif;
            $column = (new Column())->make($column);
            $columns[$column->getName()] = $column;

        endforeach;
        $foreignKeys = [];
        $options = isset($table['options']) ? $table['options'] : [];
        $this->table = (new DoctrineTable($name, $columns, $indexes, $foreignKeys, false, $options));
        return $this;
    }

    public function create()
    {
        SchemaManager::databaseManager()->createTable($this->table);
        return true;
    }

}
