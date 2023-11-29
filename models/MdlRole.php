<?php

namespace app\models;
use yii\db\ActiveRecord;

class MdlRole extends ActiveRecord
{
    public function rules()
    {
        return [
            [['id','shortname'],'required'],
        ];
    }
}