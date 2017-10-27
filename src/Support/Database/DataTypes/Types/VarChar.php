<?php

namespace GitLab\Ripple\Support\Database\DataTypes\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class VarChar extends Type
{

    const VARCHAR = 'VARCHAR';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $length = $fieldDeclaration['length'] === null ? 255 : $fieldDeclaration['length'];
        return "VARCHAR({$length})";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : (int) $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return null === $value || '' === $value ? null : (string) $value;
    }

    public function getName()
    {
        return self::VARCHAR;
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
