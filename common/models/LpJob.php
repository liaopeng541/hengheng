<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_job}}".
 *
 * @property int $id
 * @property int $f_id 上级
 * @property string $name 职务名称
 * @property string $desc 职务说明
 */
class LpJob extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_job}}';
    }
    public function rules()
    {
        return [
            [['f_id'], 'integer'],
            [['name', 'desc'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'f_id' => '上级',
            'desc' => '职务说明',
            'id' => 'ID',
            'name' => '职务名称',
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
  'table_name' => 'lp_job',
  'table' => 
  array (
    'f_id' => 
    array (
      'sort' => '100',
      'show_name' => '上级',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '职务说明',
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
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '职务名称',
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
