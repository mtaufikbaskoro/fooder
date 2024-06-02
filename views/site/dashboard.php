<?php

setlocale(LC_MONETARY,"id_ID");

/** @var yii\web\View $this */
use app\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">
    
    <hr>

    <div class="body-content" style="margin-top: 36px;">
        <div class="d-flex flex-column flex-sm-row align-items-sm-start align-items-center dashboard-info">
            <div class="card text-center" style="width: 10rem;">
                <div class="card-header">
                    <p style="margin-bottom: 0px;"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;Products</p>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle my-2 text-muted">12</h6>
                </div>
            </div>
            <div class="card text-center" style="width: 10rem;">
                <div class="card-header">
                    <p style="margin-bottom: 0px;"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;Branch</p>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle my-2 text-muted">4</h6>
                </div>
            </div>
            <div class="card text-center" style="width: 11rem;">
                <div class="card-header">
                    <p style="margin-bottom: 0px;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbsp;Transaction</p>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle my-2 text-muted">122</h6>
                </div>
            </div>
        </div>

    </div>
</div>
