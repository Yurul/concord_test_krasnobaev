<?php
namespace backend\modules\users\models;

use Yii;
use yii\base\Model;
use common\models\User as CommonUser;
use common\models\Group;


class User extends CommonUser
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'email', 'photo', 'group_id'], 'safe'],
            [['login', 'password', 'email', 'group_id'], 'required'],
            [['login','email'], 'trim'],

            ['login', 'unique', 'targetClass' => '\common\models\User', 'filter'=>['not', ['id' => $this->id]], 'message' => 'This username has already been taken.'],
            ['login', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'filter'=>['not', ['id' => $this->email]], 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => 6],

            ['photo', 'string'],
            ['group_id', 'integer'],
            ['group_id', 'isExistingGroup'],
        ];
    }

    public function isExistingGroup($attribute){
        $group_ids = Group::find()
            ->select(['id'])
            ->column();

        if($this->group_id != '0' && !in_array($this->group_id, $group_ids)){
            $this->addError($attribute, 'There are no such role');
        }
    }
}
