<?php
namespace app\services\month;

use app\factories\MonthFactory;
use app\models\month\Id;
use app\models\month\Month;
use app\models\month\Name;
use app\models\month\SearchModel;
use app\repositories\month\RepositoryInterface;
use League\Flysystem\FilesystemInterface;
use yii\data\ArrayDataProvider;

/**
 * Class Service
 * @package app\services\month
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
     * @var MonthFactory
     */
    protected $factory;

    /**
     * Service constructor.
     * @param RepositoryInterface $repository
     * @param MonthFactory $factory
     */
    public function __construct(RepositoryInterface $repository, MonthFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
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
     * @param Month $month
     * @return mixed
     */
    public function add(Month $month)
    {
        return $this->repository->add($month);
    }

    /**
     * @param Month $month
     * @return mixed
     */
    public function remove(Month $month)
    {
        return $this->repository->delete($month);
    }

    /**
     * @param Month $month
     * @return mixed
     */
    public function update(Month $month)
    {
        return $this->repository->update($month);
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
     *
     */
    public function count(array $criteria = [])
    {
        return $this->repository->count($criteria);
    }

    /**
     * @param SearchModel $searchModel
     * @return ArrayDataProvider
     */
    public function getDataProvider(SearchModel $searchModel)
    {
        $offset = ($searchModel->page - 1) * $searchModel->limit;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->all($searchModel->getAttributes(['id', 'name']), ['index' => 'ASC'], $offset, $searchModel->limit),
            'totalCount' => $this->count($searchModel->getAttributes(['id', 'name'])),
            'key' => function (Month $model) {
                return $model->getId();
            }
        ]);

        return $dataProvider;
    }

    /**
     * @param string $name
     * @param int $index
     * @return Month|mixed
     */
    public function create(string $name, int $index)
    {
        if (!$month = $this->findByName($name)) {
            return $this->factory->create($name, $index);
        }
        return $month;
    }

    /**
     * @param string $name
     * @return Month|mixed
     */
    public function createByName(string $name)
    {
        if (!$month = $this->findByName($name)) {
            return $this->factory->createByName($name);
        }
        return $month;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return $this->find(['name' => new Name($name)]);
    }
}