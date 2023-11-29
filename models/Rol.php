<?php

namespace app\models;
use yii\base\Model;
class Rol extends Model
{
    public $role;
    public $context;

    public function rules()
    {
        return [
            [['role','context'],'required'],
            [['role','context'],'integer'],
        ];
    }
}
