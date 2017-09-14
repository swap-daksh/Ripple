<?php

namespace GitLab\Ripple\Support\Database\Schema;

use Illuminate\Support\Facades\DB; 

abstract class SchemaManager
{
    public static function databaseManager()
    {
        return DB::connection()->getDoctrineSchemaManager();
    }

    public static function make($table)
    {
        return self::databaseManager()->createTable($table);
    }

    public static function getConnection()
    {
        return DB::connection()->getDoctrineConnection();
    }

    public static function schemaTable($tableName)
    {
        return self::schema()->createTable($tableName);
    }

    public static function schema()
    {
        return new \Doctrine\DBAL\Schema\Schema();
    }
}
