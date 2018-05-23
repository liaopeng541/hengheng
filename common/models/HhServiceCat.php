<?php

namespace common\models;
use common\models\HhServiceCat;
use Yii;

/**
 * This is the model class for table "{{%hh_service_cat}}".
 *
 * @property int $id
 * @property string $name 名称
 * @property int $pid
 */
class HhServiceCat extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_service_cat}}';
    }
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => '所属分类',
            'name' => '名称',
        ];
    }

      public function getHh_service_cat_id(){
          return $this->hasOne(HhServiceCat::className(),["id"=>"pid"]);
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
    'edt_btn' => 'on',
    'del_btn' => 'on',
  ),
  'table_name' => 'hh_service_cat',
  'table' => 
  array (
    'id' => 
    array (
      'sort' => '100',
      'show_name' => 'ID',
      'show_mode' => '文本',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'pid' => 
    array (
      'sort' => '100',
      'show_name' => '所属分类',
      'show_mode' => '关联文本',
      'mini_table' => '1',
      'add_mode' => '树型下拉选择',
      'search_mode' => '不搜索',
      'f_key' => 'key:hh_service_cat:id>pid:id>name:一对一',
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
  ),
);
    }

}
