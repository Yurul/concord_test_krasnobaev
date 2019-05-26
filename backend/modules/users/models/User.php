<?php
namespace backend\modules\users\models;

use Yii;
use yii\base\Model;
use common\models\User as CommonUser;
use mohorev\file\UploadImageBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\Group as UserGroup;


class User extends CommonUser
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'email', 'photo', 'group_id, created_at'], 'safe'],
            [['login', 'email', 'group_id'], 'required'],
            [['login','email'], 'trim'],

            ['login', 'unique', 'targetClass' => '\common\models\User', 'filter'=>['not', ['id' => $this->id]], 'message' => 'This username has already been taken.'],
            ['login', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'filter'=>['not', ['email' => $this->email]], 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'on' => 'insert'],
            ['password', 'string', 'min' => 6],

            ['photo', 'file', 'extensions' => 'png, jpg, jpeg', 'on' => ['insert', 'update']],
            ['photo', 'file', 'maxSize' => 1000*1024, 'tooBig'=>'Limit is 1mb', 'on' => ['insert', 'update']],
	    ['group_id', 'integer'],
            ['group_id', 'isExistingGroup'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'photo',
                'scenarios' => ['insert', 'update'],
                'placeholder' => '@backend/web/uploads/users_photo/placeholder.png',
                'path' => '@backend/web/uploads/users_photo',
                'url' => 'uploads/users_photo',
                'createThumbsOnSave' => false,
                'createThumbsOnRequest' => true,
                'unlinkOnDelete' => true,
                'thumbs' => [
                    'preview' => ['width' => 200, 'height' => 200],
                ],
                'generateNewName' => function($file){
                    if($this->getScenario() == 'insert'){
                        return $file->baseName. '.' . $file->extension;
                    }
                    return $this->id . '.' . $file->extension;
                }
            ],
            TimestampBehavior::class,
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['renamePhoto'] = [];

        return $scenarios;
    }

    public function isExistingGroup($attribute){
        $group_ids = Group::find()
            ->select(['id'])
            ->column();

        if($this->group_id != '0' && !in_array($this->group_id, $group_ids)){
            $this->addError($attribute, 'There are no such role');
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        //after insert operation we get the user id, so we can name photo properly
        if ($insert) {

            $oldName = $this->getUploadPath('photo');
            if(is_file($oldName)){
                $extension = explode('.', $oldName)[1];
                $baseName = $this->id . '.' . $extension;
                $newName = \Yii::getAlias($this->path) . '/' . $baseName;
                rename($oldName, $newName);

                $this->setScenario('renamePhoto');
                $this->photo = $baseName;
                $this->save();
            }

        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if($this->password){
                $this->password = md5($this->password);
            }else{
                $this->password = $this->getOldAttribute('password');
            }
            return true;
        }
        return false;
    }

    public function getGroup()
    {
        return $this->hasOne( UserGroup::className(), ['id' => 'group_id']);
    }
}
