<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Comments;
use yii\web\Controller;

class CommentsController extends Controller
{
  

    public function actionIndex()
    {
        $model = Comments::find()->all();
        return $this->render('index', ['comments' => $model]);
    }

    
    public function actionAllow($id)
    {
        $comment = Comments::findOne($id);
        if ($comment->allow()) {
            return $this->redirect(['index']);
        }
    }

    public function actionDisallow($id)
    {
        $comment = Comments::findOne($id);
        if ($comment->disallow()) {
            return $this->redirect(['index']);
        }
    }

    public function actionDelete($id)
    {
        $comment = Comments::findOne($id)->delete();
        return $this->redirect(['index']);
    }


}
