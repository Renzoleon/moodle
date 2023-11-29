<?php

namespace app\models;
use yii\db\ActiveRecord;

class MdlUser extends ActiveRecord
{
    public function rules()
    {
        return [
            [['id','username'],'required'],
        ];
    }
}