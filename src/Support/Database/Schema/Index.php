<?php

namespace YPC\Ripple\Schema;

use Doctrine\DBAL\Schema\Index as DbalIndex;

class Index
{

    const PRIMARY = 'PRIMARY';
    const UNIQUE = 'UNIQUE';
    const INDEX = 'INDEX';

    public function make(array $column)
    {
//        $column = array_diff_key($column, ['$$hashKey' => $column['$$hashKey']]);
        if ($column['default'] == null) {
            $column = array_diff_key($column, ['default' => $column['default']]);
        }
        $name = strtolower($column['index']);
        $columns = [$column['name']];
        $type = $column['index'];
        $isPrimary = ($type == static::PRIMARY);
        $isUnique = $isPrimary || ($type == static::UNIQUE);
        $flags = isset($column['flags']) ? $column['flags'] : [];
        $options = isset($column['options']) ? $column['options'] : [];
        return new DbalIndex($name, $columns, $isUnique, $isPrimary, $flags, $options);
    }

}
