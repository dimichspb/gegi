<?php
namespace app\models\user;

use app\entities\base\BaseHash;
use Assert\Assertion;

/**
 * Class PasswordHash
 * @package app\models\user
 */
class PasswordHash extends BaseHash
{
    public function assert($value)
    {
        Assertion::maxLength($value, 255);
    }

}