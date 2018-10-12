<?php
namespace app\controllers;

use app\models\program\Program;
use app\models\result\Result;
use app\models\result\SearchModel as ResultSearchModel;
use app\models\program\SearchModel as ProgramSearchModel;
use yii\base\Module;
use app\components\DataColumn;
use yii\web\Controller;
use yii\web\Request;
use app\services\result\Service as ResultService;
use app\services\program\Service as ProgramService;

class SiteController extends Controller
{
    protected $request;
    protected $resultService;
    protected $programService;

    public function __construct(string $id, Module $module, Request $request, ResultService $resultService,
                                ProgramService $programService, array $config = [])
    {
        $this->request = $request;
        $this->resultService = $resultService;
        $this->programService = $programService;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $resultSearchModel = new ResultSearchModel();
        $resultSearchModel->load($this->request->getQueryParams());

        $resultDataProvider = $this->resultService->getDataProvider($resultSearchModel);

        $programSearchModel = new ProgramSearchModel();
        $programSearchModel->load($this->request->getQueryParams());

        $programDataProvider = $this->programService->getDataProvider($programSearchModel);

        /** @var Program[] $programs */
        $programs = $programDataProvider->getModels();

        $columns = $this->prepareColumns($programs);

        return $this->render('index', [
            'resultSearchModel' => $resultSearchModel,
            'resultDataProvider' => $resultDataProvider,
            'programSearchModel' => $programSearchModel,
            'programDataProvider' => $programDataProvider,
            'columns' => $columns,
        ]);
    }

    /**
     * @param Program[] $programs
     * @return array
     */
    protected function prepareColumns(array $programs)
    {
        $columns = [];

        foreach ($programs as $program) {
            $columns[] = [
                'attribute' => $program->getCode()->getValue(),
                'value' => function(Result $model) use ($program) {
                    return $model->getValue($program);
                },
                'label' => $program->getCode()->getValue(),
            ];
        }

        $columns = array_merge([
            [
                'class' => DataColumn::class,
                'attribute' => 'month',
                'value' => function(Result $model) {
                    return $model->getMonth()->getName()->getValue();
                },
                'contentOptions' => ['class' => 'strong'],
                'type' => 'string',
            ],
        ], $columns);

        return $columns;
    }
}
