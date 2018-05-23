<?php

namespace common\models;
use common\models\HhStore;
use Yii;

/**
 * This is the model class for table "{{%hh_tv}}".
 *
 * @property int $id
 * @property string $sn
 * @property int $store_id
 */
class HhTv extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_tv}}';
    }
    public function rules()
    {
        return [
            [['store_id'], 'integer'],
            [['sn'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'sn' => '序列号',
            'id' => 'ID',
            'store_id' => '门店',
        ];
    }

      public function getHh_store_id(){
          return $this->hasOne(HhStore::className(),["id"=>"store_id"]);
      }

    public function giishow()
    {
        return array (
  'column_btn' => 
  array (
    'detail_btn' => 'on',
    'edt_btn' => 'on',
  ),
  'table_name' => 'hh_tv',
  'table' => 
  array (
    'sn' => 
    array (
      'sort' => '100',
      'show_name' => '序列号',
      'show_mode' => '文本',
      'detail' => '1',
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
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'store_id' => 
    array (
      'sort' => '100',
      'show_name' => '门店',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:hh_store:id>store_id:id>name:一对一',
    ),
  ),
);
    }

}
