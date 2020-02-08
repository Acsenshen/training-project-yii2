<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string|null $text
 * @property int|null $author_comment
 * @property int|null $article_id
 * @property string|null $comment_date
 * @property int|null $status
 *
 * @property Article $article
 * @property Users $authorComment
 * @property Status $status0
 */
class Comments extends \yii\db\ActiveRecord
{
    const STATUS_ALLOW = 1;
    const STATUS_DISALLOW = 2;

    public static function tableName()
    {
        return 'comments';
    }


    public function rules()
    {
        return [
            [['author_comment', 'article_id', 'status'], 'integer'],
            [['comment_date'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['author_comment'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['author_comment' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'author_comment']);
    }

    
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status']);
    }

    public function isAllowed()
    {
        if ($this->status == self::STATUS_ALLOW) {
            return true;
        }
    }

    public function allow()
    {
        $this->status = self::STATUS_ALLOW;
        return $this->save(false);
    }

    
    public function disallow()
    {
        $this->status = self::STATUS_DISALLOW;
        return $this->save(false);
    }
}
