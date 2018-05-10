<?php
/**
* Created by 廖鹏
* Date: 2018年05月09日 13:23*/
namespace backend\modules\admin\controllers;
use backend\controllers\AdminController;
use common\models\LpUsers;
use PHPExcel_Writer_Excel5;
    use common\models\LpUserLevel;

class LpUsersController extends AdminController
{

    /**
    * LpUsers 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = LpUsers::find();
            //筛选条件
            if (isset($_GET['email']) && $_GET['email']) {
                  $model->andWhere(['like', 'email', $_GET['email']]);
            }
            if (isset($_GET['password']) && $_GET['password']) {
                  $model->andWhere(['like', 'password', $_GET['password']]);
            }
            if (isset($_GET['paypwd']) && $_GET['paypwd']) {
                  $model->andWhere(['like', 'paypwd', $_GET['paypwd']]);
            }
            if (isset($_GET['mobile']) && $_GET['mobile']) {
                  $model->andWhere(['like', 'mobile', $_GET['mobile']]);
            }
            if (isset($_GET['level']) && ($_GET['level'] || $_GET['level']==="0")) {
                  $model->andWhere(['level'=>$_GET['level']]);
            }
            //排序
            $sort = 'user_id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("lp_user_level_level_id");
             $lp_user_level_level_id=LpUserLevel::find()->asArray()->all();
             $page_data["lp_user_level_level_id"]=\yii\helpers\ArrayHelper::map($lp_user_level_level_id,"level_id","level_name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                          $data[$key]['sex_lp'] = LpUsers::getsextext($v["sex"]);
             $v['reg_time'] and $data[$key]['reg_time'] = date("Y-m-d H:i:s", $v['reg_time']);
                      $data[$key]['level_lp'] = $v["lp_user_level_level_id"]["level_name"];
             $v['level_end_time'] and $data[$key]['level_end_time'] = date("Y-m-d H:i:s", $v['level_end_time']);
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
            R($redata);
        }
        $page_data=[];
        $lp_user_level_level_id=LpUserLevel::find()->asArray()->all();
        $page_data["lp_user_level_level_id"]=\yii\helpers\ArrayHelper::map($lp_user_level_level_id,"level_id","level_name");
        return $this->render('index',$page_data);
    }

    /**
    * LpUsers 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new LpUsers();
            //数据转换
                $data = ['LpUsers' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了LpUsers中user_id:[".$model->user_id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        $lp_user_level_level_id=LpUserLevel::find()->asArray()->all();
                $page_data["lp_user_level_level_id"]=\yii\helpers\ArrayHelper::map($lp_user_level_level_id,"level_id","level_name");
        return $this->render('form',$page_data);

    }

    /**
    * LpUsers 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = LpUsers::findOne($_POST['user_id']);
            //数据转换
                $data = ['LpUsers' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功", "data" => [$model->attributes]]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        $lp_user_level_level_id=LpUserLevel::find()->asArray()->all();
                        $page_data["lp_user_level_level_id"]=\yii\helpers\ArrayHelper::map($lp_user_level_level_id,"level_id","level_name");
        return $this->render('form',$page_data);
    }

    /**
    * LpUsers 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(LpUsers::deleteAll(['in', "user_id", $idarr]))
        {
            $this->addLog("删除了LpUsers中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * LpUsers 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        LpUsers::updateAll([$key => $val], ['in', "user_id", $idarr]);
        $data=LpUsers::find()->where(['in','user_id',$idarr])->asArray()->all();
        $this->addLog("设置LpUsers表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * LpUsers 导出数据为excel
    */
    public function actionExportexcel()
    {
        $model = LpUsers::find();
        //筛选条件
            if (isset($_GET['email']) && $_GET['email']) {
                  $model->andWhere(['like', 'email', $_GET['email']]);
            }
            if (isset($_GET['password']) && $_GET['password']) {
                  $model->andWhere(['like', 'password', $_GET['password']]);
            }
            if (isset($_GET['paypwd']) && $_GET['paypwd']) {
                  $model->andWhere(['like', 'paypwd', $_GET['paypwd']]);
            }
            if (isset($_GET['mobile']) && $_GET['mobile']) {
                  $model->andWhere(['like', 'mobile', $_GET['mobile']]);
            }
            if (isset($_GET['level']) && $_GET['level']) {
                  $model->andWhere(['level'=>$_GET['level']]);
            }
        //排序
        $sort = 'user_id desc';
        if (isset($_GET['sort'])) {
            if ($_GET['sort']) {
                $sort=str_replace('|'," ",$_GET['sort']);
            }
        }
      $model=$model->with("lp_user_level_level_id");
      $lp_user_level_level_id=LpUserLevel::find()->asArray()->all();
      $page_data["lp_user_level_level_id"]=\yii\helpers\ArrayHelper::map($lp_user_level_level_id,"level_id","level_name");
        $data = $model->orderBy($sort)->asArray()->all();
        //处理列表显示内容
        if ($data) {
            foreach ($data as $key => $v) {
              $data[$key]['sex_lp'] = LpUsers::getsextext($v["sex"]);
      $v['reg_time'] and $data[$key]['reg_time'] = date("Y-m-d H:i:s", $v['reg_time']);
              $data[$key]['level_lp'] = $v["lp_user_level_level_id"]["level_name"];
      $v['level_end_time'] and $data[$key]['level_end_time'] = date("Y-m-d H:i:s", $v['level_end_time']);
            }
        }
        $PHPExcel=new \PHPExcel();
        $write = new PHPExcel_Writer_Excel5($PHPExcel);
        $sheet=$PHPExcel->getActiveSheet();  //获得当前获得sheet的操作对象
        $sheet->setTitle('LpUsers');   //设置名称
        $start="A";
        $c_start=1;
        $giishow=new LpUsers();
        $giishow=$giishow->giishow();
        $columns=[];
        if(isset($giishow['table'])){
            foreach ($giishow['table'] as $key=>$val)
            {
                (isset($val['show_mode']) && $val['show_mode']!='不展示') and $columns[]=$key;
            }
            krsort($columns);
            foreach ($columns as $val)
            {
                $sheet->setCellValue($start.$c_start,$giishow['table'][$val]['show_name']);
                $start++;
            }
        }

        foreach ($data as $v)
        {
            $c_start++;
            $start="A";
            foreach ($columns as $val)
            {
                isset($v[$val."_lp"]) and $v[$val] = $v[$val."_lp"];
                $sheet->setCellValue($start.$c_start,$v[$val]);
                $start++;
            }
        }
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename=充值数据.xls');
        header("Content-Transfer-Encoding:binary");
        $write->save('php://output');   //按照指定格式生成Excel文件
    }
}
