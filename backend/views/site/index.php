<?php

/* @var $this yii\web\View */
use \yii\helpers\Url;

$this->title = 'Admin dashboard';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h1 class="text-center">Admin dashboard</h1>
                <div class="users-default-index">
                    <h2>User managment module</h2>
                    <p>
                        <a href="<?= Url::to(['users/user']); ?>">
                            User's list
                        </a>
                    </p>
                    <p>
                        <a href="<?= Url::to(['users/group']); ?>">
                            Group's list
                        </a>
                    </p>

                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>

    </div>
</div>



