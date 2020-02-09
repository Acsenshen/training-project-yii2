<?php

$this->title = 'Все новости';?>

<div class="container">

    <!--Section: Post-->
    <section class="mt-4">

        <!--Grid row-->
        <div class="row">

            <!--Grid column-->
            <div class="col-md-8 mb-4">

                <!--Featured Image-->
                <div class="card mb-4 wow fadeIn">

                    <img src="<?= $article->image ?>" class="img-fluid" alt="">

                </div>

                <div class="card mb-4 wow fadeIn">
                    <div class="card-body text-center">
                        <h4 class="h5 my-4"><?= $article->title; ?></h4>
                    </div>
                </div>

                <div class="card mb-4 wow fadeIn">
                    <div class="card-body">
                        <p><?= $article->content; ?></p>
                    </div>
                </div>
                <!--/.Card-->

                <div class="card mb-4 wow fadeIn">
                    <div class="card-body">
                        <p>Категория:</p>
                        <p><?= $categoryName; ?></p>
                        <p>Теги:</p>
                        <p>
                            <?php $fields = '';
                            foreach ($tags as $tag ) { 
                                $fields .= $tag . ", ";
                            }
                            $fields = rtrim($fields, ', ');
                            echo $fields;
                            ?>
                        </p>
                    </div>
                </div>


                <!--Card-->
                <div class="card mb-4 wow fadeIn">

                    <div class="card-header font-weight-bold">
                        <span>О авторе</span>
                    </div>

                    <div class="card-body">
                        <div class="media d-block d-md-flex mt-3">
                            <img class="d-flex mb-3 mx-auto z-depth-1"
                                src="https://mdbootstrap.com/img/Photos/Avatars/img (30).jpg"
                                alt="Generic placeholder image" style="width: 100px;">
                            <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                <h5 class="mt-0 font-weight-bold"><?= $article->user->name; ?></h5>
                                <p>Описание</p>
                            </div>
                        </div>

                    </div>

                </div>

                <!--Comments-->
                <?= $this->render('/partials/comments', [
                'article' => $article,
                'comments' => $comments,
                'commentForm' => $commentForm,
                ]) ?>

            </div>

            <!--Последние статьи -->
            <?= $this->render('/partials/lastArticles', [
                'lastArticles' => $lastArticles,
                ]) ?>

        </div>
    </section>
</div>