<?php

namespace common\models;
use common\models\LpUsers;
use Yii;

/**
 * This is the model class for table "{{%lp_order}}".
 *
 * @property string $order_id 订单id
 * @property string $order_sn 订单编号
 * @property string $user_id 用户id
 * @property int $order_status 订单状态 0:己确认.1:已取消。2：已完成。3：已完成(不能退款),9订单异常
 * @property int $shipping_status 发货状态
 * @property int $pay_status 支付状态0未付款，1已付款，2己申请退款，3己退款
 * @property string $consignee 收货人
 * @property string $country 国家
 * @property string $province 省份
 * @property string $city 城市
 * @property string $district 县区
 * @property int $twon 乡镇
 * @property string $address 地址
 * @property string $zipcode 邮政编码
 * @property string $mobile 手机
 * @property string $email 邮件
 * @property string $shipping_code 物流code
 * @property string $shipping_name 物流名称
 * @property int $pay_code 支付code
 * @property string $pay_name 支付方式名称
 * @property string $invoice_title 发票抬头
 * @property string $goods_price 商品总价
 * @property string $shipping_price 邮费
 * @property string $user_money 使用余额
 * @property string $coupon_price 优惠券抵扣
 * @property string $integral 使用积分
 * @property string $integral_money 使用积分抵多少钱
 * @property string $order_amount 应付款金额
 * @property string $total_amount 订单总价
 * @property string $add_time 下单时间
 * @property int $shipping_time 最后新发货时间
 * @property int $confirm_time 收货确认时间
 * @property string $pay_time 支付时间
 * @property int $order_prom_type 0默认1抢购2团购3优惠4预售5虚拟
 * @property int $order_prom_id 活动id
 * @property string $order_prom_amount 活动优惠金额
 * @property string $discount 价格调整
 * @property string $user_note 用户备注
 * @property string $admin_note 管理员备注
 * @property string $parent_sn 父单单号
 * @property int $is_distribut 是否已分成0未分成1已分成
 * @property string $paid_money 订金
 * @property string $coupon_ids
 */
class LpOrder extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_order}}';
    }
    public function rules()
    {
        return [
            [['user_id', 'country', 'province', 'city', 'district', 'twon', 'integral', 'add_time', 'shipping_time', 'confirm_time', 'pay_time', 'order_prom_id'], 'integer'],
            [['pay_code'], 'required'],
            [['goods_price', 'shipping_price', 'user_money', 'coupon_price', 'integral_money', 'order_amount', 'total_amount', 'order_prom_amount', 'discount', 'paid_money'], 'number'],
            [['order_sn'], 'string', 'max' => 20],
            [['order_status', 'shipping_status', 'pay_status', 'is_distribut'], 'string', 'max' => 1],
            [['consignee', 'zipcode', 'mobile', 'email'], 'string', 'max' => 60],
            [['address', 'user_note', 'admin_note', 'coupon_ids'], 'string', 'max' => 255],
            [['shipping_code', 'pay_code'], 'string', 'max' => 32],
            [['shipping_name', 'pay_name'], 'string', 'max' => 120],
            [['invoice_title'], 'string', 'max' => 256],
            [['order_prom_type'], 'string', 'max' => 4],
            [['parent_sn'], 'string', 'max' => 100],
            [['order_sn'], 'unique'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'order_prom_type' => '0默认1抢购2团购3优惠4预售5虚拟',
            'coupon_ids' => 'Coupon Ids',
            'twon' => '乡镇',
            'discount' => '价格调整',
            'coupon_price' => '优惠券抵扣',
            'user_money' => '使用余额',
            'integral' => '使用积分',
            'integral_money' => '使用积分抵多少钱',
            'district' => '县区',
            'invoice_title' => '发票抬头',
            'goods_price' => '商品总价',
            'country' => '国家',
            'address' => '地址',
            'city' => '城市',
            'pay_code' => '支付code',
            'pay_name' => '支付方式名称',
            'pay_status' => '支付状态0未付款，1已付款，2己申请退款，3己退款',
            'consignee' => '收货人',
            'confirm_time' => '收货确认时间',
            'is_distribut' => '是否已分成0未分成1已分成',
            'shipping_time' => '最后新发货时间',
            'order_prom_id' => '活动id',
            'order_prom_amount' => '活动优惠金额',
            'parent_sn' => '父单单号',
            'shipping_code' => '物流code',
            'shipping_name' => '物流名称',
            'user_note' => '用户备注',
            'province' => '省份',
            'admin_note' => '管理员备注',
            'paid_money' => '订金',
            'zipcode' => '邮政编码',
            'shipping_price' => '邮费',
            'add_time' => '下单时间',
            'shipping_status' => '发货状态',
            'order_amount' => '在线支付',
            'mobile' => '手机',
            'pay_time' => '支付时间',
            'total_amount' => '订单总价',
            'email' => '邮件',
            'user_id' => '用户',
            'order_id' => '订单id',
            'order_sn' => '订单编号',
            'order_status' => '订单状态',
        ];
    }

      public function getLp_users_user_id(){
          return $this->hasOne(LpUsers::className(),["user_id"=>"user_id"]);
      }
      public static function getorder_statustext($index){
              $text=[
                  "0"=>"待付款",
                  "1"=>"己取消",
                  "2"=>"己申请退款",
                  "3"=>"已完成(未使用)",
                  "4"=>"已完成",
                  "5"=>"己退款",
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
  'table_name' => 'lp_order',
  'table' => 
  array (
    'order_prom_type' => 
    array (
      'sort' => '100',
      'show_name' => '0默认1抢购2团购3优惠4预售5虚拟',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'coupon_ids' => 
    array (
      'sort' => '100',
      'show_name' => 'Coupon Ids',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'twon' => 
    array (
      'sort' => '100',
      'show_name' => '乡镇',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'discount' => 
    array (
      'sort' => '100',
      'show_name' => '价格调整',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'coupon_price' => 
    array (
      'sort' => '100',
      'show_name' => '优惠券抵扣',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'user_money' => 
    array (
      'sort' => '100',
      'show_name' => '使用余额',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'integral' => 
    array (
      'sort' => '100',
      'show_name' => '使用积分',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'integral_money' => 
    array (
      'sort' => '100',
      'show_name' => '使用积分抵多少钱',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'district' => 
    array (
      'sort' => '100',
      'show_name' => '县区',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'invoice_title' => 
    array (
      'sort' => '100',
      'show_name' => '发票抬头',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'goods_price' => 
    array (
      'sort' => '100',
      'show_name' => '商品总价',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'country' => 
    array (
      'sort' => '100',
      'show_name' => '国家',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'address' => 
    array (
      'sort' => '100',
      'show_name' => '地址',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'city' => 
    array (
      'sort' => '100',
      'show_name' => '城市',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pay_code' => 
    array (
      'sort' => '100',
      'show_name' => '支付code',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pay_name' => 
    array (
      'sort' => '100',
      'show_name' => '支付方式名称',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pay_status' => 
    array (
      'sort' => '100',
      'show_name' => '支付状态0未付款，1已付款，2己申请退款，3己退款',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'consignee' => 
    array (
      'sort' => '100',
      'show_name' => '收货人',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'confirm_time' => 
    array (
      'sort' => '100',
      'show_name' => '收货确认时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'is_distribut' => 
    array (
      'sort' => '100',
      'show_name' => '是否已分成0未分成1已分成',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'shipping_time' => 
    array (
      'sort' => '100',
      'show_name' => '最后新发货时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_prom_id' => 
    array (
      'sort' => '100',
      'show_name' => '活动id',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_prom_amount' => 
    array (
      'sort' => '100',
      'show_name' => '活动优惠金额',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'parent_sn' => 
    array (
      'sort' => '100',
      'show_name' => '父单单号',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'shipping_code' => 
    array (
      'sort' => '100',
      'show_name' => '物流code',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'shipping_name' => 
    array (
      'sort' => '100',
      'show_name' => '物流名称',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'user_note' => 
    array (
      'sort' => '100',
      'show_name' => '用户备注',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'province' => 
    array (
      'sort' => '100',
      'show_name' => '省份',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_note' => 
    array (
      'sort' => '100',
      'show_name' => '管理员备注',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'paid_money' => 
    array (
      'sort' => '100',
      'show_name' => '订金',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'zipcode' => 
    array (
      'sort' => '100',
      'show_name' => '邮政编码',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'shipping_price' => 
    array (
      'sort' => '100',
      'show_name' => '邮费',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'add_time' => 
    array (
      'sort' => '100',
      'show_name' => '下单时间',
      'show_mode' => '日期时间',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'shipping_status' => 
    array (
      'sort' => '100',
      'show_name' => '发货状态',
      'show_mode' => '不展示',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_amount' => 
    array (
      'sort' => '100',
      'show_name' => '在线支付',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'mobile' => 
    array (
      'sort' => '100',
      'show_name' => '手机',
      'show_mode' => '不展示',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pay_time' => 
    array (
      'sort' => '100',
      'show_name' => '支付时间',
      'show_mode' => '日期时间',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'total_amount' => 
    array (
      'sort' => '100',
      'show_name' => '订单总价',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'email' => 
    array (
      'sort' => '100',
      'show_name' => '邮件',
      'show_mode' => '不展示',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'user_id' => 
    array (
      'sort' => '100',
      'show_name' => '用户',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => 'key:lp_users:user_id>user_id:user_id>mobile:一对一',
    ),
    'order_id' => 
    array (
      'sort' => '100',
      'show_name' => '订单id',
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
    'order_status' => 
    array (
      'sort' => '100',
      'show_name' => '订单状态',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=待付款,1=己取消,2=己申请退款,3=已完成(未使用),4=已完成,5=己退款',
    ),
  ),
);
    }

}
