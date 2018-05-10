<?php
use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;
$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();
$pks=$pks[0];
$giishow=$generator->giishow();
$tables=$giishow['table'];
echo "<?php\n";
?>
/**
* Created by 廖鹏
* Date: <?=date("Y年m月d日 H:i")?>
*/
namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;
use backend\controllers\AdminController;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?
    foreach ($tables as $val)
    {
        if($val['f_key'])
        {
            $k_arr=explode(':',$val['f_key']);
            if($k_arr[0]=='key')
            {
                $mc=$generator->L_T($k_arr[1],"_");
                echo 'use common\\models\\'.$mc.";";
            }

        }
    }
?>

class <?= $controllerClass ?> extends AdminController
{

    /**
    * <?= $modelClass ?> 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['p']) ? intval($_GET['p']) : 0;
            $size = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : 10;
            $start = ($page - 1) * $size;
            $model = <?=$modelClass?>::find();
            //筛选条件
<?
foreach ($tables as $key=>$val)
{

    if($val['search_mode']!="不搜索")
    {
        if($val['search_mode']=="文本框")
        {
            echo '          if (isset($_GET[\''.$key.'\']) && $_GET[\''.$key.'\']) {
                              $model->andWhere([\'like\', \''.$key.'\', $_GET[\''.$key.'\']]);
                     }'."\n";
        }else if($val['search_mode']=="日期")
        {
            echo '          if (isset($_GET[\''.$key.'\']) && $_GET[\''.$key.'\']) {
                              $search_start_time=strtotime($_GET[\''.$key.'\']);
                              $searchend_time=$search_start_time+(24*60*60);
                              $model->andWhere([\'between\', \''.$key.'\', $search_start_time,$searchend_time]);
                     }'."\n";
        }else{
            echo '          if (isset($_GET[\''.$key.'\']) && $_GET[\''.$key.'\']) {
                              $model->andWhere([\''.$key.'\'=>$_GET[\''.$key.'\']]);
                     }'."\n";
        }

    }

}?>
            //排序
            $sort = '<?=$pks?> desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
            <?
                foreach ($tables as $val)
                {
                    if($val['f_key'])
                    {
                        $f_arr=explode(':',$val['f_key']);
                        if($f_arr[0]=='key')
                        {
                            $table_name=$f_arr[1];
                            $model_class=$generator->L_T($table_name,"_");
                            $o_arr=explode(">",$f_arr[2]);
                            $table_name.="_".$o_arr[0];
                            $kv_arr=explode(">",$f_arr[3]);
                            echo '$model=$model->with("'.$table_name.'");';
                            //下拉框需要下的下拉内容
                            if($val['add_mode']=="下拉选择" || $val['search_mode']=="下拉选择")
                            {
                                echo "
            ";
                                echo "$".$table_name."=".$model_class."::find()->asArray()->all();";
                                echo "
            ";
                                echo '$page_data["'.$table_name.'"]=\yii\helpers\ArrayHelper::map($'.$table_name.',"'.$kv_arr[0].'","'.$kv_arr[1].'");';
                            }

                        }


                    }
                }
            ?>
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {

                    <?
                    foreach ($tables as $key=>$val)
                    {
                        if($val['show_mode']=="日期时间")
                        {
                            echo '$v[\''.$key.'\'] and $data[$key][\''.$key.'\'] = date("Y-m-d H:i:s", $v[\''.$key.'\']);';
                        }
                        if($val['f_key'])
                        {

                            if($val['show_mode']=="关联文本")
                            {
                                //是外键的情况
                                $f_arr=explode(':',$val['f_key']);

                                if($f_arr[0]=='key')
                                {
                                    $o_arr=explode(">",$f_arr[2]);
                                    $table_name=$f_arr[1]."_".$o_arr[0];
                                    $s_arr=explode(">",$f_arr[3]);
                                    echo '$data[$key][\''.$key.'_lp\'] = $v["'.$table_name.'"]["'.$s_arr[1].'"];'."\n";
                                }else{
                                    $o_arr=explode(",",$f_arr[1]);
                                    echo '$data[$key][\''.$key.'_lp\'] = '.$modelClass.'::get'.$key.'text($v["'.$key.'"]);'."\n";


                                }
                            }
                        }
                    }?>
                }
            }
            $redata['status'] = 200;
            $redata['pages'] = ceil($total / $size);
            $redata['total'] = $total;
            $redata['data']['list'] = $data;
            R($redata);
        }
        $page_data=[];
        <?
        foreach ($tables as $val)
        {
            if($val['f_key'])
            {
                $f_arr=explode(':',$val['f_key']);
                if($f_arr[0]=='key')
                {
                    $table_name=$f_arr[1];
                    $model_class=$generator->L_T($table_name,"_");
                    $o_arr=explode(">",$f_arr[2]);
                    $table_name.="_".$o_arr[0];
                    $kv_arr=explode(">",$f_arr[3]);
                    //下拉框需要下的下拉内容
                    if($val['add_mode']=="下拉选择" || $val['search_mode']=="下拉选择")
                    {
                        echo "$".$table_name."=".$model_class."::find()->asArray()->all();";
                        echo "
        ";
                        echo '$page_data["'.$table_name.'"]=\yii\helpers\ArrayHelper::map($'.$table_name.',"'.$kv_arr[0].'","'.$kv_arr[1].'");';

                    }

                }


            }
        }
        ?>

        return $this->render('index',$page_data);
    }

    /**
    * <?= $modelClass ?> 添加数据
    */
    public function actionAdd()
    {
        $model = new <?= $modelClass ?>();
        //数据转换
<?
foreach ($tables as $key=>$val)
{

        if($val['show_mode']=="日期时间")
        {
            echo '         $_POST[\''.$key.'\'] and $_POST[\''.$key.'\'] = strtotime($_POST[\''.$key.'\']);'."\n";
        }

}?>
        $data = ['<?= $modelClass ?>' => $_POST];
        if ($model->load($data) && $model->save()) {
            $this->addLog("添加了<?= $modelClass ?>中<?=$pks?>:[".$model-><?=$pks?>."]的数据:".json_encode($model->attributes));
            R(['status' => 200, 'msg' => "添加成功", "data" => $model->attributes]);
        }
        R(['status' => 100, 'msg' => "添加失败"]);
    }

    /**
    * <?= $modelClass ?> 更新数据
    */
    public function actionUpdate()
    {
        $model = <?= $modelClass ?>::findOne($_POST['<?=$pks?>']);
        //数据转换
<?
foreach ($tables as $key=>$val)
{
        if($val['show_mode']=="日期时间")
        {
            echo '         $_POST[\''.$key.'\'] and $_POST[\''.$key.'\'] = strtotime($_POST[\''.$key.'\']);'."\n";
        }
    if($val['show_mode']=="开关")
    {
        echo '        isset($_POST[\''.$key.'\']) or $_POST[\''.$key.'\']=0;'."\n";

    }

}?>
        $data = ['<?= $modelClass ?>' => $_POST];
        if ($model->load($data) && $model->save()) {
            R(['status' => 200, 'msg' => "修改成功", "data" => [$model->attributes]]);
        }
        R(['status' => 100, 'msg' => "修改失败"]);
    }

    /**
    * <?= $modelClass ?> 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_GET['<?=$pks?>']);
        if(<?= $modelClass ?>::deleteAll(['in', "<?=$pks?>", $idarr]))
        {
            $this->addLog("删除了<?= $modelClass ?>中id:[".$_GET['<?=$pks?>']."]的数据");
            R(['status' => 200, 'msg' => "删除成功"]);
        }
        R(['status' => 100, 'msg' => "删除失败"]);
    }

    /**
    * <?= $modelClass ?> 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_GET['<?=$pks?>']);
        $title = "启用成功";
        $key=$_GET['k'];
        $val=$_GET[$key.'_v'];
        $val== 0 and $title = "禁用成功";
        (isset($_GET['type']) && $_GET['type']=="set") and $title="设置成功";
        <?= $modelClass ?>::updateAll([$key => $val], ['in', "<?=$pks?>", $idarr]);
        $data=<?= $modelClass ?>::find()->where(['in','<?=$pks?>',$idarr])->asArray()->all();
        $this->addLog("设置<?= $modelClass ?>表中id:[".$_GET['<?=$pks?>']."]的属性[".$key."=>".$val."]");
        R(['status' => 200, 'msg' => $title,"data"=>$data]);
    }
}
