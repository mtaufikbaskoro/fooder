<?php

setlocale(LC_MONETARY,"id_ID");

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <hr>

    <div class="body-content">
        <div class="row mt-5">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
        ?>
            <div class="col-lg-4 mb-3">
                <?php echo Html::a(Html::encode($model->item_name), ['view', 'id_item' => $model->id_item], ['class' => 'link-dark h4 d-inline']) ?>
                <?php 
                    if ($model->item_type === 'food') {
                        echo Html::tag('span', Html::encode(ucfirst($model->item_type)), ['class' => 'badge bg-danger']);
                    } else {
                        echo Html::tag('span', Html::encode(ucfirst($model->item_type)), ['class' => 'badge bg-primary']);
                    }
                ?>
                <p><?= Html::encode(Yii::$app->formatter->asCurrency($model->item_price, 'IDR')) ?></p>
            </div>
        <?php },]) ?>
        </div>

        <?php Pjax::end(); ?>

    </div>
</div>
