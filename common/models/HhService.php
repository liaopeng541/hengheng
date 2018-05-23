<?php

namespace common\models;
use common\models\HhServiceCat;
use Yii;

/**
 * This is the model class for table "{{%hh_service}}".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $desc 介绍
 * @property string $thumb 图片
 * @property int $cat_id 分类
 * @property string $process_tpl
 * @property string $price
 */
class HhService extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_service}}';
    }
    public function rules()
    {
        return [
            [['cat_id'], 'integer'],
            [['process_tpl'], 'string'],
            [['price'], 'number'],
            [['name', 'desc', 'thumb'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'process_tpl' => 'Process Tpl',
            'desc' => '介绍',
            'thumb' => '图片',
            'id' => 'ID',
            'price' => 'Price',
            'cat_id' => '分类',
            'name' => '名称',
        ];
    }

    public function getHh_service_cat_id(){
      return $this->hasOne(HhServiceCat::className(),["id"=>"cat_id"]);
    }

    public static function getByCount()
    {
      $count = static::find()->asArray()->count();
      return $count;
    }

    public static function getByList()
    {
      $list = static::find()->asArray()->all();
      return $list;
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
  'table_name' => 'hh_service',
  'table' => 
  array (
    'process_tpl' => 
    array (
      'sort' => '100',
      'show_name' => 'Process Tpl',
      'show_mode' => '不展示',
      'mini_table' => '1',
      'add_mode' => '不新增',
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
      'add_mode' => '文本域',
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
    'price' => 
    array (
      'sort' => '100',
      'show_name' => 'Price',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
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
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '树型下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '树型下拉选择',
      'f_key' => 'key:hh_service_cat:id>cat_id:id>name:一对一',
    ),
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '名称',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
