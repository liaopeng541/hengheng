<?php

namespace common\models;
use common\models\HhWorkStation;
use common\models\HhStore;
use Yii;

/**
 * This is the model class for table "{{%hh_live}}".
 *
 * @property int $id
 * @property int $work_id
 * @property string $device
 * @property string $crame
 * @property int $store_id
 */
class HhLive extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_live}}';
    }
    public function rules()
    {
        return [
            [['work_id', 'store_id'], 'integer'],
            [['device', 'crame'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'crame' => '摄像头',
            'id' => 'ID',
            'device' => '设备号',
            'work_id' => '工位',
            'store_id' => '门店',
        ];
    }

      public function getHh_work_station_id(){
          return $this->hasOne(HhWorkStation::className(),["id"=>"work_id"]);
      }
      public function getHh_store_id(){
          return $this->hasOne(HhStore::className(),["id"=>"store_id"]);
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
  'table_name' => 'hh_live',
  'table' => 
  array (
    'crame' => 
    array (
      'sort' => '100',
      'show_name' => '摄像头',
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
    'device' => 
    array (
      'sort' => '100',
      'show_name' => '设备号',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'work_id' => 
    array (
      'sort' => '100',
      'show_name' => '工位',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:hh_work_station:id>work_id:id>name:一对一',
    ),
    'store_id' => 
    array (
      'sort' => '100',
      'show_name' => '门店',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:hh_store:id>store_id:id>name:一对一',
    ),
  ),
);
    }

}
