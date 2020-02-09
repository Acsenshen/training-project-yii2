<?php

namespace app\controllers;

use app\models\Article;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\CommentForm;

class SiteController extends Controller
{

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
        $articleList = Article::getAll(5);
        return $this->render('index', ['articles' => $articleList['articles'], 'pages' => $articleList['pages'],
       ]);
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);
        $categoryName = $article->categoryName;
        $commentForm = new CommentForm();
        $commentList = $article->getArticleComment();
        $lastArticles = Article::find()->orderBy('id desc')->limit(3)->all();
        $tagList = $article->articleTag;
        $article->viewedCount();
        return $this->render('view', ['article' => $article, 'categoryName' => $categoryName, 'tags' => $tagList, 'comments' => $commentList, 'commentForm' => $commentForm, 'lastArticles' => $lastArticles]);
    }


    public function actionComment($id)
    {
        $commentForm = new CommentForm();

        if (Yii::$app->request->isPost) {
            $commentForm->load(Yii::$app->request->post());
            if ($commentForm->saveComment($id)) {
                Yii::$app->getSession()->setFlash('comment', 'Ваш комментарий был добавлен. Ожидайте подтверждения');
                return $this->redirect(['/site/view', 'id' => $id]);
            }
        }
    }
}
