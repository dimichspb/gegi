<?php
namespace app\models\program\types;

use app\models\program\Description;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DescriptionType extends GuidType
{
    const NAME = 'Type\Program\Description';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Description */
        return $value? (string)$value->getValue(): '';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Description($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}