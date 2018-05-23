<?php

namespace common\models;
use common\models\HhWorker;
use common\models\HhWorkStation;
use common\models\HhStore;
use common\models\HhService;
use Yii;

/**
 * This is the model class for table "{{%hh_oto_order_service}}".
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property int $service_id
 * @property int $start_time
 * @property int $over_time
 * @property int $num
 * @property int $deduction_num 劵抵扣后的数量
 * @property string $total
 * @property int $status 0:未开始，1己开始 2己完成
 * @property string $price
 * @property string $worker_id
 * @property string $money
 * @property string $service_name
 * @property int $station_id
 * @property int $store_id
 * @property int $has_comment 是否可评价
 * @property int $comment_id 评价id
 * @property string $p_price 最终单价
 * @property string $p_total
 * @property int $level_id
 * @property string $level_name
 * @property string $level_price
 * @property int $level_price_type
 * @property string $discount 折扣
 * @property string $deduction_price 抵扣后单价(己用p_price代替),此项改为卡劵抵扣总额
 * @property string $deduction_total 抵扣后总计
 */
class HhOtoOrderService extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_oto_order_service}}';
    }
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'service_id', 'start_time', 'over_time', 'num', 'deduction_num', 'station_id', 'store_id', 'comment_id', 'level_id'], 'integer'],
            [['total', 'price', 'money', 'p_price', 'p_total', 'level_price', 'discount', 'deduction_price', 'deduction_total'], 'number'],
            [['status', 'has_comment', 'level_price_type'], 'string', 'max' => 4],
            [['worker_id', 'service_name', 'level_name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'level_id' => 'Level ID',
            'level_name' => 'Level Name',
            'level_price' => 'Level Price',
            'level_price_type' => 'Level Price Type',
            'money' => 'Money',
            'num' => 'Num',
            'order_id' => 'Order ID',
            'p_total' => 'P Total',
            'price' => 'Price',
            'total' => 'Total',
            'user_id' => 'User ID',
            'deduction_num' => '劵抵扣后的数量',
            'worker_id' => '员工',
            'station_id' => '工位',
            'discount' => '折扣',
            'deduction_price' => '抵扣后单价(己用p_price代替),此项改为卡劵抵扣总额',
            'deduction_total' => '抵扣后总计',
            'has_comment' => '是否可评价',
            'p_price' => '最终单价',
            'service_name' => '服务名称',
            'status' => '状态',
            'comment_id' => '评价id',
            'id' => 'ID',
            'store_id' => '门店',
            'start_time' => '开始时间',
            'service_id' => '服务名称',
            'over_time' => '结束时间',
        ];
    }

      public function getHh_worker_id(){
          return $this->hasOne(HhWorker::className(),["id"=>"worker_id"]);
      }
      public function getHh_work_station_id(){
          return $this->hasOne(HhWorkStation::className(),["id"=>"station_id"]);
      }
      public static function getstatustext($index){
              $text=[
                  "1"=>"完成",
                  "2"=>"正在施工...",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public function getHh_store_id(){
          return $this->hasOne(HhStore::className(),["id"=>"store_id"]);
      }
      public function getHh_service_id(){
          return $this->hasOne(HhService::className(),["id"=>"service_id"]);
      }

    public function giishow()
    {
        return array (
  'table_name' => 'hh_oto_order_service',
  'table' => 
  array (
    'level_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Level ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_name' => 
    array (
      'sort' => '100',
      'show_name' => 'Level Name',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_price' => 
    array (
      'sort' => '100',
      'show_name' => 'Level Price',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level_price_type' => 
    array (
      'sort' => '100',
      'show_name' => 'Level Price Type',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'money' => 
    array (
      'sort' => '100',
      'show_name' => 'Money',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'num' => 
    array (
      'sort' => '100',
      'show_name' => 'Num',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'order_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Order ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'p_total' => 
    array (
      'sort' => '100',
      'show_name' => 'P Total',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'price' => 
    array (
      'sort' => '100',
      'show_name' => 'Price',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'total' => 
    array (
      'sort' => '100',
      'show_name' => 'Total',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'user_id' => 
    array (
      'sort' => '100',
      'show_name' => 'User ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'deduction_num' => 
    array (
      'sort' => '100',
      'show_name' => '劵抵扣后的数量',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'worker_id' => 
    array (
      'sort' => '100',
      'show_name' => '员工',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => 'key:hh_worker:id>worker_id:id>real_name:一对一',
    ),
    'station_id' => 
    array (
      'sort' => '100',
      'show_name' => '工位',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => 'key:hh_work_station:id>station_id:id>name:一对一',
    ),
    'discount' => 
    array (
      'sort' => '100',
      'show_name' => '折扣',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'deduction_price' => 
    array (
      'sort' => '100',
      'show_name' => '抵扣后单价(己用p_price代替),此项改为卡劵抵扣总额',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'deduction_total' => 
    array (
      'sort' => '100',
      'show_name' => '抵扣后总计',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'has_comment' => 
    array (
      'sort' => '100',
      'show_name' => '是否可评价',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'p_price' => 
    array (
      'sort' => '100',
      'show_name' => '最终单价',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'service_name' => 
    array (
      'sort' => '100',
      'show_name' => '服务名称',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'status' => 
    array (
      'sort' => '100',
      'show_name' => '状态',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => 'txt:1=完成,2=正在施工...',
    ),
    'comment_id' => 
    array (
      'sort' => '100',
      'show_name' => '评价id',
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
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'store_id' => 
    array (
      'sort' => '100',
      'show_name' => '门店',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:hh_store:id>store_id:id>name:一对一',
    ),
    'start_time' => 
    array (
      'sort' => '100',
      'show_name' => '开始时间',
      'order' => '1',
      'show_mode' => '日期时间',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '日期时间',
      'f_key' => '',
    ),
    'service_id' => 
    array (
      'sort' => '100',
      'show_name' => '服务名称',
      'order' => '1',
      'show_mode' => '关联文本',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:hh_service:id>service_id:id>name:一对一',
    ),
    'over_time' => 
    array (
      'sort' => '100',
      'show_name' => '结束时间',
      'order' => '1',
      'show_mode' => '日期时间',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '日期时间',
      'f_key' => '',
    ),
  ),
);
    }

}
