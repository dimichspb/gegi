<?php
namespace app\factories;

use app\models\month\Index;
use app\models\month\Month;
use app\models\month\Name;
use app\repositories\month\RepositoryInterface;

/**
 * Class MonthFactory
 * @package app\factories
 */
class MonthFactory
{
    /**
     * @var array
     */
    protected $defaults = [
        [
            'name' => 'January',
            'index' => 1,
        ],
        [
            'name' => 'February',
            'index' => 2,
        ],
        [
            'name' => 'March',
            'index' => 3,
        ],
        [
            'name' => 'April',
            'index' => 4,
        ],
        [
            'name' => 'May',
            'index' => 5,
        ],
        [
            'name' => 'June',
            'index' => 6,
        ],
        [
            'name' => 'July',
            'index' => 7,
        ],
        [
            'name' => 'August',
            'index' => 8,
        ],
        [
            'name' => 'September',
            'index' => 9,
        ],
        [
            'name' => 'October',
            'index' => 10,
        ],
        [
            'name' => 'November',
            'index' => 11,
        ],
        [
            'name' => 'December',
            'index' => 12,
        ],
    ];

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * MonthFactory constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getDefaults()
    {
        return $this->defaults;
    }

    /**
     * @param string $name
     * @param int $index
     * @return Month
     */
    public function create(string $name, int $index)
    {
        $month = new Month(
            $this->repository->nextId(),
            new Name($name),
            new Index($index)
        );

        return $month;
    }

    /**
     * @param string $name
     * @return Month
     */
    public function createByName(string $name)
    {
        foreach ($this->getDefaults() as $default) {
            if (strtolower($name) === strtolower($default['name'])) {
                return $this->create($default['name'], $default['index']);
            }
        }

        throw new \InvalidArgumentException();
    }
}