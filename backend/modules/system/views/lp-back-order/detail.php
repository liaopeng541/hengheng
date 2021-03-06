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
<div class="lp-detail-box">
    <div class="lp-detail-box-row ">
        <div class="lp-detail-lable">
            <div class="lp-detail-lable-title">
                ID
            </div>
        </div>
        <div class="lp-detail-content">
            <?=$data["id"]?>

        </div>
    </div>


    <div class="lp-detail-box-row ">
        <div class="lp-detail-lable">
            <div class="lp-detail-lable-title">
                订单编号
            </div>
        </div>
        <div class="lp-detail-content">
            <?=$data["order_sn"]?>

        </div>
    </div>

    <div class="lp-detail-box-row ">
        <div class="lp-detail-lable">
            <div class="lp-detail-lable-title">
                退货原因
            </div>
        </div>
        <div class="lp-detail-content">
            <?=$data["reason"]?>

        </div>
    </div>


    <div class="lp-detail-box-row ">
        <div class="lp-detail-lable">
            <div class="lp-detail-lable-title">
                用户ID
            </div>
        </div>
        <div class="lp-detail-content">
            <?=$data["user_id"]?>

        </div>
    </div>


    <div class="lp-detail-box-row ">
        <div class="lp-detail-lable">
            <div class="lp-detail-lable-title">
                申请时间
            </div>
        </div>
        <div class="lp-detail-content">
            <?=$data["add_time"]?>

        </div>
    </div>


    <div class="lp-detail-box-row ">
        <div class="lp-detail-lable">
            <div class="lp-detail-lable-title">
                订单总额
            </div>
        </div>
        <div class="lp-detail-content">
            <?=$data["order_total"]?>

        </div>
    </div>

    <div class="lp-detail-box-row ">
        <div class="lp-detail-lable">
            <div class="lp-detail-lable-title">
                状态
            </div>
        </div>
        <div class="lp-detail-content">
            <?=$data["status_lp"]?>

        </div>
    </div>
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
        lplist: "src/lpui/lplist"
    })
</script>
<script>
    layui.use(['jquery'], function () {
        var $ = layui.jquery;


    })

</script>

</html>
