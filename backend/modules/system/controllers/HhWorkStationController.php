<?php
/**
* Created by 廖鹏
* Date: 2018年05月16日 10:18*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhWorkStation;
use common\models\HhService;
use common\models\HhStore;

class HhWorkStationController extends AdminController
{

    /**
    * HhWorkStation 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhWorkStation::find();
            //筛选条件
            if (isset($_GET['name']) && $_GET['name']) {
                  $model->andWhere(['like', 'name', $_GET['name']]);
            }
            if (isset($_GET['service_id']) && ($_GET['service_id'] || $_GET['service_id']==="0")) {
                  $model->andWhere(['service_id'=>$_GET['service_id']]);
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
                         $model=$model->with("hh_service_id");
             $hh_service_id=HhService::find()->asArray()->all();
             $page_data["hh_service_id"]=\yii\helpers\ArrayHelper::map($hh_service_id,"id","name");
             $model=$model->with("hh_store_id");
             $hh_store_id=HhStore::find()->asArray()->all();
             $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                          $data[$key]['service_id_lp'] = $v["hh_service_id"]["name"];
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
        $hh_service_id=HhService::find()->asArray()->all();
        $page_data["hh_service_id"]=\yii\helpers\ArrayHelper::map($hh_service_id,"id","name");$hh_store_id=HhStore::find()->asArray()->all();
        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * HhWorkStation 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhWorkStation();
            //数据转换
            isset($_POST['status']) or $_POST['status']=0;
            $data = ['HhWorkStation' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhWorkStation中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        $hh_service_id=HhService::find()->asArray()->all();
                $page_data["hh_service_id"]=\yii\helpers\ArrayHelper::map($hh_service_id,"id","name");$hh_store_id=HhStore::find()->asArray()->all();
                $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
        return $this->render('form',$page_data);

    }

    /**
    * HhWorkStation 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhWorkStation::findOne($_POST['id']);
            //数据转换
            isset($_POST['status']) or $_POST['status']=0;
            $data = ['HhWorkStation' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            print_r($model->getErrors());die;
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $hh_service_id=HhService::find()->asArray()->all();
                        $page_data["hh_service_id"]=\yii\helpers\ArrayHelper::map($hh_service_id,"id","name");$hh_store_id=HhStore::find()->asArray()->all();
                        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
        return $this->render('form',$page_data);
    }

    /**
    * HhWorkStation 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhWorkStation::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhWorkStation中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhWorkStation 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhWorkStation::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhWorkStation::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhWorkStation表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhWorkStation 详情页
    */
    public function actionDetail($id)
    {
        $model=HhWorkStation::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("hh_service_id");
             $model=$model->with("hh_store_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['service_id_lp'] = $data["hh_service_id"]["name"];
                      $data['store_id_lp'] = $data["hh_store_id"]["name"];

        }
        return $this->render('detail',['data'=>$data]);
    }
}
