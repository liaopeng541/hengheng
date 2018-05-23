<?php
/**
 * Created by PhpStorm.
 * User: liaopeng
 * Date: 2018/2/27
 * Time: 23:06
 */
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



</head>
<body>
<div class="container-fluid larry-wrapper">


    <div class="row">
        <div class="col-xs-12 col-md-6">
            <blockquote class="layui-elem-quote"><?=$message?></blockquote>
        </div>




    </div>

</div>

</body>
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
    layui.use("jquery",function(){
        $=layui.jquery;
        if("<?=$message?>"=="请重新登录"){
            if (self != top) {
            parent.location.href="<?=\yii\helpers\Url::toRoute("index/login")?>"
            }else {
                location.href="<?=\yii\helpers\Url::toRoute("index/login")?>"
            }
        }


    })
</script>
</html>
