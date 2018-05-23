<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_comment_lable}}".
 *
 * @property int $id
 * @property string $content
 * @property int $type 0商品，1为店铺，2为评论
 * @property int $check_num
 */
class HhCommentLable extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_comment_lable}}';
    }
    public function rules()
    {
        return [
            [['check_num'], 'integer'],
            [['content'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 4],
        ];
    }
    public function attributeLabels()
    {
        return [
            'check_num' => 'Check Num',
            'id' => 'ID',
            'content' => '标签名称',
            'type' => '类型',
        ];
    }

      public static function gettypetext($index){
              $text=[
                  "0"=>"商品",
                  "1"=>"店铺",
                  "2"=>"评论",
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
  'table_name' => 'hh_comment_lable',
  'table' => 
  array (
    'check_num' => 
    array (
      'sort' => '100',
      'show_name' => 'Check Num',
      'show_mode' => '不展示',
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
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'content' => 
    array (
      'sort' => '100',
      'show_name' => '标签名称',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
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
      'f_key' => 'txt:0=商品,1=店铺,2=评论',
    ),
  ),
);
    }

}
