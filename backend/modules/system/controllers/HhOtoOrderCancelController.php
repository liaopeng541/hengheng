<?php
/**
* Created by 廖鹏
* Date: 2018年05月16日 12:26*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhOtoOrderCancel;

class HhOtoOrderCancelController extends AdminController
{

    /**
    * HhOtoOrderCancel 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhOtoOrderCancel::find();
            //筛选条件
            if (isset($_GET['time']) && $_GET['time']) {
                  $search_start_time=strtotime($_GET['time']);
                  $searchend_time=$search_start_time+(24*60*60);
                  $model->andWhere(['between', 'time', $search_start_time,$searchend_time]);
            }
            if (isset($_GET['order_sn']) && $_GET['order_sn']) {
                  $model->andWhere(['like', 'order_sn', $_GET['order_sn']]);
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
                                 $v['time'] and $data[$key]['time'] = date("Y-m-d H:i:s", $v['time']);
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
    * HhOtoOrderCancel 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhOtoOrderCancel();
            //数据转换
                $data = ['HhOtoOrderCancel' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhOtoOrderCancel中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        
        return $this->render('form',$page_data);

    }

    /**
    * HhOtoOrderCancel 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhOtoOrderCancel::findOne($_POST['id']);
            //数据转换
                $data = ['HhOtoOrderCancel' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        
        return $this->render('form',$page_data);
    }

    /**
    * HhOtoOrderCancel 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhOtoOrderCancel::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhOtoOrderCancel中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhOtoOrderCancel 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhOtoOrderCancel::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhOtoOrderCancel::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhOtoOrderCancel表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhOtoOrderCancel 详情页
    */
    public function actionDetail($id)
    {
        $model=HhOtoOrderCancel::find()->where(['id'=>$id]);
        //处理外键

        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                             $data['time'] and $data['time'] = date("Y-m-d H:i:s", $data['time']);

        }
        return $this->render('detail',['data'=>$data]);
    }
}
