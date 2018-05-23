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
        .layui-table-box img {max-width: 60px;}
    </style>
</head>
<body>

<div class="lp-grid">
    <div class="lp-table-top">
        <div class="layui-btn-group">
            <button class="layui-btn layui-btn-sm lp-modal"
                    lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-process/add")?>',type:2,maxmin:true,area: ['600px', '500px'],title:'添加' }"
                    style="background: #2980B9"><i class="layui-icon"></i>添加
            </button>
            <button class="layui-btn layui-btn-sm layui-btn-danger lp-all-del"
                    lp-data="{table:'hh-process',key:'id',url:'<?=\yii\helpers\Url::toRoute("hh-process/delete")?>'}"
                    style="background: #D35400"><i class="layui-icon"></i>删除
            </button>
        </div>
        <form class="layui-form lp-search-form" action="#">
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input class="layui-input" name="name" placeholder="名称" />
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <select name="is_comment" placeholder="是否可评价">
                        <option value="">请选择是否可评价</option>
                        <option value="0">禁止</option>
                        <option value="1">允许</option>
                    </select>
                </div>
            </div>

            <div class="layui-inline">
                <div class="layui-input-inline">
                    <select name="cat_id" placeholder="分类">
                        <option value="0">顶级分类</option>
                        <? foreach ($hh_process_cat_id as $key=>$val){echo '<option value="'.$key.'">'.$val.'</option>';}?>
                    </select>
                </div>
            </div>
                    
            <div class="layui-input-inline">
                <button lay-submit lp-table="hh-process" lay-filter="search"
                        class="layui-btn layui-btn-sm layui-btn-default"><i
                            class="layui-icon">&#xe615;</i>搜索
                </button>
                <div lp-reset-mini-search lp-table="hh-process"
                     class="layui-btn layui-btn-sm layui-btn-primary"><i
                            class="layui-icon">&#xe639;</i>重置
                </div>
            </div>

        </form>
    </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="hh-process-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("hh-process/index")?>','id':'hh-process'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                <th lay-data="{field:'id',sort: true,width:80,align:'center'}">ID</th>

                <th lay-data="{field:'cat_id',sort: true,templet:'#cat_idTpl'}">分类</th>

                <th lay-data="{field:'name'}">名称</th>

                <th lay-data="{field:'time',sort: true}">预计时长(分钟)</th>

                <th lay-data="{field:'thumb',templet:'#thumbTpl'}">展示图</th>

                <th lay-data="{field:'is_comment',templet:'#is_commentTpl'}">是否可评价</th>

                <th lay-data="{fixed: 'right',  align:'center',width:220, toolbar: '#barDemo'}"></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>

<script type="text/html" id="cat_idTpl">
    <div class="lp-col-center"
         lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-process-cat/detail")?>',area: ['893px', '600px'],title:'详情',key:'cat_id'}">

        {{# if(d.cat_id_lp) {}}{{d.cat_id_lp}}{{# }else{}}顶级分类{{#}}}
    </div>
</script>
        
<script type="text/html" id="thumbTpl">
    <div class="lp-col-center ">
        <div {{# if(d.thumb){}}class="lp-zoom" {{# }}}>
            <img src="{{# if(d.thumb){}}{{d.thumb}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 jqimg="{{# if(d.thumb){}}{{d.thumb}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 {{# if(d.thumb){}} class="lp-img" {{# }}}>
        </div>
    </div>
</script>
        
<script type="text/html" id="is_commentTpl">
    <div class="lp-col-center ">
        <input type="checkbox"
               lp-data="{url:'<?=\yii\helpers\Url::toRoute("hh-process/setstatus")?>',id:{{d.id}},on:'1',off:'0',key:'id',table:'hh-process'}"
               name="is_comment" lay-skin="switch" lay-filter="hh-process"
               title="开关" lay-text="允许|禁止" {{# if(d.is_comment==1){ }} checked {{# }}}>
    </div>
</script>

        
<script type="text/html" id="barDemo">
    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-process/update")?>',key:'id',type:2,maxmin:true,area: ['600px', '500px'],title:'编辑'}"
       class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
    </a>
    <a lp-data="{table:'hh-process',key:'id',url:'<?=\yii\helpers\Url::toRoute("hh-process/delete")?>'}"
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

