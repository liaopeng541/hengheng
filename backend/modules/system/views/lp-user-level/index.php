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
                            <button class="layui-btn layui-btn-sm lp-modal"
                        lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-user-level/add")?>',type:2,maxmin:true,area: ['893px', '600px'],title:'添加' }"
                        style="background: #2980B9"><i class="layui-icon"></i>添加
                </button>
                                        <button class="layui-btn layui-btn-sm layui-btn-danger lp-all-del"
                        lp-data="{table:'lp-user-level',key:'level_id',url:'<?=\yii\helpers\Url::toRoute("lp-user-level/delete")?>'}"
                        style="background: #D35400"><i class="layui-icon"></i>删除
                </button>
                                                                <button class="layui-btn layui-btn-sm lp-all-set"
                                lp-data="{table:'lp-user-level','field':'list_show',value:1,checked:'on',key:'level_id',title:'展示',url:'<?=\yii\helpers\Url::toRoute("lp-user-level/setstatus")?>'}"
                                style="background:#27AE60"><i class="layui-icon">&#xe658;</i>展示                        </button>
                        <button lp-data="{table:'lp-user-level','field':'list_show',value:0,checked:'off',key:'level_id',title:'隐藏',url:'<?=\yii\helpers\Url::toRoute("lp-user-level/setstatus")?>'}"
                                class="lp-all-set layui-btn layui-btn-sm layui-btn-danger" style="background:#E74C3C"><i
                                    class="layui-icon">&#xe600;</i>隐藏                        </button>

                                                <button class="layui-btn layui-btn-sm lp-all-set"
                                lp-data="{table:'lp-user-level','field':'is_show',value:1,checked:'on',key:'level_id',title:'展示',url:'<?=\yii\helpers\Url::toRoute("lp-user-level/setstatus")?>'}"
                                style="background:#27AE60"><i class="layui-icon">&#xe658;</i>展示                        </button>
                        <button lp-data="{table:'lp-user-level','field':'is_show',value:0,checked:'off',key:'level_id',title:'隐藏',url:'<?=\yii\helpers\Url::toRoute("lp-user-level/setstatus")?>'}"
                                class="lp-all-set layui-btn layui-btn-sm layui-btn-danger" style="background:#E74C3C"><i
                                    class="layui-icon">&#xe600;</i>隐藏                        </button>

                        

                        

        </div>
                    <form class="layui-form lp-search-form" action="#">


                <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="level_name" placeholder="等级名称" />
                            </div>
                        </div>
                        

                <div class="layui-input-inline">
                    <button lay-submit lp-table="lp-user-level" lay-filter="search"
                            class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                    <div lp-reset-mini-search lp-table="lp-user-level"
                         class="layui-btn layui-btn-sm layui-btn-primary"><i
                                class="layui-icon">&#xe639;</i>重置
                    </div>
                </div>

            </form>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="lp-user-level-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("lp-user-level/index")?>','id':'lp-user-level'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                                        <th lay-data="{field:'level_name'}">等级名称</th>

                                                <th lay-data="{field:'amount',sort: true}">预充金额</th>

                                                <th lay-data="{field:'describe'}">描述</th>

                                                <th lay-data="{field:'thumb',templet:'#thumbTpl'}">展示图片</th>

                                                <th lay-data="{field:'sort',sort: true,edit: 'text'}">排序</th>

                                                <th lay-data="{field:'is_show',templet:'#is_showTpl'}">APP首页展示</th>

                                                <th lay-data="{field:'list_show',templet:'#list_showTpl'}">APP列表页展示</th>

                                            <th lay-data="{fixed: 'right',  align:'center',width:220, toolbar: '#barDemo'}"></th>
                

            </tr>
            </thead>
        </table>
        
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
        
            <script type="text/html" id="is_showTpl">
                <div class="lp-col-center ">
                    <input type="checkbox"
                           lp-data="{url:'<?=\yii\helpers\Url::toRoute("lp-user-level/setstatus")?>',id:{{d.level_id}},on:'1',off:'0',key:'level_id',table:'lp-user-level'}"
                           name="is_show" lay-skin="switch" lay-filter="lp-user-level"
                           title="开关" lay-text="展示|隐藏" {{# if(d.is_show==1){ }} checked {{# }}}>
                </div>
            </script>

        
            <script type="text/html" id="list_showTpl">
                <div class="lp-col-center ">
                    <input type="checkbox"
                           lp-data="{url:'<?=\yii\helpers\Url::toRoute("lp-user-level/setstatus")?>',id:{{d.level_id}},on:'1',off:'0',key:'level_id',table:'lp-user-level'}"
                           name="list_show" lay-skin="switch" lay-filter="lp-user-level"
                           title="开关" lay-text="展示|隐藏" {{# if(d.list_show==1){ }} checked {{# }}}>
                </div>
            </script>

        
    <script type="text/html" id="barDemo">
                    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-user-level/detail")?>',key:'level_id',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"
               class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
                <i class="layui-icon">&#xe60a;</i> 查看
            </a>
                            <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-user-level/update")?>',key:'level_id',type:2,maxmin:true,area: ['893px', '600px'],title:'编辑'}"
               class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
            </a>
                            <a lp-data="{table:'lp-user-level',key:'level_id',url:'<?=\yii\helpers\Url::toRoute("lp-user-level/delete")?>'}"
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

