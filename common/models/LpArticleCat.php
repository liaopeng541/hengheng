<?php

namespace common\models;
use common\models\LpArticleCat;
use Yii;

/**
 * This is the model class for table "{{%lp_article_cat}}".
 *
 * @property string $id 表id
 * @property string $name 类别名称
 * @property int $cat_type 系统分组
 * @property int $parent_id 夫级ID
 * @property int $show_in_nav 是否导航显示
 * @property int $sort_order 排序
 * @property string $cat_desc 分类描述
 * @property string $keywords 搜索关键词
 * @property string $cat_alias 别名
 * @property int $pid
 */
class LpArticleCat extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_article_cat}}';
    }
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }
    public function attributeLabels()
    {
        return [
            'cat_alias' => '别名',
            'parent_id' => '夫级ID',
            'keywords' => '搜索关键词',
            'show_in_nav' => '是否导航显示',
            'cat_type' => '系统分组',
            'cat_desc' => '分类描述',
            'id' => 'ID',
            'sort_order' => '排序',
            'name' => '类别名称',
            'pid' => 'Pid',
        ];
    }

      public function getLp_article_cat_id(){
          return $this->hasOne(LpArticleCat::className(),["id"=>"pid"]);
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
  'table_name' => 'lp_article_cat',
  'table' => 
  array (
    'cat_alias' => 
    array (
      'sort' => '100',
      'show_name' => '别名',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'parent_id' => 
    array (
      'sort' => '100',
      'show_name' => '夫级ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'keywords' => 
    array (
      'sort' => '100',
      'show_name' => '搜索关键词',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'show_in_nav' => 
    array (
      'sort' => '100',
      'show_name' => '是否导航显示',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'cat_type' => 
    array (
      'sort' => '100',
      'show_name' => '系统分组',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'cat_desc' => 
    array (
      'sort' => '100',
      'show_name' => '分类描述',
      'show_mode' => '文本',
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
      'mini_table' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'name' => 
    array (
      'sort' => '100',
      'show_name' => '类别名称',
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
      'show_name' => 'Pid',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '树型下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '树型下拉选择',
      'f_key' => 'key:lp_article_cat:id>pid:id>name:一对一',
    ),
  ),
);
    }

}
