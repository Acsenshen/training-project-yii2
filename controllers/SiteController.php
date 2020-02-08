<?php

namespace app\controllers;

use app\models\Article;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\CommentsForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $data = Article::getAll(5);
        return $this->render('index', ['articles' => $data['articles'], 'pages' => $data['pages'],
       ]);
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);
        $category = $article->category->title;
        $commentForm = new CommentsForm();
        $comments = $article->getArticleComments();
        $lastpost =  Article::find()->orderBy('id desc')->limit(3)->all();
        $tags = $article->getNameTags();
        $article->viewedCount();
        return $this->render('view', ['article' => $article, 'category' => $category, 'tags' => $tags, 'comments' => $comments, 'commentForm' => $commentForm, 'lastpost' => $lastpost]);
    }


    public function actionComment($id)
    {
        $model = new CommentsForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->saveComment($id)) {
                Yii::$app->getSession()->setFlash('comment', 'Ваш комментарий был добавлен. Ожидайте подтверждения');
                return $this->redirect(['/site/view', 'id' => $id]);
            }
        }
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
