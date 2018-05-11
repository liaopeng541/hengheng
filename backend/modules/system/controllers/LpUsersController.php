<?php
/**
* Created by 廖鹏
* Date: 2018年05月10日 17:42*/
namespace backend\modules\system\controllers;
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
            if (isset($_GET['level']) && ($_GET['level'] || $_GET['level']==="0")) {
                  $model->andWhere(['level'=>$_GET['level']]);
            }
            if (isset($_GET['is_lock']) && ($_GET['is_lock'] || $_GET['is_lock']==="0")) {
                  $model->andWhere(['is_lock'=>$_GET['is_lock']]);
            }
            if (isset($_GET['mobile']) && $_GET['mobile']) {
                  $model->andWhere(['like', 'mobile', $_GET['mobile']]);
            }
            if (isset($_GET['sex']) && ($_GET['sex'] || $_GET['sex']==="0")) {
                  $model->andWhere(['sex'=>$_GET['sex']]);
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
                                          $data[$key]['level_lp'] = $v["lp_user_level_level_id"]["level_name"];
             $v['reg_time'] and $data[$key]['reg_time'] = date("Y-m-d H:i:s", $v['reg_time']);
                      $data[$key]['sex_lp'] = LpUsers::getsextext($v["sex"]);
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
        $page_data["lp_user_level_level_id"]=\yii\helpers\ArrayHelper::map($lp_user_level_level_id,"level_id","level_name");        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
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
        //处理外键

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
            $model = LpUsers::findOne($_POST['id']);
            //数据转换
                $data = ['LpUsers' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
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
    * LpUsers 详情页
    */
    public function actionDetail($id)
    {
        $model=LpUsers::find()->where(['user_id'=>$id]);
        //处理外键

             $model=$model->with("lp_user_level_level_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                                      $data['level_lp'] = $data["lp_user_level_level_id"]["level_name"];
             $data['reg_time'] and $data['reg_time'] = date("Y-m-d H:i:s", $data['reg_time']);
                      $data['is_lock_lp'] = LpUsers::getis_locktext($data["is_lock"]);
                      $data['sex_lp'] = LpUsers::getsextext($data["sex"]);

        }
        return $this->render('detail',['data'=>$data]);
    }
    /**
    * LpUsers 导出数据为excel
    */
    public function actionExportexcel()
    {
        $model = LpUsers::find();
        //筛选条件
            if (isset($_POST['level']) && $_POST['level']) {
                  $model->andWhere(['level'=>$_POST['level']]);
            }
            if (isset($_POST['is_lock']) && $_POST['is_lock']) {
                  $model->andWhere(['is_lock'=>$_POST['is_lock']]);
            }
            if (isset($_POST['mobile']) && $_POST['mobile']) {
                  $model->andWhere(['like', 'mobile', $_POST['mobile']]);
            }
            if (isset($_POST['sex']) && $_POST['sex']) {
                  $model->andWhere(['sex'=>$_POST['sex']]);
            }
        //排序
        $sort = 'user_id desc';
        if (isset($_POST['sort'])) {
            if ($_POST['sort']) {
                $sort=str_replace('|'," ",$_POST['sort']);
            }
        }
      $model=$model->with("lp_user_level_level_id");
      $lp_user_level_level_id=LpUserLevel::find()->asArray()->all();
      $page_data["lp_user_level_level_id"]=\yii\helpers\ArrayHelper::map($lp_user_level_level_id,"level_id","level_name");
        $data = $model->orderBy($sort)->asArray()->all();
        //处理列表显示内容
        if ($data) {
            foreach ($data as $key => $v) {
              $data[$key]['level_lp'] = $v["lp_user_level_level_id"]["level_name"];
      $v['reg_time'] and $data[$key]['reg_time'] = date("Y-m-d H:i:s", $v['reg_time']);
              $data[$key]['sex_lp'] = LpUsers::getsextext($v["sex"]);
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
