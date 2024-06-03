<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h4><?= Html::encode(ucFirst($this->title)) ?></h4>

    <p>
        <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['update', 'id_user' => $model->id_user], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['delete', 'id_user' => $model->id_user], [
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
            'id_user',
            'username',
            // 'password',
            'role',
            'tbBranch.branch_name',
        ],
    ]) ?>

</div>
