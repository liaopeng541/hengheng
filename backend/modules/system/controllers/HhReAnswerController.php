<?php
/**
* Created by 廖鹏
* Date: 2018年05月16日 12:15*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\HhReAnswer;
use common\models\HhReFeedback;

class HhReAnswerController extends AdminController
{

    /**
    * HhReAnswer 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = HhReAnswer::find();
            //筛选条件
            if (isset($_GET['f_id']) && ($_GET['f_id'] || $_GET['f_id']==="0")) {
                  $model->andWhere(['f_id'=>$_GET['f_id']]);
            }
            if (isset($_GET['answer']) && $_GET['answer']) {
                  $model->andWhere(['like', 'answer', $_GET['answer']]);
            }
            //排序
            $sort = 'id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("hh_re_feedback_id");
             $hh_re_feedback_id=HhReFeedback::find()->asArray()->all();
             $page_data["hh_re_feedback_id"]=\yii\helpers\ArrayHelper::map($hh_re_feedback_id,"id","question");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                          $data[$key]['f_id_lp'] = $v["hh_re_feedback_id"]["question"];
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $hh_re_feedback_id=HhReFeedback::find()->asArray()->all();
        $page_data["hh_re_feedback_id"]=\yii\helpers\ArrayHelper::map($hh_re_feedback_id,"id","question");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * HhReAnswer 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new HhReAnswer();
            //数据转换
                $data = ['HhReAnswer' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了HhReAnswer中id:[".$model->id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        $hh_re_feedback_id=HhReFeedback::find()->asArray()->all();
                $page_data["hh_re_feedback_id"]=\yii\helpers\ArrayHelper::map($hh_re_feedback_id,"id","question");
        return $this->render('form',$page_data);

    }

    /**
    * HhReAnswer 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = HhReAnswer::findOne($_POST['id']);
            //数据转换
                $data = ['HhReAnswer' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $hh_re_feedback_id=HhReFeedback::find()->asArray()->all();
                        $page_data["hh_re_feedback_id"]=\yii\helpers\ArrayHelper::map($hh_re_feedback_id,"id","question");
        return $this->render('form',$page_data);
    }

    /**
    * HhReAnswer 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(HhReAnswer::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了HhReAnswer中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * HhReAnswer 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        HhReAnswer::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=HhReAnswer::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置HhReAnswer表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * HhReAnswer 详情页
    */
    public function actionDetail($id)
    {
        $model=HhReAnswer::find()->where(['id'=>$id]);
        //处理外键

             $model=$model->with("hh_re_feedback_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['f_id_lp'] = $data["hh_re_feedback_id"]["question"];

        }
        return $this->render('detail',['data'=>$data]);
    }
}
