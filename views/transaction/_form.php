<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Transaction $model */
/** @var yii\widgets\ActiveForm $form */
?>

<hr>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div>

        <?= $form->field($model, 'id_branch')->label('Branch Name')->dropDownList($branchName, ['prompt' => '']) ?>

        <?= $form->field($model, 'transaction_date')->textInput(['type' => 'date']) ?>

        <?= $form->field($model, 'subtotal')->label(false)->textInput(['hidden' => true, 'value' => 0]) ?>

        <?= $form->field($model, 'updated_time')->label(false)->textInput(['hidden' => true, 'value' => date('Y-m-d H:i:s')]) ?>
    
    </div>
        
        <div class="panel panel-default">
            <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items',
                'widgetItem' => '.house-item',
                'limit' => 10,
                'min' => 1,
                'insertButton' => '.add-house',
                'deleteButton' => '.remove-house',
                'model' => $modelsTransactionDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    't_item_quantity',
                    't_item_price',
                    'id_transaction',
                    'updated_time',
                    'created_time',
                    // 't_item_price'
                ],
            ]); ?>
            <table class="table table-bordered table-striped" style="margin-top: 36px;">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Quantity</th>
                        <th class="text-center" style="width: 90px;">
                            <button type="button" class="add-house btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                        </th>
                    </tr>
                </thead>
                <tbody class="container-items">
                <?php foreach ($modelsTransactionDetail as $index => $modelTransactionDetail): ?>
                    <tr class="house-item">
                        <td class="vcenter">
                            <?php
                                // necessary for update action.
                                if (! $modelTransactionDetail->isNewRecord) {
                                    echo Html::activeHiddenInput($modelTransactionDetail, "[{$index}]id");
                                }
                            ?>
                            <?= $form->field($modelTransactionDetail, "[{$index}]id_item")->label(false)->dropDownList($itemName, ['prompt' => '']) ?>
                        </td>
                        <td class="vcenter" style="width: 160px; verti">
                            <?php
                                // necessary for update action.
                                if (! $modelTransactionDetail->isNewRecord) {
                                    echo Html::activeHiddenInput($modelTransactionDetail, "[{$index}]id");
                                }
                            ?>
                            <?= $form->field($modelTransactionDetail, "[{$index}]t_item_quantity")->label(false)->textInput(['maxlength' => true, 'type' => 'number']) ?>
                        </td>
                        <?= $form->field($modelTransactionDetail, "[{$index}]t_item_price")->label(false)->textInput(['hidden' => true, 'value' => 12]) ?>
                        <?= $form->field($modelTransactionDetail, "[{$index}]id_transaction")->label(false)->textInput(['hidden' => true, 'value' => 1]) ?>
                        <?= $form->field($modelTransactionDetail, "[{$index}]created_time")->label(false)->textInput(['hidden' => true, 'value' => date('Y-m-d H:i:s')]) ?>
                        <?= $form->field($modelTransactionDetail, "[{$index}]updated_time")->label(false)->textInput(['hidden' => true, 'value' => date('Y-m-d H:i:s')]) ?>
                        <td class="text-center vcenter" style="width: 90px; verti">
                            <button type="button" class="remove-house btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php DynamicFormWidget::end(); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
