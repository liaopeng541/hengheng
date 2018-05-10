<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_user_level}}".
 *
 * @property int $level_id 表id
 * @property string $level_name 头衔名称
 * @property string $amount 等级必要金额
 * @property int $discount 折扣
 * @property string $describe 头街 描述
 * @property string $thumb
 * @property string $detail_img
 * @property int $sort
 * @property int $is_show
 * @property int $list_show 表示页展示
 * @property string $level_desc
 */
class LpUserLevel extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_user_level}}';
    }
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['discount', 'sort'], 'integer'],
            [['thumb', 'detail_img', 'level_desc'], 'string'],
            [['level_name'], 'string', 'max' => 30],
            [['describe'], 'string', 'max' => 200],
            [['is_show', 'list_show'], 'integer', 'max' => 4],
        ];
    }
    public function attributeLabels()
    {
        return [
            'level_id' => '表id',
            'level_name' => '等级名称',
            'amount' => '预充金额',
            'discount' => '折扣',
            'level_desc' => '充值说明',
            'list_show' => 'APP列表页展示',
            'is_show' => 'APP首页展示',
            'thumb' => '展示图片',
            'describe' => '描述',
            'detail_img' => '详情图片',
            'sort' => '排序',
        ];
    }

      public static function getlist_showtext($index){
              $text=[
                  "0"=>"隐藏",
                  "1"=>"展示",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public static function getis_showtext($index){
              $text=[
                  "0"=>"隐藏",
                  "1"=>"展示",
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
    'dis_btn' => 'on',
  ),
  'column_btn' => 
  array (
    'detail_btn' => 'on',
    'edt_btn' => 'on',
    'del_btn' => 'on',
  ),
  'table_name' => 'lp_user_level',
  'table' => 
  array (
    'level_id' => 
    array (
      'sort' => '1',
      'show_name' => '表id',
      'order' => '1',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_name' => 
    array (
      'sort' => '2',
      'show_name' => '等级名称',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'amount' => 
    array (
      'sort' => '3',
      'show_name' => '预充金额',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'discount' => 
    array (
      'sort' => '4',
      'show_name' => '折扣',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_desc' => 
    array (
      'sort' => '100',
      'show_name' => '充值说明',
      'show_mode' => '不展示',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'list_show' => 
    array (
      'sort' => '100',
      'show_name' => 'APP列表页展示',
      'show_mode' => '开关',
      'detail' => '1',
      'add_mode' => '开关',
      'search_mode' => '不搜索',
      'f_key' => 'txt:0=隐藏,1=展示',
    ),
    'is_show' => 
    array (
      'sort' => '100',
      'show_name' => 'APP首页展示',
      'show_mode' => '开关',
      'detail' => '1',
      'add_mode' => '开关',
      'search_mode' => '不搜索',
      'f_key' => 'txt:0=隐藏,1=展示',
    ),
    'thumb' => 
    array (
      'sort' => '100',
      'show_name' => '展示图片',
      'show_mode' => '不展示',
      'detail' => '1',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'describe' => 
    array (
      'sort' => '100',
      'show_name' => '描述',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'detail_img' => 
    array (
      'sort' => '100',
      'show_name' => '详情图片',
      'show_mode' => '不展示',
      'detail' => '1',
      'add_mode' => '图集',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sort' => 
    array (
      'sort' => '100',
      'show_name' => '排序',
      'order' => '1',
      'show_mode' => '可编辑',
      'detail' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
