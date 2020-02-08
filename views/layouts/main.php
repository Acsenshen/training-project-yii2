<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\MainAsset;

MainAsset::register($this);?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container">

            <a class="navbar-brand waves-effect" href="/" target="_blank">
                <strong class="blue-text">Сайт</strong>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="/">Новости</span></a>
                    </li>
                    <?php if (Yii::$app->user->isGuest) { ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="/auth/login">Авторизация</a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="/site/profile"><?= Yii::$app->user->identity->name ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="/auth/logout" action="post">Выход</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<?php $this->beginBody() ?>
<main class="mt-5 pt-5">

<?= $content ?>

<footer class="page-footer text-center font-small mdb-color darken-2 mt-4 wow fadeIn">

    <hr class="my-4">

    <div class="pb-4">
        <a href="#" target="_blank">
            <i class="fab fa-facebook-f mr-3"></i>
        </a>

        <a href="#" target="_blank">
            <i class="fab fa-twitter mr-3"></i>
        </a>

        <a href="#" target="_blank">
            <i class="fab fa-youtube mr-3"></i>
        </a>

        <a href="#" target="_blank">
            <i class="fab fa-google-plus-g mr-3"></i>
        </a>

        <a href="#" target="_blank">
            <i class="fab fa-dribbble mr-3"></i>
        </a>

        <a href="#" target="_blank">
            <i class="fab fa-pinterest mr-3"></i>
        </a>

        <a href="#" target="_blank">
            <i class="fab fa-github mr-3"></i>
        </a>

        <a href="#" target="_blank">
            <i class="fab fa-codepen mr-3"></i>
        </a>
    </div>

    <div class="footer-copyright py-3">
        © 2019-2020 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank">MySite </a>
    </div>
</footer>
</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
