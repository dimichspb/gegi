<?php
namespace app\repositories\result;

use app\models\month\Month;
use app\models\program\Program;

/**
 * Interface RepositoryInterface
 * @package app\repositories\result
 */
interface RepositoryInterface
{
    /**
     * @param Program $program
     * @param Month $month
     * @return mixed
     */
    public function get(Program $program, Month $month);

    /**
     * @param array $criteria
     * @return mixed
     */
    public function find(array $criteria = []);

    /**
     * @param array $criteria
     * @return mixed
     */
    public function count(array $criteria = []);

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $offset
     * @param null $limit
     * @return mixed
     */
    public function all(array $criteria = [], array $orderBy = null, $offset = null, $limit = null);
}