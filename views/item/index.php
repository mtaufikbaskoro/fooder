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

    <h4><?= Html::encode('Products') ?></h4>

    <p>
        <?= Html::a('<i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Product', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#searchbar" aria-controls="searchbar" aria-expanded="true"><i class="fa fa-search" aria-hidden="true"></i></button>
    </p>

    <?php Pjax::begin(); ?>
    <div class="collapse" id="searchbar">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?> 
    </div>
    
    <hr>

    <div class="body-content">
        <div class="row mt-5 item-list mx-auto">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
        ?>
            <div class="col-lg-3 card">
                <div class="card-body">
                    <p>
                        <?php echo Html::a(Html::encode($model->item_name), ['view', 'id_item' => $model->id_item], ['class' => 'text-dark h5']) ?>
                        &nbsp;&nbsp;
                        <?php 
                            if ($model->item_type === 'food') {
                                echo Html::tag('span', Html::encode(ucfirst($model->item_type)), ['class' => 'badge bg-danger text-light font-weight-normal']);
                            } else {
                                echo Html::tag('span', Html::encode(ucfirst($model->item_type)), ['class' => 'badge bg-primary text-light font-weight-normal']);
                            }
                        ?>
                    </p>
                    <p class="text-muted"><?= Html::encode(Yii::$app->formatter->asCurrency($model->item_price, 'IDR')) ?></p>
                </div>
            </div>
        <?php },]) ?>
        </div>

        <?php Pjax::end(); ?>

    </div>
</div>
