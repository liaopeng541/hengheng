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
    <style type="text/css">
        
        .lp-col-center img {
            width: 64px;
        }
    </style>

</head>
<body>

<div class="lp-grid">
    <div class="lp-table-top">
        <div class="layui-btn-group"></div>
        <form class="layui-form lp-search-form" action="#">


        <div class="layui-inline">
                    
            <div class="layui-input-inline">
                <input class="layui-input" name="title" placeholder="推送标题" />
            </div>
        </div>
                <div class="layui-inline">
                    
                    <div class="layui-input-inline">
                        <select name="status" placeholder="推送状态">
                            <option value="">请选择推送状态</option>
                            <option value="0">未推送</option>
                            <option value="1">已推送</option>
                            <option value="2">推送失败</option>

                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    
                    <div class="layui-input-inline">
                        <select name="is_read" placeholder="是否阅读">
                            <option value="">请选择是否阅读</option>
                            <option value="0">未读</option>
                            <option value="1">已读</option>

                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    
                    <div class="layui-input-inline">
                        <select name="type" placeholder="类型">
                            <option value="">请选择类型</option>
                            <option value="1">线下订单详情</option>
                            <option value="2">账户流水</option>
                            <option value="3">后备箱使用记录</option>
                            <option value="4">充值</option>
                            <option value="5">我的洗车卡</option>
                            <option value="6">商品详情</option>
                            <option value="7">会员详情</option>
                            <option value="8">员工详情</option>
                            <option value="9">网页跳转</option>

                        </select>
                    </div>
                </div>
                        

                <div class="layui-input-inline">
                    <button lay-submit lp-table="hh-push-queue" lay-filter="search"
                            class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                    <div lp-reset-mini-search lp-table="hh-push-queue"
                         class="layui-btn layui-btn-sm layui-btn-primary"><i
                                class="layui-icon">&#xe639;</i>重置
                    </div>
                </div>

            </form>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="hh-push-queue-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("hh-push-queue/index")?>','id':'hh-push-queue'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                <th lay-data="{field:'id',sort: true,width:80,align:'center'}">ID</th>

                <th lay-data="{field:'type',sort: true,templet:'#typeTpl'}">类型</th>

                <th lay-data="{field:'url'}">跳转地址</th>

                <th lay-data="{field:'title'}">推送标题</th>

                <th lay-data="{field:'image',templet:'#imageTpl'}">图片</th>

                <th lay-data="{field:'desc'}">描述</th>

                <th lay-data="{field:'send_time',templet:'#send_timeTpl'}">推送时间</th>

                <th lay-data="{field:'status',templet:'#statusTpl'}">推送状态</th>

                <th lay-data="{field:'user_id'}">推送账号</th>

                <th lay-data="{field:'level_id'}">等级</th>

                <th lay-data="{field:'is_read',templet:'#is_readTpl'}">是否阅读</th>  
            </tr>
            </thead>
        </table>
        
    </div>
</div>

</body>
<script src="admin/src/layui.js"></script>

<script type="text/html" id="typeTpl">
    <div class="lp-col-center">
        {{ d.type_lp }}
    </div>
</script>

<script type="text/html" id="imageTpl">
    <div class="lp-col-center ">
        <div {{# if(d.image){}}class="lp-zoom" {{# }}}>
            <img src="{{# if(d.image){}}{{d.image}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 jqimg="{{# if(d.image){}}{{d.image}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 {{# if(d.image){}} class="lp-img" {{# }}}>
        </div>
    </div>
</script>
<script type="text/html" id="statusTpl">
    <div class="lp-col-center">
        {{ d.status_lp }}
    </div>
</script>

<script type="text/html" id="is_readTpl">
    <div class="lp-col-center">
        {{ d.is_read_lp }}
    </div>
</script>
        
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
layui.use(['lpsearchbox', 'jquery', 'element', 'lpui', 'lpzoom', 'lplist', 'lpform'])
</script>

</html>

