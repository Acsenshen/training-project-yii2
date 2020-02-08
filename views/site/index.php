<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Главная | Все новости';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <section class="card wow fadeIn" style="background-image: url('/img/gradientNews.jpg');">

        <div class="card-body text-white text-center py-5 px-5 my-5">

            <h1 class="mb-4">
                <strong>Все новости</strong>
            </h1>
        </div>
    </section>

    <hr class="my-5">

    <section class="text-center">
        <div class="row mb-4 wow fadeIn">
            <?php foreach ($articles as $article) { ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">

                    <div class="view overlay">
                        <img src="<?= $article->image ?>"
                            class="card-img-top" alt="">
                        <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>"
                            target="_blank">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>

                    <div class="card-body">
                        <h4 class="card-title"><?= $article->title ?>
                        </h4>
                        <p class="card-text"><?= $article->content ?>
                        </p>
                        <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>"
                            target="_blank" class="btn btn-primary btn-md">Подробнее</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <!--Pagination-->
        <nav class="d-flex justify-content-center wow fadeIn">
            <?php
                echo LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount' => 3,
                'linkOptions' => ['class' => 'page-link'],
                'pageCssClass' => 'page-item',
                'activePageCssClass' => 'active',
                'options' => ['class' => 'pagination'],
                'nextPageCssClass' => 'page-item',
                'prevPageCssClass' => 'page-item'
                ]);
            ?>
        </nav>
    </section>
</div>