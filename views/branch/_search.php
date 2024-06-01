<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BranchSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="branch-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_branch') ?>

    <?= $form->field($model, 'branch_name') ?>

    <?= $form->field($model, 'branch_status')->dropDownList(['active' => 'Active', 'inactive' => 'Inactive'], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_time') ?>

    <?= $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
