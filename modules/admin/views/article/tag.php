<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Добавить категорию';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $this->title;\yii\web\YiiAsset::register($this);
?>



<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= Html::dropDownList('tag', $selectedTagId, $tag, ['class' => 'form-control', 'multiple' => 'true']) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
