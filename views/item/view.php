<?php

setlocale(LC_MONETARY,"id_ID");

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Item $model */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <hr>

    <p>
        <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['update', 'id_item' => $model->id_item], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['delete', 'id_item' => $model->id_item], [
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
            'id_item',
            'item_name',
            [
                'attribute' => 'item_price',
                'value' => function ($model) {
                    return \Yii::$app->formatter->asCurrency($model->item_price, 'IDR');
                },
            ],
            [
                'attribute' => 'item_type',
                'value' => function ($model) {
                    return ucfirst($model->item_type);
                }
            ],
            // 'created_time',
            // 'updated_time',
        ],
    ]) ?>

</div>
