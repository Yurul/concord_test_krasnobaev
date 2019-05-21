<?php

namespace backend\modules\users\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Group as CommonGroup;
use backend\modules\users\models\User;
use backend\rbac\UserGroupRule;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 */
class Group extends CommonGroup
{
    /**
     * @var autoAuthRole if true creates, update or deletes auth roles accordingly to group changes
     */
    private $autoAuthRole = true;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => 'backend\modules\users\models\Group', 'filter'=>['not', ['name' => $this->name]], 'message' => 'This name has already been taken.'],
            ['name', 'string']
        ];

    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($this->autoAuthRole) {
            //Add or update auth role
            $auth = \Yii::$app->authManager;

            $rule = $auth->getRule('UserGroup');
            if (!$rule) {
                $rule = new UserGroupRule;
                $auth->add($rule);
            }

            $newRole = $auth->createRole($this->name);
            $newRole->ruleName = $rule->name;

            if ($insert) {
                $auth->add($newRole);
            } else {
                $auth->update($changedAttributes['name'], $newRole);
            }
        }
    }

    public function beforeDelete()
    {

        if ($this->users) {
            Yii::$app->getSession()->addFlash('error',
                'There are users in group ' . $this->name . '. Change their group or delete those users entirely');
            return false;
        }

        return parent::beforeDelete();

    }

    public function afterDelete()
    {
        parent::afterDelete();

        if($this->autoAuthRole){
            $auth = \Yii::$app->authManager;
            $role = $auth->getRole($this->name);
            if($role){
                $auth -> remove($role);
            }
        }

     }

    public function getUsers()
    {
        return $this->hasOne(User::className(), ['group_id' => 'id']);
    }


}
