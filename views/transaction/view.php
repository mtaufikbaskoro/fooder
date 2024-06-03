<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Transaction $model */

$this->title = $model->transaction_date;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transaction-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Update', ['update', 'id_transaction' => $model->id_transaction], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_transaction' => $model->id_transaction], [
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
            // 'id_transaction',
            'tbBranch.branch_name',
            [
                'attribute' => 'subtotal',
                'value' => function ($model) {
                    return \Yii::$app->formatter->asCurrency($model->subtotal, 'IDR');
                },
            ],
            'transaction_date',
            // 'created_time',
            // 'updated_time',
        ],
    ]) ?>

    <hr class="my-5">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Item Name</th>
                <th scope="col">Item Quantity</th>
                <th scope="col">Item Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detailTransactions as $detailTransaction) { ?>
                <tr>
                    <td><?= $detailTransaction[0] ?></td>
                    <td><?= $detailTransaction['t_item_quantity'] ?></td>
                    <td><?= \Yii::$app->formatter->asCurrency($detailTransaction['t_item_price'], 'IDR'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
