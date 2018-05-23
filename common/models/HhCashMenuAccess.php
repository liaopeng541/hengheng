<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_cash_menu_access}}".
 *
 * @property int $id
 * @property int $worker_id
 * @property int $menu_id
 * @property string $menu_name
 */
class HhCashMenuAccess extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_cash_menu_access}}';
    }
    public function rules()
    {
        return [
            [['worker_id', 'menu_id'], 'integer'],
            [['menu_name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Menu ID',
            'menu_name' => 'Menu Name',
            'worker_id' => 'Worker ID',
        ];
    }


    public function giishow()
    {
        return array (
  'table_name' => 'hh_cash_menu_access',
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
    'menu_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Menu ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'menu_name' => 
    array (
      'sort' => '100',
      'show_name' => 'Menu Name',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'worker_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Worker ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
