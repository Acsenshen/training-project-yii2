<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" style="height: 77vh;">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin()?>

        <?= $form->field($loginForm, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($loginForm, 'password')->passwordInput() ?>

        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        
        <p>Вы ещё не участник?
            <a href="/auth/signup">Зарегистрируйтесь!</a>
        </p>


    <?php ActiveForm::end(); ?>

</div>
