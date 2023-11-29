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
}