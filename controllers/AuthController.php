<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\SignupForm;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $loginForm = new LoginForm();
        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->login()) {
            return $this->goBack();
        }

        $loginForm->password = '';
        return $this->render('login', ['loginForm' => $loginForm]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $signupForm = new SignupForm();

        if ($signupForm->load(Yii::$app->request->post()) && $signupForm->saveNewUser()) {
            return $this->redirect(['auth/login']); 
        }

        return $this->render('signup', ['signupForm' => $signupForm]);
    }
}
