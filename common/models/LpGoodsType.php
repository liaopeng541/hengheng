<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_goods_type}}".
 *
 * @property int $id id自增
 * @property string $name 类型名称
 */
class LpGoodsType extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_goods_type}}';
    }
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 60],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => '模型ID',
            'name' => '模型名称',
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
  'table_name' => 'lp_goods_type',
  'table' => 
  array (
    'id' => 
    array (
      'sort' => '100',
      'show_name' => '模型ID',
      'order' => '1',
      'show_mode' => '文本',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '模型名称',
      'show_mode' => '文本',
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
