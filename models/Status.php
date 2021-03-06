<?php

namespace app\models;

use Yii;


class Status extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'status';
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
        return $this->hasMany(Article::className(), ['status' => 'id']);
    }


    public function getComments():object
    {
        return $this->hasMany(Comment::className(), ['status' => 'id']);
    }
}
