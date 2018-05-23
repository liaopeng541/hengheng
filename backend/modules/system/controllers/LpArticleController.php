<?php
/**
* Created by 廖鹏
* Date: 2018年05月23日 08:33*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpArticle;
use common\models\LpArticleCat;
use backend\models\Tree;

class LpArticleController extends AdminController
{

    /**
    * LpArticle 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = LpArticle::find();
            //筛选条件
            if (isset($_GET['cat_id']) && $_GET['cat_id']) {
                  $model->andWhere(['cat_id'=>$_GET['cat_id']]);
            }
            //排序
            $sort = 'article_id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("lp_article_cat_id");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                 $v['add_time'] and $data[$key]['add_time'] = date("Y-m-d H:i:s", $v['add_time']);
                      $data[$key]['cat_id_lp'] = $v["lp_article_cat_id"]["name"];
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $menu = LpArticleCat::find()->select("*,name as sub_name");
        $data=$menu->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $list=array_values($treeObj->getGridTree());
        $page_data["lp_article_cat_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
                if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * LpArticle 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new LpArticle();
            //数据转换
                $data = ['LpArticle' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了LpArticle中article_id:[".$model->article_id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

                $menu = LpArticleCat::find()->select("*,name as sub_name");
                $data=$menu->asArray()->all();
                $treeObj = new Tree($data);
                $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
                $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
                $list=array_values($treeObj->getGridTree());
                $page_data["lp_article_cat_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
                
        return $this->render('form',$page_data);

    }

    /**
    * LpArticle 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = LpArticle::findOne($_POST['id']);
            //数据转换
            $_POST['thumb'] = (isset($_POST['thumb'])&&$_POST['thumb']) ? $_POST['thumb']:null;
            $data = ['LpArticle' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
                $menu = LpArticleCat::find()->select("*,name as sub_name");
                        $data=$menu->asArray()->all();
                        $treeObj = new Tree($data);
                        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
                        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
                        $list=array_values($treeObj->getGridTree());
                        $page_data["lp_article_cat_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
                        
        return $this->render('form',$page_data);
    }

    /**
    * LpArticle 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(LpArticle::deleteAll(['in', "article_id", $idarr]))
        {
            $this->addLog("删除了LpArticle中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * LpArticle 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        LpArticle::updateAll([$key => $val], ['in', "article_id", $idarr]);
        $data=LpArticle::find()->where(['in','article_id',$idarr])->asArray()->all();
        $this->addLog("设置LpArticle表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * LpArticle 详情页
    */
    public function actionDetail($id)
    {
        $model=LpArticle::find()->where(['article_id'=>$id]);
        //处理外键

             $model=$model->with("lp_article_cat_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                             $data['add_time'] and $data['add_time'] = date("Y-m-d H:i:s", $data['add_time']);
                      $data['cat_id_lp'] = $data["lp_article_cat_id"]["name"];

        }
        return $this->render('detail',['data'=>$data]);
    }
}
