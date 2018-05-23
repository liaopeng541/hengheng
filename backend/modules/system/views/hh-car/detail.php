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
                        Brand Logo
                    </div>
                </div>
                <div class="lp-detail-content">
                    <div style="padding: 5px" id="original_img_box">
                        <ul class="lp_upfile_list">
<?if($data["brand_logo"]){?><li id="item-1" class="lp_upfile_itme">
                                <img id="item-img-1" src="<?=$data["brand_logo"]?>" style="display: inline-block;">
                            </li><?}?>
<div style="clear: both"></div>
                        </ul>
                    </div>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Car ID
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["car_id"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Carname
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["carname"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Datatime
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["datatime"]?>

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
                        Lever
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["lever"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Prices
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["prices"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Retry Times
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["retry_times"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Sela Status
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["sela_status"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Sell
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["sell"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Series
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["series"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Series ID
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["series_id"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        发动机
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["engine"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        变速箱
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["gearbox"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        最高车速(km/h)
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["maximum"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        车身结构
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["bodywork"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        长*宽*高(mm)
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["size"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Brand
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["brand"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Brand ID
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["brand_id"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        Letter
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["letter"]?>

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
