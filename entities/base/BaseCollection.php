<?php
namespace app\entities\base;

use Assert\Assertion;

/**
 * Class BaseCollection
 * @package app\entities\base
 */
abstract class BaseCollection extends BaseArray
{
    /**
     * @param $value
     * @return mixed|void
     */
    public function assert($value)
    {
        Assertion::allIsInstanceOf($value, $this->getClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getClass();
}