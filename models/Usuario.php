<?php

namespace app\models;
use Yii;
use yii\base\Model;
class Usuario extends Model
{
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $email;

    public function rules()
    {
        return [
            [['username','password','firstname','lastname','email'],'required'],
            [['firstname','lastname'],'string'],['email','email'],
            ['username', 'match', 'pattern' => '/^[a-z]+$/', 'message' => 'El username solo puede contener minúsculas.'],
            ['password', 'match', 'pattern' => '/^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()-_])[A-Za-z\d!@#$%^&*()-_]{8,}$/', 'message' => 'La contraseña no cumple con los requisitos.'],
        ];
    }
}