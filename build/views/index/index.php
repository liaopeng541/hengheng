<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>系统后台管理</title>
    <meta name="description" content="廖鹏" />
    <meta name="keywords" content="廖鹏" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <!-- load css -->
    <link rel="stylesheet" type="text/css" href="admin/css/font/iconfont.css?v=1.0.0" media="all">
    <link rel="stylesheet" type="text/css" href="admin/css/layui.css?v=1.0.9" media="all">
    <link rel="stylesheet" type="text/css" href="admin/css/jqadmin.css?v=2.0.0" media="all">
</head>

<body>
<ul class='right-click-menu'>
    <li><a href='javascript:;' data-event='fresh'>刷新</a></li>
    <li><a href='javascript:;' data-event='close'>关闭</a></li>
    <li><a href='javascript:;' data-event='other'>关闭其它</a></li>
    <li><a href='javascript:;' data-event='all'>全部关闭</a></li>
</ul>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <!-- logo区域 -->
        <div class="jqadmin-logo-box">
            <a class="logo" href="#" title="廖鹏">
                <h1>代码生成系统</h1>
            </a>
            <div class="menu-type"><i class="iconfont">&#xe61a;</i></div>
        </div>

        <!-- 主菜单区域 -->
        <div class="jqadmin-main-menu">
            <ul class="layui-nav clearfix" id="menu" lay-filter="main-menu">

            </ul>

        </div>

        <!-- 头部右侧导航 -->
        <div class="header-right">
            <ul class="layui-nav jqadmin-header-item right-menu">
                <li class="layui-nav-item first">
                    <a href="javascript:;">
                        <cite> <?if (!Yii::$app->user->isGuest) { echo Yii::$app->user->identity->admin_name; }?></cite>
                        <span class="layui-nav-more"></span>
                    </a>

                    <dl class="layui-nav-child">
                        <!--<dd class="tab-menu">
                            <a href="javascript:;" data-url="user-info.html" data-title="个人信息"> <i class="iconfont " data-icon='&#xe672;'>&#xe672; </i><span>个人信息</span></a>
                        </dd>-->
                        <dd>
                            <a href="<?=\yii\helpers\Url::toRoute('index/loginout')?>"><i class="iconfont ">&#xe64b; </i>退出</a>
                        </dd>
                    </dl>
                </li>
                <!--<li class="layui-nav-item tab-menu"><a class="msg" href="javascript:;" data-url="msg.html" data-title="站内信息"><i class="iconfont" data-icon='&#xe63c;'>&#xe63c; </i><span class="msg-num">1</span></a></li>-->
            </ul>
            <button title="刷新" class="layui-btn layui-btn-normal fresh-btn"><i class="iconfont">&#xe62e; </i> </button>
        </div>
    </div>

    <!-- 左侧导航-->
    <div class="layui-side layui-bg-black jqamdin-left-bar">
        <div class="layui-side-scroll">
            <!--子菜单项-->

            <div id="submenu"></div>
        </div>
    </div>

    <!-- 左侧侧边导航结束 -->
    <!-- 右侧主体内容 -->
    <div class="layui-body jqadmin-body">

        <div class="layui-tab layui-tab-card jqadmin-tab-box" id="jqadmin-tab" lay-filter="tabmenu" lay-notAuto="true">
            <ul class="layui-tab-title">
                <li class="layui-this" id="admin-home" lay-id="0" fresh=1><i class="iconfont">&#xe622;</i><em>后台首页</em></li>

            </ul>
            <div class="menu-btn" title="显示左则菜单">
                <i class="iconfont">&#xe616;</i>
            </div>
            <div class="tab-move-btn">
                <span>更多<i class="iconfont">&#xe604;</i></span>

                <!--<span class="move-left-btn"><i class="iconfont">&#xe616;</i></span>
                <span class="move-right-btn"><i class="iconfont ">&#xe618;</i></span>-->
            </div>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe class="jqadmin-iframe" data-id='0' src="<?=\yii\helpers\Url::toRoute('index/home')?>"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部区域 -->
    <div class="layui-footer jqadmin-foot">
        <div class="layui-mian">
            <p class="jqadmin-copyright">
                <span class="layui">2018 &copy;</span> Write by liaopeng,<a href="#">廖鹏</a>. 版权所有 <span class="layui"></span>
                <button type="button" class="layui-btn  layui-btn-small my-tips"> <i class="iconfont">&#xe630;</i> 联系我</button>
            </p>
        </div>
    </div>
</div>
<div class="my-tip">

</div>
<ul class="menu-list" id="menu-list"></ul>
</body>
<script id="menu-tpl" type="text/html" data-params='{"url":"<?=\yii\helpers\Url::toRoute('index/getmenu')?>","listid":"menu"}'>
    {{# layui.each(d.list, function(index, item){ }}
    <li class="layui-nav-item {{# if(index==0){ }}layui-this{{# } }}">
        <a href="javascript:;" data-title="{{item.name}}"><i class="iconfont  {{# if(!d.showIcon){ }} hide-icon  {{# } }}">{{item.iconfont}}</i><span>{{item.name}}</span></a>
    </li>
    {{# }); }}
</script>

<script id="submenu-tpl" type="text/html">
    {{# layui.each(d.list, function(index, menu){ }}
    <div class="sub-menu">
        <ul class="layui-nav layui-nav-tree">
            {{# layui.each(menu.sub, function(index, submenu){ }} {{# if(submenu.sub && submenu.sub.length>0){ }}
            <li class="layui-nav-item" data-bind="0">
                <a href="javascript:;" data-title="{{submenu.name}}">
                    <i class="iconfont {{# if(!d.showIcon){ }} hide-icon  {{# } }}">{{submenu.iconfont}}</i>
                    <span>{{submenu.name}}</span>
                    <em class="layui-nav-more"></em>
                </a>
                <dl class="layui-nav-child">
                    {{# layui.each(submenu.sub, function(index, secMenu){ }}
                    <dd>
                        <a href="javascript:;" data-url="{{secMenu.url}}" data-title="{{secMenu.name}}">
                            <i class="iconfont  {{# if(!d.showIcon){ }} hide-icon  {{# } }}" data-icon='{{secMenu.iconfont}}'>{{secMenu.iconfont}}</i>
                            <span>{{secMenu.name}}</span>
                        </a>
                    </dd>
                    {{# }); }}
                </dl>
            </li>
            {{# }else{ }}
            <li class="layui-nav-item">
                <a href="javascript:;" data-url="{{submenu.url}}" data-title="{{submenu.name}}">
                    <i class="iconfont  {{# if(!d.showIcon){ }} hide-icon  {{# } }}" data-icon='{{submenu.iconfont}}'>{{submenu.iconfont}}</i>
                    <span>{{submenu.name}}</span>
                </a>
            </li>
            {{# } }} {{# }); }}
        </ul>
    </div>
    {{# }); }}
</script>
<script id="menu-list-tpl" type="text/html">

    {{# layui.each(d.list, function(index, item){ }}
    <li>
        <a href="javascript:;" data-url="{{item.href}}" data-title="{{item.title}}">
            <i class="iconfont " data-icon='{{item.icon}}'>{{item.icon}}</i>
            <span>{{item.title}}</span>
        </a>
    </li>
    {{# }); }}

</script>
<script type="text/javascript" src="admin/js/layui/layui.js"></script>
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
    var global = {};
    layui.use('index');
</script>



</html>