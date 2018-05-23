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
            <button class="layui-btn layui-btn-sm lp-modal" lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-tip-gift/add")?>',type:2,maxmin:true,area: ['600px', '600px'],title:'添加' }" style="background: #2980B9"><i class="layui-icon"></i>添加
            </button>
            <button class="layui-btn layui-btn-sm layui-btn-danger lp-all-del" lp-data="{table:'hh-tip-gift',key:'id',url:'<?=\yii\helpers\Url::toRoute("hh-tip-gift/delete")?>'}" style="background: #D35400"><i class="layui-icon"></i>删除
            </button>                          
        </div>
        <form class="layui-form lp-search-form" action="#">
            <div class="layui-inline">     
                <div class="layui-input-inline">
                    <input class="layui-input" name="name" placeholder="名称" />
                </div>
            </div>     
            <div class="layui-input-inline">
                <button lay-submit lp-table="hh-tip-gift" lay-filter="search"
                        class="layui-btn layui-btn-sm layui-btn-default"><i
                            class="layui-icon">&#xe615;</i>搜索
                </button>
                <div lp-reset-mini-search lp-table="hh-tip-gift"
                     class="layui-btn layui-btn-sm layui-btn-primary"><i
                            class="layui-icon">&#xe639;</i>重置
                </div>
            </div>
        </form>
    </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="hh-tip-gift-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("hh-tip-gift/index")?>','id':'hh-tip-gift'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                <th lay-data="{field:'id',sort: true,width:80,align:'center'}">ID</th>
                <th lay-data="{field:'name',sort: true}">名称</th>
                <th lay-data="{field:'money',sort: true}">价格</th>
                <th lay-data="{field:'dot'}">计量单位</th>
                <th lay-data="{field:'icon',templet:'#iconTpl'}">图标</th>
                <th lay-data="{field:'sort',sort: true,edit: 'text'}">排序</th>
                <th lay-data="{fixed: 'right',  align:'center',width:220, toolbar: '#barDemo'}"></th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</body>
<script src="admin/src/layui.js"></script>

<script type="text/html" id="iconTpl">
    <div class="lp-col-center ">
        <div {{# if(d.icon){}}class="lp-zoom" {{# }}}>
            <img src="{{# if(d.icon){}}{{d.icon}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 jqimg="{{# if(d.icon){}}{{d.icon}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 {{# if(d.icon){}} class="lp-img" {{# }}}>
        </div>
    </div>
</script>
        
<script type="text/html" id="barDemo">
    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-tip-gift/detail")?>',key:'id',type:2,maxmin:true,area: ['600px', '450px'],title:'详情'}"
       class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
        <i class="layui-icon">&#xe60a;</i> 查看
    </a>
    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-tip-gift/update")?>',key:'id',type:2,maxmin:true,area: ['600px', '600px'],title:'编辑'}"
       class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
    </a>
    <a lp-data="{table:'hh-tip-gift',key:'id',url:'<?=\yii\helpers\Url::toRoute("hh-tip-gift/delete")?>'}"
       class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
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

