<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Users;

class SignupForm extends Model
{
    public $email;
    public $password;
    public $name;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password', 'name'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\Users', 'targetAttribute' => 'email'],
            [['name'], 'string'],
            ['password', 'string'],
        ];
    }

    public function saveNewUser()
    {
        if ($this->validate()) {
            $user = new Users();
        
            $data = [
            "email" => $this->email,
            "password" => $this->hashPassword($this->password),
            "name" => $this->name,
            ];
            
            $user->attributes = $data;
            return $user->create();
        }
    }

    private function hashPassword($password)
    {
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        return $hash;
    }
}
