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
<style type="text/css">
.layui-filter-item {
    position: relative;
}
.layui-filter-item .z-item {
    width: 50%;
    display: inline-block;
}
.layui-filter-item .z-opreation-groups {
    position: absolute;
    left: 50%;
    top: 0;
}
.layui-filter-item .layui-btn-sm {
    width: 38px;
    height: 38px;
    line-height: 38px;
    font-size: 14px;
}
</style>

<body>
<div class="container-fluid " style="padding:10px">
    <form class="layui-form layui-form-pane" action="<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("lp-spec/update");}else{echo \yii\helpers\Url::toRoute("lp-spec/add");}?>" lp-data="{<?if(isset($_GET["id"])){?>type:'edit',key:'id',value:<?=$_GET["id"]?>,<?}?>table:'lp-spec'}">
        <div class="layui-form-item">
            <label class="layui-form-label">规格名称</label>
            <div class="layui-input-block">
                <input class="layui-input" name="name" required lay-verify="required" lay-error="规格名称不能为空" placeholder="请输入规格名称" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input class="layui-input" name="order" required lay-verify="required" lay-error="排序不能为空" placeholder="请输入排序" value="50" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">规格类型</label>
            <div class="layui-input-block">
                <select name="type_id" required lay-verify="required" lay-error="规格类型不能为空" placeholder="请输入规格类型">
                    <option value="">请选择规格类型</option>
                    <? foreach ($lp_goods_type_id as $key=>$val){echo '<option value="'.$key.'">'.$val.'</option>';}?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">规格项</label>
            <div class="layui-input-block layui-block-item">
                <?php if(isset($specList) && count($specList) > 0) : ?>
                <?php foreach($specList as $k => $spe) :?>
                <div class="layui-filter-item">
                    <input class="layui-input z-item" name="item[]" placeholder="选填规格项" value="<?=$spe['item'];?>" />
                    <input type="hidden" class="layui-input z-hidden-item" name="itemId[]" value="<?=$spe['id'];?>" />
                    <div class="z-opreation-groups">
                    <?php if($k > 0) : ?>
                        <a class="layui-btn layui-btn-primary layui-btn-sm layui-btn-remove"><i class="layui-icon">&#x1006;</i></a>
                    <?php else: ?>
                        <a class="layui-btn layui-btn-sm layui-btn-add"><i class="layui-icon"></i></a>
                    <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else : ?>
                <div class="layui-filter-item">
                    <input class="layui-input z-item" name="item[]" placeholder="选填规格项" />
                    <div class="z-opreation-groups">
                        <a class="layui-btn layui-btn-sm layui-btn-add"><i class="layui-icon"></i></a>
                    </div>
                </div>

                <?php endif; ?>     
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block" style="position: fixed;bottom: 10px;left: 50%;margin-left: -86px;">
                <?if(isset($_GET["id"])){?>                    
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
layui.use(['lpform','jquery'], function() {
    var $ = layui.jquery;
    var minAllowLimit = 1;
    var maxAllowLimit = 8;
    var specDeleteScen = "<?=\yii\helpers\Url::toRoute("lp-spec-item/ajax-delete")?>";

    $('.layui-btn-add').on("click", function() {
        var zItemLength = $('.z-item').length;
        if (zItemLength+1 > maxAllowLimit) {
            layer.msg("规格项最多只能选择" + maxAllowLimit + "个");
            return false;
        }
        var ele = '<div class="layui-filter-item"><input class="layui-input z-item" name="item[]" placeholder="选填规格项" /><a class="layui-btn layui-btn-primary layui-btn-sm layui-btn-remove"><i class="layui-icon">&#x1006;</i></a></div>';
        $('.layui-block-item').append(ele);
    });

    $(document).on('click','.layui-btn-remove', function() {
        var hiddenItemId = $(this).parent('.z-opreation-groups').prev('.z-hidden-item').val();
        console.log(hiddenItemId);
        if (hiddenItemId != 'undefined' && hiddenItemId > 0) {
            $.getJSON(specDeleteScen,{'id':hiddenItemId});
        }
        $(this).parent('.z-opreation-groups').parent('.layui-filter-item').remove();
    })

})
</script>
</html>
