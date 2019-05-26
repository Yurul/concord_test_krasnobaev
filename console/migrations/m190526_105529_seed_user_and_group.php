<?php

use yii\db\Migration;
use backend\rbac\UserGroupRule;
use common\models\Group;
use common\models\User;

/**
 * Class m190526_105529_seed_user_and_group
 */
class m190526_105529_seed_user_and_group extends Migration
{
    /**
     * {@inheritdoc}
     */

    public function up()
    {
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

    public function down()
    {
        $auth = \Yii::$app->authManager;

        $auth->removeAll();
        echo 'All auth settings removed';
    }
   
}
