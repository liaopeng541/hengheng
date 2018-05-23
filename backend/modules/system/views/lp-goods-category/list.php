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
                                <input class="layui-input" name="name" placeholder="菜单名称" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="pid" placeholder="父分类">
                                    <option value="0">顶级父分类</option>
                                    <? foreach ($lp_goods_category_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        

                <div class="layui-input-inline">
                    <button lay-submit lp-table="lp-goods-category" lay-filter="search"
                            class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                    <div lp-reset-mini-search lp-table="lp-goods-category"
                         class="layui-btn layui-btn-sm layui-btn-primary"><i
                                class="layui-icon">&#xe639;</i>重置
                    </div>
                </div>

            </form>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="lp-goods-category-filter" lay-size="sm" lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("lp-goods-category/index")?>','id':'lp-goods-category'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                                        <th lay-data="{field:'name'}">菜单名称</th>

                                                <th lay-data="{field:'sort_order',sort: true}">排序</th>

                                                <th lay-data="{field:'is_show',sort: true,templet:'#is_showTpl'}">是否显示</th>

                                                <th lay-data="{field:'pid',sort: true,templet:'#pidTpl'}">父分类</th>

                                    </tr>
            </thead>
        </table>
        
    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>


            <script type="text/html" id="is_showTpl">
                <div class="lp-col-center ">
                    <input type="checkbox" lp-data="{url:'<?=\yii\helpers\Url::toRoute("lp-goods-category/setstatus")?>',id:{{d.id}},on:'1',off:'0',key:'id',table:'lp-goods-category'}" name="is_show" lay-skin="switch" lay-filter="lp-goods-category"  title="开关" lay-text="启用|禁用">
                </div>
            </script>

                            <script type="text/html" id="pidTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("lp-goods-category/detail")?>',area: ['893px', '600px'],title:'详情',key:'pid'}" >
                    {{ d.pid_lp }}
                </div>
            </script>
        
        
    <script type="text/html" id="barDemo">
                    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-goods-category/detail")?>',key:'id',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"  class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
                <i class="layui-icon">&#xe60a;</i> 查看
            </a>
                            <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-goods-category/update")?>',key:'id',type:2,maxmin:true,area: ['893px', '600px'],title:'编辑'}" class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
            </a>
                            <a lp-data="{table:'lp-goods-category',key:'id',url:'<?=\yii\helpers\Url::toRoute("lp-goods-category/delete")?>'}" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
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

