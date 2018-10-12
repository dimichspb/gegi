<?php
namespace app\entities\base;

/**
 * Class BaseDecimal
 * @package app\entities\base
 */
abstract class BaseDecimal extends BaseFloat
{
    /**
     * @return float|null
     */
    public function getValue()
    {
        return round(parent::getValue(), 2);
    }
}