<?php

namespace app\models;
use yii\db\ActiveRecord;

class MdlEnrol extends ActiveRecord
{
    public function rules()
    {
        return [
            [['id','enrol','courseid'],'required'],
        ];
    }

    public function getCourse()
    {
        return $this->hasOne(MdlCourse::class, ['id' => 'courseid']);
    }
}