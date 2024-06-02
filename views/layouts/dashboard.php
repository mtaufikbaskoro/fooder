<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$relativeHomeUrl = $_GET['r'];

function filterGet($str) {
    $backslashPosition = strpos($str, '/');
    if ($backslashPosition > 1) {
        return substr($str, 0, $backslashPosition);
    }
    return $str;
    // if (strpos($relativeHomeUrl, '/') > 0) {

    // }
}

$controller = filterGet($relativeHomeUrl);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/site/index">Fooder</a>
    <a class="navbar-toggler position-absolute d-md-none collapsed" href="#sidebarMenu" data-toggle="collapse" aria-controls="sidebarMenu" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </a>
  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a 
                        class="nav-link <?php echo ($controller == 'site') ? 'active' : '' ?>"
                        aria-current="page" 
                        href="index.php?r=site%2Fdashboard"
                    >
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($controller == 'branch') ? 'active' : '' ?>" href="/index.php?r=branch">
                    <i class="fa fa-building" aria-hidden="true"></i> <span class="ml-3">Branch</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($controller == 'item') ? 'active' : '' ?>" href="/index.php?r=item">
                    <i class="fa fa-cubes" aria-hidden="true"></i> <span class="ml-2">Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?r=item">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="ml-2">Transaction</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="fa fa-user" aria-hidden="true"></i> <span class="ml-3">Users</span> 
                    </a>
                </li>
            </ul>
        </div>
        </nav>
        <div class="col-md-2 d-md-block"></div>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
            <h3>Selamat Datang, Admin</h3>
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs'], 'options' => ['style' => 'font-size: 14px;']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <br>
            <?= $content ?> 
        </main>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
