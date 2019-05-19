<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h1 class="text-center">App title</h1>
                <p>Hello <b><?= Yii::$app->user->identity->login; ?></b></p>
            </div>
            <div class="col-sm-4"></div>
        </div>

    </div>
</div>
