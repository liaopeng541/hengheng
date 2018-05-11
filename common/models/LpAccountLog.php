<?php

namespace common\models;
use common\models\LpUsers;
use Yii;

/**
 * This is the model class for table "{{%lp_account_log}}".
 *
 * @property int $log_id 日志id
 * @property int $user_id 用户id
 * @property string $user_money 用户金额
 * @property string $frozen_money 冻结金额
 * @property int $pay_points 支付积分
 * @property int $change_time 变动时间
 * @property string $desc 描述
 * @property string $order_sn 订单编号
 * @property int $order_id 订单id
 * @property int $otoorder_id
 * @property int $order_type 0为商城支付，2为充值，3为转出，4为转入,5为线下消费,6为增加积分,7为订单退款，101为系统调整
 */
class LpAccountLog extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_account_log}}';
    }
    public function rules()
    {
        return [
            [['user_id', 'pay_points', 'change_time', 'order_id', 'otoorder_id'], 'integer'],
            [['user_money', 'frozen_money'], 'number'],
            [['desc'], 'string', 'max' => 255],
            [['order_sn'], 'string', 'max' => 50],
            [['order_type'], 'string', 'max' => 4],
        ];
    }
    public function attributeLabels()
    {
        return [
            'order_type' => '0为商城支付，2为充值，3为转出，4为转入,5为线下消费,6为增加积分,7为订单退款，101为系统调整',
            'otoorder_id' => 'Otoorder ID',
            'frozen_money' => '冻结金额',
            'desc' => '描述',
            'pay_points' => '支付积分',
            'order_id' => '订单id',
            'order_sn' => '订单编号',
            'change_time' => '变动时间',
            'user_money' => '用户金额',
            'log_id' => '日志id',
            'user_id' => '用户',
        ];
    }

      public function getLp_users_user_id(){
          return $this->hasOne(LpUsers::className(),["user_id"=>"user_id"]);
      }

    public function giishow()
    {
        return array (
  'bottom_btn' => 
  array (
    'export_btn' => 'on',
  ),
  'column_btn' => 
  array (
    'detail_btn' => 'on',
  ),
  'table_name' => 'lp_account_log',
  'table' => 
  array (
    'order_type' => 
    array (
      'sort' => '100',
      'show_name' => '0为商城支付，2为充值，3为转出，4为转入,5为线下消费,6为增加积分,7为订单退款，101为系统调整',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'otoorder_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Otoorder ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'frozen_money' => 
    array (
      'sort' => '100',
      'show_name' => '冻结金额',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '描述',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pay_points' => 
    array (
      'sort' => '100',
      'show_name' => '支付积分',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_id' => 
    array (
      'sort' => '100',
      'show_name' => '订单id',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_sn' => 
    array (
      'sort' => '100',
      'show_name' => '订单编号',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'change_time' => 
    array (
      'sort' => '100',
      'show_name' => '变动时间',
      'order' => '1',
      'show_mode' => '日期时间',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'user_money' => 
    array (
      'sort' => '100',
      'show_name' => '用户金额',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'log_id' => 
    array (
      'sort' => '100',
      'show_name' => '日志id',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'user_id' => 
    array (
      'sort' => '100',
      'show_name' => '用户',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => 'key:lp_users:user_id>user_id:user_id>mobile:一对一',
    ),
  ),
);
    }

}
