<?php
/**
* Created by 廖鹏
* Date: 2018年05月14日 04:06*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpGoodsCategory;
use backend\models\Tree;

class LpGoodsCategoryController extends AdminController
{
    /**
    * LpGoodsCategory 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = LpGoodsCategory::find();
            //筛选条件
            if (isset($_GET['name']) && $_GET['name']) {
                  $model->andWhere(['like', 'name', $_GET['name']]);
            }
            if (isset($_GET['pid']) && $_GET['pid']) {
                  $model->andWhere(['pid'=>$_GET['pid']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
            $model=$model->with("lp_goods_category_id");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                    $data[$key]['pid_lp'] = $v["lp_goods_category_id"]["name"];
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $menu = LpGoodsCategory::find()->select("*,name as sub_name");
        $data=$menu->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $list=array_values($treeObj->getGridTree());
        $page_data["lp_goods_category_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
        if(isset($_GET['mini'])) {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * LpGoodsCategory 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new LpGoodsCategory();
            //数据转换
            isset($_POST['is_show']) or $_POST['is_show']=0;
            $data = ['LpGoodsCategory' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了LpGoodsCategory中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            } 
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键
        $menu = LpGoodsCategory::find()->select("*,name as sub_name");
        $data=$menu->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $list=array_values($treeObj->getGridTree());
        $page_data["lp_goods_category_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
                
        return $this->render('form',$page_data);

    }

    /**
    * LpGoodsCategory 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = LpGoodsCategory::findOne($_POST['id']);
            //数据转换
            isset($_POST['is_show']) or $_POST['is_show']=0;
            $data = ['LpGoodsCategory' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $menu = LpGoodsCategory::find()->select("*,name as sub_name");
        $data=$menu->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $list=array_values($treeObj->getGridTree());
        $page_data["lp_goods_category_id"]=\yii\helpers\ArrayHelper::map($list,"id","name");
                        
        return $this->render('form',$page_data);
    }

    /**
    * LpGoodsCategory 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(LpGoodsCategory::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了LpGoodsCategory中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * LpGoodsCategory 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        LpGoodsCategory::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=LpGoodsCategory::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置LpGoodsCategory表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * LpGoodsCategory 详情页
    */
    public function actionDetail($id)
    {
        $model=LpGoodsCategory::find()->where(['id'=>$id]);
        //处理外键
        $model=$model->with("lp_goods_category_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
            $data['pid_lp'] = $data["lp_goods_category_id"]["name"];
        }
        return $this->render('detail',['data'=>$data]);
    }
}
