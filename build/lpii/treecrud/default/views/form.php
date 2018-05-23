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
    <!-- load css -->
    <link rel="stylesheet" type="text/css" href="admin/css/bootstrap.min.css?v=v3.3.7" media="all">
    <link rel="stylesheet" type="text/css" href="admin/css/font/iconfont.css?v=1.0.1" media="all">
    <link rel="stylesheet" type="text/css" href="admin/css/layui.css?v=1.0.9" media="all">
    <link rel="stylesheet" type="text/css" href="admin/css/main.css?v1.4.0" media="all">
    <script src="admin/js/laydate/laydate.js"></script>
</head>


<body>
<div class="container-fluid larry-wrapper">
    <form id="form1" class="layui-form layui-form-pane"
          data-params='{"dataName":"<?= $generator->controllerID ?>","key":"<?= $pks ?>",<?='<?if(isset($_GET["'.$pks.'"])){?>'?>"action":"edit","bind":true<?='<? }else{?>'?>"action":"add"<?='<?}?>'?>}' action="<?= '<?=isset($_GET["'.$pks.'"])?\yii\helpers\Url::toRoute("' . $generator->controllerID . '/update"):\yii\helpers\Url::toRoute("' . $generator->controllerID . '/add")?>' ?>"
          method="POST">
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
        foreach ($giishow['table'] as $key=>$val)
        {
            if($val['add_mode']!="不新增")
            {
                if($name && $name==$key)
                {
                    $key="sub_".$key;
                }
                echo $generator->getsearchhtml($val['add_mode'],$key,$val['show_name'],$val["f_key"],true);

            }

        }
        ?>
        <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                <?='<?if(isset($_GET["'.$pks.'"])){?>'?>
                <button class="layui-btn" jq-submit jq-filter="submit" lp-sub>保存修改</button>
                <div  lp-close class="layui-btn layui-btn-primary">关 闭</div>
                <?='<? }else{?>'?>
                <button class="layui-btn" jq-submit jq-filter="submit" lp-sub>立即提交</button>
                <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
                <?='<?}?>'?>
            </div>
        </div>
    </form>
</div>
</body>
<script src="admin/js/layui/layui.js"></script>
<?if(count($has_edit)>0){?>
<script src="admin/js/lib/ueditor/ueditor.config.js"></script>
<script src="admin/js/lib/ueditor/ueditor.all.min.js"></script>
<?}?>
<script>
    layui.config({
        base: 'admin/js/',
        version: "2.0.0"
    }).extend({
        jqelem: 'jqmodules/jqelem',
        jqmenu: 'jqmodules/jqmenu',
        tabmenu: 'jqmodules/tabmenu',
        jqajax: 'jqmodules/jqajax',
        jqtable: 'jqmodules/jqtable',
        jqbind: 'jqmodules/jqbind',
        jqdate: 'jqmodules/jqdate',
        jqtags: 'jqmodules/jqtags',
        jqform: 'jqmodules/jqform',
        echarts: 'lib/echarts',
        webuploader: 'lib/webuploader',
        jqcitys: "jqmodules/jqcitys",
        simpleform: "jqmodules/simpleform"
    })
</script>
<script>
    layui.use('lp_edit');
    laydate.render({
        elem: '.date_time',
        format: 'yyyy-MM-dd HH:mm:ss',
        type: 'datetime'
    });
    laydate.render({
        elem: '.date',
        format: 'yyyy-MM-dd',
        type: 'date'
    });
    laydate.render({
        elem: '.time',
        format: 'HH:mm:ss',
        type: 'time'
    });
    laydate.render({
        elem: '.add_date_time',
        format: 'yyyy-MM-dd HH:mm:ss',
        type: 'datetime'
    });
    laydate.render({
        elem: '.add_date',
        format: 'yyyy-MM-dd',
        type: 'date'
    });
    laydate.render({
        elem: '.add_time',
        format: 'HH:mm:ss',
        type: 'time'
    });
    <? if(isset($giishow['bottom_btn']['export_btn'])){?>
    layui.use(['jquery','layer'],function () {
        var $ = layui.jquery;
        var layer=layui.layer;
        $(".lp-export").on("click",function () {
            var table = top.global['<?= $generator->controllerID ?>'];
            var url=table.options.url;
            url=url.replace("index&","exportexcel&");
            var index=layer.msg('加载中', {
                icon: 16
                ,shade: 0.4,
                time:20000,
            });
            var $form = $('<form method="POST"></form>');
            $form.attr('action', url);
            $form.appendTo($('body'));
            $form.submit();
            layer.close(index);
        })


    })

    <?}?>
</script>

</html>
