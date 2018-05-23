<?php
/**
* Created by 廖鹏
* Date: 2018年05月18日 08:41*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhTv;
use common\models\HhStore;

class HhTvController extends AdminController
{

    /**
    * HhTv 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhTv::find();
            //筛选条件
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
                         $model=$model->with("hh_store_id");
             $hh_store_id=HhStore::find()->asArray()->all();
             $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
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
        $hh_store_id=HhStore::find()->asArray()->all();
        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * HhTv 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhTv();
            //数据转换
                $data = ['HhTv' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhTv中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        $hh_store_id=HhStore::find()->asArray()->all();
                $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
        return $this->render('form',$page_data);

    }

    /**
    * HhTv 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhTv::findOne($_POST['id']);
            //数据转换
                $data = ['HhTv' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $hh_store_id=HhStore::find()->asArray()->all();
                        $page_data["hh_store_id"]=\yii\helpers\ArrayHelper::map($hh_store_id,"id","name");
        return $this->render('form',$page_data);
    }

    /**
    * HhTv 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhTv::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhTv中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhTv 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhTv::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhTv::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhTv表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhTv 详情页
    */
    public function actionDetail($id)
    {
        $model=HhTv::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("hh_store_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['store_id_lp'] = $data["hh_store_id"]["name"];

        }
        return $this->render('detail',['data'=>$data]);
    }
}
