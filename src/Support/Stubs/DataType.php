<?php

namespace YPC\Ripple\Support\Database\DataTypes\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TypeClass extends Type
{

    const CONSTANT = 'CONST_VALUE';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TypeClass';
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
        return self::CONSTANT;
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
