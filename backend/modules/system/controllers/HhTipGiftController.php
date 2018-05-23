<?php
/**
* Created by 廖鹏
* Date: 2018年05月12日 04:41*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhTipGift;

class HhTipGiftController extends AdminController
{

    /**
    * HhTipGift 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhTipGift::find();
            //筛选条件
            if (isset($_GET['name']) && $_GET['name']) {
                  $model->andWhere(['like', 'name', $_GET['name']]);
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
    * HhTipGift 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhTipGift();
            //数据转换
                $data = ['HhTipGift' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhTipGift中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        
        return $this->render('form',$page_data);

    }

    /**
    * HhTipGift 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhTipGift::findOne($_POST['id']);
            //数据转换
            $_POST['icon'] = (isset($_POST['icon'])&&$_POST['icon']) ? $_POST['icon']:null;
            $data = ['HhTipGift' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        
        return $this->render('form',$page_data);
    }

    /**
    * HhTipGift 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhTipGift::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhTipGift中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhTipGift 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhTipGift::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhTipGift::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhTipGift表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhTipGift 详情页
    */
    public function actionDetail($id)
    {
        $model=HhTipGift::find()->where(['id'=>$id]);
        //处理外键

        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                
        }
        return $this->render('detail',['data'=>$data]);
    }
}
