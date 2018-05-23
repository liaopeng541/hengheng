<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_tip_gift}}".
 *
 * @property int $id
 * @property string $name
 * @property string $money 总额
 * @property string $dot 计量单位（例个，件，包）
 * @property string $desc 介绍
 * @property string $icon
 * @property int $sort
 */
class HhTipGift extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_tip_gift}}';
    }
    public function rules()
    {
        return [
            [['money'], 'number'],
            [['sort'], 'integer'],
            [['name', 'dot', 'desc', 'icon'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'desc' => '介绍',
            'icon' => '图标',
            'dot' => '计量单位',
            'id' => 'ID',
            'money' => '价格',
            'sort' => '排序',
            'name' => '名称',
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
  'table_name' => 'hh_tip_gift',
  'table' => 
  array (
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '介绍',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'icon' => 
    array (
      'sort' => '100',
      'show_name' => '图标',
      'show_mode' => '图片',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'dot' => 
    array (
      'sort' => '100',
      'show_name' => '计量单位',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'id' => 
    array (
      'sort' => '100',
      'show_name' => 'ID',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'money' => 
    array (
      'sort' => '100',
      'show_name' => '价格',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sort' => 
    array (
      'sort' => '100',
      'show_name' => '排序',
      'order' => '1',
      'show_mode' => '可编辑',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '名称',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
  ),
);
    }

}
