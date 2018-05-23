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
    <link rel="stylesheet" type="text/css" href="admin/src/lpui/css/lpui.css">
</head>


<body>
<div class="container-fluid " style="padding:10px">
    <form class="layui-form layui-form-pane" action="<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("hh-work-station/update");}else{echo \yii\helpers\Url::toRoute("hh-work-station/add");}?>" lp-data="{<?if(isset($_GET["id"])){?>type:'edit',key:'id',value:<?=$_GET["id"]?>,<?}?>table:'hh-work-station'}">
    <div class="layui-form-item">
            <label class="layui-form-label">服务</label>
            <div class="layui-input-block">
                <select name="service_id" required lay-verify="required" lay-error="服务不能为空" placeholder="请输入服务">
                    <option value="">请选择服务</option>
                    <? foreach ($hh_service_id as $key=>$val){echo '<option value="'.$key.'">'.$val.'</option>';}?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">门店</label>
            <div class="layui-input-block">
                <select name="store_id" required lay-verify="required" lay-error="门店不能为空" placeholder="请输入门店">
                    <option value="">请选择门店</option>
                    <? foreach ($hh_store_id as $key=>$val){echo '<option value="'.$key.'">'.$val.'</option>';}?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input class="layui-input" name="name" required lay-verify="required" lay-error="名称不能为空" placeholder="请输入名称" />
            </div>
        </div>

        <div class="layui-form-item" pane="">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" class="layui-input " value="1" name="status" checked/>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block" style="position: fixed;bottom: 10px;left: 50%;margin-left: -86px;">
                <? if(isset($_GET["id"])){ ?>                    
                <button class="layui-btn" lay-submit lay-filter="edit">保存修改</button>
                    <div  lp-close class="layui-btn layui-btn-primary">关 闭</div>
                <? }else{?>                    
                <button class="layui-btn" lay-submit lay-filter="add">立即提交</button>
                    <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
                <?}?>            
            </div>
        </div>
    </form>
</div>
</body>
<script src="admin/src/layui.js"></script>
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
        lp_upimages: "src/lpui/lp_upimages",
        lplist: "src/lpui/lplist",
        lpform: "src/lpui/lpform"
    })
</script>
<script>
        layui.use("lpform")



</script>

</html>
