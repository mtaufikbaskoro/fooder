<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Update User: ' . ucFirst($model->username);
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id_user' => $model->id_user]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'branchesAvail' => $branchesAvail,
        'isUpdate' => $isUpdate
    ]) ?>

</div>
