<?php
/**
* Created by 廖鹏
* Date: 2018年05月16日 12:00*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhOtoOrderService;
use common\models\HhWorker;
use common\models\HhWorkStation;
use common\models\HhStore;
use common\models\HhService;

class HhOtoOrderServiceController extends AdminController
{

    /**
    * HhOtoOrderService 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhOtoOrderService::find();
            //筛选条件
            if (isset($_GET['store_id']) && ($_GET['store_id'] || $_GET['store_id']==="0")) {
                  $model->andWhere(['store_id'=>$_GET['store_id']]);
            }
            if (isset($_GET['start_time']) && $_GET['start_time']) {
                  $model->andWhere(['start_time'=>$_GET['start_time']]);
            }
            if (isset($_GET['service_id']) && ($_GET['service_id'] || $_GET['service_id']==="0")) {
                  $model->andWhere(['service_id'=>$_GET['service_id']]);
            }
            if (isset($_GET['over_time']) && $_GET['over_time']) {
                  $model->andWhere(['over_time'=>$_GET['over_time']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("hh_worker_id");
             $model=$model->with("hh_work_station_id");
             $model=$model->with("hh_store_id");
             $hh_store_id=HhStore::find()->asArray()->all();
             $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
             $model=$model->with("hh_service_id");
             $hh_service_id=HhService::find()->asArray()->all();
             $page_data["hh_service_id"]=\yii\helpers\ArrayHelper::map($hh_service_id,"id","name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                          $data[$key]['worker_id_lp'] = $v["hh_worker_id"]["real_name"];
                      $data[$key]['station_id_lp'] = $v["hh_work_station_id"]["name"];
                      $data[$key]['status_lp'] = HhOtoOrderService::getstatustext($v["status"]);
                      $data[$key]['store_id_lp'] = $v["hh_store_id"]["name"];
             $v['start_time'] and $data[$key]['start_time'] = date("Y-m-d H:i:s", $v['start_time']);
                      $data[$key]['service_id_lp'] = $v["hh_service_id"]["name"];
             $v['over_time'] and $data[$key]['over_time'] = date("Y-m-d H:i:s", $v['over_time']);
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
        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");$hh_service_id=HhService::find()->asArray()->all();
        $page_data["hh_service_id"]=\yii\helpers\ArrayHelper::map($hh_service_id,"id","name");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * HhOtoOrderService 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhOtoOrderService();
            //数据转换
                $data = ['HhOtoOrderService' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhOtoOrderService中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        $hh_store_id=HhStore::find()->asArray()->all();
                $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");$hh_service_id=HhService::find()->asArray()->all();
                $page_data["hh_service_id"]=\yii\helpers\ArrayHelper::map($hh_service_id,"id","name");
        return $this->render('form',$page_data);

    }

    /**
    * HhOtoOrderService 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhOtoOrderService::findOne($_POST['id']);
            //数据转换
                $data = ['HhOtoOrderService' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $hh_store_id=HhStore::find()->asArray()->all();
                        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");$hh_service_id=HhService::find()->asArray()->all();
                        $page_data["hh_service_id"]=\yii\helpers\ArrayHelper::map($hh_service_id,"id","name");
        return $this->render('form',$page_data);
    }

    /**
    * HhOtoOrderService 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhOtoOrderService::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhOtoOrderService中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhOtoOrderService 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhOtoOrderService::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhOtoOrderService::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhOtoOrderService表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhOtoOrderService 详情页
    */
    public function actionDetail($id)
    {
        $model=HhOtoOrderService::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("hh_worker_id");
             $model=$model->with("hh_work_station_id");
             $model=$model->with("hh_store_id");
             $model=$model->with("hh_service_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['worker_id_lp'] = $data["hh_worker_id"]["real_name"];
                      $data['station_id_lp'] = $data["hh_work_station_id"]["name"];
                      $data['status_lp'] = HhOtoOrderService::getstatustext($data["status"]);
                      $data['store_id_lp'] = $data["hh_store_id"]["name"];
             $data['start_time'] and $data['start_time'] = date("Y-m-d H:i:s", $data['start_time']);
                      $data['service_id_lp'] = $data["hh_service_id"]["name"];
             $data['over_time'] and $data['over_time'] = date("Y-m-d H:i:s", $data['over_time']);

        }
        return $this->render('detail',['data'=>$data]);
    }
}
