<?php

namespace app\models;

use Yii;


class ArticleTag extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'article_tag';
    }


    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getArticle():object
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    public function getTag():object
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
