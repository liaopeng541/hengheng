<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_push_queue}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property string $img
 * @property int $type
 * @property int $status
 */
class LpPushQueue extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_push_queue}}';
    }
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['title', 'content', 'img'], 'string', 'max' => 255],
            [['type', 'status'], 'string', 'max' => 4],
        ];
    }
    public function attributeLabels()
    {
        return [
            'img' => '图片',
            'content' => '推送内容',
            'title' => '推送标题',
            'user_id' => '推送账号',
            'status' => '状态',
            'id' => 'ID',
            'type' => '推送类型',
        ];
    }

      public static function getstatustext($index){
              $text=[
                  "1"=>"成功",
                  "0"=>"未推送",
                  "2"=>"推送失败",
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
  'table_name' => 'lp_push_queue',
  'table' => 
  array (
    'img' => 
    array (
      'sort' => '100',
      'show_name' => '图片',
      'show_mode' => '图片',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'content' => 
    array (
      'sort' => '100',
      'show_name' => '推送内容',
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
    'status' => 
    array (
      'sort' => '100',
      'show_name' => '状态',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => 'txt:1=成功,0=未推送,2=推送失败',
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
    'type' => 
    array (
      'sort' => '100',
      'show_name' => '推送类型',
      'order' => '1',
      'show_mode' => '关联文本',
      'add_mode' => '下拉选择',
      'search_mode' => '不搜索',
      'f_key' => 'txt:1=线下订单详情,2=账户流水,3=后备箱使用记录,4=充值,5=我的洗车卡,6=商品详情,7=会员详情,8=员工详情,9=网页跳转',
    ),
  ),
);
    }

}
