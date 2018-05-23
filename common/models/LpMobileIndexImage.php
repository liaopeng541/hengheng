<?php

namespace common\models;
use common\models\LpGoods;
use Yii;

/**
 * This is the model class for table "{{%lp_mobile_index_image}}".
 *
 * @property int $id
 * @property string $image
 * @property int $order
 * @property int $type 点击类型 0为转入商品 1为转入h5,2为转入会员
 * @property int $goods_id
 * @property string $url
 * @property int $level_id
 */
class LpMobileIndexImage extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_mobile_index_image}}';
    }
    public function rules()
    {
        return [
            [['order', 'type', 'goods_id', 'level_id'], 'integer'],
            [['image'], 'string', 'max' => 256],
            [['url'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'level_id' => 'Level ID',
            'goods_id' => 'Goods ID',
            'image' => '图片',
            'url' => '链接',
            'id' => 'ID',
            'type' => '事件',
            'order' => '排序',
        ];
    }

      public function getLp_goods_goods_id(){
          return $this->hasOne(LpGoods::className(),["goods_id"=>"goods_id"]);
      }
      public static function gettypetext($index){
              $text=[
                  "0"=>"商品",
                  "1"=>"链接",
                  "2"=>"会员",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
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
  ),
  'table_name' => 'lp_mobile_index_image',
  'table' => 
  array (
    'level_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Level ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'goods_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Goods ID',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '下拉选择',
      'search_mode' => '不搜索',
      'f_key' => 'key:lp_goods:goods_id>goods_id:goods_id>goods_name:一对一',
    ),
    'image' => 
    array (
      'sort' => '100',
      'show_name' => '图片',
      'show_mode' => '图片',
      'detail' => '1',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'url' => 
    array (
      'sort' => '100',
      'show_name' => '链接',
      'show_mode' => '文本',
      'detail' => '1',
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
    'type' => 
    array (
      'sort' => '100',
      'show_name' => '事件',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=商品,1=链接,2=会员',
    ),
    'order' => 
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
  ),
);
    }

}
