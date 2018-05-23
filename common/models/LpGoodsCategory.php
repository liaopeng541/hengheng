<?php

namespace common\models;
use common\models\LpGoodsCategory;
use Yii;

/**
 * This is the model class for table "{{%lp_goods_category}}".
 *
 * @property int $id 商品分类id
 * @property string $name 商品分类名称
 * @property string $mobile_name 手机端显示的商品分类名
 * @property int $parent_id 父id
 * @property string $parent_id_path 家族图谱
 * @property int $level 等级
 * @property int $sort_order 顺序排序
 * @property int $is_show 是否显示
 * @property string $image 分类图片
 * @property int $is_hot 是否推荐为热门分类
 * @property int $cat_group 分类分组默认0
 * @property int $commission_rate 分佣比例
 * @property int $pid
 */
class LpGoodsCategory extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_goods_category}}';
    }
    public function rules()
    {
        return [
            [['pid', 'sort_order', 'is_show'], 'integer'],
            [['name'], 'string', 'max' => 90],
        ];
    }
    public function attributeLabels()
    {
        return [
            'commission_rate' => '分佣比例',
            'cat_group' => '分类分组默认0',
            'image' => '分类图片',
            'parent_id_path' => '家族图谱',
            'mobile_name' => '手机端显示的商品分类名',
            'is_hot' => '是否推荐为热门分类',
            'parent_id' => '父分类',
            'level' => '等级',
            'sort_order' => '排序',
            'is_show' => '是否显示',
            'id' => '分类ID',
            'name' => '菜单名称',
            'pid' => '父分类',
        ];
    }

      public function getLp_goods_category_id(){
          return $this->hasOne(LpGoodsCategory::className(),["id"=>"pid"]);
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
  'table_name' => 'lp_goods_category',
  'table' => 
  array (
    'commission_rate' => 
    array (
      'sort' => '100',
      'show_name' => '分佣比例',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'cat_group' => 
    array (
      'sort' => '100',
      'show_name' => '分类分组默认0',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'image' => 
    array (
      'sort' => '100',
      'show_name' => '分类图片',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'parent_id_path' => 
    array (
      'sort' => '100',
      'show_name' => '家族图谱',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'mobile_name' => 
    array (
      'sort' => '100',
      'show_name' => '手机端显示的商品分类名',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'is_hot' => 
    array (
      'sort' => '100',
      'show_name' => '是否推荐为热门分类',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'parent_id' => 
    array (
      'sort' => '100',
      'show_name' => '父分类',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'level' => 
    array (
      'sort' => '100',
      'show_name' => '等级',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sort_order' => 
    array (
      'sort' => '100',
      'show_name' => '排序',
      'order' => '1',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'is_show' => 
    array (
      'sort' => '100',
      'show_name' => '是否显示',
      'order' => '1',
      'show_mode' => '开关',
      'detail' => '1',
      'add_mode' => '开关',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'id' => 
    array (
      'sort' => '100',
      'show_name' => '分类ID',
      'order' => '1',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '菜单名称',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'pid' => 
    array (
      'sort' => '100',
      'show_name' => '父分类',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '树型下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '树型下拉选择',
      'f_key' => 'key:lp_goods_category:id>pid:id>name:一对一',
    ),
  ),
);
    }

}
