<?php
namespace app\models\month\types;

use app\models\month\Index;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class IndexType extends GuidType
{
    const NAME = 'Type\Month\Index';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Index */
        return $value? (int)$value->getValue(): null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Index((int)$value);
    }

    public function getName()
    {
        return self::NAME;
    }
}