<?php

namespace app\models;
use yii\base\Model;
class AlumnoForm extends Model
{
    public $username;
    public $password;
    public $items;
    public $uploadFile;
    public $category;
//    public $radio;
    public function rules()
    {
        return [
          [['username','password','items','uploadFile'],'required'],
            [['username', 'password'], 'string'],
        ];
    }
}