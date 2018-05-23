<?php

namespace common\models;
use common\models\LpGoodsType;
use Yii;

/**
 * This is the model class for table "{{%lp_spec}}".
 *
 * @property int $id 规格表
 * @property int $type_id 规格类型
 * @property string $name 规格名称
 * @property int $order 排序
 * @property int $search_index 是否需要检索：1是，0否
 */
class LpSpec extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_spec}}';
    }
    public function rules()
    {
        return [
            [['type_id', 'order'], 'integer'],
            [['name'], 'string', 'max' => 55],
        ];
    }
    public function attributeLabels()
    {
        return [
            'search_index' => '是否需要检索：1是，0否',
            'name' => '规格名称',
            'order' => '排序',
            'id' => '规格表',
            'type_id' => '规格类型',
        ];
    }

      public function getLp_goods_type_id(){
          return $this->hasOne(LpGoodsType::className(),["id"=>"type_id"]);
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
  'table_name' => 'lp_spec',
  'table' => 
  array (
    'search_index' => 
    array (
      'sort' => '100',
      'show_name' => '是否需要检索：1是，0否',
      'show_mode' => '不展示',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '规格名称',
      'show_mode' => '文本',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'order' => 
    array (
      'sort' => '100',
      'show_name' => '排序',
      'order' => '1',
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
      'show_name' => '规格表',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'type_id' => 
    array (
      'sort' => '100',
      'show_name' => '规格类型',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => 'key:lp_goods_type:id>type_id:id>name:一对一',
    ),
  ),
);
    }

}
