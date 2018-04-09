<?php

namespace YPC\Ripple\Support\Database\DataTypes;

use Doctrine\DBAL\Types\Type as DBALTYPES;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class Type extends DBALTYPES
{

    const TINYINT = 'tinyint';
    const TINYTEXT = 'tinytext';
    const MEDIUMTEXT = 'mediumtext';
    const LONGTEXT = 'longtext';
    const VARCHAR = 'varchar';
    const CHAR = 'char';
    const TIMESTAMP = 'timestamp';
    const YEAR = 'year';
    const LONGBLOB = 'longblob';
    const MEDIUMBLOB = 'mediumblob';
    const TINYBLOB = 'tinyblob';
    const VARBINARY = 'varbinary';
    const BIT = 'bit';
    const SET = 'set';
    const ENUM = 'enum';
    const GEOMETRYCOLLECTION = 'geometrycollection';
    const GEOMETRY = 'geometry';
    const LINESTRING = 'linestring';
    const MULTILINESTRING = 'multilinestring';
    const MULTIPOINT = 'multipoint';
    const MULTIPOLYGON = 'multipolygon';
    const POINT = 'point';
    const POLYGON = 'polygon';

    public static $register = [
        self::TINYINT => \YPC\Ripple\Support\Database\DataTypes\Types\TinyInt::class,
        self::TINYTEXT => \YPC\Ripple\Support\Database\DataTypes\Types\TinyText::class,
        self::MEDIUMTEXT => \YPC\Ripple\Support\Database\DataTypes\Types\MediumText::class,
        self::LONGTEXT => \YPC\Ripple\Support\Database\DataTypes\Types\LongText::class,
        self::VARCHAR => \YPC\Ripple\Support\Database\DataTypes\Types\VarChar::class,
        self::CHAR => \YPC\Ripple\Support\Database\DataTypes\Types\Char::class,
        self::TIMESTAMP => \YPC\Ripple\Support\Database\DataTypes\Types\TimeStamp::class,
        self::YEAR => \YPC\Ripple\Support\Database\DataTypes\Types\Year::class,
        self::LONGBLOB => \YPC\Ripple\Support\Database\DataTypes\Types\LongBlob::class,
        self::MEDIUMBLOB => \YPC\Ripple\Support\Database\DataTypes\Types\MediumBlob::class,
        self::TINYBLOB => \YPC\Ripple\Support\Database\DataTypes\Types\TinyBlob::class,
        self::VARBINARY => \YPC\Ripple\Support\Database\DataTypes\Types\VarBinary::class,
        self::BIT => \YPC\Ripple\Support\Database\DataTypes\Types\Bit::class,
        self::SET => \YPC\Ripple\Support\Database\DataTypes\Types\Set::class,
        self::ENUM => \YPC\Ripple\Support\Database\DataTypes\Types\Enum::class,
        self::GEOMETRYCOLLECTION => \YPC\Ripple\Support\Database\DataTypes\Types\GeometryCollection::class,
        self::GEOMETRY => \YPC\Ripple\Support\Database\DataTypes\Types\Geometry::class,
        self::LINESTRING => \YPC\Ripple\Support\Database\DataTypes\Types\LineString::class,
        self::MULTILINESTRING => \YPC\Ripple\Support\Database\DataTypes\Types\MultiLineString::class,
        self::MULTIPOINT => \YPC\Ripple\Support\Database\DataTypes\Types\MultiPoint::class,
        self::MULTIPOLYGON => \YPC\Ripple\Support\Database\DataTypes\Types\MultiPolygon::class,
        self::POINT => \YPC\Ripple\Support\Database\DataTypes\Types\Point::class,
        self::POLYGON => \YPC\Ripple\Support\Database\DataTypes\Types\Polygon::class,
    ];
}
