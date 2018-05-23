<?php
/**
* Created by 廖鹏
* Date: 2018年05月18日 08:50*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhCamera;
use common\models\HhCameraDot;
use common\models\HhWorkStation;
use common\models\HhStore;

class HhCameraController extends AdminController
{

    /**
    * HhCamera 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhCamera::find();
            //筛选条件
            if (isset($_GET['sn']) && $_GET['sn']) {
                  $model->andWhere(['like', 'sn', $_GET['sn']]);
            }
            if (isset($_GET['station_id']) && ($_GET['station_id'] || $_GET['station_id']==="0")) {
                  $model->andWhere(['station_id'=>$_GET['station_id']]);
            }
            if (isset($_GET['store_id']) && ($_GET['store_id'] || $_GET['store_id']==="0")) {
                  $model->andWhere(['store_id'=>$_GET['store_id']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("hh_camera_dot_id");
             $hh_camera_dot_id=HhCameraDot::find()->asArray()->all();
             $page_data["hh_camera_dot_id"]=\yii\helpers\ArrayHelper::map($hh_camera_dot_id,"id","name");
             $model=$model->with("hh_work_station_id");
             $hh_work_station_id=HhWorkStation::find()->asArray()->all();
             $page_data["hh_work_station_id"]=\yii\helpers\ArrayHelper::map($hh_work_station_id,"id","name");
             $model=$model->with("hh_store_id");
             $hh_store_id=HhStore::find()->asArray()->all();
             $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                          $data[$key]['is_entrance_lp'] = $v["hh_camera_dot_id"]["name"];
                      $data[$key]['station_id_lp'] = $v["hh_work_station_id"]["name"];
                      $data[$key]['store_id_lp'] = $v["hh_store_id"]["name"];
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $hh_camera_dot_id=HhCameraDot::find()->asArray()->all();
        $page_data["hh_camera_dot_id"]=\yii\helpers\ArrayHelper::map($hh_camera_dot_id,"id","name");$hh_work_station_id=HhWorkStation::find()->asArray()->all();
        $page_data["hh_work_station_id"]=\yii\helpers\ArrayHelper::map($hh_work_station_id,"id","name");$hh_store_id=HhStore::find()->asArray()->all();
        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * HhCamera 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhCamera();
            //数据转换
                $data = ['HhCamera' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhCamera中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        $hh_camera_dot_id=HhCameraDot::find()->asArray()->all();
                $page_data["hh_camera_dot_id"]=\yii\helpers\ArrayHelper::map($hh_camera_dot_id,"id","name");$hh_work_station_id=HhWorkStation::find()->asArray()->all();
                $page_data["hh_work_station_id"]=\yii\helpers\ArrayHelper::map($hh_work_station_id,"id","name");$hh_store_id=HhStore::find()->asArray()->all();
                $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
        return $this->render('form',$page_data);

    }

    /**
    * HhCamera 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhCamera::findOne($_POST['id']);
            //数据转换
                $data = ['HhCamera' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $hh_camera_dot_id=HhCameraDot::find()->asArray()->all();
                        $page_data["hh_camera_dot_id"]=\yii\helpers\ArrayHelper::map($hh_camera_dot_id,"id","name");$hh_work_station_id=HhWorkStation::find()->asArray()->all();
                        $page_data["hh_work_station_id"]=\yii\helpers\ArrayHelper::map($hh_work_station_id,"id","name");$hh_store_id=HhStore::find()->asArray()->all();
                        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
        return $this->render('form',$page_data);
    }

    /**
    * HhCamera 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhCamera::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhCamera中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhCamera 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhCamera::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhCamera::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhCamera表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhCamera 详情页
    */
    public function actionDetail($id)
    {
        $model=HhCamera::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("hh_camera_dot_id");
             $model=$model->with("hh_work_station_id");
             $model=$model->with("hh_store_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['is_entrance_lp'] = $data["hh_camera_dot_id"]["name"];
                      $data['station_id_lp'] = $data["hh_work_station_id"]["name"];
                      $data['store_id_lp'] = $data["hh_store_id"]["name"];

        }
        return $this->render('detail',['data'=>$data]);
    }
}
