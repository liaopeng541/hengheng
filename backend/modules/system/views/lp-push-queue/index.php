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
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="lp-push-queue-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("lp-push-queue/index")?>','id':'lp-push-queue'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                <th lay-data="{field:'id',sort: true}">ID</th>

                <th lay-data="{field:'title'}">推送标题</th>

                <th lay-data="{field:'content'}">推送内容</th>

                <th lay-data="{field:'user_id'}">推送账号</th>

                <th lay-data="{field:'img',templet:'#imgTpl'}">图片</th>

                <th lay-data="{field:'type',sort: true,templet:'#typeTpl'}">推送类型</th>

                <th lay-data="{field:'status',templet:'#statusTpl'}">状态</th>   

            </tr>
            </thead>
        </table>
        
    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>

            <script type="text/html" id="imgTpl">
                <div class="lp-col-center ">
                    <div {{# if(d.img){}}class="lp-zoom" {{# }}}>
                        <img src="{{# if(d.img){}}{{d.img}}{{# }else{}}admin/images/avatar.png{{# }}}"
                             jqimg="{{# if(d.img){}}{{d.img}}{{# }else{}}admin/images/avatar.png{{# }}}"
                             {{# if(d.img){}} class="lp-img" {{# }}}>
                    </div>
                </div>
            </script>
                            <script type="text/html" id="typeTpl">
                <div class="lp-col-center">
                    {{ d.type_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="statusTpl">
                <div class="lp-col-center">
                    {{ d.status_lp }}
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

