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
                        Goods ID
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["goods_id_lp"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        图片
                    </div>
                </div>
                <div class="lp-detail-content">
                    <div style="padding: 5px" id="original_img_box">
                        <ul class="lp_upfile_list">
<?if($data["image"]){?><li id="item-1" class="lp_upfile_itme">
                                <img id="item-img-1" src="<?=$data["image"]?>" style="display: inline-block;">
                            </li><?}?>
<div style="clear: both"></div>
                        </ul>
                    </div>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        链接
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["url"]?>

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
                        事件
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["type_lp"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        排序
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["order"]?>

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
