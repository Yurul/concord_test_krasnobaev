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

class RolesController extends Controller
{
    public function actionIndex() {
        echo "Use yii roles/create or roles/destroy";
    }

    public function actionCreate() {
//        $auth = \Yii::$app->authManager;
//
//        $rule = new UserGroupRule;
//        $auth->add($rule);
//
//        $manager = $auth->createRole('manager');
//        $manager->ruleName = $rule->name;
//        $auth->add($manager);
//
//
//        $admin = $auth->createRole('admin');
//        $admin->ruleName = $rule->name;
//        $auth->add($admin);

        echo 'Auth settings created';
    }

    public function actionDestroy() {
//        $auth = \Yii::$app->authManager;
//
//        $auth->removeAll();
        echo 'All auth settings removed';
    }
}