<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Comment;
use yii\web\Controller;

class CommentController extends Controller
{
  

    public function actionIndex()
    {
        $commentList = Comment::find()->all();
        return $this->render('index', ['comments' => $commentList]);
    }

    
    public function actionAllow($id)
    {
        $comment = Comment::findOne($id);
        if ($comment->allow()) {
            return $this->redirect(['index']);
        }
    }

    public function actionDisallow($id)
    {
        $comment = Comment::findOne($id);
        if ($comment->disallow()) {
            return $this->redirect(['index']);
        }
    }

    public function actionDelete($id)
    {
        $comment = Comment::findOne($id)->delete();
        return $this->redirect(['index']);
    }


}
