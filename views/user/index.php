<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('<i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New User', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

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

            // 'id_user',
            'username',
            // 'password',
            'role',
            'tbBranch.branch_name',
            //'created_time:datetime',
            //'updated_time:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_user' => $model->id_user]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
