<?php

namespace app\models;
use Yii;
use yii\base\Model;
class Matricula extends Model
{
    public $userid;
    public $courseid;


    public function rules()
    {
        return [
            [['userid','courseid'],'required'],
            [['userid','courseid'],'integer'],
        ];
    }
}