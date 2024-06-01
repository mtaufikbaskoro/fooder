<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Branch $model */

$this->title = 'Update Branch: ' . $model->id_branch;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_branch, 'url' => ['view', 'id_branch' => $model->id_branch]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="branch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
