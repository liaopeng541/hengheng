<?php

namespace common\models;
use common\models\LpUserLevel;
use Yii;

/**
 * This is the model class for table "{{%lp_users}}".
 *
 * @property int $user_id 表id
 * @property string $email 邮件
 * @property string $password 密码
 * @property string $paypwd 支付密码
 * @property int $sex 0 保密 1 男 2 女
 * @property int $birthday 生日
 * @property string $user_money 用户金额
 * @property string $frozen_money 冻结金额
 * @property string $distribut_money 累积分佣金额
 * @property int $pay_points 消费积分
 * @property int $address_id 默认收货地址
 * @property int $reg_time 注册时间
 * @property int $last_login 最后登录时间
 * @property string $last_ip 最后登录ip
 * @property string $qq QQ
 * @property string $mobile 手机号码
 * @property int $mobile_validated 是否验证手机
 * @property string $oauth 第三方来源 wx weibo alipay
 * @property string $openid 第三方唯一标示
 * @property string $unionid
 * @property string $head_pic 头像
 * @property int $province 省份
 * @property int $city 市区
 * @property int $district 县
 * @property int $email_validated 是否验证电子邮箱
 * @property string $nickname 第三方返回昵称
 * @property int $level 会员等级
 * @property string $level_name
 * @property int $level_start_time 等级开始时间
 * @property int $level_end_time 等级失效时间
 * @property string $discount 会员折扣，默认1不享受
 * @property string $total_amount 消费累计额度
 * @property int $is_lock 是否被锁定冻结
 * @property int $is_distribut 是否为分销商 0 否 1 是
 * @property int $first_leader 第一个上级
 * @property int $second_leader 第二个上级
 * @property int $third_leader 第三个上级
 * @property string $token 用于app 授权类似于session_id
 * @property string $device_token 硬件唯一标识
 * @property string $client 手机系统
 * @property int $login_error_time 登录错误最后时间
 * @property int $login_error_num 登陆错误次数
 * @property int $comment_num 评价数量
 * @property int $tips_num
 * @property string $tips_money
 * @property int $order_num
 * @property int $oto_order_num
 * @property int $bag_num
 * @property int $vip_remind VIP快到期是否提醒
 */
class LpUsers extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_users}}';
    }
    public function rules()
    {
        return [
            [['birthday', 'pay_points', 'address_id', 'reg_time', 'last_login', 'province', 'city', 'district', 'level_start_time', 'level_end_time', 'first_leader', 'second_leader', 'third_leader', 'login_error_time', 'login_error_num', 'comment_num', 'tips_num', 'order_num', 'oto_order_num', 'bag_num'], 'integer'],
            [['user_money', 'frozen_money', 'distribut_money', 'discount', 'total_amount', 'tips_money'], 'number'],
            [['mobile'], 'required'],
            [['email', 'password', 'paypwd', 'head_pic', 'nickname', 'level_name', 'token', 'device_token'], 'string', 'max' => 255],
            [['sex', 'email_validated', 'level', 'is_lock', 'is_distribut'], 'string', 'max' => 1],
            [['last_ip'], 'string', 'max' => 15],
            [['qq', 'mobile'], 'string', 'max' => 20],
            [['mobile_validated'], 'string', 'max' => 3],
            [['oauth'], 'string', 'max' => 10],
            [['openid', 'unionid'], 'string', 'max' => 100],
            [['client'], 'string', 'max' => 64],
            [['vip_remind'], 'string', 'max' => 4],
        ];
    }
    public function attributeLabels()
    {
        return [
            'bag_num' => 'Bag Num',
            'level_name' => 'Level Name',
            'order_num' => 'Order Num',
            'oto_order_num' => 'Oto Order Num',
            'qq' => 'QQ',
            'tips_money' => 'Tips Money',
            'tips_num' => 'Tips Num',
            'unionid' => 'Unionid',
            'vip_remind' => 'VIP快到期是否提醒',
            'discount' => '会员折扣，默认1不享受',
            'frozen_money' => '冻结金额',
            'district' => '县',
            'head_pic' => '头像',
            'password' => '密码',
            'city' => '市区',
            'client' => '手机系统',
            'paypwd' => '支付密码',
            'is_distribut' => '是否为分销商 0 否 1 是',
            'mobile_validated' => '是否验证手机',
            'email_validated' => '是否验证电子邮箱',
            'last_ip' => '最后登录ip',
            'last_login' => '最后登录时间',
            'pay_points' => '消费积分',
            'total_amount' => '消费累计额度',
            'birthday' => '生日',
            'token' => '用于app 授权类似于session_id',
            'login_error_time' => '登录错误最后时间',
            'login_error_num' => '登陆错误次数',
            'province' => '省份',
            'device_token' => '硬件唯一标识',
            'first_leader' => '第一个上级',
            'third_leader' => '第三个上级',
            'openid' => '第三方唯一标示',
            'oauth' => '第三方来源 wx weibo alipay',
            'nickname' => '第三方返回昵称',
            'second_leader' => '第二个上级',
            'level_end_time' => '等级失效时间',
            'level_start_time' => '等级开始时间',
            'distribut_money' => '累积分佣金额',
            'comment_num' => '评价数量',
            'email' => '邮件',
            'address_id' => '默认收货地址',
            'level' => '会员等级',
            'reg_time' => '注册时间',
            'is_lock' => '状态',
            'user_money' => '用户金额',
            'mobile' => '手机号码',
            'sex' => '性别',
            'user_id' => '用户id',
        ];
    }

      public function getLp_user_level_level_id(){
          return $this->hasOne(LpUserLevel::className(),["level_id"=>"level"]);
      }
      public static function getis_locktext($index){
              $text=[
                  "0"=>"正常",
                  "1"=>"冻结",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public static function getsextext($index){
              $text=[
                  "0"=>"保密",
                  "1"=>"男",
                  "2"=>"女",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }

    public function giishow()
    {
        return array (
  'top_btn' => 
  array (
    'del_btn' => 'on',
    'dis_btn' => 'on',
  ),
  'bottom_btn' => 
  array (
    'export_btn' => 'on',
  ),
  'column_btn' => 
  array (
    'detail_btn' => 'on',
    'edt_btn' => 'on',
    'del_btn' => 'on',
  ),
  'table_name' => 'lp_users',
  'table' => 
  array (
    'bag_num' => 
    array (
      'sort' => '100',
      'show_name' => 'Bag Num',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_name' => 
    array (
      'sort' => '100',
      'show_name' => 'Level Name',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_num' => 
    array (
      'sort' => '100',
      'show_name' => 'Order Num',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'oto_order_num' => 
    array (
      'sort' => '100',
      'show_name' => 'Oto Order Num',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'qq' => 
    array (
      'sort' => '100',
      'show_name' => 'QQ',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'tips_money' => 
    array (
      'sort' => '100',
      'show_name' => 'Tips Money',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'tips_num' => 
    array (
      'sort' => '100',
      'show_name' => 'Tips Num',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'unionid' => 
    array (
      'sort' => '100',
      'show_name' => 'Unionid',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'vip_remind' => 
    array (
      'sort' => '100',
      'show_name' => 'VIP快到期是否提醒',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'discount' => 
    array (
      'sort' => '100',
      'show_name' => '会员折扣，默认1不享受',
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
    'district' => 
    array (
      'sort' => '100',
      'show_name' => '县',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'head_pic' => 
    array (
      'sort' => '100',
      'show_name' => '头像',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'password' => 
    array (
      'sort' => '100',
      'show_name' => '密码',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'city' => 
    array (
      'sort' => '100',
      'show_name' => '市区',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'client' => 
    array (
      'sort' => '100',
      'show_name' => '手机系统',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'paypwd' => 
    array (
      'sort' => '100',
      'show_name' => '支付密码',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'is_distribut' => 
    array (
      'sort' => '100',
      'show_name' => '是否为分销商 0 否 1 是',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'mobile_validated' => 
    array (
      'sort' => '100',
      'show_name' => '是否验证手机',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'email_validated' => 
    array (
      'sort' => '100',
      'show_name' => '是否验证电子邮箱',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'last_ip' => 
    array (
      'sort' => '100',
      'show_name' => '最后登录ip',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'last_login' => 
    array (
      'sort' => '100',
      'show_name' => '最后登录时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pay_points' => 
    array (
      'sort' => '100',
      'show_name' => '消费积分',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'total_amount' => 
    array (
      'sort' => '100',
      'show_name' => '消费累计额度',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'birthday' => 
    array (
      'sort' => '100',
      'show_name' => '生日',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'token' => 
    array (
      'sort' => '100',
      'show_name' => '用于app 授权类似于session_id',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'login_error_time' => 
    array (
      'sort' => '100',
      'show_name' => '登录错误最后时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'login_error_num' => 
    array (
      'sort' => '100',
      'show_name' => '登陆错误次数',
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
    'device_token' => 
    array (
      'sort' => '100',
      'show_name' => '硬件唯一标识',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'first_leader' => 
    array (
      'sort' => '100',
      'show_name' => '第一个上级',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'third_leader' => 
    array (
      'sort' => '100',
      'show_name' => '第三个上级',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'openid' => 
    array (
      'sort' => '100',
      'show_name' => '第三方唯一标示',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'oauth' => 
    array (
      'sort' => '100',
      'show_name' => '第三方来源 wx weibo alipay',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'nickname' => 
    array (
      'sort' => '100',
      'show_name' => '第三方返回昵称',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'second_leader' => 
    array (
      'sort' => '100',
      'show_name' => '第二个上级',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_end_time' => 
    array (
      'sort' => '100',
      'show_name' => '等级失效时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_start_time' => 
    array (
      'sort' => '100',
      'show_name' => '等级开始时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'distribut_money' => 
    array (
      'sort' => '100',
      'show_name' => '累积分佣金额',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'comment_num' => 
    array (
      'sort' => '100',
      'show_name' => '评价数量',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'email' => 
    array (
      'sort' => '100',
      'show_name' => '邮件',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'address_id' => 
    array (
      'sort' => '100',
      'show_name' => '默认收货地址',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level' => 
    array (
      'sort' => '100',
      'show_name' => '会员等级',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '下拉选择',
      'f_key' => 'key:lp_user_level:level_id>level:level_id>level_name:一对一',
    ),
    'reg_time' => 
    array (
      'sort' => '100',
      'show_name' => '注册时间',
      'show_mode' => '日期时间',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'is_lock' => 
    array (
      'sort' => '100',
      'show_name' => '状态',
      'show_mode' => '开关',
      'detail' => '1',
      'add_mode' => '不新增',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=正常,1=冻结',
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
    'mobile' => 
    array (
      'sort' => '100',
      'show_name' => '手机号码',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'sex' => 
    array (
      'sort' => '100',
      'show_name' => '性别',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=保密,1=男,2=女',
    ),
    'user_id' => 
    array (
      'sort' => '100',
      'show_name' => '用户id',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
