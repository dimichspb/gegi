<?php
namespace app\entities\base;

use Assert\Assertion;

/**
 * Class BaseHash
 * @package app\entities\base
 */
class BaseHash extends BaseString
{
    /**
     * @param $value
     * @return mixed|void
     * @throws \Assert\AssertionFailedException
     */
    public function assert($value)
    {
        Assertion::maxLength($value, 36);

        parent::assert($value);
    }
}