<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" style="height: 77vh;">

    <?php $form = ActiveForm::begin(); ?>

    <p class="h4 mb-4">Регистрация</p>
    <div class="form-row mb-4">
        <div class="col">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>
    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>


    <?= Html::submitButton('Вперед', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>


    <?php ActiveForm::end(); ?>

</div>