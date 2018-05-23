<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_oto_order_cancel_cause}}".
 *
 * @property int $id
 * @property string $cause
 */
class HhOtoOrderCancelCause extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_oto_order_cancel_cause}}';
    }
    public function rules()
    {
        return [
            [['cause'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cause' => '退单原因',
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
  'table_name' => 'hh_oto_order_cancel_cause',
  'table' => 
  array (
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
    'cause' => 
    array (
      'sort' => '100',
      'show_name' => '退单原因',
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
