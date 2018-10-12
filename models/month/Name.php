<?php
namespace app\models\month;

use app\entities\base\BaseString;
use Assert\Assertion;

/**
 * Class Name
 * @package app\models\month
 */
class Name extends BaseString
{
    /**
     * @param $value
     * @return mixed|void
     * @throws \Assert\AssertionFailedException
     */
    public function assert($value)
    {
        parent::assert($value);
        Assertion::maxLength($value, 12);
    }

}