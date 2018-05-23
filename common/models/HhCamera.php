<?php

namespace common\models;
use common\models\HhCameraDot;
use common\models\HhWorkStation;
use common\models\HhStore;
use Yii;

/**
 * This is the model class for table "{{%hh_camera}}".
 *
 * @property int $id
 * @property int $store_id
 * @property int $station_id
 * @property string $sn
 * @property int $is_entrance 是否入口
 */
class HhCamera extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_camera}}';
    }
    public function rules()
    {
        return [
            [['store_id', 'station_id'], 'integer'],
            [['sn', 'is_entrance'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'is_entrance' => '解发点',
            'id' => 'ID',
            'sn' => '摄像头序列号',
            'station_id' => '工位',
            'store_id' => '门店',
        ];
    }

      public function getHh_camera_dot_id(){
          return $this->hasOne(HhCameraDot::className(),["id"=>"is_entrance"]);
      }
      public function getHh_work_station_id(){
          return $this->hasOne(HhWorkStation::className(),["id"=>"station_id"]);
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
  'table_name' => 'hh_camera',
  'table' => 
  array (
    'is_entrance' => 
    array (
      'sort' => '100',
      'show_name' => '解发点',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'search_mode' => '不搜索',
      'f_key' => 'key:hh_camera_dot:id>is_entrance:id>name:一对一',
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
    'sn' => 
    array (
      'sort' => '100',
      'show_name' => '摄像头序列号',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'station_id' => 
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
      'f_key' => 'key:hh_work_station:id>station_id:id>name:一对一',
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
