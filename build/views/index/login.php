<?php
/**
 * Created by PhpStorm.
 * User: liaopeng
 * Date: 2018/2/27
 * Time: 23:06
 */
use yii\captcha\Captcha;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>新系统后台管理</title>
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


    <style>
        html{
            height: 100%;
        }
    </style>

</head>
<body class="login-bg">
<div class="login">
    <div class="message">新系统管理登录</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class="layui-form"  action="<?=\yii\helpers\Url::toRoute("index/dologin")?>">
        <input name="Login[username]" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="Login[password]" lay-verify="required" placeholder="密码"  autocomplete="new-password"  type="password" class="layui-input">
        <hr class="hr15">
        <input name="Login[verify]" placeholder="验证码"  type="text" lay-verify="required" class="layui-input layui-input-inline"
               style="width: 50%"
        >
        <div class="layui-input-inline" style="width:48%;"> <?= Captcha::widget(['name' => 'captchaimg', 'captchaAction' => '/index/captcha', 'imageOptions' => [
                'title' => '看不清楚，点击更换验证码', 'id' => "codeimage", 'alt' => '换一个'], 'template' => '{image}']); ?></div>
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20" >
    </form>
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
</script>
<script>
    layui.use('simpleform');
    layui.use('jquery',function () {
        var $ = layui.jquery;
        $("#codeimage").on('click',function () {
            $.get("<?=\yii\helpers\Url::toRoute('index/captcha')?>&refresh=1",function (data,status) {
                $("#codeimage").attr('src',data.url)
            })
        })



    });


</script>

</html>
