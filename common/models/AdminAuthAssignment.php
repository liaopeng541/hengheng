<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%admin_auth_assignment}}".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int $created_at
 *
 * @property AdminAuthItem $itemName
 */
class AdminAuthAssignment extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_auth_assignment}}';
    }
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AdminAuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    public function getItemName()
    {
        return $this->hasOne(AdminAuthItem::className(), ['name' => 'item_name']);
    }

    public function giishow()
    {
        return null;
    }

}
