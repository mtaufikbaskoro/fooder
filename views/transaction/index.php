<?php

setlocale(LC_MONETARY,"id_ID");

use app\models\TbTransaction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TransactionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <p>
        <?= Html::a('<i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Transaction', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <hr>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summaryOptions' => [
            'class' => 'py-3'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_transaction',
            'tbBranch.branch_name',
            'transaction_date',
            [
                'attribute' => 'subtotal',
                'value' => function ($model) {
                    return \Yii::$app->formatter->asCurrency($model->subtotal, 'IDR');
                },
            ],
            // 'created_time',
            //'updated_time',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}&nbsp;&nbsp;&nbsp;{delete}',
                'urlCreator' => function ($action, TbTransaction $model, $key, $index, $column) {
                    if ($action === 'view'){
                        return Url::toRoute([$action, 'id_transaction' => $model->id_transaction]);
                    }
                    if ($action === 'delete'){
                        return Url::toRoute([$action, 'id_transaction' => $model->id_transaction]);
                    }
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
