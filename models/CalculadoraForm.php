<?php

namespace app\models;
use yii\base\Model;
class CalculadoraForm extends Model
{
    public $texto1;
    public $texto2;
    public function rules()
    {
        return [
            [['texto1','texto2'],'required'],
            ['texto1','string'],['texto2','string']
        ];
    }
}