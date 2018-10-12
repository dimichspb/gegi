<?php
namespace app\entities\base;

use Assert\Assertion;

/**
 * Class BaseFilename
 * @package app\entities\base
 */
abstract class BaseFilename extends BaseEntity
{
    /**
     * @param $value
     * @return mixed|void
     */
    public function assert($value)
    {
        Assertion::regex($value, '/^[\w,\s-]+\.[A-Za-z]{3}$/');
    }

}