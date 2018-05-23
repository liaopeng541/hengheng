<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\db\ActiveRecordInterface;
/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$labels=$generator->generateSearchLabels();
$class = $generator->modelClass;
$pks = $class::primaryKey();
$pks=$pks[0];
$giishow=$generator->giishow();
$has_search=false;
$has_add=false;
$has_column_btn=false;
$has_pics=false;
$has_edit=[];
foreach ($giishow['table'] as $key=>$val)
{
    if($val['search_mode']!="不搜索")
    {
        $has_search=true;
    }
    if($val['add_mode']!="不新增")
    {
        $has_add=true;
    }
    if ($val['add_mode'] == "图集") {
        $has_pics = true;
    }
    if($val['add_mode']=="富文本")
    {
        $has_edit[]=$key;
    }

}
if(isset($giishow['column_btn']))
{
    $has_column_btn=true;
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
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <!--头部搜索-->
            <? if($has_search){?>
            <section class="panel panel-padding">
                <form class="layui-form" data-params='{"dataName":"<?=$generator->controllerID?>","action":"list"}' action="<?='<?=\yii\helpers\Url::toRoute("'.$generator->controllerID.'/index")?>'?>">
                    <div class="layui-form">
                        <?
                        foreach ($giishow['table'] as $key=>$val)
                        {
                            if($val['search_mode']!="不搜索")
                            {
                                echo $generator->getsearchhtml($val['search_mode'],$key,$val['show_name'],$val["f_key"]);
                            }
                        }
                        ?>
                        <div class="layui-inline">
                            <button lay-submit class="layui-btn" lay-filter="search">查找</button>
                        </div>
                    </div>
                </form>
            </section>
            <?}?>

            <!--列表-->
            <section class="panel panel-padding">
                <div class="group-button">
                    <?if($has_add && isset($giishow['top_btn']['add_btn'])){?>
                        <button class="layui-btn layui-btn-small modal"
                                data-params='{"content":"<?= '<?=\yii\helpers\Url::toRoute("' . $generator->controllerID . '/add")?>' ?>",<?if(!$has_edit){?>"area":"800px,400px",<?}?> "title":"添加","type":"2","dataName":"<?= $generator->controllerID ?>","key":"<?= $pks ?>"}'>
                            <i class="iconfont">&#xe649;</i> 添加
                        </button>
                    <?}?>
                    <?if(isset($giishow['top_btn']['dis_btn'])){?>
                        <?

                            $key_name="";
                            $data="status=1";
                            foreach ($giishow['table'] as $key=>$val)
                            {
                                if($val['show_mode']=="开关")
                                {
                                    $key_name=$key;
                                }
                            }
                            if($key_name)
                            {
                                $data='k='.$key_name."&".$key_name."_v=1";
                            }

                        ?>
                    <button class="layui-btn layui-btn-small layui-btn-normal ajax-all" data-params='{"url": "<?='<?=\yii\helpers\Url::toRoute("'.$generator->controllerID.'/setstatus")?>'?>","data":"<?=$data?>","dataName":"<?=$generator->controllerID?>","key":"<?=$pks?>"}'>
                        <i class="layui-icon">&#x1005;</i> 启用
                    </button>
                    <?}?>
                    <?if(isset($giishow['top_btn']['dis_btn'])){?>
                        <?
                        if($key_name){
                            $d_data='k='.$key_name."&".$key_name."_v=0";
                        }
                        ?>
                    <button class="layui-btn layui-btn-small layui-btn-warm ajax-all" data-params='{"url": "<?='<?=\yii\helpers\Url::toRoute("'.$generator->controllerID.'/setstatus")?>'?>","data":"<?=$d_data?>","dataName":"<?=$generator->controllerID?>","key":"<?=$pks?>"}'>
                        <i class="layui-icon">&#x1005;</i> 禁用
                    </button>
                    <?}?>
                    <?if(isset($giishow['top_btn']['del_btn'])){?>
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" data-params='{"url": "<?='<?=\yii\helpers\Url::toRoute("'.$generator->controllerID.'/delete")?>'?>","dataName":"<?=$generator->controllerID?>","key":"<?=$pks?>","action":"del","confirm":"true","title":"您确定要删除多条记录么？"}'>
                        <i class="iconfont">&#xe626;</i> 删除
                    </button>
                    <?}?>
                </div>
                <div class="layui-form">
                    <table id="example" class="layui-table jq-even" data-params='{"dataName":"<?=$generator->controllerID?>","key":"<?=$pks?>"}'>
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="checkall" data-name="<?=$pks?>" lay-filter="check" lay-skin="primary"></th>
                            <?
                            foreach ($generator->getColumnNames() as $attribute) {

                                if(isset($giishow['table'][$attribute]['show_mode']) && $giishow['table'][$attribute]['show_mode']!="不展示") {
                                    if(isset($giishow['table'][$attribute]['order']))
                                    {
                                        echo '                            <th><span class="order" data-params=\'{"field":"'.$attribute.'","sort":"asc"}\'> '.$labels[$attribute].'</span></th>'."\n";
                                    }else{
                                        echo '                            <th>'.$labels[$attribute].'</th>'."\n";
                                    }}
                            }
                            if($has_column_btn){
                            ?>
                            <th width="260">操作</th>
                            <?}?>
                        </tr>
                        </thead>
                        <tbody id="list"></tbody>
                    </table>
                </div>

                <div class="text-right" id="page"></div>
            </section>
        </div>
    </div>
</div>
<div class="add-subcat">
    <form id="form1" class="layui-form layui-form-pane" data-params='{"dataName":"<?=$generator->controllerID?>","key":"<?=$pks?>","action":"add"}' action="#" method="POST">
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
                <button class="layui-btn" jq-submit jq-filter="submit" lp-sub>立即提交</button>
                <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
</body>
<script id="list-tpl" type="text/html" data-params='{"url":"<?='<?=\yii\helpers\Url::toRoute("'.$generator->controllerID.'/index")?>'?>","dataName":"<?=$generator->controllerID?>","key":"<?=$pks?>","pageid":"#page","server":"true"}'>

    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td><input type="checkbox" name="<?=$pks?>" value="{{ item.<?=$pks?>}}" lay-skin="primary"></td>

        <?
            $count = 0;
            foreach ($generator->getColumnNames() as $attribute) {
                if(isset($giishow['table'][$attribute]['show_mode']) &&$giishow['table'][$attribute]['show_mode']!="不展示") {
                        if($giishow['table'][$attribute]['show_mode']=="开关")
                        {
                            echo '<td><input type="checkbox" name="'.$attribute.'_v" lay-skin="switch" lay-text="启用|禁用" value="1" {{#if (item.'.$attribute.'>0){ }}checked="checked" {{# } }} lay-filter="ajax" data-params=\'{"url":"<?=\yii\helpers\Url::toRoute("'.$generator->controllerID.'/setstatus")?>","data":"'.$pks.'={{ item.'.$pks.'}}&k='.$attribute.'","action":"edit"}\'></td>'."\n";
                        }else if($giishow['table'][$attribute]['show_mode']=="图片"){
                            echo '<td><div class="img">{{# if(item.' . $attribute . '){}}<img src="{{item.' . $attribute . '}}" alt="..." class="img-thumbnail">{{# }}}</div></td>' . "\n";
                        }else if($giishow['table'][$attribute]['show_mode']=="可编辑") {
                            echo '<td class="edit" data-params=\'{"url":"<?=\yii\helpers\Url::toRoute("'.$generator->controllerID.'/setstatus")?>","data":"'.$pks.'={{ item.'.$pks.'}}&k='.$attribute.'&type=set","field":"'.$attribute.'_v","input_width":"50px"}\'>{{ item.'.$attribute.'}}</td>'."\n";

                        }else if($giishow['table'][$attribute]['show_mode']=='文本' || $giishow['table'][$attribute]['show_mode']=='关联文本'){
                            echo '<td>
<p class="lp-onelinetext" title="{{# if(item.' . $attribute . ' != null && item.' . $attribute . ' != undefined){}}{{ item.' . $attribute . '}}{{#}}}">{{# if(item.' . $attribute . ' != null && item.' . $attribute . ' != undefined){}}{{ item.' . $attribute . '}}{{#}}}</p>
</td>';
                        }else{
                            if($giishow['table'][$attribute]['f_key'])
                            {
                                $attribute=$attribute.'_lp';
                            }
                            echo '<td>{{# if(item.' . $attribute . ' != null && item.' . $attribute . ' != undefined){}}{{ item.' . $attribute . '}}{{#}}}</td>' . "\n";
                        }

                    }
            }
        if($has_column_btn){

        ?>

        <td style="text-align: center">
            <?if(isset($giishow['column_btn']['edt_btn'])){?>
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini modal"
                        data-params='{"content": "<?= '<?=\yii\helpers\Url::toRoute("' . $generator->controllerID . '/update")?>' ?>",<?if(!$has_edit){?>"area":"800px,400px",<?}?>"title":"编辑","data":"<?= $pks ?>={{item.<?= $pks ?>}}","type":"2"}'>
                    <i class="iconfont">&#xe653;</i>编辑
                </button>
            </div>
            <?}?>
            <?if(isset($giishow['column_btn']['del_btn'])){?>
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini layui-btn-danger ajax" data-params='{"url": "<?='<?=\yii\helpers\Url::toRoute("'.$generator->controllerID.'/delete")?>'?>","data":"<?=$pks?>={{item.<?=$pks?>}}","action":"del","confirm":"true","title":"您确定要删除这条记录么？"}'>
                    <i class="iconfont">&#xe626;</i>删除
                </button>
            </div>
            <?}?>
        </td>
        <?}?>
    </tr>
    {{# }); }}
</script>
<script src="admin/js/layui/layui.js"></script>
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
    layui.use('list');
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
</script>

</html>
