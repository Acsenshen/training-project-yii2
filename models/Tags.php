<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property ArticleTags[] $articleTags
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['id' => 'article_id'])->viaTable('article_tags', ['tag_id' => 'id']);
    }

    public static function allTags() {
        return ArrayHelper::map(Tags::find()->all(), 'id', 'title');
    }
}
