<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_spec_item}}".
 *
 * @property int $id 规格项id
 * @property int $spec_id 规格id
 * @property string $item 规格项
 */
class LpSpecItem extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_spec_item}}';
    }
    public function rules()
    {
        return [
            [['spec_id'], 'integer'],
            [['item'], 'string', 'max' => 54],
        ];
    }
    public function attributeLabels()
    {
        return [
            'spec_id' => '规格id',
            'item' => '规格项',
            'id' => '规格项id',
        ];
    }


    public function giishow()
    {
        return array (
  'table_name' => 'lp_spec_item',
  'table' => 
  array (
    'spec_id' => 
    array (
      'sort' => '100',
      'show_name' => '规格id',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'item' => 
    array (
      'sort' => '100',
      'show_name' => '规格项',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'id' => 
    array (
      'sort' => '100',
      'show_name' => '规格项id',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
