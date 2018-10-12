<?php
namespace app\repositories\program;

use app\models\program\Id;
use app\models\program\Program;

/**
 * Interface RepositoryInterface
 * @package app\repositories\program
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
     * @param Program $program
     * @return mixed
     */
    public function add(Program $program);

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
     * @param Program $program
     * @return mixed
     */
    public function update(Program $program);

    /**
     * @param Program $program
     * @return mixed
     */
    public function delete(Program $program);

    /**
     * @return mixed
     */
    public function nextId();
}