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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_item' => $model->id_item], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_item' => $model->id_item], [
            'class' => 'btn btn-danger',
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
