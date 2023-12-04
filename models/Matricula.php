<?php

namespace app\models;
use yii\base\Model;

/**
 * This is the model class for table "mdl_role".
 *
 * @property MdlRole $mdlRole
 * @property MdlContext $mdlContext
 * */
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
