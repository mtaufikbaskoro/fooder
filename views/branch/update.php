<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Branch $model */

$this->title = 'Update Branch: ' . $model->branch_name;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->branch_name, 'url' => ['view', 'id_branch' => $model->id_branch]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="branch-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
