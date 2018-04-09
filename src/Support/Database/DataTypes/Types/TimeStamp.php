<?php

namespace YPC\Ripple\Support\Database\DataTypes\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TimeStamp extends Type
{

    const TIMESTAMP = 'timestamp';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TimeStamp';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        //return (null === $value) ? null : (int) $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        //return $value->toDecimal();
    }

    public function getName()
    {
        return self::TIMESTAMP;
    }

    public function canRequireSQLConversion()
    {
        return true;
    }

    public function convertToPHPValueSQL($sqlExpr, $platform)
    {
        return $sqlExpr;
    }

    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform)
    {
        return $sqlExpr;
    }

}
