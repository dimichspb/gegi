<?php
namespace app\services\user;

use app\models\user\AccessToken;
use app\models\user\Id;
use app\models\user\User;
use app\models\user\Username;
use app\repositories\user\RepositoryInterface;

/**
 * Class Service
 * @package app\services\user
 */
class Service
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Service constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get User by Id
     * @param Id $id
     * @return mixed
     */
    public function getById(Id $id)
    {
        return $this->repository->get($id);
    }

    /**
     * Get User by Username
     * @param Username $username
     * @return mixed
     */
    public function getByUsername(Username $username)
    {
        return $this->repository->find([
            'username' => $username,
        ]);
    }

    /**
     * Get User by AccessToken
     * @param AccessToken $accessToken
     * @return mixed
     */
    public function getByAccessToken(AccessToken $accessToken)
    {
        return $this->repository->find([
            'access_token' => $accessToken,
        ]);
    }

    /**
     * Add User to repository
     * @param User $user
     * @return mixed
     */
    public function add(User $user)
    {
        return $this->repository->add($user);
    }

    /**
     * Get next Id from repository
     * @return mixed
     */
    public function nextId()
    {
        return $this->repository->nextId();
    }
}