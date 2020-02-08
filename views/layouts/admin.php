<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\MyAsset;

MyAsset::register($this);
?>
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

<header>

<?php

?>

    <nav id="navStyle" class="sidebar-fixed position-fixed">
    <a class="logo-wrapper d-block navbar-brand text-center text-primary font-weight-bold" href="#">Сайт</a>
      
      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse" id="navbarSupportedContent">  
        <ul class="navbar-nav list-group list-group-flush" id="collapsibleNavbar">
            <li class="nav-item">
              <a href="/admin/" class="nav-link list-group-item list-group-item-action waves-effect">
                <i class="fas fa-chart-pie ml-3 mr-3"></i>Главная
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/users" class="nav-link list-group-item list-group-item-action waves-effect">
                <i class="fas fa-users ml-3 mr-3"></i>Пользователи
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/article" class="nav-link list-group-item list-group-item-action waves-effect">
                <i class="fas fa-book ml-3 mr-3"></i>Новости
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/comments" class="nav-link list-group-item list-group-item-action waves-effect">
                <i class="fas fa-user ml-3 mr-3"></i>Комментарии
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/category" class="nav-link list-group-item list-group-item-action waves-effect">
                <i class="fas fa-link ml-3 mr-3"></i>Категории
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/tags" class="nav-link list-group-item list-group-item-action waves-effect">
                <i class="fas fa-tags ml-3 mr-3"></i>Теги
              </a>
            </li>
        </ul>
      </div>
    </nav>
</header>

<body>
<?php $this->beginBody() ?>
<main class="pt-5 mx-lg-5">
<div class="container-fluid contentTask">
<?= $content ?>
</div>
</main>
<?php $this->endBody() ?>
<?php $this->registerJsFile('/ckeditor/ckeditor.js'); ?>
<?php $this->registerJsFile('/ckfinder/ckfinder.js'); ?>
<script>
    $(document).ready(function(){
        var editor = CKEDITOR.replaceAll();
        CKFinder.setupCKEditor( editor );
    })

</script>
</body>
</html>
<?php $this->endPage() ?>
