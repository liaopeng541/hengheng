<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_camera_dot}}".
 *
 * @property int $id
 * @property string $name
 */
class HhCameraDot extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_camera_dot}}';
    }
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }


    public function giishow()
    {
        return array (
  'table_name' => 'hh_camera_dot',
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
    'name' => 
    array (
      'sort' => '100',
      'show_name' => 'Name',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
