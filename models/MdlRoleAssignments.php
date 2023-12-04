<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "mdl_role".
 * This is the model class for table "mdl_user".
 * This is the model class for table "mdl_context".
 *
 * @property MdlRole $mdlRole
 * @property MdlUser $mdlUser
 * @property MdlContext $mdlContext
 * */
class MdlRoleAssignments extends ActiveRecord
{
    public $role;
    public $user;
//    public $context;

    public function rules()
    {
        return [
            [['role','user'],'required'],
            [['role','user'],'integer'],
        ];
    }
}
