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
            <button class="layui-btn layui-btn-sm lp-modal" lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-brand/add")?>',type:2,maxmin:true,area: ['600px', '520px'],title:'添加' }" style="background: #2980B9"><i class="layui-icon"></i>添加
            </button>
            <button class="layui-btn layui-btn-sm layui-btn-danger lp-all-del" lp-data="{table:'lp-brand',key:'id',url:'<?=\yii\helpers\Url::toRoute("lp-brand/delete")?>'}" style="background: #D35400"><i class="layui-icon"></i>删除</button>                     
        </div>
        <form class="layui-form lp-search-form" action="#">
            <div class="layui-input-inline">
                <button lay-submit lp-table="lp-brand" lay-filter="search" class="layui-btn layui-btn-sm layui-btn-default"><i class="layui-icon">&#xe615;</i>搜索
                </button>
                <div lp-reset-mini-search lp-table="lp-brand" class="layui-btn layui-btn-sm layui-btn-primary"><i class="layui-icon">&#xe639;</i>重置
                </div>
            </div>
        </form>
    </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="lp-brand-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("lp-brand/index")?>','id':'lp-brand'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                <th lay-data="{field:'id',sort: true}">品牌ID</th>
                <th lay-data="{field:'name'}">品牌名称</th>
                <th lay-data="{field:'logo',templet:'#logoTpl'}">品牌logo</th>
                <th lay-data="{field:'sort',sort: true}">排序</th>
                <th lay-data="{field:'cat_id',sort: true,templet:'#cat_idTpl'}">分类id</th>
                <th lay-data="{field:'is_hot',templet:'#is_hotTpl'}">是否推荐</th>
                <th lay-data="{fixed: 'right',  align:'center',width:220, toolbar: '#barDemo'}"></th>
            </tr>
            </thead>
        </table>
            <div class="lp-search-box">
                <div class="lp-search-title">
                    <div class="lp-search-close">
                        <i class="layui-icon">&#xe65b;</i>
                    </div>
                </div>

                <div class="layui-body lp-search-body">
                    <form class="layui-form layui-form-pane" action="#" style="padding: 5px">
                        <button style="display: none" lp-table="lp-brand" lay-submit lay-filter="search" lp-search-submit></button>
                    </form>
                </div>

                <div class="lp-search-sub-btn">
                    <button class="layui-btn layui-btn-sm layui-btn-default" lp-search-btn><i class="layui-icon">&#xe615;</i>搜 索
                    </button>
                    <button class="layui-btn layui-btn-sm layui-btn-primary" lp-search-box-reset><i class="layui-icon">&#xe639;</i>重 置
                    </button>
                </div>

            </div>
            <div class="lp-sear-btn lp-tip" lp-tip-box="lp-tip">
                <i class="layui-icon">&#xe615;</i> 更多搜索
            </div>
    </div>
</div>
</body>
<script src="admin/src/layui.js"></script>

<script type="text/html" id="logoTpl">
    <div class="lp-col-center ">
        <div {{# if(d.logo){}}class="lp-zoom" {{# }}}>
            <img src="{{# if(d.logo){}}{{d.logo}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 jqimg="{{# if(d.logo){}}{{d.logo}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 {{# if(d.logo){}} class="lp-img" {{# }}}>
        </div>
    </div>
</script>

<script type="text/html" id="cat_idTpl">
    <div class="lp-col-center"
         lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("lp-goods-category/detail")?>',area: ['893px', '600px'],title:'详情',key:'cat_id'}">
        {{ d.cat_id_lp }}
    </div>
</script>

<script type="text/html" id="is_hotTpl">
    <div class="lp-col-center ">
        <input type="checkbox"
               lp-data="{url:'<?=\yii\helpers\Url::toRoute("lp-brand/setstatus")?>',id:{{d.id}},on:'1',off:'0',key:'id',table:'lp-brand'}"
               name="is_hot" lay-skin="switch" lay-filter="lp-brand"
               title="开关" lay-text="启用|禁用" {{# if(d.is_hot==1){ }} checked {{# }}}>
    </div>
</script>

        
<script type="text/html" id="barDemo">
    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-brand/detail")?>',key:'id',type:2,maxmin:true,area: ['600px', '450px'],title:'详情'}" class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
        <i class="layui-icon">&#xe60a;</i> 查看
    </a>
    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-brand/update")?>',key:'id',type:2,maxmin:true,area: ['600px', '520px'],title:'编辑'}" class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑</a>
    <a lp-data="{table:'lp-brand',key:'id',url:'<?=\yii\helpers\Url::toRoute("lp-brand/delete")?>'}" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
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

