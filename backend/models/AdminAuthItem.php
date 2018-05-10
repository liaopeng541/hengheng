<?php

namespace backend\models;
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


        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'type' => '类型',
            'description' => '表述',
            'rule_name' => '角色名称',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
  'table_name' => 'admin_auth_item',
  'table' => 
  array (
    'name' => 
    array (
      'sort' => '1',
      'show_name' => '名称',
      'show_mode' => '文本',
      'add_mode' => '文本框',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'type' => 
    array (
      'sort' => '2',
      'show_name' => '类型',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'description' => 
    array (
      'sort' => '3',
      'show_name' => '表述',
      'show_mode' => '文本',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'rule_name' => 
    array (
      'sort' => '4',
      'show_name' => '角色名称',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'data' => 
    array (
      'sort' => '5',
      'show_name' => 'Data',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'created_at' => 
    array (
      'sort' => '6',
      'show_name' => 'Created At',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'updated_at' => 
    array (
      'sort' => '7',
      'show_name' => 'Updated At',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
