<?php
namespace app\repositories\result;

use app\models\application\Application;
use app\models\month\Month;
use app\models\program\Program;
use app\models\result\Result;
use app\repositories\RepositoryException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineRepository
 * @package app\repositories\result
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
    protected $applicationRepository;

    /**
     * DoctrineResultRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->applicationRepository = $em->getRepository(Application::class);
    }

    /**
     * @param Program $program
     * @param Month $month
     * @return Result[]|null
     */
    public function get(Program $program, Month $month)
    {
        try {
            /** @var Result $result */
            $applications = $this->applicationRepository->findBy([
                'program' => $program,
                'month' => $month,
            ]);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $results = $applications? $this->convert($applications): [];

        return $results;
    }

    /**
     * Find one by criteria
     * @param array $criteria
     * @return mixed
     */
    public function find(array $criteria = [])
    {
        try {
            /** @var Result $result */
            $applications = $this->applicationRepository->findBy($criteria);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $results = $applications? $this->convert($applications): [];

        return reset($results);
    }

    /**
     * Get all Results by criteria
     * @param array $criteria
     * @param array|null $orderBy
     * @param int $offset
     * @param int $limit
     * @return Result[]
     */
    public function all(array $criteria = [], array $orderBy = null, $offset = null, $limit = null)
    {
        try {
            $applications = $this->applicationRepository->findBy($criteria, $orderBy, $limit, $offset);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $results = $applications? $this->convert($applications): [];

        return $results;
    }

    /**
     * Count Results by criteria
     * @param array $criteria
     * @return int
     */
    public function count(array $criteria = [])
    {
        try {
            $applications = $this->applicationRepository->findBy($criteria);
        } catch (\Exception $exception) {
            throw new RepositoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $results = $applications? $this->convert($applications): [];

        return count($results);
    }

    /**
     * @param Application[] $applications
     * @return array
     */
    protected function convert(array $applications = [])
    {
        $results = [];

        foreach ($applications as $application) {
            $index = $application->getMonth()->getIndex()->getValue();

            $result = isset($results[$index])? $results[$index]: new Result($application->getMonth());

            $result->setValue($application->getProgram(), $application->getCount());
            $results[$index] = $result;
        }
        ksort($results);
        return array_values($results);
    }
}