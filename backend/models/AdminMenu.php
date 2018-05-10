<?php

namespace backend\models;
use Yii;

/**
 * This is the model class for table "{{%admin_menu}}".
 *
 * @property int $id
 * @property int $pid
 * @property string $name
 * @property string $url
 * @property string $icon_style
 * @property int $display
 * @property int $sort
 * @property string $iconfont
 * @property int $is_menu
 * @property int $group_id
 */
class AdminMenu extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_menu}}';
    }
    public function rules()
    {
        return [
            [['pid', 'sort','display','is_menu','group_id'], 'integer'],
            [['name', 'icon_style', 'iconfont'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 60],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => '上级菜单',
            'name' => '菜单名称',
            'url' => '链接',
            'display' => '显示',
            'sort' => '排序',
            'iconfont' => '图标',
        ];
    }


    public function giishow()
    {
        return array (
  'top_btn' => 
  array (
    'add_btn' => 'on',
    'del_btn' => 'on',
    'dis_btn' => 'on',
  ),
  'column_btn' => 
  array (
    'edt_btn' => 'on',
    'del_btn' => 'on',
  ),
  'table_name' => 'admin_menu',
  'table' => 
  array (
    'id' => 
    array (
      'sort' => '1',
      'show_name' => 'ID',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pid' => 
    array (
      'sort' => '2',
      'show_name' => '上级菜单',
      'show_mode' => '不展示',
      'add_mode' => '下拉选择',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'name' => 
    array (
      'sort' => '3',
      'show_name' => '菜单名称',
      'show_mode' => '文本',
      'add_mode' => '文本框',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'url' => 
    array (
      'sort' => '4',
      'show_name' => '链接',
      'show_mode' => '文本',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'display' => 
    array (
      'sort' => '5',
      'show_name' => '显示',
      'show_mode' => '开关',
      'add_mode' => '开关',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sort' => 
    array (
      'sort' => '6',
      'show_name' => '排序',
      'show_mode' => '可编辑',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'iconfont' => 
    array (
      'sort' => '7',
      'show_name' => '图标',
      'show_mode' => '文本',
      'add_mode' => '文本框',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
  ),
);
    }

}
