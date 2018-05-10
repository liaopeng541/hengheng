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
$has_mini_search=false;
$has_search_box=false;
$has_edit = [];
$search_sum=0;
$mini_search_num=0;
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
if($search_sum!=$mini_search_num)
{
    $has_search_box=true;
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
    <link rel="stylesheet" type="text/css" href="admin/src/lpui/ztree/css/metroStyle/metroStyle.css">
    <link rel="stylesheet" type="text/css" href="admin/src/lpui/css/lpui.css">


</head>
<body>

<div class="lp-grid">
    <div class="lp-table-top">
        <div class="layui-btn-group">
        </div>
        <? if ($has_mini_search) { ?>
            <form class="layui-form lp-search-form" action="#">



                <?
                foreach ($giishow['table'] as $key => $val) {
                    if ($val['search_mode'] != "不搜索") {
                        if (isset($val['mini_search_mode']) && $val['mini_search_mode']) {
                            echo $generator->getsearchhtml($val['search_mode'], $key, $val['show_name'], $val["f_key"]);
                        }
                    }
                }
                ?>


                <div class="layui-input-inline">
                    <button lay-submit lp-table="<?=$generator->controllerID?>" lay-filter="search"
                            class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                    <div lp-reset-mini-search lp-table="<?=$generator->controllerID?>"
                         class="layui-btn layui-btn-sm layui-btn-primary"><i
                                class="layui-icon">&#xe639;</i>重置
                    </div>
                </div>

            </form>
        <?}?>
    </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="<?=$generator->controllerID?>-filter" lay-size="sm" lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?= '<?=\yii\helpers\Url::toRoute("' . $generator->controllerID . '/index")?>' ?>','id':'<?=$generator->controllerID?>'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                <?
                foreach ($generator->getColumnNames() as $attribute) {

                    if (isset($giishow['table'][$attribute]['show_mode']) && $giishow['table'][$attribute]['show_mode'] != "不展示") {
                        $lp_data="field:'".$attribute."'";
                        isset($giishow['table'][$attribute]['order']) and $lp_data.=",sort: true";
                        ($giishow['table'][$attribute]['show_mode'] != "可编辑" && $giishow['table'][$attribute]['show_mode'] != "文本") and $lp_data.=",templet:'#".$attribute."Tpl'";
                        $giishow['table'][$attribute]['show_mode'] == "可编辑" and $lp_data.=",edit: 'text'";
                        ?>
                        <th lay-data="{<?=$lp_data?>}"><?=$labels[$attribute]?></th>

                        <?
                    }
                }
                ?>
            </tr>
            </thead>
        </table>
        <?if($has_search_box){?>
            <div class="lp-search-box">

                <div class="lp-search-title">
                    <div class="lp-search-close">
                        <i class="layui-icon">&#xe65b;</i>
                    </div>
                </div>

                <div class="layui-body lp-search-body">
                    <form class="layui-form layui-form-pane" action="#" style="padding: 5px">
                        <?
                        foreach ($giishow['table'] as $key => $val) {
                            if ($val['search_mode'] != "不搜索") {
                                echo $generator->getsearchhtml($val['search_mode'], $key, $val['show_name'], $val["f_key"],1);
                            }
                        }
                        ?>


                        <button style="display: none" lp-table="<?=$generator->controllerID?>" lay-submit lay-filter="search"
                                lp-search-submit></button>

                    </form>


                </div>

                <div class="lp-search-sub-btn">
                    <button class="layui-btn layui-btn-sm layui-btn-default" lp-search-btn><i
                                class="layui-icon">&#xe615;</i>搜 索
                    </button>
                    <button class="layui-btn layui-btn-sm layui-btn-primary" lp-search-box-reset><i
                                class="layui-icon">&#xe639;</i>重 置
                    </button>


                </div>


            </div>
            <div class="lp-sear-btn lp-tip" lp-tip-box="lp-tip">
                <i class="layui-icon">&#xe615;</i> 更多搜索
            </div>
        <?}?>

    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>

<?
foreach ($generator->getColumnNames() as $attribute) {
    if (isset($giishow['table'][$attribute]['show_mode']) && $giishow['table'][$attribute]['show_mode'] != "不展示") {
        if ($giishow['table'][$attribute]['show_mode'] == "开关") {   ?>

            <script type="text/html" id="<?=$attribute?>Tpl">
                <div class="lp-col-center ">
                    <input type="checkbox" lp-data="{url:'<?= '<?=\yii\helpers\Url::toRoute("' . $generator->controllerID . '/setstatus")?>' ?>',id:{{d.<?=$pks?>}},on:'1',off:'0',key:'<?=$pks?>',table:'<?=$generator->controllerID?>'}" name="<?=$attribute?>" lay-skin="switch" lay-filter="<?=$generator->controllerID?>"  title="开关" lay-text="启用|禁用">
                </div>
            </script>

        <?} else if ($giishow['table'][$attribute]['show_mode'] == "图片") {?>
            <script type="text/html" id="<?=$attribute?>Tpl">
                <div class="lp-col-center ">
                    <div {{# if(d.<?=$attribute?>){}}class="lp-zoom"{{# }}}>
                        <img src="{{# if(d.<?=$attribute?>){}}{{d.<?=$attribute?>}}{{# }else{}}admin/images/avatar.png{{# }}}" jqimg="{{# if(d.<?=$attribute?>){}}{{d.<?=$attribute?>}}{{# }else{}}admin/images/avatar.png{{# }}}" {{# if(d.<?=$attribute?>){}} class="lp-img" {{# }}}>
                    </div>
                </div>
            </script>
        <?} else if($giishow['table'][$attribute]['show_mode']=='关联文本'){?>
        <?if(isset($giishow['table'][$attribute]['f_key']) && $giishow['table'][$attribute]['f_key']) {
        $fk = explode(':', $giishow['table'][$attribute]['f_key']);
        if($fk[0]=="key")
        {
        $url_controller = str_replace('_', '-', $fk[1]);
        ?>
            <script type="text/html" id="<?=$attribute?>Tpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?= '<?=\yii\helpers\Url::toRoute("' . $url_controller . '/detail")?>' ?>',area: ['893px', '600px'],title:'详情',key:'<?=$attribute?>'}" >
                    {{ d.<?=$attribute."_lp"?> }}
                </div>
            </script>
        <?}else{?>
            <script type="text/html" id="<?=$attribute?>Tpl">
                <div class="lp-col-center">
                    {{ d.<?=$attribute."_lp"?> }}
                </div>
            </script>
        <?}

        }else{?>
            <script type="text/html" id="<?=$attribute?>Tpl">
                <div class="lp-col-center">
                    {{ d.<?=$attribute?> }}
                </div>
            </script>
        <?}

        ?>

        <?} else if($giishow['table'][$attribute]['show_mode']=='勾选框'){?>
            <script type="text/html" id="<?=$attribute?>Tpl">
                <div class="lp-col-detail">
                    <input lp-data="{url:'<?= '<?=\yii\helpers\Url::toRoute("' . $generator->controllerID . '/setstatus")?>' ?>',id:{{d.<?=$pks?>}},field:'<?=$attribute?>',on:'1',off:'0',key:'<?=$pks?>',table:'<?=$generator->controllerID ?>'}" lay-filter="<?=$generator->controllerID ?>" class="lp-table-checkbox" type="checkbox" name="<?=$attribute?>" title="上架" checked="" lay-text="上架|下架">
                </div>
            </script>
        <?}


    }
}

if ($has_column_btn) {
    ?>

    <script type="text/html" id="barDemo">
        <? if (isset($giishow['column_btn']['detail_btn'])) { ?>
            <a lp-data="{content:'<?= '<?=\yii\helpers\Url::toRoute("' . $generator->controllerID . '/detail")?>' ?>',key:'<?=$pks?>',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"  class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
                <i class="layui-icon">&#xe60a;</i> 查看
            </a>
        <? } ?>
        <? if (isset($giishow['column_btn']['edt_btn'])) { ?>
            <a lp-data="{content:'<?= '<?=\yii\helpers\Url::toRoute("' . $generator->controllerID . '/update")?>' ?>',key:'<?=$pks?>',type:2,maxmin:true,area: ['893px', '600px'],title:'编辑'<?if($has_edit){?>,full:true<?}?>}" class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
            </a>
        <? } ?>
        <? if (isset($giishow['column_btn']['del_btn'])) { ?>
            <a lp-data="{table:'<?=$generator->controllerID?>',key:'<?=$pks?>',url:'<?= '<?=\yii\helpers\Url::toRoute("' . $generator->controllerID . '/delete")?>' ?>'}" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
            </a>
        <? } ?>
    </script>

<? } ?>





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
        lplist: "src/lpui/lplist",
        lp_upimages: "src/lpui/lp_upimages",
        lpform: "src/lpui/lpform"
    })
</script>
<script>
    layui.use(['lpsearchbox', 'jquery', 'element', 'lpui', 'lpzoom', 'lplist','lpform'])
</script>

</html>

