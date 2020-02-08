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
use app\models\Tags;

class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
        $model = Article::find()->all();
        return $this->render('index', ['articles' => $model]);
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }


    public function actionCreate()
    {
        $model = new Article();
        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpload();

        if (Yii::$app->request->isPost) {
            $article = $this->findModel($id); // Получаем данные текущего article
            $file = UploadedFile::getInstance($model, 'image'); // Экземпляр текущего файла
            $nameFile = $model->upload($file, $article->preview);
            
            if ($article->saveImage($nameFile)) {
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }

        return $this->render('image', ['model' => $model]);
    }

    public function actionSetCategory($id)
    {
        $model = $this->findModel($id);
        $selectedCategory = $model->selectedCategory;
        $category = Category::allCategory();

        if (Yii::$app->request->isPost) {
            $category = Yii::$app->request->post('category'); // Получаем id категории из POST
            if ($model->saveCategory($category)) {
                return $this->redirect(['view', 'id' => $model->id]);
            };
        }

        return $this->render('category', ['category' => $category, 'selectedCategory' => $selectedCategory]);
    }

    public function actionSetTags($id)
    {
        $article = $this->findModel($id);
        $selectedTags = $article->selectedTags;
        $tags = Tags::allTags();

        if (Yii::$app->request->isPost) {
            $tags = Yii::$app->request->post('tags');
  
            if ($article->saveTags($tags)) {
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }

        return $this->render('tags', ['tags' => $tags, 'selectedTags' => $selectedTags]);
    }

    public function actionAllow($id)
    {
        $article = Article::findOne($id);
        if ($article->allow()) {
            return $this->redirect(['index']);
        }
    }

    public function actionDisallow($id)
    {
        $article = Article::findOne($id);
        if ($article->disallow()) {
            return $this->redirect(['index']);
        }
    }


    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
