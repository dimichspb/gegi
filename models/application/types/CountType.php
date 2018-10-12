<?php
namespace app\models\application\types;

use app\models\application\Count;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class CountType extends GuidType
{
    const NAME = 'Type\Application\Count';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Count */
        return $value? $value->getValue(): null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value? new Count((int)$value): null;
    }

    public function getName()
    {
        return self::NAME;
    }
}