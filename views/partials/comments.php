      <?php if (!Yii::$app->user->isGuest) {?>
      <?php $form = \yii\widgets\ActiveForm::begin([
      'action' => ['site/comment', 'id' => $article->id],
      'options' => ['class'=>'form-horizontal contact-form', 'role' => 'form']]) ?>

      <div class="card my-4">

        <?php if (Yii::$app->session->getFlash('comment')):?>
        <div class="alert alert-success" role="alert">
          <?= Yii::$app->session->getFlash('comment'); ?>
        </div>
        <?php endif;?>

        <!--Reply-->
        <div class="card mb-3 wow fadeIn">
          <div class="card-header font-weight-bold">Оставить комментарий</div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control', 'placeholder'=>'Введите комментарий'])->label(false)?>
              </div>

              <div class="text-center mt-4">
                <button type="submit" class="btn btn-info btn-md">Отправить</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php \yii\widgets\ActiveForm::end();?>
      <?php } ?>


      <?php if (!empty($comments)) { ?>
      <?php foreach ($comments as $comment) { ?>

      <!-- Single Comment -->
      <div class="card card-comments mb-3 wow fadeIn">
        <div class="card-header font-weight-bold">Комментарии</div>
        <div class="card-body">
          <div class="media d-block d-md-flex mt-3">
            <img class="d-flex mb-3 mx-auto " src="https://mdbootstrap.com/img/Photos/Avatars/img (30).jpg" alt="Generic placeholder image">
            <div class="media-body text-center text-md-left ml-md-3 ml-0">
              <h5 class="mt-0 font-weight-bold"><?= $comment->user->name; ?><a href="#" class="pull-right"><i class="fas fa-reply"></i></a></h5>
              <p><?= $comment->text ?></p>
            </div>
          </div>

        </div>
      </div>

      <?php } } ?>
