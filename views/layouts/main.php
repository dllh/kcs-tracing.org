<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);


    $navBarItems = [];
    $navBarItems[] = ['label' => 'Home', 'url' => ['/site/index']];
    $navBarItems[] = ['label' => 'Schools', 'url' => ['/schools']];
    $navBarItems[] = ['label' => 'School Board', 'url' => ['/board-members']];
    $navBarItems[] = ['label' => 'Add Report', 'url' => ['/reports/create']];
    $navBarItems[] = ['label' => 'Privacy', 'url' => ['/site/privacy']];
    //$navBarItems[] = ['label' => 'About', 'url' => ['/site/about']];
    //$navBarItems[] = ['label' => 'Contact', 'url' => ['/site/contact']];
    if ( ! Yii::$app->user->isGuest ) {
	$logoutForm = Html::beginForm(['/user/security/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm();
	//$navBarItems[] = ['label' => 'Class Details', 'url' => ['/class-details']];
	$navBarItems[] = ['label' => 'Reports', 'url' => ['/reports']];
	//$navBarItems[] = ['label' => 'Log Out', 'url' => ['/user/security/logout']];
	$navBarItems[] = $logoutForm;
    } else {
    	$navBarItems[] = ['label' => 'Admin Login', 'url' => ['/user/security/login']];
    }

    echo Nav::widget( [
        'options' => ['class' => 'navbar-nav'],
	'items' => $navBarItems,
    ] );

/*
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/user/security/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/user/security/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
	    )
 */
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
	<!--
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	-->
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    </main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left"><!-- Copyright or other info? --></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
