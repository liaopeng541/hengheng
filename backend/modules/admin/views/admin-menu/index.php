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
                <form class="layui-form" data-params='{"dataName":"admin-menu","action":"list"}'
                      action="<?= \yii\helpers\Url::toRoute("admin-menu/index") ?>">
                    <div class="layui-form">
                        <div class="layui-inline">

                            <div class="layui-input-inline">
                                <input class="layui-input" name="name" placeholder="菜单名称"/>
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
                    <button class="layui-btn layui-btn-small modal"
                            data-params='{"content":".add-subcat","area":"500px,auto", "title":"添加","type":"1","dataName":"admin-menu","key":"id","action":"add","url":"<?= \yii\helpers\Url::toRoute("admin-menu/add") ?>"}'>
                        <i class="iconfont">&#xe649;</i> 添加
                    </button>
                    <button class="layui-btn layui-btn-small layui-btn-normal ajax-all"
                            data-params='{"url": "<?= \yii\helpers\Url::toRoute("admin-menu/setstatus") ?>","data":"k=display&display_v=1","dataName":"admin-menu","key":"id"}'>
                        <i class="layui-icon">&#x1005;</i> 启用
                    </button>
                    <button class="layui-btn layui-btn-small layui-btn-warm ajax-all"
                            data-params='{"url": "<?= \yii\helpers\Url::toRoute("admin-menu/setstatus") ?>","data":"k=display&display_v=0","dataName":"admin-menu","key":"id"}'>
                        <i class="layui-icon">&#x1005;</i> 禁用
                    </button>
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all"
                            data-params='{"url": "<?= \yii\helpers\Url::toRoute("admin-menu/delete") ?>","dataName":"admin-menu","key":"id","action":"del","confirm":"true","title":"您确定要删除多条记录么？"}'>
                        <i class="iconfont">&#xe626;</i> 删除
                    </button>
                </div>
                <div class="layui-form">
                    <table id="example" class="layui-table jq-even" data-params='{"dataName":"admin-menu","key":"id"}'>
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="checkall" data-name="id" lay-filter="check"
                                                  lay-skin="primary"></th>
                            <th>ID</th>
                            <th>菜单名称</th>
                            <th>图标</th>
                            <th>链接</th>
                            <th>显示</th>
                            <th width="90">排序</th>

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
    <form id="form1" class="layui-form layui-form-pane"
          data-params='{"dataName":"admin-menu","key":"id","action":"add"}' action="#" method="POST">
        <div class="layui-form-item">
            <label class="layui-form-label">上级菜单</label>
            <div class="layui-input-block">
                <select name="pid" required jq-verify="required" id="menu_list" jq-error="上级菜单不能为空" placeholder="请输入上级菜单">
                    <option value="0">顶级菜单</option>
                    <? $opt = \yii\helpers\ArrayHelper::map($list, 'id', 'name');
                    foreach ($opt as $key => $val) {
                        echo '<option value="' . $key . '">' . $val . '</option>';
                    }
                    ?>


                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">菜单名称</label>
            <div class="layui-input-block">
                <input class="layui-input" name="sub_name" required jq-verify="required" jq-error="菜单名称不能为空"
                       placeholder="请输入菜单名称"/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">链接</label>
            <div class="layui-input-block">
                <input class="layui-input" name="url" required jq-verify="required" jq-error="链接不能为空"
                       placeholder="请输入链接"/>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">显示</label>
            <div class="layui-input-block">
                <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" class="layui-input " value="1" name="display"
                       checked/>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">图标</label>
            <div class="layui-input-block">
                <input type="hidden" name="iconfont" id="iconinput" value="&#xe637;"/>

                <i class="iconfont" style="font-size: 36px;line-height: 100%;height: 100%;float: left"
                   id="icondata" data=""></i>

                <div style="float: right;width: 50%;height: 36px;line-height: 36px;padding-left: 20px">
                    <div id="changeicon" class="layui-btn" style="margin: 0 auto;">
                        更换
                    </div>
                </div>

            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input class="layui-input" name="sort" required jq-verify="required" jq-error="排序不能为空"
                       placeholder="请输入排序" value="50"/>
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
<script id="list-tpl" type="text/html"
        data-params='{"url":"<?= \yii\helpers\Url::toRoute("admin-menu/index") ?>","dataName":"admin-menu","key":"id","pageid":"#page","server":"true"}'>

    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td><input type="checkbox" name="id" value="{{ item.id}}" lay-skin="primary"></td>

        <td>{{ item.id}}</td>
        <td>{{ item.name}}</td>
        <td><i class="iconfont">{{ item.iconfont}}</i></td>
        <td>{{ item.url}}</td>
        <td><input type="checkbox" name="display_v" lay-skin="switch" lay-text="显示|隐藏" value="1" {{#if (item.display>0){
            }}checked="checked" {{# } }} lay-filter="ajax"
            data-params='{"url":"<?= \yii\helpers\Url::toRoute("admin-menu/setstatus") ?>","data":"id={{
            item.id}}&k=display&type=set","action":"edit"}'>
        </td>
        <td class="edit"
            data-params='{"url":"<?= \yii\helpers\Url::toRoute("admin-menu/setstatus") ?>","data":"id={{ item.id}}&k=sort&type=set","field":"sort_v","input_width":"50px"}'>
            {{ item.sort}}
        </td>


        <td >
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini modal"
                        data-params='{"content": ".add-subcat","area":"520px,auto","title":"编辑","data":"id={{item.id}}","type":"1","action":"edit","bind":true,"url":"<?= \yii\helpers\Url::toRoute("admin-menu/update") ?>"}'>
                    <i class="iconfont">&#xe653;</i>编辑
                </button>
            </div>
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini layui-btn-normal modal" data-params='{"content":".add-subcat","area":"600px,430px","title":"添加子分类","data":"pid={{ item.id }}","action":"add","url":"<?=\yii\helpers\Url::toRoute("admin-menu/add")?>"}'>
                    <i class="iconfont">&#xe649;</i>添加子菜单
                </button>
            </div>
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-mini layui-btn-danger ajax"
                        data-params='{"url": "<?= \yii\helpers\Url::toRoute("admin-menu/delete") ?>","data":"id={{item.id}}","action":"del","confirm":"true","title":"您确定要删除这条记录么？"}'>
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
    layui.use(['jquery', 'layer', 'form'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        $("#changeicon").on("click", function () {
            layer.open({
                type: 2,
                title: '选择图标',
                shadeClose: true,
                shade: 0,
                area: ['700px', '600px'],
                content: '<?=\yii\helpers\Url::toRoute("admin-menu/icon")?>',
                btn: ['确定', '取消'],
                btnAlign: 'c',
                yes: function (index, layero) {
                    var data = $("#icondata").attr("data");
                    $("#icondata").html(data);
                    $("#iconinput").val(data);
                    layer.close(index);
                },

            });

        })
    })
</script>

</html>
