<?php
/**
* Created by 廖鹏
* Date: 2018年05月23日 09:55*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhCarSeries;

class HhCarSeriesController extends AdminController
{

    /**
    * HhCarSeries 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhCarSeries::find();
            //筛选条件
            if (isset($_GET['brand_id']) && $_GET['brand_id']) {
                  $model->andWhere(['like', 'brand_id', $_GET['brand_id']]);
            }
            if (isset($_GET['initial']) && $_GET['initial']) {
                  $model->andWhere(['like', 'initial', $_GET['initial']]);
            }
            if (isset($_GET['series']) && $_GET['series']) {
                  $model->andWhere(['like', 'series', $_GET['series']]);
            }
            if (isset($_GET['series_id']) && $_GET['series_id']) {
                  $model->andWhere(['like', 'series_id', $_GET['series_id']]);
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
    * HhCarSeries 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhCarSeries();
            //数据转换
                $data = ['HhCarSeries' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhCarSeries中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        
        return $this->render('form',$page_data);

    }

    /**
    * HhCarSeries 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhCarSeries::findOne($_POST['id']);
            //数据转换
                $data = ['HhCarSeries' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        
        return $this->render('form',$page_data);
    }

    /**
    * HhCarSeries 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhCarSeries::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhCarSeries中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhCarSeries 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhCarSeries::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhCarSeries::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhCarSeries表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhCarSeries 详情页
    */
    public function actionDetail($id)
    {
        $model=HhCarSeries::find()->where(['id'=>$id]);
        //处理外键

        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                
        }
        return $this->render('detail',['data'=>$data]);
    }
}
