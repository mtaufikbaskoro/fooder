<?php
date_default_timezone_set('Asia/Jakarta');

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Item $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_price')->textInput() ?>

    <?= $form->field($model, 'item_type')->dropDownList([ 'food' => 'Food', 'drink' => 'Drink', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'updated_time')->label(false)->textInput(['hidden' => true, 'value' => date('Y-m-d H:i:s')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
