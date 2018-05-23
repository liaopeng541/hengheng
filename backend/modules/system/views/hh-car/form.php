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
    <form class="layui-form layui-form-pane" action="<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("hh-car/update");}else{echo \yii\helpers\Url::toRoute("hh-car/add");}?>" lp-data="{<?if(isset($_GET["id"])){?>type:'edit',key:'id',value:<?=$_GET["id"]?>,<?}?>table:'hh-car'}">
        <div class="layui-form-item">
            <label class="layui-form-label">Letter</label>
            <div class="layui-input-block">
                <input class="layui-input" name="letter" required lay-verify="required" lay-error="Letter不能为空" placeholder="请输入Letter" />
            </div>
        </div>
         <div class="layui-form-item">
            <label class="layui-form-label">Brand</label>
            <div class="layui-input-block">
                <input class="layui-input" name="brand" required lay-verify="required" lay-error="Brand不能为空" placeholder="请输入Brand" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">Brand ID</label>
            <div class="layui-input-block">
                <input class="layui-input" name="brand_id" required lay-verify="required" lay-error="Brand ID不能为空" placeholder="请输入Brand ID" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">Brand Logo</label>
            <div class="layui-input-block">
                <input class="layui-input" name="brand_logo" required lay-verify="required" lay-error="Brand Logo不能为空" placeholder="请输入Brand Logo" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">Series</label>
            <div class="layui-input-block">
                <input class="layui-input" name="series" required lay-verify="required" lay-error="Series不能为空" placeholder="请输入Series" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">Series ID</label>
            <div class="layui-input-block">
                <input class="layui-input" name="series_id" required lay-verify="required" lay-error="Series ID不能为空" placeholder="请输入Series ID" />
            </div>
        </div>
       <div class="layui-form-item">
            <label class="layui-form-label">Carname</label>
            <div class="layui-input-block">
                <input class="layui-input" name="carname" required lay-verify="required" lay-error="Carname不能为空" placeholder="请输入Carname" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">Car ID</label>
            <div class="layui-input-block">
                <input class="layui-input" name="car_id" required lay-verify="required" lay-error="Car ID不能为空" placeholder="请输入Car ID" />
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">Sela Status</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="sela_status" class="layui-textarea" required lay-verify="required" lay-error="Sela Status不能为空" placeholder="请输入Sela Status"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">Sell</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="sell" class="layui-textarea" required lay-verify="required" lay-error="Sell不能为空" placeholder="请输入Sell"></textarea>
            </div>
        </div>
      
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">Datatime</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="datatime" class="layui-textarea" required lay-verify="required" lay-error="Datatime不能为空" placeholder="请输入Datatime"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">Prices</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="prices" class="layui-textarea" required lay-verify="required" lay-error="Prices不能为空" placeholder="请输入Prices"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">Lever</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="lever" class="layui-textarea" required lay-verify="required" lay-error="Lever不能为空" placeholder="请输入Lever"></textarea>
            </div>
        </div>
      
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">发动机</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="engine" class="layui-textarea" required lay-verify="required" lay-error="发动机不能为空" placeholder="请输入发动机"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">变速箱</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="gearbox" class="layui-textarea" required lay-verify="required" lay-error="变速箱不能为空" placeholder="请输入变速箱"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">最高车速(km/h)</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="maximum" class="layui-textarea" required lay-verify="required" lay-error="最高车速(km/h)不能为空" placeholder="请输入最高车速(km/h)"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">车身结构</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="bodywork" class="layui-textarea" required lay-verify="required" lay-error="车身结构不能为空" placeholder="请输入车身结构"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">长*宽*高(mm)</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="size" class="layui-textarea" required lay-verify="required" lay-error="长*宽*高(mm)不能为空" placeholder="请输入长*宽*高(mm)"></textarea>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">Retry Times</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="retry_times" class="layui-textarea" required lay-verify="required" lay-error="Retry Times不能为空" placeholder="请输入Retry Times"></textarea>
            </div>
        </div>
       
        <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
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
        layui.use("lpform")



</script>

</html>
