<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 21.05.2019
 * Time: 13:47
 */

namespace console\controllers;

use backend\rbac\UserGroupRule;
use yii\console\Controller;
use common\models\Group;
use common\models\User;

class RolesController extends Controller
{
    public function actionIndex() {
        echo "Use yii roles/create or roles/destroy";
    }

    public function actionCreate() {
        $auth = \Yii::$app->authManager;

        $rule = new UserGroupRule;
        $auth->add($rule);

        $group_admin = new Group();
        $group_admin->name = 'admin';
        $group_admin->save();

        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);

        $group_manager = new Group();
        $group_manager->name = 'manager';
        $group_manager->save();

        $manager = $auth->createRole('manager');
        $manager->ruleName = $rule->name;
        $auth->add($manager);

        $user = new User();
        $user->login = 'admin';
        $user->email = 'admin@com.ua';
        $user->password = md5('111111');
        $user->group_id = '1';
        $user->save();

        echo 'Auth roles and admin user are created'."\n"
            .'Login: admin'."\n"
            .'Password: 111111'."\n";
    }

    public function actionDestroy() {
        $auth = \Yii::$app->authManager;

        $auth->removeAll();
        echo 'All auth settings removed';
    }
}