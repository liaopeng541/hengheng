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
                                <input class="layui-input" name="order_sn" placeholder="订单编号" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="order_status" placeholder="订单状态">
                                    <option value="">请选择订单状态</option>
                                    <option value="0">待付款</option>
<option value="1">己取消</option>
<option value="2">己申请退款</option>
<option value="3">已完成(未使用)</option>
<option value="4">已完成</option>
<option value="5">己退款</option>

                                </select>
                            </div>
                        </div>
                        

                <div class="layui-input-inline">
                    <button lay-submit lp-table="lp-order" lay-filter="search"
                            class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                    <div lp-reset-mini-search lp-table="lp-order"
                         class="layui-btn layui-btn-sm layui-btn-primary"><i
                                class="layui-icon">&#xe639;</i>重置
                    </div>
                </div>

            </form>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="lp-order-filter" lay-size="sm" lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("lp-order/index")?>','id':'lp-order'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                                        <th lay-data="{field:'order_id',sort: true}">订单id</th>

                                                <th lay-data="{field:'order_sn'}">订单编号</th>

                                                <th lay-data="{field:'user_id',sort: true,templet:'#user_idTpl'}">用户</th>

                                                <th lay-data="{field:'order_status',sort: true,templet:'#order_statusTpl'}">订单状态</th>

                                                <th lay-data="{field:'order_amount'}">在线支付</th>

                                                <th lay-data="{field:'total_amount'}">订单总价</th>

                                                <th lay-data="{field:'add_time',templet:'#add_timeTpl'}">下单时间</th>

                                                <th lay-data="{field:'pay_time',templet:'#pay_timeTpl'}">支付时间</th>

                                    </tr>
            </thead>
        </table>
        
    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>

                    <script type="text/html" id="user_idTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("lp-users/detail")?>',area: ['893px', '600px'],title:'详情',key:'user_id'}" >
                    {{ d.user_id_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="order_statusTpl">
                <div class="lp-col-center">
                    {{ d.order_status_lp }}
                </div>
            </script>
        
        
    <script type="text/html" id="barDemo">
                    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-order/detail")?>',key:'order_id',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"  class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
                <i class="layui-icon">&#xe60a;</i> 查看
            </a>
                                    <a lp-data="{table:'lp-order',key:'order_id',url:'<?=\yii\helpers\Url::toRoute("lp-order/delete")?>'}" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
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

