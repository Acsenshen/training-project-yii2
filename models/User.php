<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    const roleAdmin = 1;
    
    public static function tableName()
    {
        return 'user';
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

    public static function findIdentity($id):object
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }


    public function getId():int
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        
    }


    public function validateAuthKey($authKey)
    {
        
    }


    public static function findByEmail($email)
    {
        return User::find()->where(['email' => $email])->one();
    }

    public function validatePassword(string $password):bool
    {
        if (Yii::$app->getSecurity()->validatePassword($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function create() {
        $this->isAdmin = self::roleAdmin;
        return $this->save(false);
    }
}
