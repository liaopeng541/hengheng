<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_car_brand}}".
 *
 * @property int $id
 * @property string $initial
 * @property string $brand
 * @property int $brand_id
 * @property string $brand_logo
 */
class HhCarBrand extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_car_brand}}';
    }
    public function rules()
    {
        return [
            [['initial', 'brand', 'brand_logo'], 'string'],
            [['brand_id'], 'integer'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'brand' => 'Brand',
            'brand_id' => 'Brand ID',
            'brand_logo' => 'Brand Logo',
            'id' => 'ID',
            'initial' => 'Initial',
        ];
    }


    public function giishow()
    {
        return array (
  'table_name' => 'hh_car_brand',
  'table' => 
  array (
    'brand' => 
    array (
      'sort' => '100',
      'show_name' => 'Brand',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'brand_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Brand ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'brand_logo' => 
    array (
      'sort' => '100',
      'show_name' => 'Brand Logo',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'id' => 
    array (
      'sort' => '100',
      'show_name' => 'ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'initial' => 
    array (
      'sort' => '100',
      'show_name' => 'Initial',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
