<?php

namespace GitLab\Ripple\Support\Database\DataTypes\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class LongText extends Type
{

    const LONGTEXT = 'longtext';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'LongText';
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
        return self::LONGTEXT;
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