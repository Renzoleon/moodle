<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "mdl_role".
 * This is the model class for table "mdl_user".
 * This is the model class for table "mdl_context".
 *
 * @property MdlRole $mdlRole
 * @property MdlContext $mdlContext
 * @property MdlUser $mdlUser
 * */
class MdlRoleAssignments extends ActiveRecord
{
    public $role;
    public $user;
    public $context;

    public function rules()
    {
        return [
            [['role','context','user'],'required'],
            [['role','context','user'],'integer'],
        ];
    }
}
