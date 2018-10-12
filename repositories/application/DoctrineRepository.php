<?php
namespace app\repositories\application;

use app\models\application\Id;
use app\models\application\Application;
use app\repositories\RepositoryException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\Uuid;

/**
 * Class DoctrineRepository
 * @package app\repositories\application
 */
class DoctrineRepository implements RepositoryInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $entityRepository;

    /**
     * DoctrineApplicationRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->entityRepository = $em->getRepository(Application::class);
    }

    /**
     * @param Id $id
     * @return Application|null
     */
    public function get(Id $id)
    {
        try {
            /** @var Application $application */
            $application = $this->entityRepository->find($id);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $application;
    }

    /**
     * Find one by criteria
     * @param array $criteria
     * @return mixed
     */
    public function find(array $criteria = [])
    {
        try {
            /** @var Application $application */
            $applications = $this->entityRepository->findBy($criteria);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return reset($applications);
    }

    /**
     * Add new Application to repository
     * @param Application $application
     */
    public function add(Application $application)
    {
        try {
            $this->em->persist($application);
            $this->em->flush($application);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Update Application in repository
     * @param Application $application
     */
    public function update(Application $application)
    {
        try {
            $this->em->flush($application);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Delete Application from repository
     * @param Application $application
     */
    public function delete(Application $application)
    {
        try {
            $this->em->remove($application);
            $this->em->flush($application);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @return Id
     */
    public function nextId()
    {
        try {
            $id = new Id(Uuid::uuid4()->toString());
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $id;
    }

    /**
     * Get all Applications by criteria
     * @param array $criteria
     * @param array|null $orderBy
     * @param int $offset
     * @param int $limit
     * @return Application[]
     */
    public function all(array $criteria = [], array $orderBy = null, $offset = null, $limit = null)
    {
        try {
            $applications = $this->entityRepository->findBy($criteria, $orderBy, $limit, $offset);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $applications;
    }

    /**
     * Count Applications by criteria
     * @param array $criteria
     * @return int
     */
    public function count(array $criteria = [])
    {
        return $this->entityRepository->count($criteria);
    }
}