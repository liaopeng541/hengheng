<?php

namespace common\models;
use common\models\LpGoodsCategory;
use Yii;

/**
 * This is the model class for table "{{%lp_brand}}".
 *
 * @property int $id 品牌表
 * @property string $name 品牌名称
 * @property string $logo 品牌logo
 * @property string $desc 品牌描述
 * @property string $url 品牌地址
 * @property int $sort 排序
 * @property string $cat_name 品牌分类
 * @property int $parent_cat_id 分类id
 * @property int $cat_id 分类id
 * @property int $is_hot 是否推荐
 */
class LpBrand extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_brand}}';
    }
    public function rules()
    {
        return [
            [['desc'], 'required'],
            [['desc'], 'string'],
            [['parent_cat_id', 'cat_id'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['logo'], 'string', 'max' => 256],
            [['url'], 'string', 'max' => 255],
            [['sort'], 'string', 'max' => 3],
            [['cat_name'], 'string', 'max' => 128],
            [['is_hot'], 'string', 'max' => 1],
        ];
    }
    public function attributeLabels()
    {
        return [
            'parent_cat_id' => '分类id',
            'cat_name' => '品牌分类',
            'url' => '品牌地址',
            'logo' => '品牌logo',
            'desc' => '品牌描述',
            'is_hot' => '是否推荐',
            'id' => '品牌ID',
            'name' => '品牌名称',
            'sort' => '排序',
            'cat_id' => '分类id',
        ];
    }

      public function getLp_goods_category_id(){
          return $this->hasOne(LpGoodsCategory::className(),["id"=>"cat_id"]);
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
  'table_name' => 'lp_brand',
  'table' => 
  array (
    'parent_cat_id' => 
    array (
      'sort' => '100',
      'show_name' => '分类id',
      'show_mode' => '不展示',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'cat_name' => 
    array (
      'sort' => '100',
      'show_name' => '品牌分类',
      'show_mode' => '不展示',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'url' => 
    array (
      'sort' => '100',
      'show_name' => '品牌地址',
      'show_mode' => '不展示',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'logo' => 
    array (
      'sort' => '100',
      'show_name' => '品牌logo',
      'show_mode' => '图片',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '品牌描述',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'is_hot' => 
    array (
      'sort' => '100',
      'show_name' => '是否推荐',
      'show_mode' => '开关',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '开关',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'id' => 
    array (
      'sort' => '100',
      'show_name' => '品牌ID',
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
      'show_name' => '品牌名称',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '文本框',
      'mini_search_mode' => '1',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sort' => 
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
    'cat_id' => 
    array (
      'sort' => '100',
      'show_name' => '分类id',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '不搜索',
      'f_key' => 'key:lp_goods_category:id>cat_id:id>name:一对一',
    ),
  ),
);
    }

}
