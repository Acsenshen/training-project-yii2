<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Добавить картинку';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $this->title;\yii\web\YiiAsset::register($this);
?>



<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($image, 'image')->fileInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
