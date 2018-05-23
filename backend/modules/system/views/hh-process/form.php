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
    <form class="layui-form layui-form-pane" action="<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("hh-process/update");}else{echo \yii\helpers\Url::toRoute("hh-process/add");}?>" lp-data="{<?if(isset($_GET["id"])){?>type:'edit',key:'id',value:<?=$_GET["id"]?>,<?}?>table:'hh-process'}">
        <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
                <select name="cat_id" required lay-verify="required" lay-error="分类不能为空" placeholder="请输入分类">
                    <option value="0">顶级分类</option>
                    <? foreach ($hh_process_cat_id as $key=>$val){echo '<option value="'.$key.'">'.$val.'</option>';}?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input class="layui-input" name="name" required lay-verify="required" lay-error="名称不能为空" placeholder="请输入名称" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">预计时长(分钟)</label>
            <div class="layui-input-block">
                <input class="layui-input" name="time" required lay-verify="required" lay-error="预计时长(分钟)不能为空" placeholder="请输入预计时长(分钟)" />
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">展示图</label>
            <div class="layui-input-block"  style="border: 1px solid #e6e6e6; background: #ffffff">
            <div style="padding: 5px" id="thumb_box">
            <input lp-key="thumb" class="lp_upfile_input" name="thumb_file" lp-type="file" type="file" style="display: none">
                <ul class="lp_upfile_list">
                <div class="img-thumbnail lp_uploadfilebtn">+</div>
                    <div style="clear: both"></div>
                </ul>
                </div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">是否可评价</label>
            <div class="layui-input-block">
                <input type="radio" name="is_comment" value="0" title="禁止" checked>
                <input type="radio" name="is_comment" value="1" title="允许" >
            </div>
        </div>
       
        
        <div class="layui-form-item">
            <div class="layui-input-block" style="position: fixed;bottom: 10px;left: 50%;margin-left: -86px;">
                <?if (isset($_GET["id"])) { ?>
                <button class="layui-btn" lay-submit lay-filter="edit">保存修改</button>
                <div  lp-close class="layui-btn layui-btn-primary">关 闭</div>
                <? } else {?>
                <button class="layui-btn" lay-submit lay-filter="add">立即提交</button>
                <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
                <? } ?>            
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
