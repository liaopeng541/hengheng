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
    <style>
        .icon_lists{
            width: 100% !important;

        }

        .icon_lists li{
            float:left;
            width: 100px;
            height:100px;
            text-align: center;
            list-style: none !important;
            cursor: pointer;
        }
        .icon_lists .icon{
            font-size: 42px;
            line-height: 100px;
            margin: 10px 0;
            color:#333;
            -webkit-transition: font-size 0.25s ease-out 0s;
            -moz-transition: font-size 0.25s ease-out 0s;
            transition: font-size 0.25s ease-out 0s;

        }
        .name,.code{
            display: none;
        }




    </style>
</head>
<body>
<div class="container-fluid larry-wrapper">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">

                <ul class="icon_lists clear">

                    <li>
                        <i class="icon iconfont">&#xe60d;</i>
                        <div class="name">品牌</div>
                        <div class="code">&#xe60d;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe60a;</i>
                        <div class="name">下载</div>
                        <div class="code">&#xe60a;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe63a;</i>
                        <div class="name">邮箱</div>
                        <div class="code">&#xe63a;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe60f;</i>
                        <div class="name">等级</div>
                        <div class="code">&#xe60f;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe64b;</i>
                        <div class="name">退出</div>
                        <div class="code">&#xe64b;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe64c;</i>
                        <div class="name">草稿箱</div>
                        <div class="code">&#xe64c;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe611;</i>
                        <div class="name">文章</div>
                        <div class="code">&#xe611;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe631;</i>
                        <div class="name">商品</div>
                        <div class="code">&#xe631;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe610;</i>
                        <div class="name">分类</div>
                        <div class="code">&#xe610;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe696;</i>
                        <div class="name">all</div>
                        <div class="code">&#xe696;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe74d;</i>
                        <div class="name">统计</div>
                        <div class="code">&#xe74d;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe632;</i>
                        <div class="name">标签</div>
                        <div class="code">&#xe632;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe64a;</i>
                        <div class="name">日志</div>
                        <div class="code">&#xe64a;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe649;</i>
                        <div class="name">新增</div>
                        <div class="code">&#xe649;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe612;</i>
                        <div class="name">品牌</div>
                        <div class="code">&#xe612;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe6bc;</i>
                        <div class="name">文章</div>
                        <div class="code">&#xe6bc;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe653;</i>
                        <div class="name">编辑</div>
                        <div class="code">&#xe653;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe60b;</i>
                        <div class="name">图片</div>
                        <div class="code">&#xe60b;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe613;</i>
                        <div class="name">分类</div>
                        <div class="code">&#xe613;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe62c;</i>
                        <div class="name">07</div>
                        <div class="code">&#xe62c;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe62f;</i>
                        <div class="name">10</div>
                        <div class="code">&#xe62f;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe63b;</i>
                        <div class="name">22</div>
                        <div class="code">&#xe63b;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe63c;</i>
                        <div class="name">23</div>
                        <div class="code">&#xe63c;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe63d;</i>
                        <div class="name">24</div>
                        <div class="code">&#xe63d;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe63e;</i>
                        <div class="name">25</div>
                        <div class="code">&#xe63e;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe640;</i>
                        <div class="name">27</div>
                        <div class="code">&#xe640;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe642;</i>
                        <div class="name">29</div>
                        <div class="code">&#xe642;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe668;</i>
                        <div class="name">等级</div>
                        <div class="code">&#xe668;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe651;</i>
                        <div class="name">38</div>
                        <div class="code">&#xe651;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe64e;</i>
                        <div class="name">上翻</div>
                        <div class="code">&#xe64e;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe652;</i>
                        <div class="name">39</div>
                        <div class="code">&#xe652;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe669;</i>
                        <div class="name">评论</div>
                        <div class="code">&#xe669;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe6a1;</i>
                        <div class="name">勾</div>
                        <div class="code">&#xe6a1;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe639;</i>
                        <div class="name">谷歌浏览器</div>
                        <div class="code">&#xe639;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe617;</i>
                        <div class="name">网站</div>
                        <div class="code">&#xe617;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe659;</i>
                        <div class="name">日志</div>
                        <div class="code">&#xe659;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe607;</i>
                        <div class="name">ios浏览器打开</div>
                        <div class="code">&#xe607;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe647;</i>
                        <div class="name">箭头 ↓</div>
                        <div class="code">&#xe647;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe662;</i>
                        <div class="name">51</div>
                        <div class="code">&#xe662;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe616;</i>
                        <div class="name">箭头</div>
                        <div class="code">&#xe616;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe618;</i>
                        <div class="name">箭头</div>
                        <div class="code">&#xe618;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe635;</i>
                        <div class="name">分类</div>
                        <div class="code">&#xe635;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe654;</i>
                        <div class="name">栏目管理</div>
                        <div class="code">&#xe654;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe648;</i>
                        <div class="name">火狐</div>
                        <div class="code">&#xe648;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe683;</i>
                        <div class="name">分类</div>
                        <div class="code">&#xe683;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe655;</i>
                        <div class="name">网站</div>
                        <div class="code">&#xe655;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe672;</i>
                        <div class="name">account</div>
                        <div class="code">&#xe672;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe674;</i>
                        <div class="name">addfriends</div>
                        <div class="code">&#xe674;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe679;</i>
                        <div class="name">eyeopen</div>
                        <div class="code">&#xe679;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe67a;</i>
                        <div class="name">form</div>
                        <div class="code">&#xe67a;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe681;</i>
                        <div class="name">person</div>
                        <div class="code">&#xe681;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe682;</i>
                        <div class="name">phone</div>
                        <div class="code">&#xe682;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe689;</i>
                        <div class="name">set</div>
                        <div class="code">&#xe689;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe68b;</i>
                        <div class="name">share</div>
                        <div class="code">&#xe68b;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe690;</i>
                        <div class="name">paynumber</div>
                        <div class="code">&#xe690;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe636;</i>
                        <div class="name">等级</div>
                        <div class="code">&#xe636;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe608;</i>
                        <div class="name">icon1</div>
                        <div class="code">&#xe608;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe62b;</i>
                        <div class="name">回复 (1)</div>
                        <div class="code">&#xe62b;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe645;</i>
                        <div class="name">商城</div>
                        <div class="code">&#xe645;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe609;</i>
                        <div class="name">icon-passport</div>
                        <div class="code">&#xe609;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe600;</i>
                        <div class="name">首页</div>
                        <div class="code">&#xe600;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe601;</i>
                        <div class="name"> iocn- left</div>
                        <div class="code">&#xe601;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe602;</i>
                        <div class="name">iocn-right</div>
                        <div class="code">&#xe602;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe603;</i>
                        <div class="name">iocn-upward</div>
                        <div class="code">&#xe603;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe604;</i>
                        <div class="name">iocn- down</div>
                        <div class="code">&#xe604;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe605;</i>
                        <div class="name">iocn-see</div>
                        <div class="code">&#xe605;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe606;</i>
                        <div class="name">iocn-address</div>
                        <div class="code">&#xe606;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe60e;</i>
                        <div class="name">iocn-share</div>
                        <div class="code">&#xe60e;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe619;</i>
                        <div class="name">悬浮-分类</div>
                        <div class="code">&#xe619;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe61a;</i>
                        <div class="name">分类svg</div>
                        <div class="code">&#xe61a;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe61b;</i>
                        <div class="name">关闭svg</div>
                        <div class="code">&#xe61b;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe61c;</i>
                        <div class="name">加svg</div>
                        <div class="code">&#xe61c;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe61d;</i>
                        <div class="name">减</div>
                        <div class="code">&#xe61d;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe61e;</i>
                        <div class="name">客服</div>
                        <div class="code">&#xe61e;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe61f;</i>
                        <div class="name">评分</div>
                        <div class="code">&#xe61f;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe620;</i>
                        <div class="name">时间</div>
                        <div class="code">&#xe620;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe621;</i>
                        <div class="name">收藏</div>
                        <div class="code">&#xe621;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe641;</i>
                        <div class="name">售后</div>
                        <div class="code">&#xe641;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe622;</i>
                        <div class="name">悬浮-首页</div>
                        <div class="code">&#xe622;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe623;</i>
                        <div class="name">我的</div>
                        <div class="code">&#xe623;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe624;</i>
                        <div class="name">照片</div>
                        <div class="code">&#xe624;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe625;</i>
                        <div class="name">键盘</div>
                        <div class="code">&#xe625;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe626;</i>
                        <div class="name">删除</div>
                        <div class="code">&#xe626;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe627;</i>
                        <div class="name">收藏1</div>
                        <div class="code">&#xe627;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe628;</i>
                        <div class="name">双下箭头</div>
                        <div class="code">&#xe628;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe629;</i>
                        <div class="name">提醒</div>
                        <div class="code">&#xe629;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe62a;</i>
                        <div class="name">消息1</div>
                        <div class="code">&#xe62a;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe62d;</i>
                        <div class="name">通知</div>
                        <div class="code">&#xe62d;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe62e;</i>
                        <div class="name">换一换</div>
                        <div class="code">&#xe62e;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe633;</i>
                        <div class="name">限时抢购</div>
                        <div class="code">&#xe633;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe634;</i>
                        <div class="name">商品分类</div>
                        <div class="code">&#xe634;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe638;</i>
                        <div class="name">留言</div>
                        <div class="code">&#xe638;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe63f;</i>
                        <div class="name">验证</div>
                        <div class="code">&#xe63f;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe643;</i>
                        <div class="name">手机1</div>
                        <div class="code">&#xe643;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe644;</i>
                        <div class="name">密码</div>
                        <div class="code">&#xe644;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe646;</i>
                        <div class="name">设置1</div>
                        <div class="code">&#xe646;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe69f;</i>
                        <div class="name">时钟1</div>
                        <div class="code">&#xe69f;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe630;</i>
                        <div class="name">团队</div>
                        <div class="code">&#xe630;</div>
                    </li>

                    <li>
                        <i class="icon iconfont">&#xe637;</i>
                        <div class="name">内容</div>
                        <div class="code">&#xe637;</div>
                    </li>

                </ul>


        </div>
    </div>
</div>
<script type="text/javascript" src="admin/js/layui/layui.js"></script>
<script>
    layui.use('jquery',function () {
        var $ = layui.jquery;
        $(".icon_lists li").on('click',function () {
            $(".iconfont").css("font-size","42px")
            $(".iconfont").css("color","#000000")
            $(this).children(".iconfont").css("font-size","100px")
            $(this).children(".iconfont").css("color","#cc0033")
            var data=$(this).children(".code").text();
           // window.parent.getEle
            $(window.parent.document.getElementById("icondata")).attr('data',data);
          //  window.parent.$('#icondata').attr('data',data);
        })
    });
</script>
</body>




</html>
