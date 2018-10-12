<?php
namespace app\models\program;

use Collections\Collection;

/**
 * Class ProgramCollection
 * @package app\models\program
 */
class ProgramCollection extends Collection
{
    /**
     * ProgramCollection constructor.
     * @param null $type
     * @param array $items
     * @throws \Collections\Exceptions\InvalidArgumentException
     */
    public function __construct($type = null, array $items = [])
    {
        $type = Program::class;

        parent::__construct($type, $items);
    }
}