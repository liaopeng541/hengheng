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
    <form class="layui-form layui-form-pane" action="<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("lp-mobile-index-image/update");}else{echo \yii\helpers\Url::toRoute("lp-mobile-index-image/add");}?>" lp-data="{<?if(isset($_GET["id"])){?>type:'edit',key:'id',value:<?=$_GET["id"]?>,<?}?>table:'lp-mobile-index-image'}">
        <div class="layui-form-item">
                            <label class="layui-form-label">Goods ID</label>
                            <div class="layui-input-block">
                                <select name="goods_id" required lay-verify="required" lay-error="Goods ID不能为空" placeholder="请输入Goods ID">
                                    <option value="">请选择Goods ID</option>
                                    <? foreach ($lp_goods_goods_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">图片</label>
                            <div class="layui-input-block"  style="border: 1px solid #e6e6e6; background: #ffffff">
                            <div style="padding: 5px" id="image_box">
                            <input lp-key="image" class="lp_upfile_input" name="image_file" lp-type="file" type="file" style="display: none">
                                <ul class="lp_upfile_list">
                                <div class="img-thumbnail lp_uploadfilebtn">+</div>
                                    <div style="clear: both"></div>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">链接</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="url" required lay-verify="required" lay-error="链接不能为空" placeholder="请输入链接" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">事件</label>
                            <div class="layui-input-block">
                                <select name="type" required lay-verify="required" lay-error="事件不能为空" placeholder="请输入事件">
                                    <option value="">请选择事件</option>
                                    <option value="0">商品</option>
<option value="1">链接</option>
<option value="2">会员</option>

                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">排序</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="order" required lay-verify="required" lay-error="排序不能为空" placeholder="请输入排序" />
                            </div>
                        </div>
                                <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                <?if(isset($_GET["id"])){?>                    <button class="layui-btn" lay-submit lay-filter="edit">保存修改</button>
                    <div  lp-close class="layui-btn layui-btn-primary">关 闭</div>
                <? }else{?>                    <button class="layui-btn" lay-submit lay-filter="add">立即提交</button>
                    <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
                <?}?>            </div>
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
