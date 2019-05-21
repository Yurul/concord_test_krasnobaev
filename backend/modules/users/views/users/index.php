<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\users\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'login',
            'email:email',
            [
                'attribute'=>'group_id',
                'label' => 'Role',
                'value' => function($data){
                    $role = $data->group->name;
                    return $role ? $role : 'user';
                }
            ],
            [
                'attribute'=>'created_at',
                'label' => 'Created',
                'value' => function($data){
                    return date("F j, Y, g:i a", $data->created_at);
                },
                'filter'=>[(string)60*60=>'for hour', (string)60*60*24=>'for day', (string)60*60*24*7=>'for week']
            ],
            [
                'label' => 'Photo',
                'format' => 'raw',
                'value' => function($data){
                    $src = $data->getThumbUploadUrl('photo','preview');
                    return Html::img($src,[
                        'alt'=>'face',
                        'style' => 'width:50px;'
                    ]);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
