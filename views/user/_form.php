<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<hr>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php
        if (isset($isUpdate)) {
            echo $form->field($model, 'old_password')->label('Old Password')->passwordInput(['maxlength' => true, 'value' => '']); 
        }
    ?>

    <?= $form->field($model, 'password')->label((isset($isUpdate)) ? 'New Password' : 'Password')->passwordInput(['maxlength' => true, 'value' => '']) ?>

    <?= $form->field($model, 'role')->dropDownList([ 'main' => 'Main', 'sub' => 'Sub', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'id_branch')->label('Branch Name')->dropDownList($branchesAvail, ['prompt' => '']) ?>

    <?= $form->field($model, 'updated_time')->label(false)->textInput(['hidden' => true, 'value' => date('Y-m-d H:i:s')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
