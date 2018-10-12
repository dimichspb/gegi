<?php
namespace app\repositories\user;

use app\models\user\Id;
use app\models\user\User;

/**
 * Interface RepositoryInterface
 * @package app\repositories\user
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
     * @param User $user
     * @return mixed
     */
    public function add(User $user);

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
     * @param User $user
     * @return mixed
     */
    public function update(User $user);

    /**
     * @param User $user
     * @return mixed
     */
    public function delete(User $user);

    /**
     * @return mixed
     */
    public function nextId();
}