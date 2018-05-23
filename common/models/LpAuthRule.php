<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_auth_rule}}".
 *
 * @property string $name
 * @property string $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property LpAuthItem[] $lpAuthItems
 */
class LpAuthRule extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_auth_rule}}';
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

    public function getLpAuthItems()
    {
        return $this->hasMany(LpAuthItem::className(), ['rule_name' => 'name']);
    }

    public function giishow()
    {
        return null;
    }

}
