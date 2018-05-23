<?php
/**
* Created by 廖鹏
* Date: 2018年05月12日 04:14*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\AdminLog;
use common\models\AdminUser;

class AdminLogController extends AdminController
{

    /**
    * AdminLog 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = AdminLog::find();
            //筛选条件
            if (isset($_GET['description']) && $_GET['description']) {
                  $model->andWhere(['like', 'description', $_GET['description']]);
            }
            if (isset($_GET['created_at']) && $_GET['created_at']) {
                  $search_start_time=strtotime($_GET['created_at']);
                  $searchend_time=$search_start_time+(24*60*60);
                  $model->andWhere(['between', 'created_at', $search_start_time,$searchend_time]);
            }
            if (isset($_GET['user_id']) && ($_GET['user_id'] || $_GET['user_id']==="0")) {
                  $model->andWhere(['user_id'=>$_GET['user_id']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("admin_user_admin_id");
             $admin_user_admin_id=AdminUser::find()->asArray()->all();
             $page_data["admin_user_admin_id"]=\yii\helpers\ArrayHelper::map($admin_user_admin_id,"admin_id","admin_name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                 $v['created_at'] and $data[$key]['created_at'] = date("Y-m-d H:i:s", $v['created_at']);
                      $data[$key]['user_id_lp'] = $v["admin_user_admin_id"]["admin_name"];
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $admin_user_admin_id=AdminUser::find()->asArray()->all();
        $page_data["admin_user_admin_id"]=\yii\helpers\ArrayHelper::map($admin_user_admin_id,"admin_id","admin_name");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * AdminLog 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new AdminLog();
            //数据转换
                $data = ['AdminLog' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了AdminLog中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        $admin_user_admin_id=AdminUser::find()->asArray()->all();
                $page_data["admin_user_admin_id"]=\yii\helpers\ArrayHelper::map($admin_user_admin_id,"admin_id","admin_name");
        return $this->render('form',$page_data);

    }

    /**
    * AdminLog 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = AdminLog::findOne($_POST['id']);
            //数据转换
                $data = ['AdminLog' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $admin_user_admin_id=AdminUser::find()->asArray()->all();
                        $page_data["admin_user_admin_id"]=\yii\helpers\ArrayHelper::map($admin_user_admin_id,"admin_id","admin_name");
        return $this->render('form',$page_data);
    }

    /**
    * AdminLog 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(AdminLog::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了AdminLog中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * AdminLog 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        AdminLog::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=AdminLog::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置AdminLog表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * AdminLog 详情页
    */
    public function actionDetail($id)
    {
        $model=AdminLog::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("admin_user_admin_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                             $data['created_at'] and $data['created_at'] = date("Y-m-d H:i:s", $data['created_at']);
                      $data['user_id_lp'] = $data["admin_user_admin_id"]["admin_name"];

        }
        return $this->render('detail',['data'=>$data]);
    }
}
