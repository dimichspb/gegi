<?php

use app\models\program\Program;
use app\models\result\SearchModel as ResultSearchModel;
use app\models\program\SearchModel as ProgramSearchModel;
use yii\data\DataProviderInterface;
use yii\web\View;

/** @var $this View */
/** @var $resultSearchModel ResultSearchModel */
/** @var $programSearchModel ProgramSearchModel */
/** @var $resultDataProvider DataProviderInterface */
/** @var $programDataProvider DataProviderInterface */
/** @var $columns Program[] */

$this->title = \Yii::$app->name;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-xs-12">
                <?= $this->render('_grid', [
                    'searchModel' => $resultSearchModel,
                    'dataProvider' => $resultDataProvider,
                    'columns' => $columns,
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?= $this->render('_chart', [
                    'searchModel' => $resultSearchModel,
                    'dataProvider' => $resultDataProvider,
                    'columns' => $columns,
                ]) ?>
            </div>
        </div>
    </div>
</div>
