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
    public $user;
    public $course;


    public function rules()
    {
        return [
            [['user','course'],'required'],
            [['user','course'],'integer'],
        ];
    }
}