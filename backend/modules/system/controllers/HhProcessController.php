<?php
/**
* Created by 廖鹏
* Date: 2018年05月11日 05:47*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhProcess;
use common\models\HhProcessCat;
use backend\models\Tree;

class HhProcessController extends AdminController
{

    /**
    * HhProcess 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhProcess::find();
            //筛选条件
            if (isset($_GET['name']) && $_GET['name']) {
                  $model->andWhere(['like', 'name', $_GET['name']]);
            }
            if (isset($_GET['is_comment']) && ($_GET['is_comment'] || $_GET['is_comment']==="0")) {
                  $model->andWhere(['is_comment'=>$_GET['is_comment']]);
            }
            if (isset($_GET['cat_id']) && $_GET['cat_id']) {
                  $model->andWhere(['cat_id'=>$_GET['cat_id']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("hh_process_cat_id");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                          $data[$key]['cat_id_lp'] = $v["hh_process_cat_id"]["name"];
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $menu = HhProcessCat::find()->select("*,name as sub_name");
        $data=$menu->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $list=array_values($treeObj->getGridTree());
        $page_data["hh_process_cat_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
                if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * HhProcess 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhProcess();
            //数据转换
                $data = ['HhProcess' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhProcess中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

                $menu = HhProcessCat::find()->select("*,name as sub_name");
                $data=$menu->asArray()->all();
                $treeObj = new Tree($data);
                $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
                $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
                $list=array_values($treeObj->getGridTree());
                $page_data["hh_process_cat_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
                
        return $this->render('form',$page_data);

    }

    /**
    * HhProcess 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhProcess::findOne($_POST['id']);
            //数据转换
            $_POST['thumb'] = (isset($_POST['thumb'])&&$_POST['thumb']) ? $_POST['thumb']:null;
            $data = ['HhProcess' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
                $menu = HhProcessCat::find()->select("*,name as sub_name");
                        $data=$menu->asArray()->all();
                        $treeObj = new Tree($data);
                        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
                        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
                        $list=array_values($treeObj->getGridTree());
                        $page_data["hh_process_cat_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
                        
        return $this->render('form',$page_data);
    }

    /**
    * HhProcess 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhProcess::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhProcess中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhProcess 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhProcess::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhProcess::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhProcess表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhProcess 详情页
    */
    public function actionDetail($id)
    {
        $model=HhProcess::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("hh_process_cat_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['is_comment_lp'] = HhProcess::getis_commenttext($data["is_comment"]);
                      $data['cat_id_lp'] = $data["hh_process_cat_id"]["name"];

        }
        return $this->render('detail',['data'=>$data]);
    }
}
