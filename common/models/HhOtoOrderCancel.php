<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_oto_order_cancel}}".
 *
 * @property int $id
 * @property int $order_id
 * @property int $cause_id
 * @property int $time
 * @property string $cause
 * @property int $store_id
 * @property string $store_name
 * @property string $total
 * @property int $order_time
 * @property string $order_sn
 */
class HhOtoOrderCancel extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_oto_order_cancel}}';
    }
    public function rules()
    {
        return [
            [['order_id', 'cause_id', 'time', 'store_id', 'order_time'], 'integer'],
            [['total'], 'number'],
            [['cause', 'store_name', 'order_sn'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'cause_id' => 'Cause ID',
            'order_id' => 'Order ID',
            'order_time' => 'Order Time',
            'store_id' => 'Store ID',
            'total' => 'Total',
            'cause' => '废单原因',
            'store_name' => '门店',
            'id' => 'ID',
            'time' => '作废时间',
            'order_sn' => '订单编号',
        ];
    }


    public function giishow()
    {
        return array (
  'table_name' => 'hh_oto_order_cancel',
  'table' => 
  array (
    'cause_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Cause ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Order ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_time' => 
    array (
      'sort' => '100',
      'show_name' => 'Order Time',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'store_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Store ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'total' => 
    array (
      'sort' => '100',
      'show_name' => 'Total',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'cause' => 
    array (
      'sort' => '100',
      'show_name' => '废单原因',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'store_name' => 
    array (
      'sort' => '100',
      'show_name' => '门店',
      'show_mode' => '文本',
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
    'time' => 
    array (
      'sort' => '100',
      'show_name' => '作废时间',
      'show_mode' => '日期时间',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '日期',
      'f_key' => '',
    ),
    'order_sn' => 
    array (
      'sort' => '100',
      'show_name' => '订单编号',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
  ),
);
    }

}
