<?php
namespace app\repositories\application;

use app\models\application\Application;
use app\models\application\Id;

/**
 * Interface RepositoryInterface
 * @package app\repositories\application
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
     * @param Application $application
     * @return mixed
     */
    public function add(Application $application);

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
     * @param Application $application
     * @return mixed
     */
    public function update(Application $application);

    /**
     * @param Application $application
     * @return mixed
     */
    public function delete(Application $application);

    /**
     * @return mixed
     */
    public function nextId();
}