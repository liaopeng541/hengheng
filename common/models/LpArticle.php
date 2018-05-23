<?php

namespace common\models;
use common\models\LpArticleCat;
use Yii;
use yii\behaviors\AttributeBehavior;
/**
 * This is the model class for table "{{%lp_article}}".
 *
 * @property string $article_id 表id
 * @property int $cat_id 类别ID
 * @property string $title 文章标题
 * @property string $content 文章内容
 * @property string $author 文章作者
 * @property string $author_email 作者邮箱
 * @property string $keywords 关键字
 * @property int $article_type 文章类型
 * @property int $is_open 是否开启
 * @property string $add_time 添加时间
 * @property string $file_url 附件地址
 * @property int $open_type open_type
 * @property string $link 链接地址
 * @property string $description 文章摘要
 * @property int $click 浏览量
 * @property int $publish_time 文章发布时间
 * @property string $thumb 文章缩略图
 */
class LpArticle extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_article}}';
    }
    public function rules()
    {
        return [
            [['cat_id', 'add_time'], 'integer'],
            [['content'], 'required'],
            [['content', 'description'], 'string'],
            [['title'], 'string', 'max' => 150],
            [['thumb'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'add_time',
                ],
                'value' => function ($event) {
                    return time();
                },
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'open_type' => 'open_type',
            'author_email' => '作者邮箱',
            'keywords' => '关键字',
            'publish_time' => '发布时间',
            'author' => '文章作者',
            'article_type' => '文章类型',
            'is_open' => '是否开启',
            'click' => '浏览量',
            'add_time' => '添加时间',
            'link' => '链接地址',
            'file_url' => '附件地址',
            'content' => '文章内容',
            'description' => '文章摘要',
            'title' => '文章标题',
            'article_id' => 'ID',
            'thumb' => '文章缩略图',
            'cat_id' => '所属分类',
        ];
    }

      public function getLp_article_cat_id()
      {
          return $this->hasOne(LpArticleCat::className(),["id"=>"cat_id"]);
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
  'table_name' => 'lp_article',
  'table' => 
  array (
    'open_type' => 
    array (
      'sort' => '100',
      'show_name' => 'open_type',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'author_email' => 
    array (
      'sort' => '100',
      'show_name' => '作者邮箱',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'keywords' => 
    array (
      'sort' => '100',
      'show_name' => '关键字',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'publish_time' => 
    array (
      'sort' => '100',
      'show_name' => '发布时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'author' => 
    array (
      'sort' => '100',
      'show_name' => '文章作者',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'article_type' => 
    array (
      'sort' => '100',
      'show_name' => '文章类型',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'is_open' => 
    array (
      'sort' => '100',
      'show_name' => '是否开启',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'click' => 
    array (
      'sort' => '100',
      'show_name' => '浏览量',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'add_time' => 
    array (
      'sort' => '100',
      'show_name' => '添加时间',
      'show_mode' => '日期时间',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'link' => 
    array (
      'sort' => '100',
      'show_name' => '链接地址',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'file_url' => 
    array (
      'sort' => '100',
      'show_name' => '附件地址',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'content' => 
    array (
      'sort' => '100',
      'show_name' => '文章内容',
      'show_mode' => '不展示',
      'detail' => '1',
      'add_mode' => '富文本',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'description' => 
    array (
      'sort' => '100',
      'show_name' => '文章摘要',
      'show_mode' => '不展示',
      'mini_table' => '1',
      'add_mode' => '文本域',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'title' => 
    array (
      'sort' => '100',
      'show_name' => '文章标题',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'article_id' => 
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
    'thumb' => 
    array (
      'sort' => '100',
      'show_name' => '文章缩略图',
      'order' => '1',
      'show_mode' => '图片',
      'mini_table' => '1',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'cat_id' => 
    array (
      'sort' => '100',
      'show_name' => '所属分类',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '树型下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '树型下拉选择',
      'f_key' => 'key:lp_article_cat:id>cat_id:id>name:一对一',
    ),
  ),
);
    }

}
