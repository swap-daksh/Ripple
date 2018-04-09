<?php

namespace YPC\Ripple\Schema;

use Doctrine\DBAL\Schema\Column as NewColumn;
use Doctrine\DBAL\Types\Type as DataType;

class Column
{

    private $name;
    private $type;
    private $length;
    private $default;
    private $unsigned;
    private $notnull;
    private $autoincrement;

    public function make($column)
    {
        $name = $column['name'];
        $type = DataType::getType(trim($column['type']));
        $hash = $column['$$hashKey'];
        $options = array_diff_key($column, ['name' => $name, 'type' => $type, '$$hashKey' => $hash]);
        return (new NewColumn($name, $type, $options));
    }

    public function nullable()
    {
        
    }

}
