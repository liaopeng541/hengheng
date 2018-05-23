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
            <!--头部搜索-->
                        <section class="panel panel-padding">
                <form class="layui-form" data-params='{"dataName":"admin-auth-item","action":"list"}' action="<?=\yii\helpers\Url::toRoute("admin-auth-item/index")?>">
                    <div class="layui-form">
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="name" placeholder="名称" />
                            </div>
                        </div>
                                                <div class="layui-inline">
                            <button lay-submit class="layui-btn" lay-filter="search">查找</button>
                        </div>
                    </div>
                </form>
            </section>
            
            <!--列表-->
            <section class="panel panel-padding">
                <div class="group-button">
                                        <button class="layui-btn layui-btn-small modal" data-params='{"content":".add-subcat","area":"500px,auto", "title":"添加","type":"1","dataName":"admin-auth-item","key":"created_at","action":"add","url":"<?=\yii\helpers\Url::toRoute("admin-auth-item/add")?>"}'>
                        <i class="iconfont">&#xe649;</i> 添加
                    </button>
                                                                                                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" data-params='{"url": "<?=\yii\helpers\Url::toRoute("admin-auth-item/delete")?>","dataName":"admin-auth-item","key":"created_at","action":"del","confirm":"true","title":"您确定要删除多条记录么？"}'>
                        <i class="iconfont">&#xe626;</i> 删除
                    </button>
                                    </div>
                <div class="layui-form">
                    <table id="example" class="layui-table jq-even" data-params='{"dataName":"admin-auth-item","key":"created_at"}'>
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="checkall" data-name="name" lay-filter="check" lay-skin="primary"></th>
                                                        <th>名称</th>
                            <th>表述</th>
                            <th width="260">操作</th>
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
    <form id="form1" class="layui-form layui-form-pane" data-params='{"dataName":"admin-auth-item","key":"created_at","action":"add"}' action="#" method="POST">
        <div class="layui-form-item">
                            <label class="layui-form-label">名称</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="name" required jq-verify="required" jq-error="名称不能为空" placeholder="请输入名称" />
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">描述</label>
                            <div class="layui-input-block">
                            <textarea  name="description" class="layui-textarea" placeholder="请输入描述"></textarea>
                            </div>
                        </div>
                                <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                <button class="layui-btn" jq-submit jq-filter="submit" lp-sub>立即提交</button>
                <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
</body>
<script id="list-tpl" type="text/html" data-params='{"url":"<?=\yii\helpers\Url::toRoute("admin-auth-item/index")?>","dataName":"admin-auth-item","key":"created_at","pageid":"#page","server":"true"}'>

    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td><input type="checkbox" name="name" value="{{ item.name}}" lay-skin="primary"></td>

        <td>{{# if(item.name != null && item.name != undefined){}}{{ item.name}}{{#}}}</td>
<td>{{# if(item.description != null && item.description != undefined){}}{{ item.description}}{{#}}}</td>

        <td style="text-align: center">
                        <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini modal" data-params='{"content":"<?=Yii::$app->request->getHostInfo().\yii\helpers\Url::toRoute("admin-auth-item/edit")?>","title":"编辑","type":2,"data":"created_at={{item.created_at}}"}'>
                    <i class="iconfont">&#xe653;</i>编辑与授权
                </button>
            </div>
                                    <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini layui-btn-danger ajax" data-params='{"url": "<?=\yii\helpers\Url::toRoute("admin-auth-item/delete")?>","data":"created_at={{item.created_at}}","action":"del","confirm":"true","title":"您确定要删除这条记录么？"}'>
                    <i class="iconfont">&#xe626;</i>删除
                </button>
            </div>
                    </td>
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
    layui.use('list');
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
</script>

</html>
