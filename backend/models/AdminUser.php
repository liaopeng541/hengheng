<?php

namespace backend\models;
use backend\models\AdminAuthItem;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%admin_user}}".
 *
 * @property int $admin_id 管理员ID
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
class AdminUser extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return '{{%admin_user}}';
    }
    public function rules()
    {
        return [
            [['admin_name'], 'required'],
            [['admin_login_time','admin_is_super','admin_login_num', 'admin_gid', 'status', 'reg_time', 'mobile', 'role_id'], 'integer'],
            [['admin_name'], 'string', 'max' => 20],
            [['admin_avatar', 'admin_password'], 'string', 'max' => 100],
            [['admin_quick_link', 'auth_key'], 'string', 'max' => 400],
            [['reg_ip', 'last_login_ip'], 'string', 'max' => 60],
            [['real_name', 'role_name', 'email'], 'string', 'max' => 255],
        ];
    }
    public function beforeSave($insert) {

        if($this->isNewRecord) {
            $this->generateAuthKey();
            $this->reg_ip = ip2long(Yii::$app->getRequest()->getUserIP());
            $this->admin_login_time = 0;
            $this->last_login_ip = '0';
            $this->admin_login_num=0;
            $this->reg_time=time();
            $this->status=1;
        }else{
            $this->admin_login_time = time();
            $this->last_login_ip = ip2long(Yii::$app->getRequest()->getUserIP());
            $this->admin_login_num++;
        }
        if(!empty($this->password)) $this->setPassword($this->password);
        return parent::beforeSave($insert);
    }
    public static function findIdentity($id)
    {
        return static::findOne(['admin_id' => $id,'status'=>self::STATUS_ACTIVE]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    public static function findByUsername($username)
    {
        return static::findOne(['admin_name' => $username]);
    }
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->admin_password);
    }
    public function setPassword($password)
    {
        $this->admin_password = Yii::$app->security->generatePasswordHash($password,10);
    }
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function attributeLabels()
    {
        return [
            'admin_id' => 'ID',
            'admin_name' => '用户名',
            'admin_avatar' => '头像',
            'admin_password' => '管理员密码',
            'admin_login_time' => '登录时间',
            'admin_login_num' => '登录次数',
            'admin_is_super' => '超级管理员',
            'admin_gid' => '权限组ID',
            'admin_quick_link' => '管理员常用操作',
            'status' => '状态',
            'auth_key' => 'Auth Key',
            'reg_ip' => 'Reg Ip',
            'last_login_ip' => 'Last Login Ip',
            'reg_time' => 'Reg Time',
            'real_name' => 'Real Name',
            'mobile' => '手机',
            'role_id' => 'Role ID',
            'role_name' => '角色',
            'email' => 'Email',
        ];
    }

      public function getAdmin_auth_item_name(){
          return $this->hasOne(AdminAuthItem::className(),["name"=>"role_name"]);
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
    'edt_btn' => 'on',
    'del_btn' => 'on',
  ),
  'table_name' => 'admin_user',
  'table' => 
  array (
    'admin_id' => 
    array (
      'sort' => '1',
      'show_name' => 'ID',
      'show_mode' => '文本',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_name' => 
    array (
      'sort' => '2',
      'show_name' => '用户名',
      'show_mode' => '文本',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_avatar' => 
    array (
      'sort' => '3',
      'show_name' => '头像',
      'show_mode' => '图片',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_password' => 
    array (
      'sort' => '4',
      'show_name' => '管理员密码',
      'show_mode' => '不展示',
      'add_mode' => '密码框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_login_time' => 
    array (
      'sort' => '5',
      'show_name' => '登录时间',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_login_num' => 
    array (
      'sort' => '6',
      'show_name' => '登录次数',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_is_super' => 
    array (
      'sort' => '7',
      'show_name' => '超级管理员',
      'show_mode' => '开关',
      'add_mode' => '开关',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_gid' => 
    array (
      'sort' => '8',
      'show_name' => '权限组ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'admin_quick_link' => 
    array (
      'sort' => '9',
      'show_name' => '管理员常用操作',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'status' => 
    array (
      'sort' => '10',
      'show_name' => '状态',
      'show_mode' => '开关',
      'add_mode' => '开关',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'auth_key' => 
    array (
      'sort' => '11',
      'show_name' => 'Auth Key',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'reg_ip' => 
    array (
      'sort' => '12',
      'show_name' => 'Reg Ip',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'last_login_ip' => 
    array (
      'sort' => '13',
      'show_name' => 'Last Login Ip',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'reg_time' => 
    array (
      'sort' => '14',
      'show_name' => 'Reg Time',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'real_name' => 
    array (
      'sort' => '15',
      'show_name' => 'Real Name',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'mobile' => 
    array (
      'sort' => '16',
      'show_name' => '手机',
      'show_mode' => '文本',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'role_id' => 
    array (
      'sort' => '17',
      'show_name' => 'Role ID',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'role_name' => 
    array (
      'sort' => '18',
      'show_name' => '角色',
      'show_mode' => '文本',
      'add_mode' => '下拉选择',
      'search_mode' => '下拉选择',
      'f_key' => 'key:admin_auth_item:name>role_name:name>name:一对一',
    ),
    'email' => 
    array (
      'sort' => '19',
      'show_name' => 'Email',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
  ),
);
    }

}
