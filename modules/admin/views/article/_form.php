<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($article, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

    <?= $form->field($article, 'annotation')->textarea(['maxlength' => true])->label('Аннотация') ?>

    <?= $form->field($article, 'content')->textarea(['maxlength' => true])->label('Содержание') ?>

    <?= $form->field($article, 'article_date')->textInput()->label('Дата публикации') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
