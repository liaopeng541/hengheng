<?php
/**
* Created by 廖鹏
* Date: 2018年05月18日 10:37*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhWorker;
use common\models\HhStore;
use common\models\LpJob;
use common\models\HhBranch;

class HhWorkerController extends AdminController
{

    /**
    * HhWorker 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhWorker::find();
            //筛选条件
            if (isset($_GET['status']) && ($_GET['status'] || $_GET['status']==="0")) {
                  $model->andWhere(['status'=>$_GET['status']]);
            }
            if (isset($_GET['job_id']) && ($_GET['job_id'] || $_GET['job_id']==="0")) {
                  $model->andWhere(['job_id'=>$_GET['job_id']]);
            }
            if (isset($_GET['worker_status']) && ($_GET['worker_status'] || $_GET['worker_status']==="0")) {
                  $model->andWhere(['worker_status'=>$_GET['worker_status']]);
            }
            if (isset($_GET['branch_id']) && ($_GET['branch_id'] || $_GET['branch_id']==="0")) {
                  $model->andWhere(['branch_id'=>$_GET['branch_id']]);
            }
            if (isset($_GET['real_name']) && $_GET['real_name']) {
                  $model->andWhere(['like', 'real_name', $_GET['real_name']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("hh_store_id");
             $hh_store_id=HhStore::find()->asArray()->all();
             $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
             $model=$model->with("lp_job_id");
             $lp_job_id=LpJob::find()->asArray()->all();
             $page_data["lp_job_id"]=\yii\helpers\ArrayHelper::map($lp_job_id,"id","name");
             $model=$model->with("hh_branch_id");
             $hh_branch_id=HhBranch::find()->asArray()->all();
             $page_data["hh_branch_id"]=\yii\helpers\ArrayHelper::map($hh_branch_id,"id","name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                          $data[$key]['sex_lp'] = HhWorker::getsextext($v["sex"]);
                      $data[$key]['store_id_lp'] = $v["hh_store_id"]["name"];
                      $data[$key]['status_lp'] = HhWorker::getstatustext($v["status"]);
                      $data[$key]['job_id_lp'] = $v["lp_job_id"]["name"];
                      $data[$key]['worker_status_lp'] = HhWorker::getworker_statustext($v["worker_status"]);
                      $data[$key]['branch_id_lp'] = $v["hh_branch_id"]["name"];
             $v['entry_time'] and $data[$key]['entry_time'] = date("Y-m-d H:i:s", $v['entry_time']);
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $hh_store_id=HhStore::find()->asArray()->all();
        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");$lp_job_id=LpJob::find()->asArray()->all();
        $page_data["lp_job_id"]=\yii\helpers\ArrayHelper::map($lp_job_id,"id","name");$hh_branch_id=HhBranch::find()->asArray()->all();
        $page_data["hh_branch_id"]=\yii\helpers\ArrayHelper::map($hh_branch_id,"id","name");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * HhWorker 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhWorker();
            //数据转换
             $_POST['entry_time'] and $_POST['entry_time'] = strtotime($_POST['entry_time']);
            $data = ['HhWorker' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhWorker中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        $hh_store_id=HhStore::find()->asArray()->all();
                $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");$lp_job_id=LpJob::find()->asArray()->all();
                $page_data["lp_job_id"]=\yii\helpers\ArrayHelper::map($lp_job_id,"id","name");$hh_branch_id=HhBranch::find()->asArray()->all();
                $page_data["hh_branch_id"]=\yii\helpers\ArrayHelper::map($hh_branch_id,"id","name");
        return $this->render('form',$page_data);

    }

    /**
    * HhWorker 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhWorker::findOne($_POST['id']);
            //数据转换
            $_POST['header_pic'] = (isset($_POST['header_pic'])&&$_POST['header_pic']) ? $_POST['header_pic']:null;
         $_POST['entry_time'] and $_POST['entry_time'] = strtotime($_POST['entry_time']);
            $data = ['HhWorker' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $hh_store_id=HhStore::find()->asArray()->all();
                        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");$lp_job_id=LpJob::find()->asArray()->all();
                        $page_data["lp_job_id"]=\yii\helpers\ArrayHelper::map($lp_job_id,"id","name");$hh_branch_id=HhBranch::find()->asArray()->all();
                        $page_data["hh_branch_id"]=\yii\helpers\ArrayHelper::map($hh_branch_id,"id","name");
        return $this->render('form',$page_data);
    }

    /**
    * HhWorker 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhWorker::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhWorker中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhWorker 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhWorker::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhWorker::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhWorker表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhWorker 详情页
    */
    public function actionDetail($id)
    {
        $model=HhWorker::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("hh_store_id");
             $model=$model->with("lp_job_id");
             $model=$model->with("hh_branch_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['sex_lp'] = HhWorker::getsextext($data["sex"]);
                      $data['store_id_lp'] = $data["hh_store_id"]["name"];
                      $data['status_lp'] = HhWorker::getstatustext($data["status"]);
                      $data['job_id_lp'] = $data["lp_job_id"]["name"];
                      $data['worker_status_lp'] = HhWorker::getworker_statustext($data["worker_status"]);
                      $data['branch_id_lp'] = $data["hh_branch_id"]["name"];
             $data['entry_time'] and $data['entry_time'] = date("Y-m-d H:i:s", $data['entry_time']);

        }
        return $this->render('detail',['data'=>$data]);
    }
}
