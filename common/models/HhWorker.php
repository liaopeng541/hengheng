<?php

namespace common\models;
use common\models\HhStore;
use common\models\LpJob;
use common\models\HhBranch;
use Yii;

/**
 * This is the model class for table "{{%hh_worker}}".
 *
 * @property int $id
 * @property string $sn
 * @property string $real_name
 * @property int $entry_time
 * @property string $header_pic 岗位
 * @property string $mobile
 * @property int $store_id 所属门店
 * @property string $password
 * @property string $password1
 * @property string $sex
 * @property int $branch_id 部门id
 * @property string $branch_name 部门名称
 * @property int $job_id
 * @property string $job_name
 * @property string $desc
 * @property int $status 0为在职，1为离职
 * @property int $worker_status 工作人员状态 0为空闲，1为忙碌
 * @property int $worker_order 当前工作订单
 * @property int $worker_service 当前服务项目
 * @property int $worker_process 当前服务工序
 * @property int $is_good
 * @property int $comment_num 评论次数
 * @property double $comment_score 评分
 * @property int $tips_num 打赏次数
 * @property string $tips_money 打赏总额
 * @property int $up_num 点赞扬
 */
class HhWorker extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_worker}}';
    }
    public function rules()
    {
        return [
            [['entry_time', 'store_id', 'branch_id', 'job_id', 'worker_order', 'worker_service', 'worker_process', 'comment_num', 'tips_num', 'up_num'], 'integer'],
            [['desc'], 'string'],
            [['comment_score', 'tips_money'], 'number'],
            [['sn', 'real_name', 'header_pic', 'mobile', 'password', 'password1', 'sex', 'branch_name', 'job_name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 11],
            [['worker_status', 'is_good'], 'string', 'max' => 4],
        ];
    }
    public function attributeLabels()
    {
        return [
            'is_good' => 'Is Good',
            'job_name' => 'Job Name',
            'password1' => 'Password1',
            'sn' => 'Sn',
            'password' => '密码',
            'worker_order' => '当前工作订单',
            'worker_process' => '当前服务工序',
            'worker_service' => '当前服务项目',
            'tips_money' => '打赏总额',
            'tips_num' => '打赏次数',
            'up_num' => '点赞扬',
            'comment_score' => '评分',
            'comment_num' => '评论次数',
            'branch_name' => '部门名称',
            'sex' => '性别',
            'store_id' => '所属门店',
            'mobile' => '手机号',
            'header_pic' => '照片',
            'desc' => '简介',
            'id' => 'ID',
            'status' => '人员流动',
            'job_id' => '岗位',
            'worker_status' => '工作状态',
            'branch_id' => '部门',
            'entry_time' => '入职时间',
            'real_name' => '名字',
        ];
    }

      public static function getsextext($index){
              $text=[
                  "0"=>"男",
                  "1"=>"女",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public function getHh_store_id(){
          return $this->hasOne(HhStore::className(),["id"=>"store_id"]);
      }
      public static function getstatustext($index){
              $text=[
                  "0"=>"在职",
                  "1"=>"离职",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public function getLp_job_id(){
          return $this->hasOne(LpJob::className(),["id"=>"job_id"]);
      }
      public static function getworker_statustext($index){
              $text=[
                  "0"=>"空闲",
                  "1"=>"忙碌",
              ];
              return isset($text[strval($index)])?$text[strval($index)]:"";
      }
      public function getHh_branch_id(){
          return $this->hasOne(HhBranch::className(),["id"=>"branch_id"]);
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
  'table_name' => 'hh_worker',
  'table' => 
  array (
    'is_good' => 
    array (
      'sort' => '100',
      'show_name' => 'Is Good',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'job_name' => 
    array (
      'sort' => '100',
      'show_name' => 'Job Name',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'password1' => 
    array (
      'sort' => '100',
      'show_name' => 'Password1',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sn' => 
    array (
      'sort' => '100',
      'show_name' => 'Sn',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'password' => 
    array (
      'sort' => '100',
      'show_name' => '密码',
      'show_mode' => '不展示',
      'add_mode' => '密码框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'worker_order' => 
    array (
      'sort' => '100',
      'show_name' => '当前工作订单',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'worker_process' => 
    array (
      'sort' => '100',
      'show_name' => '当前服务工序',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'worker_service' => 
    array (
      'sort' => '100',
      'show_name' => '当前服务项目',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'tips_money' => 
    array (
      'sort' => '100',
      'show_name' => '打赏总额',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'tips_num' => 
    array (
      'sort' => '100',
      'show_name' => '打赏次数',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'up_num' => 
    array (
      'sort' => '100',
      'show_name' => '点赞扬',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'comment_score' => 
    array (
      'sort' => '100',
      'show_name' => '评分',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'comment_num' => 
    array (
      'sort' => '100',
      'show_name' => '评论次数',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'branch_name' => 
    array (
      'sort' => '100',
      'show_name' => '部门名称',
      'show_mode' => '不展示',
      'add_mode' => '不新增',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'sex' => 
    array (
      'sort' => '100',
      'show_name' => '性别',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '下拉选择',
      'search_mode' => '不搜索',
      'f_key' => 'txt:0=男,1=女',
    ),
    'store_id' => 
    array (
      'sort' => '100',
      'show_name' => '所属门店',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '下拉选择',
      'search_mode' => '不搜索',
      'f_key' => 'key:hh_store:id>store_id:id>name:一对一',
    ),
    'mobile' => 
    array (
      'sort' => '100',
      'show_name' => '手机号',
      'show_mode' => '文本',
      'detail' => '1',
      'add_mode' => '文本框',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'header_pic' => 
    array (
      'sort' => '100',
      'show_name' => '照片',
      'show_mode' => '图片',
      'detail' => '1',
      'add_mode' => '图片',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'desc' => 
    array (
      'sort' => '100',
      'show_name' => '简介',
      'show_mode' => '不展示',
      'mini_table' => '1',
      'add_mode' => '文本域',
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
    'status' => 
    array (
      'sort' => '100',
      'show_name' => '人员流动',
      'show_mode' => '关联文本',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=在职,1=离职',
    ),
    'job_id' => 
    array (
      'sort' => '100',
      'show_name' => '岗位',
      'show_mode' => '关联文本',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:lp_job:id>job_id:id>name:一对一',
    ),
    'worker_status' => 
    array (
      'sort' => '100',
      'show_name' => '工作状态',
      'show_mode' => '关联文本',
      'mini_table' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'txt:0=空闲,1=忙碌',
    ),
    'branch_id' => 
    array (
      'sort' => '100',
      'show_name' => '部门',
      'show_mode' => '关联文本',
      'detail' => '1',
      'add_mode' => '下拉选择',
      'mini_search_mode' => '1',
      'search_mode' => '下拉选择',
      'f_key' => 'key:hh_branch:id>branch_id:id>name:一对一',
    ),
    'entry_time' => 
    array (
      'sort' => '100',
      'show_name' => '入职时间',
      'order' => '1',
      'show_mode' => '日期时间',
      'detail' => '1',
      'mini_table' => '1',
      'add_mode' => '日期时间',
      'search_mode' => '不搜索',
      'f_key' => '',
    ),
    'real_name' => 
    array (
      'sort' => '100',
      'show_name' => '名字',
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
