<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $email;
    public $password;
    public $name;

    public function rules()
    {
        return [
            [['email', 'password', 'name'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
            [['name'], 'string'],
            ['password', 'string'],
        ];
    }

    public function saveNewUser():bool
    {
        if ($this->validate()) {
            $user = new User();
        
            $data = [
            "email" => $this->email,
            "password" => $this->hashPassword($this->password),
            "name" => $this->name,
            ];
            
            $user->attributes = $data;
            return $user->create();
        }
    }

    private function hashPassword(string $password):string
    {
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        return $hash;
    }
}
