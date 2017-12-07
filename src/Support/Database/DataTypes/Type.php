<?php

namespace GitLab\Ripple\Support\Database\DataTypes;

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
        self::TINYINT => \GitLab\Ripple\Support\Database\DataTypes\Types\TinyInt::class,
        self::TINYTEXT => \GitLab\Ripple\Support\Database\DataTypes\Types\TinyText::class,
        self::MEDIUMTEXT => \GitLab\Ripple\Support\Database\DataTypes\Types\MediumText::class,
        self::LONGTEXT => \GitLab\Ripple\Support\Database\DataTypes\Types\LongText::class,
        self::VARCHAR => \GitLab\Ripple\Support\Database\DataTypes\Types\VarChar::class,
        self::CHAR => \GitLab\Ripple\Support\Database\DataTypes\Types\Char::class,
        self::TIMESTAMP => \GitLab\Ripple\Support\Database\DataTypes\Types\TimeStamp::class,
        self::YEAR => \GitLab\Ripple\Support\Database\DataTypes\Types\Year::class,
        self::LONGBLOB => \GitLab\Ripple\Support\Database\DataTypes\Types\LongBlob::class,
        self::MEDIUMBLOB => \GitLab\Ripple\Support\Database\DataTypes\Types\MediumBlob::class,
        self::TINYBLOB => \GitLab\Ripple\Support\Database\DataTypes\Types\TinyBlob::class,
        self::VARBINARY => \GitLab\Ripple\Support\Database\DataTypes\Types\VarBinary::class,
        self::BIT => \GitLab\Ripple\Support\Database\DataTypes\Types\Bit::class,
        self::SET => \GitLab\Ripple\Support\Database\DataTypes\Types\Set::class,
        self::ENUM => \GitLab\Ripple\Support\Database\DataTypes\Types\Enum::class,
        self::GEOMETRYCOLLECTION => \GitLab\Ripple\Support\Database\DataTypes\Types\GeometryCollection::class,
        self::GEOMETRY => \GitLab\Ripple\Support\Database\DataTypes\Types\GeoMetry::class,
        self::LINESTRING => \GitLab\Ripple\Support\Database\DataTypes\Types\LineString::class,
        self::MULTILINESTRING => \GitLab\Ripple\Support\Database\DataTypes\Types\MultiLineString::class,
        self::MULTIPOINT => \GitLab\Ripple\Support\Database\DataTypes\Types\MultiPoint::class,
        self::MULTIPOLYGON => \GitLab\Ripple\Support\Database\DataTypes\Types\MultiPolygon::class,
        self::POINT => \GitLab\Ripple\Support\Database\DataTypes\Types\Point::class,
        self::POLYGON => \GitLab\Ripple\Support\Database\DataTypes\Types\Polygon::class,
    ];
}
