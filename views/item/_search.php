<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ItemSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php  // echo $form->field($model, 'id_item') ?>

    <?= $form->field($model, 'item_name')->textInput(['class' => 'form-control']) ?>

    <?= $form->field($model, 'item_price')->textInput(['class' => 'form-control']) ?>

    <hr>

    <?= Html::activeDropDownList($model, 'item_type', ['food' => 'Food', 'drink' => 'Drink'], ['class' => 'form-control mb-3', 'prompt' => 'all item type']) ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
