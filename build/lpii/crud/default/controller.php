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
$has_model=[];
if(isset($giishow['bottom_btn']['export_btn'])) {
    ?>
use PHPExcel_Writer_Excel5;
    <?
}
    foreach ($tables as $val)
    {
        if($val['f_key'])
        {
            $k_arr=explode(':',$val['f_key']);
            if($k_arr[0]=='key')
            {
                $mc=$generator->L_T($k_arr[1],"_");
                if(!in_array($mc,$has_model))
                {
                    echo 'use common\\models\\'.$mc.";\n";
                    $has_model[]=$mc;
                }

            }

        }
        if($val['add_mode']=="树型下拉选择" ||$val['search_mode']=="树型下拉选择")
        {
            if(!in_array("Tree",$has_model)){
                echo 'use backend\models\Tree;'."\n";
                $has_model[]="Tree";
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
            $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
            $size = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
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
            echo '            if (isset($_GET[\''.$key.'\']) && $_GET[\''.$key.'\']) {
                  $model->andWhere([\'like\', \''.$key.'\', $_GET[\''.$key.'\']]);
            }'."\n";
        }else if($val['search_mode']=="日期")
        {
            echo '            if (isset($_GET[\''.$key.'\']) && $_GET[\''.$key.'\']) {
                  $search_start_time=strtotime($_GET[\''.$key.'\']);
                  $searchend_time=$search_start_time+(24*60*60);
                  $model->andWhere([\'between\', \''.$key.'\', $search_start_time,$searchend_time]);
            }'."\n";
        }else if($val['search_mode']=="下拉选择"){
            echo '            if (isset($_GET[\''.$key.'\']) && ($_GET[\''.$key.'\'] || $_GET[\''.$key.'\']==="0")) {
                  $model->andWhere([\''.$key.'\'=>$_GET[\''.$key.'\']]);
            }'."\n";
        }else if($val['search_mode']=="关联文本框"){
            if($val['f_key'])
            {
                $k_arr=explode(':',$val['f_key']);
                if($k_arr[0]=='key')
                {
                    $mc=$generator->L_T($k_arr[1],"_");
                    $mk=explode(">",$k_arr[3]);
                    $mv=explode(">",$k_arr[2]);
                    $dataname='$'.$k_arr[1]."_data";
                    echo '            if (isset($_GET[\''.$key.'\']) && ($_GET[\''.$key.'\'] || $_GET[\''.$key.'\']==="0")) {'."\n";
                    echo "              ".$dataname.'='.$mc.'::find()->where(["like","'.$mk[1].'",$_GET["'.$key.'"]])->all();'."\n";
                    echo '              if('.$dataname.'){'."\n";
                    echo "                  ".$dataname.'=\yii\helpers\ArrayHelper::getColumn('.$dataname.',"'.$mk[0].'");'."\n";
                    echo '                  $model->andWhere(["in","'.$mv[1].'",'.$dataname.']);'."\n";
                    echo "              }\n";

                    echo "             }\n";



                }

            }

        }else
        {
            echo '            if (isset($_GET[\''.$key.'\']) && $_GET[\''.$key.'\']) {
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
                            echo '             $model=$model->with("'.$table_name.'");'."\n";
                            //下拉框需要下的下拉内容
                            if($val['add_mode']=="下拉选择" || $val['search_mode']=="下拉选择")
                            {
                                echo "             $".$table_name."=".$model_class."::find()->asArray()->all();\n";
                                echo '             $page_data["'.$table_name.'"]=\yii\helpers\ArrayHelper::map($'.$table_name.',"'.$kv_arr[0].'","'.$kv_arr[1].'");'."\n";
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
                            echo '             $v[\''.$key.'\'] and $data[$key][\''.$key.'\'] = date("Y-m-d H:i:s", $v[\''.$key.'\']);'."\n";
                        }
                        if($val['add_mode']=="图集")
                        {
                            echo '             $v[\''.$key.'\'] and $data[$key][\''.$key.'\'] = unserialize($v[\''.$key.'\']);'."\n";

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
                                    echo '                      $data[$key][\''.$key.'_lp\'] = $v["'.$table_name.'"]["'.$s_arr[1].'"];'."\n";
                                }else{
                                    $o_arr=explode(",",$f_arr[1]);
                                    echo '                      $data[$key][\''.$key.'_lp\'] = '.$modelClass.'::get'.$key.'text($v["'.$key.'"]);'."\n";


                                }
                            }
                        }
                    }?>
                }
            }
            $redata['code'] = 0;
            $redata['pages'] = ceil($total / $size);
            $redata['count'] = $total;
            $redata['data'] = $data;
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
                    if($val['add_mode']=="树型下拉选择" || $val['search_mode']=="树型下拉选择")
                    {
                        echo '$menu = '.$model_class.'::find()->select("*,'.$kv_arr[1].' as sub_'.$kv_arr[1].'");
        $data=$menu->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = [\'&nbsp;&nbsp;&nbsp;│\', \'&nbsp;&nbsp;&nbsp;├─\', \'&nbsp;&nbsp;&nbsp;└─\'];
        $treeObj->nbsp = \'&nbsp;&nbsp;&nbsp;\';
        $list=array_values($treeObj->getGridTree());
        $page_data["'.$table_name.'"]=\yii\helpers\ArrayHelper::map($list,"'.$kv_arr[0].'","'.$kv_arr[1].'");
        ';

                    }

                }


            }
        }
        ?>
        if(isset($_GET['mini']))
        {
            return $this->render('list',$page_data);
        }
        return $this->render('index',$page_data);
    }

    /**
    * <?= $modelClass ?> 添加数据
    */
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax) {
            $model = new <?= $modelClass ?>();
            //数据转换
    <?
    foreach ($tables as $key=>$val)
    {

            if($val['add_mode']=="日期时间")
            {
                echo '         $_POST[\''.$key.'\'] and $_POST[\''.$key.'\'] = strtotime($_POST[\''.$key.'\']);'."\n";
            }
        if($val['add_mode']=="开关")
        {
            echo '        isset($_POST[\''.$key.'\']) or $_POST[\''.$key.'\']=0;'."\n";

        }
        if($val['add_mode']=="图集")
        {
            echo '        isset($_POST[\''.$key.'\']) and $_POST[\''.$key.'\']=serialize($_POST[\''.$key.'\']);'."\n";

        }

    }?>
            $data = ['<?= $modelClass ?>' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了<?= $modelClass ?>中<?=$pks?>:[".$model-><?=$pks?>."]的数据:".json_encode($model->attributes));
                R(['status' => 0, 'msg' => "添加成功", "data" => $model->attributes]);
            }
            R(['status' => 1, 'msg' => "添加失败"]);
        }
        $page_data=[];
        //处理外键

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
                    if($val['add_mode']=="树型下拉选择" || $val['search_mode']=="树型下拉选择")
                    {
                        echo '        $menu = '.$model_class.'::find()->select("*,'.$kv_arr[1].' as sub_'.$kv_arr[1].'");
                $data=$menu->asArray()->all();
                $treeObj = new Tree($data);
                $treeObj->icon = [\'&nbsp;&nbsp;&nbsp;│\', \'&nbsp;&nbsp;&nbsp;├─\', \'&nbsp;&nbsp;&nbsp;└─\'];
                $treeObj->nbsp = \'&nbsp;&nbsp;&nbsp;\';
                $list=array_values($treeObj->getGridTree());
                $page_data["'.$table_name.'"]=\yii\helpers\ArrayHelper::map($list,"'.$kv_arr[0].'","'.$kv_arr[1].'");
                ';

                    }

                }


            }
        }
        echo "\n";
        ?>
        return $this->render('form',$page_data);

    }

    /**
    * <?= $modelClass ?> 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
            $model = <?= $modelClass ?>::findOne($_POST['id']);
            //数据转换
    <?
    foreach ($tables as $key=>$val)
    {
            if($val['add_mode']=="日期时间")
            {
                echo '         $_POST[\''.$key.'\'] and $_POST[\''.$key.'\'] = strtotime($_POST[\''.$key.'\']);'."\n";
            }
        if($val['add_mode']=="开关")
        {
            echo '        isset($_POST[\''.$key.'\']) or $_POST[\''.$key.'\']=0;'."\n";

        }
        if($val['add_mode']=="图集")
        {
            echo '        $_POST[\''.$key.'\'] = (isset($_POST[\''.$key.'\'])&&$_POST[\''.$key.'\']) ? serialize($_POST[\''.$key.'\']):null;'."\n";

        }
        if($val['add_mode']=="图片")
        {
            echo '        $_POST[\''.$key.'\'] = (isset($_POST[\''.$key.'\'])&&$_POST[\''.$key.'\']) ? $_POST[\''.$key.'\']:null;'."\n";

        }

    }?>
            $data = ['<?= $modelClass ?>' => $_POST];
            if ($model->load($data) && $model->save()) {
                R(['status' => 0, 'msg' => "修改成功"]);
            }
            R(['status' => 1, 'msg' => "修改失败"]);
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
                    if($val['add_mode']=="树型下拉选择" || $val['search_mode']=="树型下拉选择")
                    {
                        echo '        $menu = '.$model_class.'::find()->select("*,'.$kv_arr[1].' as sub_'.$kv_arr[1].'");
                        $data=$menu->asArray()->all();
                        $treeObj = new Tree($data);
                        $treeObj->icon = [\'&nbsp;&nbsp;&nbsp;│\', \'&nbsp;&nbsp;&nbsp;├─\', \'&nbsp;&nbsp;&nbsp;└─\'];
                        $treeObj->nbsp = \'&nbsp;&nbsp;&nbsp;\';
                        $list=array_values($treeObj->getGridTree());
                        $page_data["'.$table_name.'"]=\yii\helpers\ArrayHelper::map($list,"'.$kv_arr[0].'","'.$kv_arr[1].'");
                        ';

                    }

                }


            }
        }
        echo "\n";
        ?>
        return $this->render('form',$page_data);
    }

    /**
    * <?= $modelClass ?> 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_POST['id']);
        if(<?= $modelClass ?>::deleteAll(['in', "<?=$pks?>", $idarr]))
        {
            $this->addLog("删除了<?= $modelClass ?>中id:[".$_POST['id']."]的数据");
            R(['status' => 0, 'msg' => "删除成功"]);
        }
        R(['status' => 1, 'msg' => "删除失败"]);
    }

    /**
    * <?= $modelClass ?> 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_POST['id']);
        $title = $_POST['title'];
        $key=$_POST['field'];
        $val=$_POST['value'];
        <?= $modelClass ?>::updateAll([$key => $val], ['in', "<?=$pks?>", $idarr]);
        $data=<?= $modelClass ?>::find()->where(['in','<?=$pks?>',$idarr])->asArray()->all();
        $this->addLog("设置<?= $modelClass ?>表中id:[".$_POST['id']."]的属性[".$key."=>".$val."]");
        R(['status' => 0, 'msg' => $title."成功"]);
    }
    /**
    * <?= $modelClass ?> 详情页
    */
    public function actionDetail($id)
    {
        $model=<?= $modelClass ?>::find()->where(['<?=$pks?>'=>$id]);
        //处理外键

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
            echo '             $model=$model->with("'.$table_name.'");'."\n";
        }


    }
}
?>
        $data = $model->asArray()->one();
        //处理列表显示内容
        if ($data) {
                <?
                foreach ($tables as $key=>$val)
                {
                    if($val['show_mode']=="日期时间")
                    {
                        echo '             $data[\''.$key.'\'] and $data[\''.$key.'\'] = date("Y-m-d H:i:s", $data[\''.$key.'\']);'."\n";
                    }
                    if($val['add_mode']=="图集")
                    {
                        echo '             $data[\''.$key.'\'] and $data[\''.$key.'\'] = unserialize($data[\''.$key.'\']);'."\n";

                    }
                    if($val['f_key'])
                    {

                            //是外键的情况
                            $f_arr=explode(':',$val['f_key']);

                            if($f_arr[0]=='key')
                            {
                                $o_arr=explode(">",$f_arr[2]);
                                $table_name=$f_arr[1]."_".$o_arr[0];
                                $s_arr=explode(">",$f_arr[3]);
                                echo '                      $data[\''.$key.'_lp\'] = $data["'.$table_name.'"]["'.$s_arr[1].'"];'."\n";
                            }else{
                                $o_arr=explode(",",$f_arr[1]);
                                echo '                      $data[\''.$key.'_lp\'] = '.$modelClass.'::get'.$key.'text($data["'.$key.'"]);'."\n";


                            }

                    }
                }?>

        }
        return $this->render('detail',['data'=>$data]);
    }
<?
if(isset($giishow['bottom_btn']['export_btn'])) {
?>
    /**
    * <?= $modelClass ?> 导出数据为excel
    */
    public function actionExportexcel()
    {
        $model = <?=$modelClass?>::find();
        //筛选条件
<?
foreach ($tables as $key=>$val)
{

    if($val['search_mode']!="不搜索")
    {
        if($val['search_mode']=="文本框")
        {
            echo '            if (isset($_POST[\''.$key.'\']) && $_POST[\''.$key.'\']) {
                  $model->andWhere([\'like\', \''.$key.'\', $_POST[\''.$key.'\']]);
            }'."\n";
        }else if($val['search_mode']=="日期")
        {
            echo '            if (isset($_POST[\''.$key.'\']) && $_POST[\''.$key.'\']) {
                  $search_start_time=strtotime($_POST[\''.$key.'\']);
                  $searchend_time=$search_start_time+(24*60*60);
                  $model->andWhere([\'between\', \''.$key.'\', $search_start_time,$searchend_time]);
            }'."\n";
        }else{
            echo '            if (isset($_POST[\''.$key.'\']) && $_POST[\''.$key.'\']) {
                  $model->andWhere([\''.$key.'\'=>$_POST[\''.$key.'\']]);
            }'."\n";
        }

    }

}?>
        //排序
        $sort = '<?=$pks?> desc';
        if (isset($_POST['sort'])) {
            if ($_POST['sort']) {
                $sort=str_replace('|'," ",$_POST['sort']);
            }
        }
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
            echo '      $model=$model->with("'.$table_name.'");'."\n";
            //下拉框需要下的下拉内容
            if($val['add_mode']=="下拉选择" || $val['search_mode']=="下拉选择")
            {
                echo "      $".$table_name."=".$model_class."::find()->asArray()->all();"."\n";
                echo '      $page_data["'.$table_name.'"]=\yii\helpers\ArrayHelper::map($'.$table_name.',"'.$kv_arr[0].'","'.$kv_arr[1].'");'."\n";
            }

        }


    }
}
?>
        $data = $model->orderBy($sort)->asArray()->all();
        //处理列表显示内容
        if ($data) {
            foreach ($data as $key => $v) {
<?
foreach ($tables as $key=>$val)
{
    if($val['show_mode']=="日期时间")
    {
        echo '      $v[\''.$key.'\'] and $data[$key][\''.$key.'\'] = date("Y-m-d H:i:s", $v[\''.$key.'\']);'."\n";
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
                echo '              $data[$key][\''.$key.'_lp\'] = $v["'.$table_name.'"]["'.$s_arr[1].'"];'."\n";
            }else{
                $o_arr=explode(",",$f_arr[1]);
                echo '              $data[$key][\''.$key.'_lp\'] = '.$modelClass.'::get'.$key.'text($v["'.$key.'"]);'."\n";


            }
        }
    }
}?>
            }
        }
        $PHPExcel=new \PHPExcel();
        $write = new PHPExcel_Writer_Excel5($PHPExcel);
        $sheet=$PHPExcel->getActiveSheet();  //获得当前获得sheet的操作对象
        $sheet->setTitle('<?=$modelClass?>');   //设置名称
        $start="A";
        $c_start=1;
        $giishow=new <?=$modelClass?>();
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
<?}?>
}
