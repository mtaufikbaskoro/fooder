<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TbBranch $model */

$this->title = 'Create Branch';
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
