<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_store_service}}".
 *
 * @property int $id
 * @property int $store_id
 * @property int $service_id
 * @property string $service_name
 */
class HhStoreService extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_store_service}}';
    }
    public function rules()
    {
        return [
            [['store_id', 'service_id'], 'integer'],
            [['service_name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'service_name' => 'Service Name',
            'store_id' => 'Store ID',
        ];
    }

    public static function getListByStoreId($storeId)
    {
        $storeService = static::find()
            ->where(['store_id' => $storeId])
            ->asArray()
            ->all();
        return $storeService;
    } 


    public function giishow()
    {
      return array (
        'table_name' => 'hh_store_service',
        'table' => 
        array (
          'id' => 
          array (
            'sort' => '100',
            'show_name' => 'ID',
            'show_mode' => '不展示',
            'add_mode' => '不新增',
            'search_mode' => '不搜索',
            'f_key' => '',
          ),
          'service_id' => 
          array (
            'sort' => '100',
            'show_name' => 'Service ID',
            'show_mode' => '不展示',
            'add_mode' => '不新增',
            'search_mode' => '不搜索',
            'f_key' => '',
          ),
          'service_name' => 
          array (
            'sort' => '100',
            'show_name' => 'Service Name',
            'show_mode' => '不展示',
            'add_mode' => '不新增',
            'search_mode' => '不搜索',
            'f_key' => '',
          ),
          'store_id' => 
          array (
            'sort' => '100',
            'show_name' => 'Store ID',
            'show_mode' => '不展示',
            'add_mode' => '不新增',
            'search_mode' => '不搜索',
            'f_key' => '',
          ),
        ),
      );
    }

}
