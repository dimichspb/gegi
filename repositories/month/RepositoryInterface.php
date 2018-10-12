<?php
namespace app\repositories\month;

use app\models\month\Month;
use app\models\month\Id;

/**
 * Interface RepositoryInterface
 * @package app\repositories\month
 */
interface RepositoryInterface
{
    /**
     * @param Id $id
     * @return mixed
     */
    public function get(Id $id);

    /**
     * @param array $criteria
     * @return mixed
     */
    public function find(array $criteria = []);

    /**
     * @param Month $month
     * @return mixed
     */
    public function add(Month $month);

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

    /**
     * @param Month $month
     * @return mixed
     */
    public function update(Month $month);

    /**
     * @param Month $month
     * @return mixed
     */
    public function delete(Month $month);

    /**
     * @return mixed
     */
    public function nextId();
}