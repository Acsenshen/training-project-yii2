<?php

namespace app\models;

use Yii;

class CommentsForm extends \yii\db\ActiveRecord
{
    public $comment;

    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveComment($article_id)
    {
        $comment = new Comments();
        $comment->text = $this->comment;
        $comment->author_comment = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->comment_date = date("Y-m-d");
        $comment->status = 2;
        return $comment->save();
    }
}
