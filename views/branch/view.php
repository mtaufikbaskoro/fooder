<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Branch $model */

$this->title = $model->branch_name;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="branch-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <hr>

    <p>
        <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['update', 'id_branch' => $model->id_branch], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['delete', 'id_branch' => $model->id_branch], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_branch',
            'branch_name',
            'branch_status',
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>
