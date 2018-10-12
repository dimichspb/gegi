<?php
namespace app\models\program\types;

use app\models\program\Code;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class CodeType extends GuidType
{
    const NAME = 'Type\Program\Code';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Code */
        return $value? (string)$value->getValue(): null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value? new Code($value): null;
    }

    public function getName()
    {
        return self::NAME;
    }
}