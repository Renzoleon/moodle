<?php

namespace app\models;
use yii\db\ActiveRecord;

class MdlCourseCategories extends ActiveRecord
{
    public function rules()
    {
        return [
            [['id','name'],'required'],
        ];
    }
}
