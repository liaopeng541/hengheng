<?php

namespace backend\models;
use Yii;

/**
 * This is the model class for table "{{%admin_log}}".
 *
 * @property int $id
 * @property string $route
 * @property string $description
 * @property int $created_at
 * @property int $user_id
 */
class AdminLog extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_log}}';
    }
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['created_at'], 'required'],
            [['created_at', 'user_id'], 'integer'],
            [['route'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route' => 'Route',
            'description' => 'Description',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
        ];
    }


    public function giishow()
    {
        return null;
    }

}
