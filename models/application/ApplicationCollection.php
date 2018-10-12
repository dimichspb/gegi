<?php
namespace app\models\application;

use Collections\Collection;

/**
 * Class ApplicationCollection
 * @package app\models\application
 */
class ApplicationCollection extends Collection
{
    /**
     * ApplicationCollection constructor.
     * @param null $type
     * @param array $items
     * @throws \Collections\Exceptions\InvalidArgumentException
     */
    public function __construct($type = null, array $items = [])
    {
        $type = Application::class;

        parent::__construct($type, $items);
    }
}