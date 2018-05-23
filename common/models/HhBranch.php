<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_branch}}".
 *
 * @property int $id
 * @property int $f_id
 * @property string $name
 * @property string $desc
 */
class HhBranch extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_branch}}';
    }
    public function rules()
    {
        return [
            [['f_id'], 'integer'],
            [['name', 'desc'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'f_id' => 'F ID',
            'id' => 'ID',
            'desc' => '部门介绍',
            'name' => '部门名称',
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
    'detail_btn' => 'on',
    'edt_btn' => 'on',
    'del_btn' => 'on',
  ),
  'table_name' => 'hh_branch',
  'table' => 
  array (
    'f_id' => 
    array (
      'sort' => '100',
      'show_name' => 'F ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'id' => 
    array (
      'sort' => '100',
      'show_name' => 'ID',
      'order' => '1',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '部门介绍',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '部门名称',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
  ),
);
    }

}
