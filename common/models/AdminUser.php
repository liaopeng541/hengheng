<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%admin_user}}".
 *
 * @property string $admin_id 管理员ID
 * @property string $admin_name 管理员名称
 * @property string $admin_avatar 管理员头像
 * @property string $admin_password 管理员密码
 * @property int $admin_login_time 登录时间
 * @property int $admin_login_num 登录次数
 * @property int $admin_is_super 是否超级管理员
 * @property int $admin_gid 权限组ID
 * @property string $admin_quick_link 管理员常用操作
 * @property int $status
 * @property string $auth_key
 * @property string $reg_ip
 * @property string $last_login_ip
 * @property int $reg_time
 * @property string $real_name
 * @property int $mobile
 * @property int $role_id
 * @property string $role_name
 * @property string $email
 */
class AdminUser extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_user}}';
    }
    public function rules()
    {
        return [
            [['admin_name'], 'required'],
            [['admin_login_time', 'admin_login_num', 'admin_gid', 'status', 'reg_time', 'mobile', 'role_id'], 'integer'],
            [['admin_name'], 'string', 'max' => 20],
            [['admin_avatar', 'admin_password'], 'string', 'max' => 100],
            [['admin_is_super'], 'string', 'max' => 1],
            [['admin_quick_link', 'auth_key'], 'string', 'max' => 400],
            [['reg_ip', 'last_login_ip'], 'string', 'max' => 60],
            [['real_name', 'role_name', 'email'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'last_login_ip' => 'Last Login Ip',
            'mobile' => 'Mobile',
            'real_name' => 'Real Name',
            'reg_ip' => 'Reg Ip',
            'reg_time' => 'Reg Time',
            'role_id' => 'Role ID',
            'role_name' => 'Role Name',
            'status' => 'Status',
            'admin_is_super' => '是否超级管理员',
            'admin_gid' => '权限组ID',
            'admin_login_time' => '登录时间',
            'admin_login_num' => '登录次数',
            'admin_id' => '管理员ID',
            'admin_name' => '管理员名称',
            'admin_avatar' => '管理员头像',
            'admin_password' => '管理员密码',
            'admin_quick_link' => '管理员常用操作',
        ];
    }


    public function giishow()
    {
        return array (
  'table_name' => 'admin_user',
  'table' => 
  array (
    'auth_key' => 
    array (
      'sort' => '100',
      'show_name' => 'Auth Key',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'email' => 
    array (
      'sort' => '100',
      'show_name' => 'Email',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'last_login_ip' => 
    array (
      'sort' => '100',
      'show_name' => 'Last Login Ip',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'mobile' => 
    array (
      'sort' => '100',
      'show_name' => 'Mobile',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'real_name' => 
    array (
      'sort' => '100',
      'show_name' => 'Real Name',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'reg_ip' => 
    array (
      'sort' => '100',
      'show_name' => 'Reg Ip',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'reg_time' => 
    array (
      'sort' => '100',
      'show_name' => 'Reg Time',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'role_id' => 
    array (
      'sort' => '100',
      'show_name' => 'Role ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'role_name' => 
    array (
      'sort' => '100',
      'show_name' => 'Role Name',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'status' => 
    array (
      'sort' => '100',
      'show_name' => 'Status',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_is_super' => 
    array (
      'sort' => '100',
      'show_name' => '是否超级管理员',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_gid' => 
    array (
      'sort' => '100',
      'show_name' => '权限组ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_login_time' => 
    array (
      'sort' => '100',
      'show_name' => '登录时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_login_num' => 
    array (
      'sort' => '100',
      'show_name' => '登录次数',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_id' => 
    array (
      'sort' => '100',
      'show_name' => '管理员ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_name' => 
    array (
      'sort' => '100',
      'show_name' => '管理员名称',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_avatar' => 
    array (
      'sort' => '100',
      'show_name' => '管理员头像',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_password' => 
    array (
      'sort' => '100',
      'show_name' => '管理员密码',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_quick_link' => 
    array (
      'sort' => '100',
      'show_name' => '管理员常用操作',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
