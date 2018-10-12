<?php
namespace app\entities\base;

use Assert\Assertion;

/**
 * Class BaseArray
 * @package app\entities\base
 */
abstract class BaseArray extends BaseEntity implements \Iterator
{
    /**
     * @param $value
     * @return mixed|void
     */
    public function assert($value)
    {
        Assertion::isArray($value);
    }

    /**
     *
     */
    public function rewind()
    {
        reset($this->value);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        $var = current($this->value);
        return $var;
    }

    /**
     * @return int|mixed|null|string
     */
    public function key()
    {
        $var = key($this->value);
        return $var;
    }

    /**
     * @return mixed
     */
    public function next()
    {
        $var = next($this->value);
        return $var;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        $key = key($this->value);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }
}