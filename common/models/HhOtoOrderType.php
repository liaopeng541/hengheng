<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_oto_order_type}}".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 */
class HhOtoOrderType extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_oto_order_type}}';
    }
    public function rules()
    {
        return [
            [['name', 'desc'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'desc' => '介绍',
            'id' => 'ID',
            'name' => '类型名称',
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
  'table_name' => 'hh_oto_order_type',
  'table' => 
  array (
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '介绍',
      'show_mode' => '不展示',
      'detail' => '1',
      'add_mode' => '文本域',
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
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '类型名称',
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
