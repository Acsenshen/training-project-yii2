<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

    <?= $form->field($model, 'annotation')->textarea(['maxlength' => true])->label('Аннотация') ?>

    <?= $form->field($model, 'content')->textarea(['maxlength' => true])->label('Содержание') ?>

    <?= $form->field($model, 'article_date')->textInput()->label('Дата публикации') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
