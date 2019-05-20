<?php
namespace backend\modules\users\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Group as CommonGroup;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 */
class Group extends CommonGroup
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
       return [
            ['name', 'required'],
            ['name', 'string']
        ];

    }

}
