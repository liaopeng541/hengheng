<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\db\ActiveRecordInterface;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$labels = $generator->generateSearchLabels();
$class = $generator->modelClass;
$pks = $class::primaryKey();
$pks = $pks[0];
$giishow = $generator->giishow();
$has_search = false;
$has_add = false;
$has_column_btn = false;
$has_edit=[];
foreach ($giishow['table'] as $key => $val) {
    if ($val['search_mode'] != "不搜索") {
        $has_search = true;
    }
    if ($val['add_mode'] != "不新增") {
        $has_add = true;
    }
    if($val['add_mode']=="富文本")
    {
        $has_edit[]=$key;
    }

}
if (isset($giishow['column_btn'])) {
    $has_column_btn = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>系统后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="admin/src/css/layui.css">
    <link rel="stylesheet" type="text/css" href="admin/src/lpui/css/lpui.css">
</head>


<body>
<div class="container-fluid " style="padding:10px">
    <form class="layui-form layui-form-pane" action="<?= '<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("' . $generator->controllerID . '/update");}else{echo \yii\helpers\Url::toRoute("' . $generator->controllerID . '/add");}?>' ?>" lp-data="{<?='<?if(isset($_GET["id"])){?>'?>type:'edit',key:'<?=$pks?>',value:<?='<?=$_GET["id"]?>'?>,<?='<?}?>'?>table:'<?= $generator->controllerID ?>'}">
        <?
        foreach ($giishow['table'] as $key => $val) {
            if ($val['add_mode'] != "不新增") {
                echo $generator->getsearchhtml($val['add_mode'], $key, $val['show_name'], $val["f_key"], true);

            }

        }
        ?>
        <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                <?='<?if(isset($_GET["id"])){?>'?>
                    <button class="layui-btn" lay-submit lay-filter="edit">保存修改</button>
                    <div  lp-close class="layui-btn layui-btn-primary">关 闭</div>
                <?='<? }else{?>'?>
                    <button class="layui-btn" lay-submit lay-filter="add">立即提交</button>
                    <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
                <?='<?}?>'?>
            </div>
        </div>
    </form>
</div>
</body>
<script src="admin/src/layui.js"></script>
<?if(count($has_edit)>0){?>
    <script src="admin/src/lpui/lib/ueditor/ueditor.config.js"></script>
    <script src="admin/src/lpui/lib/ueditor/ueditor.all.js"></script>
<?}?>
<script>
    layui.config({
        base: 'admin/'
    }).extend({
        lpresize: "src/lpui/lpresize",
        lpsearchbox: "src/lpui/lpsearchbox",
        ztree: "src/lpui/ztree/js/ztree",
        lptree: "src/lpui/lptree",
        lpui: "src/lpui/lpui",
        lpzoom: "src/lpui/lpzoom",
        lp_upimages: "src/lpui/lp_upimages",
        lplist: "src/lpui/lplist",
        lpform: "src/lpui/lpform"
    })
</script>
<script>
    <?
    foreach ($giishow['table'] as $key => $val) {
        if($val['add_mode']=="富文本")
        {
            echo '<?
        if(!isset($_GET["id"])){
    ?>
    UE.getEditor("'.$key.'_edit");
    <?}?>';
        }

    }
    ?>
    layui.use("lpform")



</script>

</html>
