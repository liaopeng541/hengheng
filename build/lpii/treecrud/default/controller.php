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
use backend\models\Tree;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?
$has_model=[];
    foreach ($tables as $val)
    {
        if($val['f_key'])
        {
            $k_arr=explode(':',$val['f_key']);
            if($k_arr[0]=='key')
            {
                $mc=$generator->L_T($k_arr[1],"_");
                if($mc != $modelClass) {
                    if(!in_array($mc,$has_model)) {
                        echo 'use common\\models\\' . $mc . ";";
                        $has_model[]=$mc;
                    }
                }
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
            list($total,$data)=$this->getGrid();
            $list=[];
            $has_search=false;
//筛选条件
<?
foreach ($tables as $key=>$val)
{

    if($val['search_mode']!="不搜索")
    {
        if($val['search_mode']=="文本框")
        {
            echo '            if (isset($_GET[\''.$key.'\']) && $_GET[\''.$key.'\']) {
                $has_search=true;
                foreach ($data as $val)
                {
                    if(strpos($val[\''.$key.'\'],$_GET[\''.$key.'\'])!==false)
                    {
                        $list[]=$val;
                    }
                }
            }'."\n";
        }


    }

}?>
            $has_search or $list=$data;
            $total=count($list);
            $data=array_slice($list,$start,$size);
            $redata['status'] = 200;
            $redata['pages'] = ceil($total / $size);
            $redata['total'] = $total;
            $redata['data']['list'] = $data;
            R($redata);
        }
<?
$data_name='list';
$name="name";
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
            $name=$kv_arr[1];

        }


    }
}
$table_name and $data_name=$table_name;
?>
        list($total,$list)=$this->getGrid();
        $list=\yii\helpers\ArrayHelper::map($list,"<?=$pks?>","<?=$name?>");
        return $this->render('index', ["<?=$data_name?>"=>$list]);
    }
    public function getGrid()
    {
<?
$name="";
$n_arr=[];
$sort="";
foreach ($tables as $key=>$val)
{
    if($val['f_key'])
    {
        $k_arr=explode(':',$val['f_key']);
        if($k_arr[0]=='key')
        {
            $n_arr=explode(">",$k_arr[3]);
        }

    }
    if(isset($val['sort']))
    {
        $sort='->orderBy(\''.$key.' desc\')';
    }

}
if(isset($n_arr[1]))
{
    $name=",".$n_arr[1]." as sub_".$n_arr[1];
}
?>
        $menu = <?=$modelClass?>::find()->select("*<?=$name?>");
        $total=$menu->count();
        $data=$menu<?=$sort?>->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $menulist=array_values($treeObj->getGridTree());
        return [$total,$menulist];
    }
    public function getOneGrid($id)
    {
        list($total,$list)=$this->getGrid();
        foreach ($list as $val)
        {
            if($val['id']==$id)
            {
                return $val;
            }
        }

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
    $name="";
    foreach ($giishow['table'] as $key=>$val)
    {
        if($val['f_key'])
        {
            $f_arr=explode(':',$val['f_key']);
            if($f_arr[0]=='key')
            {
                $kv_arr=explode(">",$f_arr[3]);
                $name=$kv_arr[1];
            }

        }
    }

    foreach ($tables as $key=>$val)
    {

            if($val['show_mode']=="日期时间")
            {
                echo '         $_POST[\''.$key.'\'] and $_POST[\''.$key.'\'] = strtotime($_POST[\''.$key.'\']);'."\n";
            }

    }
            if($name)
            {
                echo '        $_POST[\''.$name.'\']=$_POST[\'sub_'.$name.'\'];'."\n";
            }
    ?>
            $data = ['<?= $modelClass ?>' => $_POST];
            if ($model->load($data) && $model->save()) {
                $this->addLog("添加了<?= $modelClass ?>中<?=$pks?>:[".$model-><?=$pks?>."]的数据:".json_encode($model->attributes));
            $data=$this->getOneGrid($model->id);
            R(['status' => 200, 'msg' => "添加成功", "data" => $data]);
            }
            R(['status' => 100, 'msg' => "添加失败"]);
        }
        <?
        $data_name='list';
        $name="name";
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
                    $name=$kv_arr[1];

                }


            }
        }
        $table_name and $data_name=$table_name;
        ?>
        list($total,$list)=$this->getGrid();
        $list=\yii\helpers\ArrayHelper::map($list,"<?=$pks?>","<?=$name?>");
        return $this->render('form', ["<?=$data_name?>"=>$list]);
    }

    /**
    * <?= $modelClass ?> 更新数据
    */
    public function actionUpdate()
    {
        if (\Yii::$app->request->isAjax) {
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

    }
            if($name)
            {
                echo '        $_POST[\''.$name.'\']=$_POST[\'sub_'.$name.'\'];'."\n";
            }
    ?>
            $data = ['<?= $modelClass ?>' => $_POST];
            if ($model->load($data) && $model->save()) {
                $data=$this->getOneGrid($model->id);
                R(['status' => 200, 'msg' => "修改成功", "data" => [$data]]);
            }
            R(['status' => 100, 'msg' => "修改失败"]);
        }
        <?
        $data_name='list';
        $name="name";
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
                    $name=$kv_arr[1];

                }


            }
        }
        $table_name and $data_name=$table_name;
        ?>
        list($total,$list)=$this->getGrid();
        $list=\yii\helpers\ArrayHelper::map($list,"<?=$pks?>","<?=$name?>");
        return $this->render('form', ["<?=$data_name?>"=>$list]);
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
