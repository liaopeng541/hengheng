<?php

namespace backend\models;
use Yii;

/**
 * This is the model class for table "{{%admin_auth_item_child}}".
 *
 * @property string $parent
 * @property string $child
 *
 * @property AdminAuthItem $parent0
 * @property AdminAuthItem $child0
 */
class AdminAuthItemChild extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_auth_item_child}}';
    }
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AdminAuthItem::className(), 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AdminAuthItem::className(), 'targetAttribute' => ['child' => 'name']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'parent' => 'Parent',
            'child' => 'Child',
        ];
    }

    public function getParent0()
    {
        return $this->hasOne(AdminAuthItem::className(), ['name' => 'parent']);
    }
    public function getChild0()
    {
        return $this->hasOne(AdminAuthItem::className(), ['name' => 'child']);
    }

    public function giishow()
    {
        return array (
  'top_btn' => 
  array (
    'add_btn' => 'on',
    'del_btn' => 'on',
  ),
  'column_btn' => 
  array (
    'edt_btn' => 'on',
    'del_btn' => 'on',
  ),
  'table_name' => 'admin_auth_item_child',
  'table' => 
  array (
    'parent' => 
    array (
      'sort' => '1',
      'show_name' => 'Parent',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'child' => 
    array (
      'sort' => '2',
      'show_name' => 'Child',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
