<?php
namespace app\models\month;

use app\entities\base\BaseInteger;
use Assert\Assertion;

/**
 * Class Index
 * @package app\models\month
 */
class Index extends BaseInteger
{
    /**
     * @param $value
     * @return mixed|void
     * @throws \Assert\AssertionFailedException
     */
    public function assert($value)
    {
        parent::assert($value);
        Assertion::between($value, 1, 12);
    }

}