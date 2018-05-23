<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_back_order}}".
 *
 * @property int $id
 * @property int $order_id
 * @property string $reason 理由
 * @property int $status
 * @property int $user_id
 * @property int $add_time
 * @property int $ok_time
 * @property string $order_sn
 * @property int $mobile
 * @property string $order_total
 * @property string $pay_total
 * @property string $coupon_total
 * @property string $sulp_total
 */
class LpBackOrder extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_back_order}}';
    }
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'add_time', 'ok_time', 'mobile'], 'integer'],
            [['reason'], 'string'],
            [['order_total', 'pay_total', 'coupon_total', 'sulp_total'], 'number'],
            [['status'], 'string', 'max' => 2],
            [['order_sn'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'coupon_total' => 'Coupon Total',
            'mobile' => 'Mobile',
            'ok_time' => 'Ok Time',
            'pay_total' => 'Pay Total',
            'sulp_total' => 'Sulp Total',
            'order_id' => '订单编号',
            'reason' => '理由',
            'user_id' => '用户ID',
            'add_time' => '申请时间',
            'order_total' => '订单总额',
            'id' => 'ID',
            'order_sn' => '订单编号',
            'status' => '状态',
        ];
    }

      public static function getstatustext($index){
              $text=[
                  "0"=>"未审批",
                  "1"=>"己同意",
                  "2"=>"己拒绝",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }

    public function giishow()
    {
        return array (
  'top_btn' => 
  array (
    'del_btn' => 'on',
  ),
  'column_btn' => 
  array (
    'detail_btn' => 'on',
    'del_btn' => 'on',
  ),
  'table_name' => 'lp_back_order',
  'table' => 
  array (
    'coupon_total' => 
    array (
      'sort' => '100',
      'show_name' => 'Coupon Total',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'mobile' => 
    array (
      'sort' => '100',
      'show_name' => 'Mobile',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'ok_time' => 
    array (
      'sort' => '100',
      'show_name' => 'Ok Time',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pay_total' => 
    array (
      'sort' => '100',
      'show_name' => 'Pay Total',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sulp_total' => 
    array (
      'sort' => '100',
      'show_name' => 'Sulp Total',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_id' => 
    array (
      'sort' => '100',
      'show_name' => '订单编号',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'reason' => 
    array (
      'sort' => '100',
      'show_name' => '理由',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'user_id' => 
    array (
      'sort' => '100',
      'show_name' => '用户ID',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'add_time' => 
    array (
      'sort' => '100',
      'show_name' => '申请时间',
      'show_mode' => '日期时间',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_total' => 
    array (
      'sort' => '100',
      'show_name' => '订单总额',
      'show_mode' => '文本',
      'detail' => '1',
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
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_sn' => 
    array (
      'sort' => '100',
      'show_name' => '订单编号',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'status' => 
    array (
      'sort' => '100',
      'show_name' => '状态',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=未审批,1=己同意,2=己拒绝',
    ),
  ),
);
    }

}
