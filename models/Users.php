<?php

namespace app\models;

use Yii;

class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['isAdmin'], 'integer'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'isAdmin' => 'Is Admin',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public static function findByEmail($email)
    {
        return Users::find()->where(['email' => $email])->one();
    }

    public function validatePassword($password)
    {
        if (Yii::$app->getSecurity()->validatePassword($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function create() {
        $this->isAdmin = 1;
        return $this->save(false);
    }
}
