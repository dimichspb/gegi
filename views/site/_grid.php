<?php

use app\models\application\SearchModel;
use yii\data\DataProviderInterface;
use yii\web\View;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var $this View */
/** @var $searchModel SearchModel */
/** @var $dataProvider DataProviderInterface */
/** @var $columns array */

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Table view</h2>
    </div>
    <div class="panel-body">
        <?php Pjax::begin() ?>
        <?= GridView::widget([
            //'filterModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'columns' => $columns,
            'options' => [
                'class' => 'table-responsive',
            ],
        ]) ?>
        <?php Pjax::end() ?>
    </div>
</div>