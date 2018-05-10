<?php
/**
* Created by 廖鹏
* Date: 2018年05月10日 16:43*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpUserLevel;

class LpUserLevelController extends AdminController
{

    /**
    * LpUserLevel 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = LpUserLevel::find();
            //筛选条件
            if (isset($_GET['level_name']) && $_GET['level_name']) {
                  $model->andWhere(['like', 'level_name', $_GET['level_name']]);
            }
            //排序
            $sort = 'level_id desc';
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
                                 $v['detail_img'] and $data[$key]['detail_img'] = unserialize($v['detail_img']);
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
    * LpUserLevel 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new LpUserLevel();
            //数据转换
            isset($_POST['list_show']) or $_POST['list_show']=0;
        isset($_POST['is_show']) or $_POST['is_show']=0;
        isset($_POST['detail_img']) and $_POST['detail_img']=serialize($_POST['detail_img']);
            $data = ['LpUserLevel' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了LpUserLevel中level_id:[".$model->level_id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        
        return $this->render('form',$page_data);

    }

    /**
    * LpUserLevel 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = LpUserLevel::findOne($_POST['id']);
            //数据转换
            isset($_POST['list_show']) or $_POST['list_show']=0;
        isset($_POST['is_show']) or $_POST['is_show']=0;
        $_POST['thumb'] = (isset($_POST['thumb'])&&$_POST['thumb']) ? $_POST['thumb']:null;
        $_POST['detail_img'] = (isset($_POST['detail_img'])&&$_POST['detail_img']) ? serialize($_POST['detail_img']):null;
            $data = ['LpUserLevel' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        
        return $this->render('form',$page_data);
    }

    /**
    * LpUserLevel 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(LpUserLevel::deleteAll(['in', "level_id", $idarr]))
        {
            $this->addLog("删除了LpUserLevel中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * LpUserLevel 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        LpUserLevel::updateAll([$key => $val], ['in', "level_id", $idarr]);
        $data=LpUserLevel::find()->where(['in','level_id',$idarr])->asArray()->all();
        $this->addLog("设置LpUserLevel表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * LpUserLevel 详情页
    */
    public function actionDetail($id)
    {
        $model=LpUserLevel::find()->where(['level_id'=>$id]);
        //处理外键

        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['list_show_lp'] = LpUserLevel::getlist_showtext($data["list_show"]);
                      $data['is_show_lp'] = LpUserLevel::getis_showtext($data["is_show"]);
             $data['detail_img'] and $data['detail_img'] = unserialize($data['detail_img']);

        }
        return $this->render('detail',['data'=>$data]);
    }
}
