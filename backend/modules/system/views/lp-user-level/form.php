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
    <form class="layui-form layui-form-pane" action="<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("lp-user-level/update");}else{echo \yii\helpers\Url::toRoute("lp-user-level/add");}?>" lp-data="{<?if(isset($_GET["id"])){?>type:'edit',key:'level_id',value:<?=$_GET["id"]?>,<?}?>table:'lp-user-level'}">
        <div class="layui-form-item">
                            <label class="layui-form-label">等级名称</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="level_name" required lay-verify="required" lay-error="等级名称不能为空" placeholder="请输入等级名称" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">预充金额</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="amount" required lay-verify="required" lay-error="预充金额不能为空" placeholder="请输入预充金额" />
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">充值说明</label>
                            <div class="layui-input-block">
                            <textarea placeholder="请输入内容" name="level_desc" class="layui-textarea" required lay-verify="required" lay-error="充值说明不能为空" placeholder="请输入充值说明"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <label class="layui-form-label">APP列表页展示</label>
                            <div class="layui-input-block">
                                <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" class="layui-input " value="1" name="list_show" checked/>
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <label class="layui-form-label">APP首页展示</label>
                            <div class="layui-input-block">
                                <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" class="layui-input " value="1" name="is_show" checked/>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">展示图片</label>
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
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">描述</label>
                            <div class="layui-input-block">
                            <textarea placeholder="请输入内容" name="describe" class="layui-textarea" required lay-verify="required" lay-error="描述不能为空" placeholder="请输入描述"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text" >
                            <label class="layui-form-label">详情图片</label>
                            <div class="layui-input-block"  style="border: 1px solid #e6e6e6; background: #ffffff">
                            <div style="padding: 5px" id="detail_img_box">
                                <input lp-key="detail_img"  class="lp_upfile_input" name="detail_img_file" lp-type="files" type="file" style="display: none">
                                <ul class="lp_upfile_list">
                                <div class="img-thumbnail lp_uploadfilebtn">+</div>
                                    <div style="clear: both"></div>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">排序</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="sort" required lay-verify="required" lay-error="排序不能为空" placeholder="请输入排序" />
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
