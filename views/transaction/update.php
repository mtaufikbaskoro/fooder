<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Transaction $model */

$this->title = 'Update Transaction: ' . $model->transaction_date;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transaction_date, 'url' => ['view', 'id_transaction' => $model->id_transaction]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsTransactionDetail' => $modelsTransactionDetail,
        'itemName' => $itemName,
        'branchName' => $branchName
    ]) ?>

</div>
