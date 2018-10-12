<?php
namespace app\services\result;

use app\models\result\SearchModel;
use app\repositories\result\RepositoryInterface;
use yii\data\ArrayDataProvider;

/**
 * Class Service
 * @package app\services\result
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
     * @param array $criteria
     * @return mixed
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
            'allModels' => $this->all($searchModel->getAttributes(['program_id']), [], $offset, $searchModel->limit),
            'totalCount' => $this->count($searchModel->getAttributes(['program_id'])),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $dataProvider;
    }
}