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
        <div class="layui-btn-group"></div>
        <form class="layui-form lp-search-form" action="#">


                <div class="layui-inline">      
                    <div class="layui-input-inline">
                        <select name="store_id" placeholder="门店">
                            <option value="">请选择门店</option>
                            <? foreach ($hh_store_id as $key=>$val){echo '<option value="'.$key.'">'.$val.'</option>';}?>
                        </select>
                    </div>
                </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input lp-date_time" name="start_time" placeholder="开始时间" placeholder="请选择日期时间" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="service_id" placeholder="服务名称">
                                    <option value="">请选择服务名称</option>
                                    <? foreach ($hh_service_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input lp-date_time" name="over_time" placeholder="结束时间" placeholder="请选择日期时间" />
                            </div>
                        </div>
                        

                <div class="layui-input-inline">
                    <button lay-submit lp-table="hh-oto-order-service" lay-filter="search"
                            class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                    <div lp-reset-mini-search lp-table="hh-oto-order-service"
                         class="layui-btn layui-btn-sm layui-btn-primary"><i
                                class="layui-icon">&#xe639;</i>重置
                    </div>
                </div>

            </form>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="hh-oto-order-service-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("hh-oto-order-service/index")?>','id':'hh-oto-order-service'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                <th lay-data="{field:'id',sort: true,width:80,align:'center'}">ID</th>
                <th lay-data="{field:'store_id',templet:'#store_idTpl'}">门店</th>
                <th lay-data="{field:'station_id',templet:'#station_idTpl'}">工位</th>
                <th lay-data="{field:'service_name'}">服务名称</th>
                <th lay-data="{field:'worker_id',templet:'#worker_idTpl'}">员工</th>
                <th lay-data="{field:'start_time',sort: true,templet:'#start_timeTpl'}">开始时间</th>
                <th lay-data="{field:'over_time',sort: true,templet:'#over_timeTpl'}">结束时间</th>
                <th lay-data="{field:'status',templet:'#statusTpl'}">状态</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</body>
<script src="admin/src/layui.js"></script>

<script type="text/html" id="service_idTpl">
    <div class="lp-col-detail" lay-event="show_detail"
         lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-service/detail")?>',area: ['893px', '600px'],title:'详情',key:'service_id'}">
        {{ d.service_id_lp }}
    </div>
</script>
        
<script type="text/html" id="statusTpl">
    <div class="lp-col-center">
        {{ d.status_lp }}
    </div>
</script>
        
<script type="text/html" id="worker_idTpl">
    <div class="lp-col-center"
         lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-worker/detail")?>',area: ['893px', '600px'],title:'详情',key:'worker_id'}">
        {{ d.worker_id_lp }}
    </div>
</script>
        
<script type="text/html" id="station_idTpl">
    <div class="lp-col-center"
         lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-work-station/detail")?>',area: ['893px', '600px'],title:'详情',key:'station_id'}">
        {{ d.station_id_lp }}
    </div>
</script>
        
<script type="text/html" id="store_idTpl">
    <div class="lp-col-center"
         lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-store/detail")?>',area: ['893px', '600px'],title:'详情',key:'store_id'}">
        {{ d.store_id_lp }}
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

