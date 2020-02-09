<?php

namespace app\models;

use yii\helpers\ArrayHelper;


class Tag extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tag';
    }


    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getArticles():object
    {
        return $this->hasMany(Article::className(), ['id' => 'article_id'])->viaTable('article_tag', ['tag_id' => 'id']);
    }

    public static function allTag():array
    {
        return ArrayHelper::map(Tag::find()->all(), 'id', 'title');
    }
}
