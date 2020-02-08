<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_tags".
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $tag_id
 *
 * @property Article $article
 * @property Tags $tag
 */
class ArticleTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'tag_id' => 'Tag ID',
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

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }
}
