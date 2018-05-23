<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_re_feedback}}".
 *
 * @property int $id
 * @property string $question
 * @property int $status 0启用，1禁用
 */
class HhReFeedback extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_re_feedback}}';
    }
    public function rules()
    {
        return [
            [['question'], 'string', 'max' => 255],
            [['status'], 'integer'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => '状态',
            'question' => '问题',
        ];
    }

      public static function getstatustext($index){
              $text=[
                  "0"=>"启用",
                  "1"=>"禁用",
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
  'table_name' => 'hh_re_feedback',
  'table' => 
  array (
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
    'status' => 
    array (
      'sort' => '100',
      'show_name' => '状态',
      'show_mode' => '开关',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '开关',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=启用,1=禁用',
    ),
    'question' => 
    array (
      'sort' => '100',
      'show_name' => '问题',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
  ),
);
    }

}
