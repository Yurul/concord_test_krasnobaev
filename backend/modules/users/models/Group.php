<?php

namespace backend\modules\users\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Group as CommonGroup;
use backend\modules\users\models\User;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 */
class Group extends CommonGroup
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string']
        ];

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

    public function getUsers()
    {
        return $this->hasOne(User::className(), ['group_id' => 'id']);
    }
}
