<?php
namespace app\entities\base;

use Assert\Assertion;

/**
 * Class BaseString
 * @package app\entities\base
 */
abstract class BaseString extends BaseEntity
{
    /**
     * @param $value
     * @return mixed|void
     * @throws \Assert\AssertionFailedException
     */
    public function assert($value)
    {
        Assertion::string($value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }
}