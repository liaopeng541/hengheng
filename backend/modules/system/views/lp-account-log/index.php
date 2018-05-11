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
                                                                <button class="layui-btn layui-btn-sm lp-drop-btn" style="background:#9B59B6"><i
                            class="layui-icon"></i>导出<i class="layui-icon">&#xe625;</i>
                    <div class="lp-drop-box">
                        <dl>
                            <dd lp-data="{table:'lp-account-log',url:'<?=\yii\helpers\Url::toRoute("lp-account-log/exportexcel")?>'}">
                                <i class="layui-icon">&#xe62d;</i><span>excel文件</span></dd>
                        </dl>
                    </div>
                </button>
            

        </div>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="lp-account-log-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("lp-account-log/index")?>','id':'lp-account-log'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                                        <th lay-data="{field:'user_id',templet:'#user_idTpl'}">用户</th>

                                                <th lay-data="{field:'user_money'}">用户金额</th>

                                                <th lay-data="{field:'change_time',sort: true,templet:'#change_timeTpl'}">变动时间</th>

                                            <th lay-data="{fixed: 'right',  align:'center',width:220, toolbar: '#barDemo'}"></th>
                

            </tr>
            </thead>
        </table>
        
    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>

                    <script type="text/html" id="user_idTpl">
                <div class="lp-col-detail" lay-event="show_detail"
                     lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("lp-users/detail")?>',area: ['893px', '600px'],title:'详情',key:'user_id'}">
                    {{ d.user_id_lp }}
                </div>
            </script>
        
        
    <script type="text/html" id="barDemo">
                    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-account-log/detail")?>',key:'log_id',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"
               class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
                <i class="layui-icon">&#xe60a;</i> 查看
            </a>
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

