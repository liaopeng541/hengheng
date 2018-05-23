<?php
/**
* Created by 廖鹏
* Date: 2018年05月23日 07:58*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpOrder;
use common\models\LpUsers;

class LpOrderController extends AdminController
{

    /**
    * LpOrder 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = LpOrder::find();
            //筛选条件
            if (isset($_GET['order_sn']) && $_GET['order_sn']) {
                  $model->andWhere(['like', 'order_sn', $_GET['order_sn']]);
            }
            if (isset($_GET['order_status']) && ($_GET['order_status'] || $_GET['order_status']==="0")) {
                  $model->andWhere(['order_status'=>$_GET['order_status']]);
            }
            //排序
            $sort = 'order_id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("lp_users_user_id");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                 $v['add_time'] and $data[$key]['add_time'] = date("Y-m-d H:i:s", $v['add_time']);
             $v['pay_time'] and $data[$key]['pay_time'] = date("Y-m-d H:i:s", $v['pay_time']);
                      $data[$key]['user_id_lp'] = $v["lp_users_user_id"]["mobile"];
                      $data[$key]['order_status_lp'] = LpOrder::getorder_statustext($v["order_status"]);
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
                if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * LpOrder 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new LpOrder();
            //数据转换
                $data = ['LpOrder' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了LpOrder中order_id:[".$model->order_id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        
        return $this->render('form',$page_data);

    }

    /**
    * LpOrder 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = LpOrder::findOne($_POST['id']);
            //数据转换
                $data = ['LpOrder' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        
        return $this->render('form',$page_data);
    }

    /**
    * LpOrder 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(LpOrder::deleteAll(['in', "order_id", $idarr]))
        {
            $this->addLog("删除了LpOrder中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * LpOrder 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        LpOrder::updateAll([$key => $val], ['in', "order_id", $idarr]);
        $data=LpOrder::find()->where(['in','order_id',$idarr])->asArray()->all();
        $this->addLog("设置LpOrder表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * LpOrder 详情页
    */
    public function actionDetail($id)
    {
        $model=LpOrder::find()->where(['order_id'=>$id]);
        //处理外键

             $model=$model->with("lp_users_user_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                             $data['add_time'] and $data['add_time'] = date("Y-m-d H:i:s", $data['add_time']);
             $data['pay_time'] and $data['pay_time'] = date("Y-m-d H:i:s", $data['pay_time']);
                      $data['user_id_lp'] = $data["lp_users_user_id"]["mobile"];
                      $data['order_status_lp'] = LpOrder::getorder_statustext($data["order_status"]);

        }
        return $this->render('detail',['data'=>$data]);
    }
}
