<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_push_queue}}".
 *
 * @property int $id
 * @property int $type
 * @property string $url
 * @property int $goods_id
 * @property string $title
 * @property string $image
 * @property string $desc
 * @property int $is_send
 * @property int $time
 * @property int $send_time
 * @property int $status
 * @property int $user_id
 * @property int $level_id
 * @property int $is_read
 */
class HhPushQueue extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_push_queue}}';
    }
    public function rules()
    {
        return [
            [['goods_id', 'time', 'send_time', 'user_id', 'level_id','type'], 'safe'],
            [['title','desc'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'is_send' => 'Is Send',
            'time' => 'Time',
            'goods_id' => '商品编号',
            'image' => '图片',
            'send_time' => '推送时间',
            'level_id' => '推送登陆',
            'user_id' => '推送账号',
            'desc' => '描述',
            'url' => '跳转地址',
            'id' => 'ID',
            'title' => '推送标题',
            'status' => '推送状态',
            'is_read' => '是否阅读',
            'type' => '类型',
        ];
    }

      public static function getstatustext($index){
              $text=[
                  "0"=>"未推送",
                  "1"=>"已推送",
                  "2"=>"推送失败",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public static function getis_readtext($index){
              $text=[
                  "0"=>"未读",
                  "1"=>"已读",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public static function gettypetext($index){
              $text=[
                  "1"=>"线下订单详情",
                  "2"=>"账户流水",
                  "3"=>"后备箱使用记录",
                  "4"=>"充值",
                  "5"=>"我的洗车卡",
                  "6"=>"商品详情",
                  "7"=>"会员详情",
                  "8"=>"员工详情",
                  "9"=>"网页跳转",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }

    public function giishow()
    {
        return array (
  'table_name' => 'hh_push_queue',
  'table' => 
  array (
    'is_send' => 
    array (
      'sort' => '100',
      'show_name' => 'Is Send',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'time' => 
    array (
      'sort' => '100',
      'show_name' => 'Time',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'goods_id' => 
    array (
      'sort' => '100',
      'show_name' => '商品编号',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'image' => 
    array (
      'sort' => '100',
      'show_name' => '图片',
      'show_mode' => '图片',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'send_time' => 
    array (
      'sort' => '100',
      'show_name' => '推送时间',
      'show_mode' => '日期时间',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_id' => 
    array (
      'sort' => '100',
      'show_name' => '推送登陆',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'user_id' => 
    array (
      'sort' => '100',
      'show_name' => '推送账号',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '描述',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'url' => 
    array (
      'sort' => '100',
      'show_name' => '跳转地址',
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
    'title' => 
    array (
      'sort' => '100',
      'show_name' => '推送标题',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'status' => 
    array (
      'sort' => '100',
      'show_name' => '推送状态',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=未推送,1=已推送,2=推送失败',
    ),
    'is_read' => 
    array (
      'sort' => '100',
      'show_name' => '是否阅读',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=未读,1=已读',
    ),
    'type' => 
    array (
      'sort' => '100',
      'show_name' => '类型',
      'order' => '1',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:1=线下订单详情,2=账户流水,3=后备箱使用记录,4=充值,5=我的洗车卡,6=商品详情,7=会员详情,8=员工详情,9=网页跳转',
    ),
  ),
);
    }

}
