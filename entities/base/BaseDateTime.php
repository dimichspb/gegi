<?php
namespace app\entities\base;

/**
 * Class BaseDateTime
 * @package app\entities\base
 */
abstract class BaseDateTime extends BaseEntity
{
    /**
     * @param $value
     */
    public function assert($value)
    {

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }
}