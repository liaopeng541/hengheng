<?php
/**
* Created by 廖鹏
* Date: 2018年05月10日 17:46*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpAccountLog;
use PHPExcel_Writer_Excel5;
    use common\models\LpUsers;

class LpAccountLogController extends AdminController
{

    /**
    * LpAccountLog 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
            $start = ($page - 1) * $size;
            $model = LpAccountLog::find();
            //筛选条件
            //排序
            $sort = 'log_id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                         $model=$model->with("lp_users_user_id");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {
                                 $v['change_time'] and $data[$key]['change_time'] = date("Y-m-d H:i:s", $v['change_time']);
                      $data[$key]['user_id_lp'] = $v["lp_users_user_id"]["mobile"];
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
    * LpAccountLog 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new LpAccountLog();
            //数据转换
                $data = ['LpAccountLog' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了LpAccountLog中log_id:[".$model->log_id."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

        
        return $this->render('form',$page_data);

    }

    /**
    * LpAccountLog 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = LpAccountLog::findOne($_POST['id']);
            //数据转换
                $data = ['LpAccountLog' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
        }
        $page_data=[];
        
        return $this->render('form',$page_data);
    }

    /**
    * LpAccountLog 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(LpAccountLog::deleteAll(['in', "log_id", $idarr]))
        {
            $this->addLog("删除了LpAccountLog中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * LpAccountLog 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        LpAccountLog::updateAll([$key => $val], ['in', "log_id", $idarr]);
        $data=LpAccountLog::find()->where(['in','log_id',$idarr])->asArray()->all();
        $this->addLog("设置LpAccountLog表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * LpAccountLog 详情页
    */
    public function actionDetail($id)
    {
        $model=LpAccountLog::find()->where(['log_id'=>$id]);
        //处理外键

             $model=$model->with("lp_users_user_id");
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                             $data['change_time'] and $data['change_time'] = date("Y-m-d H:i:s", $data['change_time']);
                      $data['user_id_lp'] = $data["lp_users_user_id"]["mobile"];

        }
        return $this->render('detail',['data'=>$data]);
    }
    /**
    * LpAccountLog 导出数据为excel
    */
    public function actionExportexcel()
    {
        $model = LpAccountLog::find();
        //筛选条件
        //排序
        $sort = 'log_id desc';
        if (isset($_POST['sort'])) {
            if ($_POST['sort']) {
                $sort=str_replace('|'," ",$_POST['sort']);
            }
        }
      $model=$model->with("lp_users_user_id");
        $data = $model->orderBy($sort)->asArray()->all();
        //处理列表显示内容
        if ($data) {
            foreach ($data as $key => $v) {
      $v['change_time'] and $data[$key]['change_time'] = date("Y-m-d H:i:s", $v['change_time']);
              $data[$key]['user_id_lp'] = $v["lp_users_user_id"]["mobile"];
            }
        }
        $PHPExcel=new \PHPExcel();
        $write = new PHPExcel_Writer_Excel5($PHPExcel);
        $sheet=$PHPExcel->getActiveSheet();  //获得当前获得sheet的操作对象
        $sheet->setTitle('LpAccountLog');   //设置名称
        $start="A";
        $c_start=1;
        $giishow=new LpAccountLog();
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
