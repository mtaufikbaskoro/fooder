<?php

/** @var yii\web\View $this */
/** @var string $content */

\yii\web\JqueryAsset::register($this);

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

<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="/index.php?r=site"><h2 class="text-center">FOODER</h2></a>
        </div>

        <ul class="list-unstyled components">
            <h6 class="text-center mb-3">Selamat datang, Administrator</h6>
            <li class="<?php echo ($controller == 'site') ? 'active' : '' ?>">
                <a 
                    class="nav-link"
                    aria-current="page" 
                    href="index.php?r=site%2Fdashboard"
                >
                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li class="<?php echo ($controller == 'branch') ? 'active' : '' ?>">
                <a href="#branchSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-building" aria-hidden="true"></i> <span class="ml-3">Branches</span></a>
                <ul class="collapse list-unstyled" id="branchSubmenu">
                    <li>
                        <a class="nav-link" href="/index.php?r=branch">
                            <span>All Branches</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/index.php?r=branch%2Fcreate">
                            <span>Create New Branch</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($controller == 'item') ? 'active' : '' ?>">
                <a href="#itemSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cubes" aria-hidden="true"></i> <span class="ml-3">Items</span></a>
                <ul class="collapse list-unstyled" id="itemSubmenu">
                    <li>
                        <a class="nav-link" href="/index.php?r=item">
                            <span>All Items</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/index.php?r=item%2Fcreate">
                            <span>Create New Item</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($controller == 'transaction') ? 'active' : '' ?>">
                <a href="#transactionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="ml-3">Transactions</span></a>
                <ul class="collapse list-unstyled" id="transactionSubmenu">
                    <li>
                        <a class="nav-link" href="/index.php?r=transaction">
                            <span>All Transactions</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/index.php?r=item%2Fcreate">
                            <span>Create New Transaction</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($controller == 'user') ? 'active' : '' ?>">
                <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users" aria-hidden="true"></i> <span class="ml-3">Users</span></a>
                <ul class="collapse list-unstyled" id="userSubmenu">
                    <li>
                        <a class="nav-link" href="/index.php?r=user">
                            <span>All Users</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/index.php?r=user%2Fcreate">
                            <span>Create New User</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Logout</a>
            </li>
        </ul>
    </nav>
    <main id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fa fa-align-left"></i>
                </button>
            </div>
        </nav>
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs'], 'options' => ['style' => 'font-size: 14px;']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <br>
        <?= $content ?> 
    </main>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
