<?php

namespace app\models;
use yii\base\Model;
class Rol extends Model
{
    public $roleid;
    public $userid;

    public function rules()
    {
        return [
            [['roleid','userid'],'required'],
            [['roleid','userid'],'integer'],
        ];
    }
}
