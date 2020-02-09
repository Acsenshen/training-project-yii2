<?php

namespace app\models;

class Comment extends \yii\db\ActiveRecord
{
    const STATUS_ALLOW = 1;
    const STATUS_DISALLOW = 2;

    public static function tableName()
    {
        return 'comment';
    }


    public function rules()
    {
        return [
            [['author_comment', 'article_id', 'status'], 'integer'],
            [['comment_date'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['author_comment'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_comment' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'author_comment' => 'Author Comment',
            'article_id' => 'Article ID',
            'comment_date' => 'Comment Date',
            'status' => 'Status',
        ];
    }


    public function getArticle():object
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    public function getUser():object
    {
        return $this->hasOne(User::className(), ['id' => 'author_comment']);
    }

    
    public function getStatus():object
    {
        return $this->hasOne(Status::className(), ['id' => 'status']);
    }

    public function isAllowed():bool
    {
        if ($this->status == self::STATUS_ALLOW) {
            return true;
        } else {
            return false;
        }
    }

    public function allow():bool
    {
        $this->status = self::STATUS_ALLOW;
        return $this->save(false);
    }

    
    public function disallow():bool
    {
        $this->status = self::STATUS_DISALLOW;
        return $this->save(false);
    }
}
