<?php
namespace app\services\application;

use app\models\application\ApplicationCollection;
use app\models\application\Count;
use app\models\application\Id;
use app\models\application\Application;
use app\models\application\SearchModel;
use app\models\month\Month;
use app\models\program\Program;
use app\repositories\application\RepositoryInterface;
use League\Flysystem\FilesystemInterface;
use yii\data\ArrayDataProvider;

/**
 * Class Service
 * @package app\services\application
 */
class Service
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    /**
     * Service constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Id $id
     * @return mixed
     */
    public function getById(Id $id)
    {
        return $this->repository->get($id);
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function find(array $criteria = [])
    {
        return $this->repository->find($criteria);
    }

    /**
     * @param array $criteria
     * @param array $orderBy
     * @param null $offset
     * @param null $limit
     * @return mixed
     */
    public function all(array $criteria = [], array $orderBy = [], $offset = null, $limit = null)
    {
        return $this->repository->all($criteria, $orderBy, $offset, $limit);
    }

    /**
     * @param Application $application
     * @return mixed
     */
    public function add(Application $application)
    {
        return $this->repository->add($application);
    }

    /**
     * @param Application $application
     * @return mixed
     */
    public function update(Application $application)
    {
        return $this->repository->update($application);
    }

    /**
     * @return mixed
     */
    public function nextId()
    {
        return $this->repository->nextId();
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function count(array $criteria = [])
    {
        return $this->repository->count($criteria);
    }

    /**
     * @param ApplicationCollection $collection
     */
    public function import(ApplicationCollection $collection)
    {
        foreach ($collection as $item)
        {
            $this->add($item);
        }
    }

    /**
     * @param SearchModel $searchModel
     * @return ArrayDataProvider
     */
    public function getDataProvider(SearchModel $searchModel)
    {
        $offset = ($searchModel->page - 1) * $searchModel->limit;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->all($searchModel->getAttributes(['id', 'program_id', 'month_id']), [], $offset, $searchModel->limit),
            'totalCount' => $this->count($searchModel->getAttributes(['id', 'program_id', 'month_id'])),
            'key' => function (Application $model) {
                return $model->getId();
            },
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }

    /**
     * @param Program $program
     * @param Month $month
     * @param int $count
     * @return Application
     */
    public function create(Program $program, Month $month, int $count): Application
    {
        $application = new Application(
            $this->repository->nextId(),
            $program,
            $month,
            new Count($count)
        );

        return $application;
    }

    /**
     * @param Program $program
     * @param Month $month
     * @return mixed
     */
    public function findByProgramAndMonth(Program $program, Month $month)
    {
        return $this->find([
            'program' => $program,
            'month' => $month,
        ]);
    }
}