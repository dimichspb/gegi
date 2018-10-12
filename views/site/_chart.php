<?php

use app\models\month\SearchModel;
use yii\data\DataProviderInterface;
use yii\web\View;
use yii\widgets\Pjax;
use sjaakp\gcharts\LineChart as Chart;

/** @var $this View */
/** @var $searchModel SearchModel */
/** @var $dataProvider DataProviderInterface */
/** @var $columns array */

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Chart view</h2>
    </div>
    <div class="panel-body">
        <?php Pjax::begin() ?>
        <?= Chart::widget([
            'dataProvider' => $dataProvider,
            'columns' => $columns
        ]); ?>
        <?php Pjax::end() ?>
    </div>
</div>