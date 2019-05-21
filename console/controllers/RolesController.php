<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 21.05.2019
 * Time: 13:47
 */

namespace console\controllers;
use yii\console\Controller;

class RolesController extends Controller
{
    public function actionIndex() {
        echo "Use yii roles/create or roles/destroy";
    }

    public function actionCreate() {
        echo 'Processing for Create';
    }

    public function actionDestroy() {
        echo 'Processing for Destroy';
    }
}