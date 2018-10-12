<?php
namespace app\models\month;

use Collections\Collection;

/**
 * Class MonthCollection
 * @package app\models\month
 */
class MonthCollection extends Collection
{
    /**
     * MonthCollection constructor.
     * @param null $type
     * @param array $items
     * @throws \Collections\Exceptions\InvalidArgumentException
     */
    public function __construct($type = null, array $items = [])
    {
        $type = Month::class;

        parent::__construct($type, $items);
    }
}