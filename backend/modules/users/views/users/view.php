<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\users\models\User */

$this->title = $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this user?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'email:email',
            [
                'label' => 'Photo',
                'format' => 'html',
                'value' => function ($data) {
                    $src = $data->getThumbUploadUrl('photo', 'preview');
                    return Html::img($src.'?t='.time(), [
                        'alt' => 'face',
                        'style' => 'width:100px; height: 100px;',
                        'class' => "openModal"
                    ]);
                },
            ],
            [
                'attribute' => 'group_id',
                'label' => 'Role',
                'value' => function ($data) {
                    $role = $data->group->name;
                    return $role ? $role : 'user';
                }
            ],
            [
                'label' => 'Created',
                'value' => function ($data) {
                    return date("F j, Y, g:i:s a", $data->created_at);
                },
            ],
            [
                'label' => 'Updated',
                'value' => function ($data) {
                    return date("F j, Y, g:i:s a", $data->updated_at);
                },
            ]
        ],
    ]) ?>

    <?php

    if ($model->getUploadUrl('photo')) {
        $script = <<< JS
        $('.openModal').css('cursor', 'pointer');
        $('.openModal').click(function(){
             $('#imagemodal').modal('show');
        });
JS;
        $this->registerJs($script, yii\web\View::POS_READY);
        ?>

        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                    class="sr-only">Close</span></button>
                        <?= Html::img($model->getUploadUrl('photo'), ['class' => 'img-thumbnail']) ?>
                    </div>
                </div>
            </div>
        </div>


    <?php } ?>
</div>
