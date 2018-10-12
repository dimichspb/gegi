<?php
namespace app\repositories\month;

use app\models\month\Id;
use app\models\month\Month;
use app\repositories\RepositoryException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\Uuid;

/**
 * Class DoctrineRepository
 * @package app\repositories\month
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
     * DoctrineMonthRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->entityRepository = $em->getRepository(Month::class);
    }

    /**
     * @param Id $id
     * @return Month|null
     */
    public function get(Id $id)
    {
        try {
            /** @var Month $month */
            $month = $this->entityRepository->find($id);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $month;
    }

    /**
     * Find one by criteria
     * @param array $criteria
     * @return mixed
     */
    public function find(array $criteria = [])
    {
        try {
            /** @var Month $month */
            $months = $this->entityRepository->findBy($criteria);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return reset($months);
    }

    /**
     * Add new Month to repository
     * @param Month $month
     */
    public function add(Month $month)
    {
        try {
            $this->em->persist($month);
            $this->em->flush($month);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Update Month in repository
     * @param Month $month
     */
    public function update(Month $month)
    {
        try {
            $this->em->flush($month);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Delete Month from repository
     * @param Month $month
     */
    public function delete(Month $month)
    {
        try {
            $this->em->remove($month);
            $this->em->flush($month);
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
     * Get all Months by criteria
     * @param array $criteria
     * @param array|null $orderBy
     * @param int $offset
     * @param int $limit
     * @return Month[]
     */
    public function all(array $criteria = [], array $orderBy = null, $offset = null, $limit = null)
    {
        try {
            $months = $this->entityRepository->findBy($criteria, $orderBy, $limit, $offset);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $months;
    }

    /**
     * Count Months by criteria
     * @param array $criteria
     * @return int
     */
    public function count(array $criteria = [])
    {
        return $this->entityRepository->count($criteria);
    }
}