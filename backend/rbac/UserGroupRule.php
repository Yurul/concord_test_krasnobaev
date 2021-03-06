<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 21.05.2019
 * Time: 13:35
 */

namespace backend\rbac;

use yii\rbac\Rule;


class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {

        if (! \Yii::$app->user->isGuest) {
            $role = \Yii::$app->user->identity->group;

            if($role){
                return $role->name == $item->name;
            }
        }


       return false;
    }
}