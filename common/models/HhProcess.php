<?php

namespace common\models;
use common\models\HhProcessCat;
use Yii;

/**
 * This is the model class for table "{{%hh_process}}".
 *
 * @property int $id
 * @property int $cat_id
 * @property string $name
 * @property int $time
 * @property string $thumb
 * @property int $is_comment 是否可评价
 */
class HhProcess extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_process}}';
    }
    public function rules()
    {
        return [
            [['cat_id', 'time'], 'integer'],
            [['name', 'thumb'], 'string', 'max' => 255],
            [['is_comment'], 'string', 'max' => 4],
        ];
    }
    public function attributeLabels()
    {
        return [
            'thumb' => '展示图',
            'id' => 'ID',
            'name' => '名称',
            'is_comment' => '是否可评价',
            'time' => '预计时长(分钟)',
            'cat_id' => '分类',
        ];
    }

      public static function getis_commenttext($index){
              $text=[
                  "0"=>"禁止",
                  "1"=>"允许",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public function getHh_process_cat_id(){
          return $this->hasOne(HhProcessCat::className(),["id"=>"cat_id"]);
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
  'table_name' => 'hh_process',
  'table' => 
  array (
    'thumb' => 
    array (
      'sort' => '100',
      'show_name' => '展示图',
      'show_mode' => '图片',
      'mini_table' => '1',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'id' => 
    array (
      'sort' => '100',
      'show_name' => 'ID',
      'order' => '1',
      'show_mode' => '文本',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '名称',
      'show_mode' => '文本',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'is_comment' => 
    array (
      'sort' => '100',
      'show_name' => '是否可评价',
      'show_mode' => '开关',
      'mini_table' => '1',
      'add_mode' => '单选框',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=禁止,1=允许',
    ),
    'time' => 
    array (
      'sort' => '100',
      'show_name' => '预计时长(分钟)',
      'order' => '1',
      'show_mode' => '文本',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'cat_id' => 
    array (
      'sort' => '100',
      'show_name' => '分类',
      'order' => '1',
      'show_mode' => '关联文本',
      'mini_table' => '1',
      'add_mode' => '树型下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '树型下拉选择',
      'f_key' => 'key:hh_process_cat:id>cat_id:id>name:一对一',
    ),
  ),
);
    }

}
