<?php
namespace app\models\month\types;

use app\models\month\Name;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class NameType extends GuidType
{
    const NAME = 'Type\Month\Name';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Name */
        return $value? (string)$value->getValue(): null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Name($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}