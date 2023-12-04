<?php

namespace app\models;
use Yii;
use yii\base\Model;

/**
  * This is the model class for table "mdl_user".
 * This is the model class for table "mdl_course".
 *
 * @property MdlUser $mdlUser
 * @property MdlCourse $mdlContext
 * */
class MdlUserEnrolments extends Model
{
    public $role;
    public $user;
    public $course;


    public function rules()
    {
        return [
            [['role','user','course'],'required'],
            [['role','user','course'],'integer'],
        ];
    }
}