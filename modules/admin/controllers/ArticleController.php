<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpload;
use yii\web\UploadedFile;
use app\models\Category;
use app\models\Tag;
use yii\data\ActiveDataProvider;

class ArticleController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $query = Article::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);

        
        $articleList = $provider->getModels();


        return $this->render('index', ['articles' => $articleList, 'provider' => $provider]);
    }


    public function actionView(int $id)
    {
        $article = $this->findModel($id);
        return $this->render('view', ['article' => $article]);
    }


    public function actionCreate()
    {
        $article = new Article();

        if ($article->load(Yii::$app->request->post()) && $article->saveArticle()) {
            return $this->redirect(['view', 'id' => $article->id]);
        } else {
            return $this->render('create', ['article' => $article]);
        }
    }

    public function actionUpdate(int $id)
    {
        $article = $this->findModel($id);
        if ($article->load(Yii::$app->request->post()) && $article->save()) {
            return $this->redirect(['view', 'id' => $article->id]);
        }

        return $this->render('update', [
            'article' => $article,
        ]);
    }

    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSetImage(int $id)
    {
        $image = new ImageUpload();

        if (Yii::$app->request->isPost) {
            $article = $this->findModel($id); // Получаем данные текущего article
            $file = UploadedFile::getInstance($image, 'image'); // Экземпляр текущего файла
            $nameFile = $image->upload($file, $article->preview);
            
            if ($article->saveImage($nameFile)) {
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }

        return $this->render('image', ['image' => $image]);
    }

    public function actionSetCategory(int $id)
    {
        $article = $this->findModel($id);
        $selectedCategoryId = $article->selectedCategoryId;
        $category = Category::allCategory();

        if (Yii::$app->request->isPost) {
            $category = Yii::$app->request->post('category'); // Получаем id категории из POST
            if ($article->saveCategory($category)) {
                return $this->redirect(['view', 'id' => $article->id]);
            };
        }

        return $this->render('category', ['category' => $category, 'selectedCategoryId' => $selectedCategoryId]);
    }

    public function actionSetTag(int $id)
    {
        $article = $this->findModel($id);
        $selectedTagId = $article->selectedTagId;
        $tag = Tag::allTag();

        if (Yii::$app->request->isPost) {
            $tag = Yii::$app->request->post('tag');
            if ($article->saveTag($tag)) {
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }

        return $this->render('tag', ['tag' => $tag, 'selectedTagId' => $selectedTagId]);
    }

    public function actionAllow(int $id)
    {
        $article = Article::findOne($id);
        if ($article->allow()) {
            return $this->redirect(['index']);
        }
    }

    public function actionDisallow(int $id)
    {
        $article = Article::findOne($id);
        if ($article->disallow()) {
            return $this->redirect(['index']);
        }
    }


    protected function findModel(int $id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
