<?php

namespace common\models;
use common\models\AdminUser;
use Yii;

/**
 * This is the model class for table "{{%admin_log}}".
 *
 * @property int $id
 * @property string $route
 * @property string $description
 * @property int $created_at
 * @property int $user_id
 */
class AdminLog extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_log}}';
    }
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['created_at'], 'required'],
            [['created_at', 'user_id'], 'integer'],
            [['route'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'route' => '请求路由',
            'id' => 'ID',
            'description' => '描述',
            'created_at' => '操作日期',
            'user_id' => '用户名',
        ];
    }

      public function getAdmin_user_admin_id(){
          return $this->hasOne(AdminUser::className(),["admin_id"=>"user_id"]);
      }

    public function giishow()
    {
        return array (
  'column_btn' => 
  array (
    'detail_btn' => 'on',
  ),
  'table_name' => 'admin_log',
  'table' => 
  array (
    'route' => 
    array (
      'sort' => '100',
      'show_name' => '请求路由',
      'show_mode' => '不展示',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
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
    'description' => 
    array (
      'sort' => '100',
      'show_name' => '描述',
      'show_mode' => '文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '文本框',
      'f_key' => '',
    ),
    'created_at' => 
    array (
      'sort' => '100',
      'show_name' => '操作日期',
      'show_mode' => '日期时间',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '日期',
      'f_key' => '',
    ),
    'user_id' => 
    array (
      'sort' => '100',
      'show_name' => '用户名',
      'order' => '1',
      'show_mode' => '关联文本',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '不新增',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:admin_user:admin_id>user_id:admin_id>admin_name:一对一',
    ),
  ),
);
    }

}
