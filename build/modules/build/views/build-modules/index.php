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
    <!-- load css -->
    <link rel="stylesheet" type="text/css" href="admin/css/bootstrap.min.css?v=v3.3.7" media="all">
    <link rel="stylesheet" type="text/css" href="admin/css/font/iconfont.css?v=1.0.1" media="all">
    <link rel="stylesheet" type="text/css" href="admin/css/layui.css?v=1.0.9" media="all">
    <link rel="stylesheet" type="text/css" href="admin/css/main.css?v1.4.0" media="all">
    <script src="admin/js/laydate/laydate.js"></script>
</head>


<body>
<div class="container-fluid larry-wrapper">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <!--列表-->
            <section class="panel panel-padding">
                <div class="group-button">
                    <button class="layui-btn layui-btn-small modal" data-params='{"content":".add-subcat","area":"500px,500px", "title":"添加模块","type":"1","dataName":"modules-list","key":"id","action":"add","url":"<?=\yii\helpers\Url::toRoute("build-modules/addmudule")?>"}'>
                        <i class="iconfont">&#xe649;</i> 添加
                    </button>
                </div>
                <div class="layui-form">
                    <table id="example" class="layui-table jq-even" data-params='{"dataName":"modules-list","key":"id"}'>
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="checkall" data-name="id" lay-filter="check" lay-skin="primary"></th>
                            <th width="70"><span class="order" data-params='{"field":"id","sort":"asc"}'> ID</span></th>
                            <th>项目</th>
                            <th>模块</th>
                            <th>路径</th>
                        </tr>
                        </thead>
                        <tbody id="list"></tbody>
                    </table>
                </div>

                <div class="text-right" id="page"></div>
            </section>
        </div>
    </div>
</div>
<div class="add-subcat">
    <form id="form1" class="layui-form" data-params='{"dataName":"modules-list","key":"id","action":"add"}' action="#" method="POST">
        <div class="layui-form-item">
            <label class="layui-form-label">项目</label>
            <div class="layui-input-block">
                <select name="app" required jq-verify="required">
                    <?
                        foreach ($prj as $val)
                        {
                            echo '<option value="'.$val.'">'.$val.'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">模块名</label>
            <div class="layui-input-block">
                <input type="text" name="modules" required jq-verify="required" jq-error="请输入模块名" placeholder="请输入模块名" autocomplete="off" class="layui-input ">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">生成菜单</label>
            <div class="layui-input-block">
                <input lay-filter="switchTest" type="checkbox" name="menu" lay-skin="switch" lay-text="是|否"  value="1" checked>
            </div>
        </div>
        <div class="layui-form-item lp-menu">
            <label class="layui-form-label">菜单名称</label>
            <div class="layui-input-block">
                <input type="text" name="menu_name"  jq-error="请输入模块名" placeholder="请输入模块名" autocomplete="off" class="layui-input ">
            </div>
        </div>
        <div class="layui-form-item lp-menu">
            <label class="layui-form-label">图标</label>
            <div class="layui-input-block">
                <input type="hidden" name="menu_icon"  id="iconinput"   jq-error="请输入模块名" placeholder="请输入模块名" autocomplete="off" class="layui-input ">

                    <i class="iconfont" style="font-size: 36px;line-height: 100%;height: 100%;float: left" id="icondata" data=""></i>

                <div style="float: left;width: 50%;height: 36px;line-height: 36px;padding-left: 20px">
                    <div id="changeicon" class="layui-btn" style="margin: 0 auto;">
                        更换
                    </div>
                </div>

            </div>
        </div>
        <div class="layui-form-item lp-menu">
            <label class="layui-form-label">是否显示</label>
            <div class="layui-input-block">
                <input  type="checkbox" name="display" lay-skin="switch" lay-text="是|否"  value="1" checked>
            </div>
        </div>
        <div class="layui-form-item lp-menu">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="text" name="sort"  jq-error="请输入模块名" placeholder="请输入模块名" autocomplete="off" class="layui-input " value="50">
            </div>
        </div>
        <div class="layui-form-item" style="position: absolute;bottom: 0px;left: 0px;right: 0px">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                <button class="layui-btn" jq-submit jq-filter="submit">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
</body>
<script id="list-tpl" type="text/html" data-params='{"url":"<?=\yii\helpers\Url::toRoute("build-modules/index")?>","dataName":"modules-list","key":"id","pageid":"#page","server":"true"}'>

    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td><input type="checkbox" name="id" value="{{ item.id}}" lay-skin="primary"></td>

        <td>{{ item.id}}</td>
        <td>{{ item.app}}</td>
        <td>{{ item.modules}}</td>
        <td>{{ item.path}}</td>


    </tr>
    {{# }); }}
</script>
<script src="admin/js/layui/layui.js"></script>
<script>
    layui.config({
        base: 'admin/js/',
        version: "2.0.0"
    }).extend({
        jqelem: 'jqmodules/jqelem',
        jqmenu: 'jqmodules/jqmenu',
        tabmenu: 'jqmodules/tabmenu',
        jqajax: 'jqmodules/jqajax',
        jqtable: 'jqmodules/jqtable',
        jqbind: 'jqmodules/jqbind',
        jqdate: 'jqmodules/jqdate',
        jqtags: 'jqmodules/jqtags',
        jqform: 'jqmodules/jqform',
        echarts: 'lib/echarts',
        webuploader: 'lib/webuploader',
        jqcitys: "jqmodules/jqcitys",
        simpleform: "jqmodules/simpleform"
    })
</script>
<script>
    layui.use(['jquery','layer','form'],function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        $("#changeicon").on("click",function () {
            layer.open({
                type: 2,
                title: '选择图标',
                shadeClose: true,
                shade: 0,
                area: ['700px', '600px'],
                content: '<?=\yii\helpers\Url::toRoute("build-modules/icon")?>',
                btn: ['确定', '取消'],
                btnAlign: 'c',
                yes:function(index, layero){
                    var data = $("#icondata").attr("data");
                    $("#icondata").html(data);
                    $("#iconinput").val(data);
                    layer.close(index);
                },

            });

        })
        var form=layui.form();
        form.on('switch(switchTest)', function(data){
            this.checked ?$(".lp-menu").show():$(".lp-menu").hide()
        });
    });
    layui.use('list');
    laydate.render({
        elem: '.start_time',
        format:'yyyy-MM-dd HH:mm:ss',
        type: 'datetime'
    });


</script>

</html>
