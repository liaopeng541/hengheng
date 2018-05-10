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
                        表id
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["level_id"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        等级名称
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["level_name"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        预充金额
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["amount"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        APP列表页展示
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["list_show_lp"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        APP首页展示
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["is_show_lp"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        展示图片
                    </div>
                </div>
                <div class="lp-detail-content">
                    <div style="padding: 5px" id="original_img_box">
                        <ul class="lp_upfile_list">
<?if($data["thumb"]){?><li id="item-1" class="lp_upfile_itme">
                                <img id="item-img-1" src="<?=$data["thumb"]?>" style="display: inline-block;">
                            </li><?}?>
<div style="clear: both"></div>
                        </ul>
                    </div>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        描述
                    </div>
                </div>
                <div class="lp-detail-content">
                    <?=$data["describe"]?>

                </div>
            </div>
        

            <div class="lp-detail-box-row ">
                <div class="lp-detail-lable">
                    <div class="lp-detail-lable-title">
                        详情图片
                    </div>
                </div>
                <div class="lp-detail-content">
                    <div style="padding: 5px" id="original_img_box">
                        <ul class="lp_upfile_list">
<?$content="";
                                if($data["detail_img"]){
                                foreach ($data["detail_img"] as $key=>$val)
                                {
                                    $content.='<li id="item-'.$key.'" class="lp_upfile_itme">
                                <img id="item-img-'.$key.'" src="'.$val.'" style="display: inline-block;">
                            </li>';
                                }}\n echo $content?>
<div style="clear: both"></div>
                        </ul>
                    </div>

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
