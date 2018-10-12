<?php
namespace app\models\application\types;

use app\models\application\Id;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class IdType extends GuidType
{
    const NAME = 'Type\Application\Id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Id */
        return (string)$value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Id($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}