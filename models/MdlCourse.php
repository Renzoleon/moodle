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
            ['fullname', 'match' ,'pattern' => '/^[A-Z]/', 'message' => 'El fullname solo puede contener Mayúsculas.'],
            ['shortname', 'match' ,'pattern' => '/^[A-Z]/', 'message' => 'El shortname solo puede contener Mayúsculas.'],
            [['category'],'integer'],
            [['fullname'], 'string', 'max' => 34],
            [['shortname'], 'string', 'max' => 35],
        ];
    }
}