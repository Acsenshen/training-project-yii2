<?php
use yii\helpers\Url;

?>
<div class="col-md-4 mb-4">
    <div class="card mb-4 wow fadeIn">
        <div class="card-header">Последние статьи</div>
        <div class="card-body">
            <ul class="list-unstyled">
                <?php foreach ($lastArticles as $article) { ?>
                <li class="media my-4">
                    <img class="d-flex mr-3"
                        src="<?= $article->image ?>"
                        style="width: 70px; height: 70px;" alt="Generic placeholder image">
                    <div class="media-body">
                        <a
                            href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>">
                            <h5 class="mt-0 mb-1 font-weight-bold"><?= $article->title ?>
                            </h5>
                        </a>
                        <p><?= $article->content ?>
                        </p>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>