<?php

namespace app\models;

use Yii;

class CommentForm extends \yii\db\ActiveRecord
{
    public $comment;
    const STATUS_DISALLOW = 2;

    public static function tableName()
    {
        return 'comment';
    }

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveComment(int $article_id):bool
    {
        $comment = new Comment();
        $comment->text = $this->comment;
        $comment->author_comment = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->comment_date = date("Y-m-d");
        $comment->status = self::STATUS_DISALLOW;
        return $comment->save();
    }
}
