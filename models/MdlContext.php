<?php

namespace app\models;
use yii\db\ActiveRecord;

class MdlContext extends ActiveRecord
{
    public function rules()
    {
        return [
            [['id','contextlevel','instanceid'],'required'],
        ];
    }
    
    public function getCourse()
    {
        return $this->hasOne(MdlCourse::class, ['id' => 'instanceid']);
    }
}