<?php
namespace app\models\program;

use app\entities\base\BaseString;
use Assert\Assertion;
use yii\helpers\StringHelper;

/**
 * Class Description
 * @package app\models\program
 */
class Description extends BaseString
{
    /**
     * @param $value
     * @return mixed|void
     * @throws \Assert\AssertionFailedException
     */
    public function assert($value)
    {
        parent::assert($value);
        Assertion::maxLength($value, 1024);
    }

    /**
     * @return string
     */
    public function getShortValue()
    {
        $short = StringHelper::truncateWords($this->value, 30);

        return strlen($this->value) > 30? $short . '...': $short;
    }
}