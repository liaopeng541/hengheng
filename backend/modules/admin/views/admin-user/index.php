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
                <form class="layui-form" data-params='{"dataName":"admin-user","action":"list"}' action="<?=\yii\helpers\Url::toRoute("admin-user/index")?>">

                    <div class="layui-form">
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="admin_name"  placeholder="请输入用户名" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <select name="role_name" placeholder="角色">
                                    <option value="">请选择角色</option>
                                    <? foreach ($admin_auth_item_name as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
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
                                        <button class="layui-btn layui-btn-small modal" data-params='{"content":".add-subcat","area":"500px,640px", "title":"添加","type":"1","dataName":"admin-user","key":"admin_id","action":"add","url":"<?=\yii\helpers\Url::toRoute("admin-user/add")?>"}'>
                        <i class="iconfont">&#xe649;</i> 添加
                    </button>
                                                                                                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" data-params='{"url": "<?=\yii\helpers\Url::toRoute("admin-user/delete")?>","dataName":"admin-user","key":"admin_id","action":"del","confirm":"true","title":"您确定要删除多条记录么？"}'>
                        <i class="iconfont">&#xe626;</i> 删除
                    </button>
                                    </div>
                <div class="layui-form">
                    <table id="example" class="layui-table jq-even" data-params='{"dataName":"admin-user","key":"admin_id"}'>
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="checkall" data-name="admin_id" lay-filter="check" lay-skin="primary"></th>
                                                        <th>ID</th>
                            <th>用户名</th>
                            <th>头像</th>
                            <th>超级管理员</th>
                            <th>状态</th>
                            <th>手机</th>
                            <th>角色</th>
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

    <form id="form1" class="layui-form layui-form-pane" data-params='{"dataName":"admin-user","key":"admin_id","action":"add"}' action="#" method="POST">
        <div class="layui-form-item">
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="admin_name" required jq-verify="required" jq-error="用户名不能为空" placeholder="请输入用户名" />
                            </div>
                        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">管理员密码</label>
            <div class="layui-input-block">
                <input type="password" class="layui-input" name="admin_password" required jq-verify="required" jq-error="管理员密码不能为空" placeholder="请输入管理员密码" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">角色</label>
            <div class="layui-input-block">
                <select name="role_name" required jq-verify="required" jq-error="角色不能为空" placeholder="请选择角色">
                    <option value="">请选择角色</option>
                    <? foreach ($admin_auth_item_name as $key=>$val)
                    {
                        echo '<option value="'.$key.'">'.$val.'</option>';
                    }?>
                </select>
            </div>
        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">头像</label>
                            <div class="layui-input-block">
                            <input type="file" name="file" class="layui-upload-file img">
                    <input type="hidden" name="admin_avatar" class="img" error-id="img-error">
                            </div>
                        </div>

                        <div class="layui-form-item" pane="">
                            <label class="layui-form-label">超级管理员</label>
                            <div class="layui-input-block">
                                <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" class="layui-input " value="1" name="admin_is_super"/>
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-block">
                                <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" class="layui-input " value="1" name="status" checked/>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="mobile" placeholder="请输入手机" />
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
<script id="list-tpl" type="text/html" data-params='{"url":"<?=\yii\helpers\Url::toRoute("admin-user/index")?>","dataName":"admin-user","key":"admin_id","pageid":"#page","server":"true"}'>

    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td><input type="checkbox" name="admin_id" value="{{ item.admin_id}}" lay-skin="primary"></td>

        <td>{{# if(item.admin_id != null && item.admin_id != undefined){}}{{ item.admin_id}}{{#}}}</td>
<td>{{# if(item.admin_name != null && item.admin_name != undefined){}}{{ item.admin_name}}{{#}}}</td>
<td><div class="img"><img src="{{ item.admin_avatar?item.admin_avatar:'admin/images/avatar.png'}}" alt="..." class="img-thumbnail"></div></td>
<td><input type="checkbox" name="admin_is_super_v" lay-skin="switch" lay-text="是|否" value="1" {{#if (item.admin_is_super>0){ }}checked="checked" {{# } }} lay-filter="ajax" data-params='{"url":"<?=\yii\helpers\Url::toRoute("admin-user/setstatus")?>&type=set","data":"admin_id={{ item.admin_id}}&k=admin_is_super","action":"edit"}'></td>
<td><input type="checkbox" name="status_v" lay-skin="switch" lay-text="启用|禁用"  value="1" {{#if (item.status>0){ }}checked="checked" {{# } }} lay-filter="ajax" data-params='{"url":"<?=\yii\helpers\Url::toRoute("admin-user/setstatus")?>","data":"admin_id={{ item.admin_id}}&k=status","action":"edit"}'></td>
<td>{{# if(item.mobile != null && item.mobile != undefined){}}{{ item.mobile}}{{#}}}</td>
<td>{{# if(item.role_name != null && item.role_name != undefined){}}{{ item.role_name}}{{#}}}</td>

        <td style="text-align: center">
                        <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini modal" data-params='{"content": ".add-subcat","area":"520px,640px","title":"编辑","data":"admin_id={{item.admin_id}}","type":"1","action":"edit","bind":true,"url":"<?=\yii\helpers\Url::toRoute("admin-user/update")?>"}'>
                    <i class="iconfont">&#xe653;</i>编辑
                </button>
            </div>
                                    <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini layui-btn-danger ajax" data-params='{"url": "<?=\yii\helpers\Url::toRoute("admin-user/delete")?>","data":"admin_id={{item.admin_id}}","action":"del","confirm":"true","title":"您确定要删除这条记录么？"}'>
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
