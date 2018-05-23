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
            <button class="layui-btn layui-btn-sm lp-modal" lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-service/add")?>',type:2,maxmin:true,area: ['650px', '500px'],title:'添加' }"
                        style="background: #2980B9"><i class="layui-icon"></i>添加</button>
            <button class="layui-btn layui-btn-sm layui-btn-danger lp-all-del" lp-data="{table:'hh-service',key:'id',url:'<?=\yii\helpers\Url::toRoute("hh-service/delete")?>'}"
                        style="background: #D35400"><i class="layui-icon"></i>删除</button>             
        </div>
        <form class="layui-form lp-search-form" action="#">
            <div class="layui-inline">  
                <div class="layui-input-inline">
                    <select name="cat_id" placeholder="分类">
                        <option value="0">顶级分类</option>
                        <? foreach ($hh_service_cat_id as $key=>$val){echo '<option value="'.$key.'">'.$val.'</option>';}?>
                    </select>
                </div>
            </div>
                    
            <div class="layui-input-inline">
                <button lay-submit lp-table="hh-service" lay-filter="search"
                        class="layui-btn layui-btn-sm layui-btn-default"><i
                            class="layui-icon">&#xe615;</i>搜索
                </button>
                <div lp-reset-mini-search lp-table="hh-service"
                     class="layui-btn layui-btn-sm layui-btn-primary"><i
                            class="layui-icon">&#xe639;</i>重置
                </div>
            </div>
        </form>
    </div>

    <div class="c-c-box">
        <table class="layui-table" lay-filter="hh-service-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("hh-service/index")?>','id':'hh-service'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                <th lay-data="{field:'id',sort: true,width:80,align:'center'}">ID</th>
                <th lay-data="{field:'name',sort: true}">名称</th>
                <th lay-data="{field:'desc'}">介绍</th>
                <th lay-data="{field:'thumb',templet:'#thumbTpl'}">图片</th>
                <th lay-data="{field:'cat_id',sort: true,templet:'#cat_idTpl'}">分类</th>
                <th lay-data="{field:'price',sort: true}">价格</th>
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
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类</label>
                        <div class="layui-input-block">
                            <select name="cat_id" placeholder="分类">
                                <option value="0">顶级分类</option>
                                <? foreach ($hh_service_cat_id as $key=>$val){echo '<option value="'.$key.'">'.$val.'</option>';}?>
                            </select>
                        </div>
                    </div>
                
                    <button style="display: none" lp-table="hh-service" lay-submit lay-filter="search" lp-search-submit></button>
                </form>
            </div>

            <div class="lp-search-sub-btn">
                <button class="layui-btn layui-btn-sm layui-btn-default" lp-search-btn><i
                            class="layui-icon">&#xe615;</i>搜 索
                </button>
                <button class="layui-btn layui-btn-sm layui-btn-primary" lp-search-box-reset><i
                            class="layui-icon">&#xe639;</i>重 置
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
<script type="text/html" id="thumbTpl">
    <div class="lp-col-center ">
        <div {{# if(d.thumb){}}class="lp-zoom" {{# }}}>
            <img src="{{# if(d.thumb){}}{{d.thumb}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 jqimg="{{# if(d.thumb){}}{{d.thumb}}{{# }else{}}admin/images/avatar.png{{# }}}"
                 {{# if(d.thumb){}} class="lp-img" {{# }}}>
        </div>
    </div>
</script>
<script type="text/html" id="cat_idTpl">
    <div class="lp-col-center"
         lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-service-cat/detail")?>',area: ['893px', '600px'],title:'详情',key:'cat_id'}">
        {{# if(d.cat_id_lp) {}}{{d.cat_id_lp}}{{# }else{}}顶级分类{{#}}}
    </div>
</script>
        
        
<script type="text/html" id="barDemo">
    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-service/detail")?>',key:'id',type:2,maxmin:true,area: ['500px', '400px'],title:'详情'}"
       class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
        <i class="layui-icon">&#xe60a;</i> 查看
    </a>
    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-service/update")?>',key:'id',type:2,maxmin:true,area: ['650px', '500px'],title:'编辑'}"
       class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
    </a>
    <a lp-data="{table:'hh-service',key:'id',url:'<?=\yii\helpers\Url::toRoute("hh-service/delete")?>'}"
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

