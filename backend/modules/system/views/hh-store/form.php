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
    .filter-service {
        border:1px solid rgb(230, 230, 230);border-top: none;
        padding: 12px 15px;
        max-height: 300px;
        overflow: auto;
    }
    .filter-service .service-tit {
        margin-left: 8px;
    }
    .filter-service .short-text {
        margin-bottom: 5px;
    }
    .filter-service h3 {
        color: #666;
        font-size: 14px;
        font-weight: bold;
    }
    .filter-service ul li {
        font-size: 12px;
        width: 30%;
        float: left;
    }
    .filter-service .layui-form-checkbox[lay-skin="primary"] span {
        color: #F85E23;
        overflow: hidden;
    }
    .filter-service ul li span b {
        color:#4592D3;
        font-weight: normal;
    }
</style>
<body>
<div class="container-fluid " style="padding:10px">
    <form class="layui-form layui-form-pane" action="<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("hh-store/update");}else{echo \yii\helpers\Url::toRoute("hh-store/add");}?>" lp-data="{<?if(isset($_GET["id"])){?>type:'edit',key:'id',value:<?=$_GET["id"]?>,<?}?>table:'hh-store'}">
        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input class="layui-input" name="name" required lay-verify="required" lay-error="名称不能为空" placeholder="请输入名称" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">介绍</label>
            <div class="layui-input-block">
                <input class="layui-input" name="desc" required lay-verify="required" lay-error="介绍不能为空" placeholder="请输入介绍" />
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">门店标签</label>
            <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="store_label" class="layui-textarea" required lay-verify="required" lay-error="门店标签不能为空" placeholder="请输入门店标签"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">地址</label>
            <div class="layui-input-block">
                <input class="layui-input" name="address" required lay-verify="required" lay-error="地址不能为空" placeholder="请输入地址" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">电话</label>
            <div class="layui-input-block">
                <input class="layui-input" name="tel" required lay-verify="required" lay-error="电话不能为空" placeholder="请输入电话" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">营业状态</label>
            <div class="layui-input-block">
                <select name="status" required lay-verify="required" lay-error="营业状态不能为空" placeholder="请输入营业状态">
                    <option value="">请选择营业状态</option>
                    <option value="0">未营业</option>
                    <option value="1">营业</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态说明</label>
            <div class="layui-input-block">
                <input class="layui-input" name="status_title" required lay-verify="required" lay-error="状态说明不能为空" placeholder="请输入状态说明" />
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">服务</label>
            <div class="layui-input-block">
                <div class="filter-service">
                    <input lay-vertype="tips" placeholder="关键字查找" autocomplete="off" class="layui-input short-text" style="width: 30%" >
                    <div class="service-tit"><h3>可以选择的服务 (<?=\common\models\HhService::getByCount();?>)</h3></div>
                    <ul>
                        <?php if(\common\models\HhService::getByList()) : ?>
                        <?php foreach (\common\models\HhService::getByList() as $k => $service) : ?>
                        <li data-service="<?=$service['name'];?>" data-serviceId="<?=$service['id'];?>">
                            <input type="checkbox" name="storeService[]" lay-skin="primary" value="<?=$service['id'];?>" title="【服务】<?=$service['name'];?>" <?php if( isset($storeService) && in_array($service['id'], $storeService)) :?>checked="checked"<?php endif; ?>>
                        </li>
                        <?php endforeach; ?>
                        <?php else :?>
                        <li>暂无服务,请快去添加服务</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">图片</label>
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
        <div class="layui-form-item layui-form-text" >
            <label class="layui-form-label">图集</label>
            <div class="layui-input-block"  style="border: 1px solid #e6e6e6; background: #ffffff">
            <div style="padding: 5px" id="thumbs_box">
                <input lp-key="thumbs"  class="lp_upfile_input" name="thumbs_file" lp-type="files" type="file" style="display: none">
                <ul class="lp_upfile_list">
                <div class="img-thumbnail lp_uploadfilebtn">+</div>
                    <div style="clear: both"></div>
                </ul>
            </div>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">详情</label>
            <div class="layui-input-block">
            <script id="details_edit" name="details" type="text/plain"></script>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                <? if (isset($_GET["id"])){ ?>      
                <button class="layui-btn" lay-submit lay-filter="edit">保存修改</button>
                    <div  lp-close class="layui-btn layui-btn-primary">关 闭</div>
                <? }else{ ?>                    
                <button class="layui-btn" lay-submit lay-filter="add">立即提交</button>
                    <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
                <? } ?>            
            </div>
        </div>
    </form>
</div>
</body>
<script src="admin/src/layui.js"></script>
    <script src="admin/src/lpui/lib/ueditor/ueditor.config.js"></script>
    <script src="admin/src/lpui/lib/ueditor/ueditor.all.js"></script>
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
<? if(!isset($_GET["id"])) { ?>
    UE.getEditor("details_edit");
<?}?>    
layui.use(['lpform','jquery'], function() {
    var $ = layui.jquery;
    var serviceLength = $('.filter-service ul li').length;
    $('.short-text').bind('input propertychange', function() { 
        for (var i=0; i<serviceLength;i++) {
            var service = $('.filter-service ul li').eq(i).attr('data-service');
            if (service.indexOf($(this).val()) >= 0) {
                $('.filter-service ul li').eq(i).show();
            } else {
                $('.filter-service ul li').eq(i).hide();
            }
        }
    });
    $('.layui-form-checkbox').on('click', function(){
        //console.log($(this).next($(input['type=hidden']).val()));
    })
})



</script>

</html>
