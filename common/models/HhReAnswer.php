<?php

namespace common\models;
use common\models\HhReFeedback;
use Yii;

/**
 * This is the model class for table "{{%hh_re_answer}}".
 *
 * @property int $id
 * @property int $f_id
 * @property string $answer
 */
class HhReAnswer extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_re_answer}}';
    }
    public function rules()
    {
        return [
            [['f_id'], 'integer'],
            [['answer'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'f_id' => '所属问题',
            'answer' => '答案',
        ];
    }

      public function getHh_re_feedback_id(){
          return $this->hasOne(HhReFeedback::className(),["id"=>"f_id"]);
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
  'table_name' => 'hh_re_answer',
  'table' => 
  array (
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
    'f_id' => 
    array (
      'sort' => '100',
      'show_name' => '所属问题',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:hh_re_feedback:id>f_id:id>question:一对一',
    ),
    'answer' => 
    array (
      'sort' => '100',
      'show_name' => '答案',
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
