<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%admin_auth_item}}".
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AdminAuthAssignment[] $adminAuthAssignments
 * @property AdminAuthRule $ruleName
 * @property AdminAuthItemChild[] $adminAuthItemChildren
 * @property AdminAuthItemChild[] $adminAuthItemChildren0
 * @property AdminAuthItem[] $children
 * @property AdminAuthItem[] $parents
 */
class AdminAuthItem extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_auth_item}}';
    }
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AdminAuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getAdminAuthAssignments()
    {
        return $this->hasMany(AdminAuthAssignment::className(), ['item_name' => 'name']);
    }
    public function getRuleName()
    {
        return $this->hasOne(AdminAuthRule::className(), ['name' => 'rule_name']);
    }
    public function getAdminAuthItemChildren()
    {
        return $this->hasMany(AdminAuthItemChild::className(), ['parent' => 'name']);
    }
    public function getAdminAuthItemChildren0()
    {
        return $this->hasMany(AdminAuthItemChild::className(), ['child' => 'name']);
    }
    public function getChildren()
    {
        return $this->hasMany(AdminAuthItem::className(), ['name' => 'child'])->viaTable('{{%admin_auth_item_child}}', ['parent' => 'name']);
    }
    public function getParents()
    {
        return $this->hasMany(AdminAuthItem::className(), ['name' => 'parent'])->viaTable('{{%admin_auth_item_child}}', ['child' => 'name']);
    }

    public function giishow()
    {
        return null;
    }

}
