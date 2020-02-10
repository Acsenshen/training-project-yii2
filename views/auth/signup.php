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

    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
    ]); ?>

    <p class="h4 mb-4">Регистрация</p>
    <div class="form-row mb-4">
        <div class="col">
            <?= $form->field($signupForm, 'email', ['enableAjaxValidation' => true])->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($signupForm, 'password')->passwordInput() ?>
        </div>
    </div>
    <?= $form->field($signupForm, 'name')->textInput(['autofocus' => true]) ?>


    <?= Html::submitButton('Вперед', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>


    <?php ActiveForm::end(); ?>

</div>