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
                    <form class="layui-form lp-search-form" action="#">



                <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="name" placeholder="名称" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="service_id" placeholder="服务">
                                    <option value="">请选择服务</option>
                                    <? foreach ($hh_service_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="store_id" placeholder="门店">
                                    <option value="">请选择门店</option>
                                    <? foreach ($hh_store_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        

                <div class="layui-input-inline">
                    <button lay-submit lp-table="hh-work-station" lay-filter="search"
                            class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                    <div lp-reset-mini-search lp-table="hh-work-station"
                         class="layui-btn layui-btn-sm layui-btn-primary"><i
                                class="layui-icon">&#xe639;</i>重置
                    </div>
                </div>

            </form>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="hh-work-station-filter" lay-size="sm" lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("hh-work-station/index")?>','id':'hh-work-station'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                                        <th lay-data="{field:'id',sort: true}">ID</th>

                                                <th lay-data="{field:'store_id',templet:'#store_idTpl'}">门店</th>

                                                <th lay-data="{field:'service_id',templet:'#service_idTpl'}">服务</th>

                                                <th lay-data="{field:'status',templet:'#statusTpl'}">状态</th>

                                                <th lay-data="{field:'name'}">名称</th>

                                    </tr>
            </thead>
        </table>
        
    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>

                    <script type="text/html" id="store_idTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-store/detail")?>',area: ['893px', '600px'],title:'详情',key:'store_id'}" >
                    {{ d.store_id_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="service_idTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-service/detail")?>',area: ['893px', '600px'],title:'详情',key:'service_id'}" >
                    {{ d.service_id_lp }}
                </div>
            </script>
        
        
            <script type="text/html" id="statusTpl">
                <div class="lp-col-center ">
                    <input type="checkbox" lp-data="{url:'<?=\yii\helpers\Url::toRoute("hh-work-station/setstatus")?>',id:{{d.id}},on:'1',off:'0',key:'id',table:'hh-work-station'}" name="status" lay-skin="switch" lay-filter="hh-work-station"  title="开关" lay-text="启用|禁用">
                </div>
            </script>

        
    <script type="text/html" id="barDemo">
                    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-work-station/detail")?>',key:'id',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"  class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
                <i class="layui-icon">&#xe60a;</i> 查看
            </a>
                            <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-work-station/update")?>',key:'id',type:2,maxmin:true,area: ['893px', '600px'],title:'编辑'}" class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
            </a>
                            <a lp-data="{table:'hh-work-station',key:'id',url:'<?=\yii\helpers\Url::toRoute("hh-work-station/delete")?>'}" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
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
    layui.use(['lpsearchbox', 'jquery', 'element', 'lpui', 'lpzoom', 'lplist','lpform'])
</script>

</html>

