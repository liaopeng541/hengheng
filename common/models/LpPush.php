<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_push}}".
 *
 * @property int $id
 * @property string $title
 * @property string $desc
 * @property string $status
 * @property int $type
 * @property string $url
 * @property int $goods_id
 * @property string $thumb
 * @property int $add_time
 */
class LpPush extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_push}}';
    }

    public function rules()
    {
        return [
            [['type', 'add_time'], 'integer'],
            ['goods_id', 'checkGoodsID'],
            [['title', 'desc', 'url', 'thumb'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 2],
        ];
    }

    public function attributeLabels()
    {
        return [
            'goods_id' => '商品',
            'thumb' => '图片',
            'desc' => '描述',
            'add_time' => '添加时间',
            'url' => '跳转地址',
            'id' => 'ID',
            'title' => '标题',
            'status' => '状态',
            'type' => '类型',
        ];
    }

    public function checkGoodsID($attribute, $params)
    {
        switch ($this->type) {
            case '1':
            case '6':
            case '7':
            case '8':
                $this->addError($attribute, "编号的值不可以为空.");
                break;
        }
        
    }

    public static function getstatustext($index)
    {
        $text = [
            "0"=>"未推送",
            "1"=>"已推送",
        ];
        return isset($text[strval($index)])?$text[strval($index)]:"";
    }

    public static function gettypetext($index)
    {
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
  'table_name' => 'lp_push',
  'table' => 
  array (
    'goods_id' => 
    array (
      'sort' => '100',
      'show_name' => '商品',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'thumb' => 
    array (
      'sort' => '100',
      'show_name' => '图片',
      'show_mode' => '图片',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '描述',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'add_time' => 
    array (
      'sort' => '100',
      'show_name' => '添加时间',
      'show_mode' => '日期时间',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '日期时间',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'url' => 
    array (
      'sort' => '100',
      'show_name' => '跳转地址',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
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
    'title' => 
    array (
      'sort' => '100',
      'show_name' => '标题',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
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
      'mini_table' => '1',
      'add_mode' => '开关',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=未推送,1=已推送',
    ),
    'type' => 
    array (
      'sort' => '100',
      'show_name' => '类型',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:1=线下订单详情,2=账户流水,3=后备箱使用记录,4=充值,5=我的洗车卡,6=商品详情,7=会员详情,8=员工详情,9=网页跳转',
    ),
  ),
);
    }

}
