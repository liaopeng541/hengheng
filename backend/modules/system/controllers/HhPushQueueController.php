<?php
/**
* Created by 廖鹏
* Date: 2018年05月17日 11:39*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhPushQueue;

class HhPushQueueController extends AdminController
{

    /**
    * HhPushQueue 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhPushQueue::find();
            //筛选条件
            if (isset($_GET['title']) && $_GET['title']) {
                  $model->andWhere(['like', 'title', $_GET['title']]);
            }
            if (isset($_GET['status']) && ($_GET['status'] || $_GET['status']==="0")) {
                  $model->andWhere(['status'=>$_GET['status']]);
            }
            if (isset($_GET['is_read']) && ($_GET['is_read'] || $_GET['is_read']==="0")) {
                  $model->andWhere(['is_read'=>$_GET['is_read']]);
            }
            if (isset($_GET['type']) && ($_GET['type'] || $_GET['type']==="0")) {
                  $model->andWhere(['type'=>$_GET['type']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                        $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                 $v['send_time'] and $data[$key]['send_time'] = date("Y-m-d H:i:s", $v['send_time']);
                      $data[$key]['status_lp'] = HhPushQueue::getstatustext($v["status"]);
                      $data[$key]['is_read_lp'] = HhPushQueue::getis_readtext($v["is_read"]);
                      $data[$key]['type_lp'] = HhPushQueue::gettypetext($v["type"]);
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
    * HhPushQueue 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhPushQueue();
            //数据转换
                $data = ['HhPushQueue' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhPushQueue中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        
        return $this->render('form',$page_data);

    }

    /**
    * HhPushQueue 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhPushQueue::findOne($_POST['id']);
            //数据转换
                $data = ['HhPushQueue' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        
        return $this->render('form',$page_data);
    }

    /**
    * HhPushQueue 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhPushQueue::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhPushQueue中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhPushQueue 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhPushQueue::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhPushQueue::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhPushQueue表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhPushQueue 详情页
    */
    public function actionDetail($id)
    {
        $model=HhPushQueue::find()->where(['id'=>$id]);
        //处理外键

        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                             $data['send_time'] and $data['send_time'] = date("Y-m-d H:i:s", $data['send_time']);
                      $data['status_lp'] = HhPushQueue::getstatustext($data["status"]);
                      $data['is_read_lp'] = HhPushQueue::getis_readtext($data["is_read"]);
                      $data['type_lp'] = HhPushQueue::gettypetext($data["type"]);

        }
        return $this->render('detail',['data'=>$data]);
    }
}
