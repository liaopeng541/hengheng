<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_car}}".
 *
 * @property int $id
 * @property string $letter
 * @property string $brand
 * @property int $brand_id
 * @property string $brand_logo
 * @property string $series
 * @property int $series_id
 * @property string $carname
 * @property int $car_id
 * @property string $sela_status
 * @property string $sell
 * @property string $datatime
 * @property string $prices
 * @property string $lever
 * @property string $engine 发动机
 * @property string $gearbox 变速箱
 * @property string $size 长*宽*高(mm)
 * @property string $bodywork 车身结构
 * @property string $maximum 最高车速(km/h)
 * @property string $retry_times
 */
class HhCar extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_car}}';
    }
    public function rules()
    {
        return [
            [['brand_id', 'series_id', 'car_id'], 'integer'],
            [['sela_status', 'sell', 'datatime', 'prices', 'lever', 'engine', 'gearbox', 'size', 'bodywork', 'maximum', 'retry_times'], 'string'],
            [['letter'], 'string', 'max' => 10],
            [['brand'], 'string', 'max' => 100],
            [['brand_logo', 'series', 'carname'], 'string', 'max' => 200],
        ];
    }
    public function attributeLabels()
    {
        return [
            'brand_logo' => 'Brand Logo',
            'car_id' => 'Car ID',
            'carname' => 'Carname',
            'datatime' => 'Datatime',
            'id' => 'ID',
            'lever' => 'Lever',
            'prices' => 'Prices',
            'retry_times' => 'Retry Times',
            'sela_status' => 'Sela Status',
            'sell' => 'Sell',
            'series' => 'Series',
            'series_id' => 'Series ID',
            'engine' => '发动机',
            'gearbox' => '变速箱',
            'maximum' => '最高车速(km/h)',
            'bodywork' => '车身结构',
            'size' => '长*宽*高(mm)',
            'brand' => 'Brand',
            'brand_id' => 'Brand ID',
            'letter' => 'Letter',
        ];
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
  'table_name' => 'hh_car',
  'table' => 
  array (
    'brand_logo' => 
    array (
      'sort' => '100',
      'show_name' => 'Brand Logo',
      'show_mode' => '图片',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'car_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Car ID',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'carname' => 
    array (
      'sort' => '100',
      'show_name' => 'Carname',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'datatime' => 
    array (
      'sort' => '100',
      'show_name' => 'Datatime',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
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
    'lever' => 
    array (
      'sort' => '100',
      'show_name' => 'Lever',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'prices' => 
    array (
      'sort' => '100',
      'show_name' => 'Prices',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'retry_times' => 
    array (
      'sort' => '100',
      'show_name' => 'Retry Times',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sela_status' => 
    array (
      'sort' => '100',
      'show_name' => 'Sela Status',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sell' => 
    array (
      'sort' => '100',
      'show_name' => 'Sell',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'series' => 
    array (
      'sort' => '100',
      'show_name' => 'Series',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'series_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Series ID',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'engine' => 
    array (
      'sort' => '100',
      'show_name' => '发动机',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'gearbox' => 
    array (
      'sort' => '100',
      'show_name' => '变速箱',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'maximum' => 
    array (
      'sort' => '100',
      'show_name' => '最高车速(km/h)',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'bodywork' => 
    array (
      'sort' => '100',
      'show_name' => '车身结构',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'size' => 
    array (
      'sort' => '100',
      'show_name' => '长*宽*高(mm)',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'brand' => 
    array (
      'sort' => '100',
      'show_name' => 'Brand',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'brand_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Brand ID',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'letter' => 
    array (
      'sort' => '100',
      'show_name' => 'Letter',
      'order' => '1',
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
