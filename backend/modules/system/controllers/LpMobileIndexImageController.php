<?php
/**
* Created by 廖鹏
* Date: 2018年05月18日 08:19*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpMobileIndexImage;
use common\models\LpGoods;

class LpMobileIndexImageController extends AdminController
{

    /**
    * LpMobileIndexImage 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = LpMobileIndexImage::find();
            //筛选条件
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
                         $model=$model->with("lp_goods_goods_id");
             $lp_goods_goods_id=LpGoods::find()->asArray()->all();
             $page_data["lp_goods_goods_id"]=\yii\helpers\ArrayHelper::map($lp_goods_goods_id,"goods_id","goods_name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                          $data[$key]['goods_id_lp'] = $v["lp_goods_goods_id"]["goods_name"];
                      $data[$key]['type_lp'] = LpMobileIndexImage::gettypetext($v["type"]);
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $lp_goods_goods_id=LpGoods::find()->asArray()->all();
        $page_data["lp_goods_goods_id"]=\yii\helpers\ArrayHelper::map($lp_goods_goods_id,"goods_id","goods_name");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * LpMobileIndexImage 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new LpMobileIndexImage();
            //数据转换
                $data = ['LpMobileIndexImage' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了LpMobileIndexImage中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        $lp_goods_goods_id=LpGoods::find()->asArray()->all();
                $page_data["lp_goods_goods_id"]=\yii\helpers\ArrayHelper::map($lp_goods_goods_id,"goods_id","goods_name");
        return $this->render('form',$page_data);

    }

    /**
    * LpMobileIndexImage 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = LpMobileIndexImage::findOne($_POST['id']);
            //数据转换
            $_POST['image'] = (isset($_POST['image'])&&$_POST['image']) ? $_POST['image']:null;
            $data = ['LpMobileIndexImage' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $lp_goods_goods_id=LpGoods::find()->asArray()->all();
                        $page_data["lp_goods_goods_id"]=\yii\helpers\ArrayHelper::map($lp_goods_goods_id,"goods_id","goods_name");
        return $this->render('form',$page_data);
    }

    /**
    * LpMobileIndexImage 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(LpMobileIndexImage::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了LpMobileIndexImage中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * LpMobileIndexImage 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        LpMobileIndexImage::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=LpMobileIndexImage::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置LpMobileIndexImage表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * LpMobileIndexImage 详情页
    */
    public function actionDetail($id)
    {
        $model=LpMobileIndexImage::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("lp_goods_goods_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['goods_id_lp'] = $data["lp_goods_goods_id"]["goods_name"];
                      $data['type_lp'] = LpMobileIndexImage::gettypetext($data["type"]);

        }
        return $this->render('detail',['data'=>$data]);
    }
}
