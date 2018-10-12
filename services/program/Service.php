<?php
namespace app\services\program;

use app\models\program\Code;
use app\models\program\Description;
use app\models\program\Id;
use app\models\program\Program;
use app\models\program\SearchModel;
use app\repositories\program\RepositoryInterface;
use yii\data\ArrayDataProvider;

/**
 * Class Service
 * @package app\services\program
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
     * Get Program by Id
     * @param Id $id
     * @return mixed
     */
    public function getById(Id $id)
    {
        return $this->repository->get($id);
    }

    /**
     * Get Program by Code
     * @param Code $code
     * @return mixed
     */
    public function getByCode(Code $code)
    {
        return $this->repository->find([
            'code' => $code,
        ]);
    }

    /**
     * Find one by criteria
     * @param array $criteria
     * @return mixed
     */
    public function find(array $criteria = [])
    {
        return $this->repository->find($criteria);
    }

    /**
     * Find all by criteria
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
     * Add Program to repository
     * @param Program $program
     * @return mixed
     */
    public function add(Program $program)
    {
        return $this->repository->add($program);
    }

    /**
     * Update Program in repository
     * @param Program $program
     * @return mixed
     */
    public function update(Program $program)
    {
        return $this->repository->update($program);
    }

    /**
     * Get repository next Id
     * @return mixed
     */
    public function nextId()
    {
        return $this->repository->nextId();
    }

    /**
     * Count Programs
     * @param array $criteria
     * @return mixed
     */
    public function count(array $criteria = [])
    {
        return $this->repository->count($criteria);
    }

    /**
     * Prepare Program DataProvider
     * @param SearchModel $searchModel
     * @return ArrayDataProvider
     */
    public function getDataProvider(SearchModel $searchModel)
    {
        $offset = ($searchModel->page - 1) * $searchModel->limit;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->all($searchModel->getAttributes(['id', 'code', 'description']), [], $offset, $searchModel->limit),
            'totalCount' => $this->count($searchModel->getAttributes(['id', 'code', 'description'])),
            'key' => function (Program $model) {
                return $model->getId();
            }
        ]);

        return $dataProvider;
    }

    /**
     * @param string $code
     * @param string $description
     * @return Program
     */
    public function create(string $code, string $description = ''): Program
    {
        $program = new Program(
            $this->repository->nextId(),
            new Code($code),
            new Description($description)
        );

        return $program;
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function findByCode(string $code)
    {
        return $this->find(['code' => new Code($code)]);
    }
}