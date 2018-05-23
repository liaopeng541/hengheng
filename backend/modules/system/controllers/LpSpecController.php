<?php
/**
* Created by 廖鹏
* Date: 2018年05月14日 05:27*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpSpec;
use common\models\LpGoodsType;
use common\models\LpSpecItem;

class LpSpecController extends AdminController
{

    /**
    * LpSpec 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = LpSpec::find();
            //筛选条件
            if (isset($_GET['name']) && $_GET['name']) {
                  $model->andWhere(['like', 'name', $_GET['name']]);
            }
            if (isset($_GET['type_id']) && $_GET['type_id']) {
                  $model->andWhere(['like', 'type_id', $_GET['type_id']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
            $model=$model->with("lp_goods_type_id");
            $lp_goods_type_id=LpGoodsType::find()->asArray()->all();
            $page_data["lp_goods_type_id"]=\yii\helpers\ArrayHelper::map($lp_goods_type_id,"id","name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                    $data[$key]['type_id_lp'] = $v["lp_goods_type_id"]["name"];
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $lp_goods_type_id=LpGoodsType::find()->asArray()->all();
        $page_data["lp_goods_type_id"]=\yii\helpers\ArrayHelper::map($lp_goods_type_id,"id","name");        
        if(isset($_GET['mini'])) {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * LpSpec 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new LpSpec();
            //数据转换
            $data = ['LpSpec' => $_POST];
            $item = [];
            if (isset($_POST['item']) && count($_POST['item'] > 0)) {
                $trs = \Yii::$app->db->beginTransaction();
                try {
                    //入库商品规格->lp_spec
                    if ($model->load($data) && $model->save()) {
                        $getLastID = $model->id;
                        foreach ($_POST['item'] as $k => $val) {
                            $buildData = ['LpSpecItem' => [
                                'spec_id' => $getLastID,
                                'item' => $val,
                            ]];
                            //入库商品规格多属性 ->lp_spec_item
                            $lpSpecItemModel = new LpSpecItem();
                            if (!$lpSpecItemModel->load($buildData) || !$lpSpecItemModel->save()) {
                                $trs->rollBack();
                                R(['status' => 1, 'msg' => "添加失败,请检查规格项"]);
                            }             
                        }
                        $trs->commit();
                        R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
                        //无法Model validate，弃用
                        /*$res = \Yii::$app->db
                            ->createCommand()
                            ->batchInsert('lp_spec_item', ['spec_id', 'item'], $item)
                            ->execute();
                        count($res) > 0 && $trs->commit();*/
                    }
                    $trs->rollBack();
                    R(['status' => 1, 'msg' => "添加失败,请检查"]);
                } catch (Exception $e) {
                    $trs->rollBack();
                    R(['status' => 1, 'msg' => "添加失败,请检查"]);
                }
            } else {
                if ($model->load($data) && $model->save()) {
                    $this->addLog("添加了LpSpec中id:[".$model->id."]的数据:".json_encode($model->attributes));
                    R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
                }
                R(['status' => 1, 'msg' => "添加失败"]);
            }
        }
        $page_data = [];
        //处理外键
        $lp_goods_type_id = LpGoodsType::find()->asArray()->all();
        $page_data["lp_goods_type_id"] = \yii\helpers\ArrayHelper::map($lp_goods_type_id,"id","name");
        return $this->render('form',$page_data);
    }

   /**
    * @Author      fall1ng丶
    * @DateTime    2018-05-14
    * @Description [规格数据更新，如不存在的，从新入库]
    * @return      [type]        [description]
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = LpSpec::findOne($_POST['id']);
            //数据转换
            $data = ['LpSpec' => $_POST];
            if (isset($_POST['itemId']) && count($_POST['itemId']) > 0) {
                $trs = \Yii::$app->db->beginTransaction();
                try {
                    $item = \Yii::$app->request->post('itemId');
                    $itemData = \Yii::$app->request->post('item');
                    if ($model->load($data) && $model->save()) {
                        foreach ($itemData as $k => $val) {
                            //判断是否位新增的 规格，新增的 重新入库，旧数据更新
                            if (!isset($item[$k]) || count($item) < $k) {
                                $specModel = new LpSpecItem();
                                $buildModel = ['LpSpecItem' => [
                                    'spec_id' => $_POST['id'],
                                    'item' => $val
                                ]];
                            } else {
                                $specModel = LpSpecItem::findOne($item[$k]);
                                $buildModel = ['LpSpecItem' => [
                                    'item' => $val
                                ]];
                            }
                            if (!$specModel->load($buildModel) || !$specModel->save()) {
                                $trs->rollBack();
                                R(['status' => 1, 'msg' => "修改失败,请检查规格项"]);
                            }
                        }
                        $trs->commit();
                        R(['status' => 0, 'msg' => "修改成功"]);  
                    }
                    $trs->commit();
                    R(['status' => 1, 'msg' => "修改失败,LpSpec_Update"]);    
                } catch (Exception $e) {
                    $trs->rollBack();
                    R(['status' => 1, 'msg' => "修改失败,请检查try{catch}部分"]);
                }
            } 
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $lp_goods_type_id = LpGoodsType::find()->asArray()->all();
        $page_data["lp_goods_type_id"]=\yii\helpers\ArrayHelper::map($lp_goods_type_id,"id","name");
        $page_data['specList'] = LpSpecItem::find()
            ->where(['spec_id' => \Yii::$app->request->get('id')])
            ->asArray()
            ->all();
        return $this->render('form',$page_data);
    }

    /**
    * LpSpec 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(LpSpec::deleteAll(['in', "id", $idarr])) {
            LpSpecItem::deleteAll(['in', "spec_id", $idarr]);
            $this->addLog("删除了LpSpec中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * LpSpec 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        LpSpec::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=LpSpec::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置LpSpec表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * LpSpec 详情页
    */
    public function actionDetail($id)
    {
        $model=LpSpec::find()->where(['id'=>$id]);
        //处理外键

        $model=$model->with("lp_goods_type_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
            $data['type_id_lp'] = $data["lp_goods_type_id"]["name"];
        }
        return $this->render('detail',['data'=>$data]);
    }
}
