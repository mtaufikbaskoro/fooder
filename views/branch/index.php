<?php

use app\models\Branch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\BranchSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Branch', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <hr>

    <div class="body-content">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id_branch',
                'branch_name',
                'branch_status',
                // 'created_time',
                // 'updated_time',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Branch $model, $key, $index, $column) { 
                        return Url::toRoute([$action, 'id_branch' => $model->id_branch]);
                    }
                ],
            ],
            'summaryOptions' => [
                'class' => 'py-3'
            ],
            'tableOptions' => [
                'class' => 'table'
            ]
        ]); ?>

        <?php Pjax::end(); ?>
    </div>

</div>
