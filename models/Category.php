<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class Category extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'category';
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
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    
    // Список всех категорий
    public static function allCategory():array 
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'title');
    }
}
