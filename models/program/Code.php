<?php
namespace app\models\program;

use app\entities\base\BaseString;
use Assert\Assertion;

/**
 * Class Code
 * @package app\models\program
 */
class Code extends BaseString
{
    /**
     * @param $value
     * @return mixed|void
     * @throws \Assert\AssertionFailedException
     */
    public function assert($value)
    {
        parent::assert($value);
        Assertion::maxLength($value, 64);
    }

}