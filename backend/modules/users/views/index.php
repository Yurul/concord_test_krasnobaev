<?php
use \yii\helpers\Url;
?>

<div class="users-default-index">
    <h1>User managment module</h1>
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
