<?php
use yii\helpers\Url;

?>
<div class="col-md-4 mb-4">
    <div class="card mb-4 wow fadeIn">
        <div class="card-header">Последние статьи</div>
        <div class="card-body">
            <ul class="list-unstyled">
                <?php foreach ($lastpost as $post) { ?>
                <li class="media my-4">
                    <img class="d-flex mr-3"
                        src="<?= $post->image ?>"
                        style="width: 70px; height: 70px;" alt="Generic placeholder image">
                    <div class="media-body">
                        <a
                            href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>">
                            <h5 class="mt-0 mb-1 font-weight-bold"><?= $post->title ?>
                            </h5>
                        </a>
                        <p><?= $post->content ?>
                        </p>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>