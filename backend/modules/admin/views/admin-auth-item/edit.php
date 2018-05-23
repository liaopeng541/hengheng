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
            <section class="panel panel-padding">
                <form id="form1" class="layui-form" data-params='{"dataName":"admin-auth-item","key":"created_at","action":"edit","bind":true}' action="<?=\yii\helpers\Url::toRoute("admin-auth-item/update")?>" method="post">
                    <div class="layui-form-item ">
                        <div class="layui-form-item">
                            <label class="layui-form-label">角色名称</label>
                            <div class="layui-input-block">
                                <input type="hidden" name="name" value="<?=$data->name?>">
                                <input type="text" name="new_name" jq-verify="required" jq-error="请输入标题" placeholder="请输入标题" autocomplete="off" class="layui-input " value="<?=$data->name?>">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">描述</label>
                            <div class="layui-input-block">
                                <textarea name="description" placeholder="角色的描述" class="layui-textarea"></textarea>

                            </div>
                        </div>
                        <div class="layui-form-item permission-list">
                            <label class="layui-form-label">拥有权限</label>
                            <div class="layui-input-block role-box" id="list"></div>
                        </div>
                    </div>

                    <div class="layui-form-item" style="text-align: center">
                        <div class="layui-input-block">
                            <button class="layui-btn" lp-sub jq-submit jq-filter="submit">立即保存</button>
                            <div id="lp-cannse" class="layui-btn layui-btn-primary">返回</div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
<script id="list-tpl" type="text/html" data-params='{"url":"<?=\yii\helpers\Url::toRoute('/admin/admin-menu/getallmenu')?>","dataName":"permision","callBack":"bindRole"}'>
    {{# layui.each(d.list, function(index, item){ }}
    <div class="jq-role-inline">
        <fieldset class="layui-elem-field">
            <legend>{{ item.name}}</legend>
            <div class="layui-field-box" style="padding: 10px 8px;">
                {{# if(item.sub && item.sub.length>0){ }}
                <ul>
                    {{# layui.each(item.sub, function(index2, item2){ }}
                    <li><input type="checkbox" name="role[]" value="{{item2.url}}" title="{{item2.name}}" lay-skin="primary" lay-filter="role" /> {{# if(item2.sub && item2.sub.length>0){ }} {{# layui.each(item2.sub, function(index3, item3){ }}
                        <dl> <input type="checkbox" name="role[]" value="{{item3.url}}" title="{{item3.name}}" lay-skin="primary" lay-filter="role" /> {{# if(item3.sub && item3.sub.length>0){ }} {{# layui.each(item3.sub, function(index4, item4){ }}
                            <dd><input type="checkbox" name="role[]" value="{{item4.url}}" title="{{item4.name}}" lay-skin="primary" lay-filter="role" /></dd>
                            {{# }) }} {{# } }}
                        </dl>
                        {{# }) }} {{# } }}

                    </li>
                    {{# }) }}
                </ul>
                {{# } }}
            </div>
        </fieldset>
    </div>
    {{# }) }}
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
    layui.use('role');
    laydate.render({
        elem: '.date_time',
        format: 'yyyy-MM-dd HH:mm:ss',
        type: 'datetime'
    });
    laydate.render({
        elem: '.date',
        format: 'yyyy-MM-dd',
        type: 'date'
    });
    laydate.render({
        elem: '.time',
        format: 'HH:mm:ss',
        type: 'time'
    });
    laydate.render({
        elem: '.add_date_time',
        format: 'yyyy-MM-dd HH:mm:ss',
        type: 'datetime'
    });
    laydate.render({
        elem: '.add_date',
        format: 'yyyy-MM-dd',
        type: 'date'
    });
    laydate.render({
        elem: '.add_time',
        format: 'HH:mm:ss',
        type: 'time'
    });
    layui.use('jquery',function () {
        $=layui.jquery;
        $("#lp-cannse").on("click",function () {
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        })
    })
</script>

</html>
