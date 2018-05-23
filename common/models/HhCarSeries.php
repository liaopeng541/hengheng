<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_car_series}}".
 *
 * @property int $id
 * @property int $series_id
 * @property string $initial
 * @property int $brand_id
 * @property string $series
 * @property string $firms
 */
class HhCarSeries extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_car_series}}';
    }
    public function rules()
    {
        return [
            [['series_id', 'brand_id'], 'integer'],
            [['initial'], 'string', 'max' => 20],
            [['series', 'firms'], 'string', 'max' => 100],
        ];
    }
    public function attributeLabels()
    {
        return [
            'firms' => 'Firms',
            'id' => 'ID',
            'brand_id' => 'Brand ID',
            'initial' => 'Initial',
            'series' => 'Series',
            'series_id' => 'Series ID',
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
  'table_name' => 'hh_car_series',
  'table' => 
  array (
    'firms' => 
    array (
      'sort' => '100',
      'show_name' => 'Firms',
      'show_mode' => '不展示',
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
    'brand_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Brand ID',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'initial' => 
    array (
      'sort' => '100',
      'show_name' => 'Initial',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'series' => 
    array (
      'sort' => '100',
      'show_name' => 'Series',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'series_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Series ID',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
  ),
);
    }

}
