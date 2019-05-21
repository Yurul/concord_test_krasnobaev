<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\users\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')
        ->passwordInput(['maxlength' => true, 'value'=>''])
        ->label($password_label) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_id')->dropdownList($roles)->label('Role'); ?>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                <?= Html::img($model->getThumbUploadUrl('photo', 'preview'), ['class' => 'img-thumbnail']) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'photo')->fileInput(['accept' => 'image/*']) ?>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
