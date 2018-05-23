<?php
/**
* Created by 廖鹏
* Date: 2018年05月15日 10:12*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhStore;
use common\models\HhService;
use common\models\HhStoreService;

class HhStoreController extends AdminController
{

    /**
    * HhStore 列表页
    */
    public function actionIndex()
    {
        //$list = ;
        //var_dump(in_array('102', $list));die;
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhStore::find();
            //筛选条件
            if (isset($_GET['name']) && $_GET['name']) {
                  $model->andWhere(['like', 'name', $_GET['name']]);
            }
            if (isset($_GET['tel']) && $_GET['tel']) {
                  $model->andWhere(['like', 'tel', $_GET['tel']]);
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
                    $v['thumbs'] and $data[$key]['thumbs'] = unserialize($v['thumbs']);
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data = [];
        if (isset($_GET['mini'])) {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * HhStore 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhStore();
            //数据转换
            isset($_POST['thumbs']) and $_POST['thumbs'] = serialize($_POST['thumbs']);
            $data = ['HhStore' => $_POST];
            $storeService = \Yii::$app->request->post('storeService');
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhStore中id:[".$model->id."]的数据:".json_encode($model->attributes));
                if ($storeService) {
                //处理对于的关联表 store_service
                    $res = $this->triggerStroeService($model->id, $storeService, 'update');
                }
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data = [];
        //处理外键
        return $this->render('form',$page_data);
    }

    /**
    * HhStore 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $storeId = \Yii::$app->request->post('id');
            $model = HhStore::findOne($storeId);
            //print_r(\Yii::$app->request->post());
            //数据转换
            $_POST['thumbs'] = (isset($_POST['thumbs'])&&$_POST['thumbs']) ? serialize($_POST['thumbs']):null;
            $_POST['thumb'] = (isset($_POST['thumb'])&&$_POST['thumb']) ? $_POST['thumb']:null;
            $data = ['HhStore' => $_POST];
            $storeService = \Yii::$app->request->post('storeService');

            if ($storeService) {
                //处理对于的关联表 store_service
                $res = $this->triggerStroeService($storeId, $storeService, 'update');
            }
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $storeService = HhStoreService::getListByStoreId(\Yii::$app->request->get('id'));
        $page_data['storeService'] = array_column($storeService, 'service_id');

        return $this->render('form',$page_data);
    }

    /**
    * HhStore 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhStore::deleteAll(['in', "id", $idarr])) {
            $this->addLog("删除了HhStore中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhStore 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhStore::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhStore::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhStore表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhStore 详情页
    */
    public function actionDetail($id)
    {
        $model=HhStore::find()->where(['id'=>$id]);
        //处理外键
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
            $data['thumbs'] and $data['thumbs'] = unserialize($data['thumbs']);
            $data['status_lp'] = HhStore::getstatustext($data["status"]);
        }
        return $this->render('detail',['data'=>$data]);
    }

    public function triggerStroeService($storeId, $data, $action)
    {
        HhStoreService::deleteAll(['in', "store_id", $storeId]);
        $list = HhService::find()->select('id,name')->where(['id' => $data])->all();
        foreach ($list as $k => $val) {
            $modelData = [
                'HhStoreService'   => [
                    'store_id'     => $storeId,
                    'service_id'   => $val->id,
                    'service_name' => $val->name
                ]
            ];
            $model = new HhStoreService();
            if (!$model->load($modelData) || !$model->save()) {
                return false;
            } 
        }
        return true;
    }
}
