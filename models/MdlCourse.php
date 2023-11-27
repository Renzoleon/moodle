<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "alumno_programa".
 *
 * @property MdlCourseCategories $MdlCourseCategories
 * */
class MdlCourse extends ActiveRecord
{
    public $fullname;
    public $shortname;
    public $category;

    public function rules()
    {
        return [
            [['fullname','shortname','category'],'required'],
            ['fullname', 'match' ,'pattern' => '/^[A-Z\s!@#$%^&*()-_]{8,}$/', 'message' => 'El fullname no permite Minúsculas.'],

            ['shortname', 'match' ,'pattern' => '/^[A-Z\s!@#$%^&*()-_]{5,}$/', 'message' => 'El shortname no permite Minúsculas.'],
            [['category'],'integer'],
            [['fullname'], 'string', 'max' => 34],
            [['shortname'], 'string', 'max' => 35],
        ];
    }
}