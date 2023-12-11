<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "mdl_course_categories".
 *
 * @property MdlCourse $MdlCourseCategories
 * */
class MdlGroups extends ActiveRecord
{
    public $course;
    public $name;
    public $description;

    public function rules()
    {
        return [
            [['course','name','description'],'required'],
        ];
    }
}