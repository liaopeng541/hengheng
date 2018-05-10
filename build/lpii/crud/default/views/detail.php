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
$has_pics = false;
$has_mini_search = false;
$has_search_box = false;
$has_edit = [];
$search_sum = 0;
$mini_search_num = 0;
foreach ($giishow['table'] as $key => $val) {
    if ($val['search_mode'] != "不搜索") {
        $has_search = true;
        $search_sum++;
    }
    if (isset($val['mini_search_mode']) && $val['mini_search_mode']) {
        $has_mini_search = true;
        $mini_search_num++;
    }
    if ($val['add_mode'] != "不新增") {
        $has_add = true;
    }
    if ($val['add_mode'] == "图集") {
        $has_pics = true;
    }
    if ($val['add_mode'] == "富文本") {
        $has_edit[] = $key;
    }

}
if ($search_sum != $mini_search_num) {
    $has_search_box = true;
}

if (isset($giishow['column_btn'])) {
    $has_column_btn = true;
}
?><!DOCTYPE html>
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
<div class="lp-detail-box">
    <?
    foreach ($giishow['table'] as $key => $val) {
        if (isset($val['detail']) && $val['detail']) {
            $content="";
            if (isset($val['f_key']) && $val['f_key']) {
                $content.='<?=$data["'.$key.'_lp"]?>';
            }else if ($val['add_mode'] == "图片" || $val['show_mode'] == "图片") {
                $content.='<div style="padding: 5px" id="original_img_box">
                        <ul class="lp_upfile_list">'."\n";
                $content.='<?if($data["'.$key.'"]){?><li id="item-1" class="lp_upfile_itme">
                                <img id="item-img-1" src="<?=$data["'.$key.'"]?>" style="display: inline-block;">
                            </li><?}?>'."\n";
                $content.='<div style="clear: both"></div>
                        </ul>
                    </div>';
            }else if ($val['add_mode'] == "图集") {
                $content.='<div style="padding: 5px" id="original_img_box">
                        <ul class="lp_upfile_list">'."\n";
                $content.='<?$content="";
                                if($data["'.$key.'"]){
                                foreach ($data["'.$key.'"] as $key=>$val)
                                {
                                    $content.=\'<li id="item-\'.$key.\'" class="lp_upfile_itme">
                                <img id="item-img-\'.$key.\'" src="\'.$val.\'" style="display: inline-block;">
                            </li>\';
                                }}\n echo $content?>'."\n";
                $content.='<div style="clear: both"></div>
                        </ul>
                    </div>';
            }else{
                $content.='<?=$data["'.$key.'"]?>';
            }
            ?>


            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        <?= $labels[$key]."\n" ?>
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$content?>


                </div>
            </div>
        <? }
    } ?>




</div>


</body>
<script src="admin/src/layui.js"></script>


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
        lplist: "src/lpui/lplist"
    })
</script>
<script>
    layui.use(['jquery'], function () {
        var $ = layui.jquery;


    })

</script>

</html>
