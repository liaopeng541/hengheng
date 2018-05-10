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
<div class="container-fluid larry-wrapper">
    <form id="form1" class="layui-form layui-form-pane"
          data-params='{"dataName":"lp-users","key":"user_id",<?if(isset($_GET["user_id"])){?>"action":"edit","bind":true,"autoClose":false<? }else{?>"action":"add","autoClose":true<?}?>}' action="<?=isset($_GET["user_id"])?\yii\helpers\Url::toRoute("lp-users/update"):\yii\helpers\Url::toRoute("lp-users/add")?>"
          method="POST">
        <div class="layui-form-item">
                            <label class="layui-form-label">邮件</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="email" required jq-verify="required" jq-error="邮件不能为空" placeholder="请输入邮件" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">密码</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="password" required jq-verify="required" jq-error="密码不能为空" placeholder="请输入密码" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">支付密码</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="paypwd" required jq-verify="required" jq-error="支付密码不能为空" placeholder="请输入支付密码" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">性别</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="sex" required jq-verify="required" jq-error="性别不能为空" placeholder="请输入性别" />
                            </div>
                        </div>
                                <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                <?if(isset($_GET["user_id"])){?>                    <button class="layui-btn" jq-submit jq-filter="submit" lp-sub>保存修改</button>
                    <div  lp-close class="layui-btn layui-btn-primary">关 闭</div>
                <? }else{?>                    <button class="layui-btn" jq-submit jq-filter="submit" lp-sub>立即提交</button>
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
