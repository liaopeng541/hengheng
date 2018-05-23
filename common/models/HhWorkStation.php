<?php

namespace common\models;
use common\models\HhService;
use common\models\HhStore;
use Yii;

/**
 * This is the model class for table "{{%hh_work_station}}".
 *
 * @property int $id
 * @property int $store_id
 * @property int $service_id
 * @property int $status
 * @property string $name
 * @property string $camera_sn
 */
class HhWorkStation extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_work_station}}';
    }
    public function rules()
    {
        return [
            [['store_id', 'service_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'camera_sn' => 'Camera Sn',
            'status' => '状态',
            'id' => 'ID',
            'name' => '名称',
            'service_id' => '服务',
            'store_id' => '门店',
        ];
    }

      public function getHh_service_id(){
          return $this->hasOne(HhService::className(),["id"=>"service_id"]);
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
  'table_name' => 'hh_work_station',
  'table' => 
  array (
    'camera_sn' => 
    array (
      'sort' => '100',
      'show_name' => 'Camera Sn',
      'show_mode' => '不展示',
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
    'service_id' => 
    array (
      'sort' => '100',
      'show_name' => '服务',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:hh_service:id>service_id:id>name:一对一',
    ),
    'store_id' => 
    array (
      'sort' => '100',
      'show_name' => '门店',
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
