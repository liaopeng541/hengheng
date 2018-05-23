<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_store}}".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $x
 * @property string $y
 * @property string $tel
 * @property string $thumb
 * @property string $thumbs
 * @property int $work_time_start
 * @property int $work_time_end
 * @property string $address
 * @property string $details
 * @property int $status 0未营业，1营业中
 * @property string $status_title
 * @property string $store_label
 * @property string $service_template
 */
class HhStore extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_store}}';
    }
    public function rules()
    {
        return [
            [['work_time_start', 'work_time_end'], 'integer'],
            [['details'], 'string'],
            [['name', 'desc', 'x', 'y', 'tel', 'status', 'status_title', 'store_label'], 'string', 'max' => 255],
            [['thumb', 'thumbs', 'service_template'], 'string', 'max' => 400],
            [['address'], 'string', 'max' => 256],
        ];
    }
    public function attributeLabels()
    {
        return [
            'service_template' => 'Service Template',
            'work_time_end' => 'Work Time End',
            'work_time_start' => 'Work Time Start',
            'x' => 'X',
            'y' => 'Y',
            'thumbs' => '图集',
            'status_title' => '状态说明',
            'store_label' => '门店标签',
            'details' => '详情',
            'desc' => '介绍',
            'thumb' => '图片',
            'address' => '地址',
            'status' => '营业状态',
            'id' => 'ID',
            'name' => '名称',
            'tel' => '电话',
        ];
    }

      public static function getstatustext($index){
              $text=[
                  "0"=>"未营业",
                  "1"=>"营业",
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
  'table_name' => 'hh_store',
  'table' => 
  array (
    'service_template' => 
    array (
      'sort' => '100',
      'show_name' => 'Service Template',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'work_time_end' => 
    array (
      'sort' => '100',
      'show_name' => 'Work Time End',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'work_time_start' => 
    array (
      'sort' => '100',
      'show_name' => 'Work Time Start',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'x' => 
    array (
      'sort' => '100',
      'show_name' => 'X',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'y' => 
    array (
      'sort' => '100',
      'show_name' => 'Y',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'thumbs' => 
    array (
      'sort' => '100',
      'show_name' => '图集',
      'show_mode' => '不展示',
      'add_mode' => '图集',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'status_title' => 
    array (
      'sort' => '100',
      'show_name' => '状态说明',
      'show_mode' => '不展示',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'store_label' => 
    array (
      'sort' => '100',
      'show_name' => '门店标签',
      'show_mode' => '不展示',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'details' => 
    array (
      'sort' => '100',
      'show_name' => '详情',
      'show_mode' => '不展示',
      'mini_table' => '1',
      'add_mode' => '富文本',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '介绍',
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
    'address' => 
    array (
      'sort' => '100',
      'show_name' => '地址',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'status' => 
    array (
      'sort' => '100',
      'show_name' => '营业状态',
      'show_mode' => '开关',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'search_mode' => '不搜索',
      'f_key' => 'txt:0=未营业,1=营业',
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
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '名称',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'tel' => 
    array (
      'sort' => '100',
      'show_name' => '电话',
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
