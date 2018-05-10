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
                <h1>新后台系统</h1>
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
                        <cite>
                          <?php if (!Yii::$app->user->isGuest) { echo Yii::$app->user->identity->admin_name; }?>
                        </cite>
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
<script id="menu-tpl" type="text/html" data-params='{"url":"<?=\yii\helpers\Url::toRoute('admin/admin-menu/getmenu')?>","listid":"menu"}'>
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
    var table={};
    var uetool={
        toolbars: [
            [
                //   'anchor', //锚点
                'undo', //撤销
                'redo', //重做
                'bold', //加粗
                'indent', //首行缩进
                //'snapscreen', //截图
                'italic', //斜体
                'underline', //下划线
                'strikethrough', //删除线
                'subscript', //下标
                'fontborder', //字符边框
                'superscript', //上标
                'formatmatch', //格式刷
                //  'source', //源代码
                // 'blockquote', //引用
                'pasteplain', //纯文本粘贴模式
                'selectall', //全选
                //   'print', //打印
                //  'preview', //预览
                'horizontal', //分隔线
                'removeformat', //清除格式
                'time', //时间
                'date', //日期
                'unlink', //取消链接
                //'insertrow', //前插入行
                //'insertcol', //前插入列
                //'mergeright', //右合并单元格
                //'mergedown', //下合并单元格
                //'deleterow', //删除行
                //'deletecol', //删除列
                //'splittorows', //拆分成行
                //'splittocols', //拆分成列
                //'splittocells', //完全拆分单元格
                //'deletecaption', //删除表格标题
                //'inserttitle', //插入标题
                // 'mergecells', //合并多个单元格
                //'deletetable', //删除表格
                'cleardoc', //清空文档
                //   'insertparagraphbeforetable', //"表格前插入行"
                //    'insertcode', //代码语言
                'fontfamily', //字体
                'fontsize', //字号
                'paragraph', //段落格式
                'simpleupload', //单图上传
                'insertimage', //多图上传
                //       'edittable', //表格属性
                //   'edittd', //单元格属性
                'link', //超链接
                //     'emotion', //表情
                //    'spechars', //特殊字符
                'searchreplace', //查询替换
                //   'map', //Baidu地图
                //     'gmap', //Google地图
                'insertvideo', //视频
                //     'help', //帮助
                'justifyleft', //居左对齐
                'justifyright', //居右对齐
                'justifycenter', //居中对齐
                'justifyjustify', //两端对齐
                'forecolor', //字体颜色
                'backcolor', //背景色
                'insertorderedlist', //有序列表
                'insertunorderedlist', //无序列表
                //    'fullscreen', //全屏
                //    'directionalityltr', //从左向右输入
                //     'directionalityrtl', //从右向左输入
                'rowspacingtop', //段前距
                'rowspacingbottom', //段后距
                //      'pagebreak', //分页
                //      'insertframe', //插入Iframe
                'imagenone', //默认
                'imageleft', //左浮动
                'imageright', //右浮动
                'attachment', //附件
                'imagecenter', //居中
                'wordimage', //图片转存
                'lineheight', //行间距
                //      'edittip ', //编辑提示
                //      'customstyle', //自定义标题
                'autotypeset', //自动排版
                //      'webapp', //百度应用
                'touppercase', //字母大写
                'tolowercase', //字母小写
                'background', //背景
                //     'template', //模板
                //      'scrawl', //涂鸦
                'music', //音乐
                //      'inserttable', //插入表格
                //      'drafts', // 从草稿箱加载
                //      'charts', // 图表
            ]
        ],


    }
    layui.use('index');
</script>



</html>