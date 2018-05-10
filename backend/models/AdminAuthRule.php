<?php

namespace backend\models;
use Yii;

/**
 * This is the model class for table "{{%admin_auth_rule}}".
 *
 * @property string $name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AdminAuthItem[] $adminAuthItems
 */
class AdminAuthRule extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_auth_rule}}';
    }
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getAdminAuthItems()
    {
        return $this->hasMany(AdminAuthItem::className(), ['rule_name' => 'name']);
    }

    public function giishow()
    {
        return null;
    }

}
