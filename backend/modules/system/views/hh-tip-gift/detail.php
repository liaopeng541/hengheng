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
                        介绍
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["desc"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        图标
                    </div>
                </div>
                <div class="lp-detail-content">
                    <div style="padding: 5px" id="original_img_box">
                        <ul class="lp_upfile_list">
<?if($data["icon"]){?><li id="item-1" class="lp_upfile_itme">
                                <img id="item-img-1" src="<?=$data["icon"]?>" style="display: inline-block;">
                            </li><?}?>
<div style="clear: both"></div>
                        </ul>
                    </div>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        计量单位
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["dot"]?>

                </div>
            </div>
        

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
                        价格
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["money"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        排序
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["sort"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        名称
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["name"]?>

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
