<?php

namespace app\entities\base;

use Assert\Assertion;

/**
 * Class BaseBool
 * @package app\entities\base
 */
abstract class BaseBool extends BaseEntity
{
    /**
     * @param $value
     * @throws \Assert\AssertionFailedException
     */
    public function assert($value)
    {
        Assertion::boolean($value);
    }

}