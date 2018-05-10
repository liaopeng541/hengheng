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
    <link rel="stylesheet" type="text/css" href="admin/src/lpui/ztree/css/metroStyle/metroStyle.css">
    <link rel="stylesheet" type="text/css" href="admin/src/lpui/css/lpui.css">
</head>
<body>
<div class="container-fluid larry-wrapper">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <!--头部搜索-->
                            <section class="panel panel-padding">
                    <form class="layui-form"
                          data-params='{"dataName":"lp-users","action":"list"}'
                          action="<?=\yii\helpers\Url::toRoute("lp-users/index")?>">
                        <div class="layui-form">
                            <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="email" placeholder="邮件" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="password" placeholder="密码" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="paypwd" placeholder="支付密码" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="mobile" placeholder="手机号码" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="level" placeholder="会员等级">
                                    <option value="">请选择会员等级</option>
                                    <? foreach ($lp_user_level_level_id as $key=>$val)
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
                                            <button class="layui-btn layui-btn-small modal"
                                data-params='{"content":"<?=\yii\helpers\Url::toRoute("lp-users/add")?>","area":"800px,800px", "title":"添加","type":"2","dataName":"lp-users","key":"user_id"}'>
                            <i class="iconfont">&#xe649;</i> 添加
                        </button>
                                                                                        <button class="layui-btn layui-btn-small layui-btn-normal ajax-all"
                                data-params='{"url": "<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>","data":"k=is_lock&is_lock_v=1","dataName":"lp-users","key":"user_id"}'>
                            <i class="layui-icon">&#x1005;</i> 启用
                        </button>
                                                                                        <button class="layui-btn layui-btn-small layui-btn-warm ajax-all"
                                data-params='{"url": "<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>","data":"k=is_lock&is_lock_v=0","dataName":"lp-users","key":"user_id"}'>
                            <i class="layui-icon">&#x1005;</i> 禁用
                        </button>
                                                                <button class="layui-btn layui-btn-small layui-btn-danger ajax-all"
                                data-params='{"url": "<?=\yii\helpers\Url::toRoute("lp-users/delete")?>","dataName":"lp-users","key":"user_id","action":"del","confirm":"true","title":"您确定要删除多条记录么？"}'>
                            <i class="iconfont">&#xe626;</i> 删除
                        </button>
                                    </div>
                <div class="layui-form">
                    <table id="example" class="layui-table jq-even"
                           data-params='{"dataName":"lp-users","key":"user_id"}'>
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="checkall" data-name="user_id"
                                                  lay-filter="check" lay-skin="primary"></th>
                                                        <th><span class="order" data-params='{"field":"user_id","sort":"asc"}'> 编号</span></th>
                            <th>邮件</th>
                            <th>性别</th>
                            <th><span class="order" data-params='{"field":"user_money","sort":"asc"}'> 用户金额</span></th>
                            <th><span class="order" data-params='{"field":"pay_points","sort":"asc"}'> 积分</span></th>
                            <th><span class="order" data-params='{"field":"reg_time","sort":"asc"}'> 注册时间</span></th>
                            <th><span class="order" data-params='{"field":"mobile","sort":"asc"}'> 手机号码</span></th>
                            <th><span class="order" data-params='{"field":"head_pic","sort":"asc"}'> 头像</span></th>
                            <th><span class="order" data-params='{"field":"level","sort":"asc"}'> 会员等级</span></th>
                            <th><span class="order" data-params='{"field":"level_end_time","sort":"asc"}'> 等级失效时间</span></th>
                            <th><span class="order" data-params='{"field":"is_lock","sort":"asc"}'> 冻结</span></th>
                                <th width="260">操作</th>
                                                    </tr>
                        </thead>
                        <tbody id="list"></tbody>
                    </table>
                </div>

                <div class="group-button" style="width: 40%;margin-right: 10px;float: left">

                                            <button class="layui-btn layui-btn-small layui-btn-danger lp-export">
                            <i class="iconfont"></i> 导出
                        </button>
                                    </div>
                <div class="text-right" style="width: 50%;float: right" id="page"></div>
                <div style="clear: both"></div>
            </section>
        </div>
    </div>
</div>
</body>
<script id="list-tpl" type="text/html"
        data-params='{"url":"<?=\yii\helpers\Url::toRoute("lp-users/index")?>","dataName":"lp-users","key":"user_id","pageid":"#page","server":"true"}'>

    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td><input type="checkbox" name="user_id" value="{{ item.user_id}}" lay-skin="primary"></td>

        <td>
<p class="lp-onelinetext" title="{{# if(item.user_id != null && item.user_id != undefined){}}{{ item.user_id}}{{#}}}">{{# if(item.user_id != null && item.user_id != undefined){}}{{ item.user_id}}{{#}}}</p>
</td><td>{{# if(item.email != null && item.email != undefined){}}{{ item.email}}{{#}}}</td>
<td>
<p class="lp-onelinetext" title="{{# if(item.sex != null && item.sex != undefined){}}{{ item.sex}}{{#}}}">{{# if(item.sex != null && item.sex != undefined){}}{{ item.sex}}{{#}}}</p>
</td><td class="edit" data-params='{"url":"<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>","data":"user_id={{ item.user_id}}&k=user_money&type=set","field":"user_money_v","input_width":"50px"}'>{{ item.user_money}}</td>
<td>
<p class="lp-onelinetext" title="{{# if(item.pay_points != null && item.pay_points != undefined){}}{{ item.pay_points}}{{#}}}">{{# if(item.pay_points != null && item.pay_points != undefined){}}{{ item.pay_points}}{{#}}}</p>
</td><td>{{# if(item.reg_time != null && item.reg_time != undefined){}}{{ item.reg_time}}{{#}}}</td>
<td>
<p class="lp-onelinetext" title="{{# if(item.mobile != null && item.mobile != undefined){}}{{ item.mobile}}{{#}}}">{{# if(item.mobile != null && item.mobile != undefined){}}{{ item.mobile}}{{#}}}</p>
</td><td><a href="{{item.head_pic}}" class="img" target="_blank">{{# if(item.head_pic){}}<img src="{{item.head_pic}}" alt="..." class="img-thumbnail lp-thumb">{{# }}}</a></td>
<td>
<p class="lp-onelinetext" title="{{# if(item.level != null && item.level != undefined){}}{{ item.level}}{{#}}}">{{# if(item.level != null && item.level != undefined){}}{{ item.level}}{{#}}}</p>
</td><td>{{# if(item.level_end_time != null && item.level_end_time != undefined){}}{{ item.level_end_time}}{{#}}}</td>
<td><input type="checkbox" name="is_lock_v" lay-skin="switch" lay-text="启用|禁用" value="1" {{#if (item.is_lock>0){ }}checked="checked" {{# } }} lay-filter="ajax" data-params='{"url":"<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>","data":"user_id={{ item.user_id}}&k=is_lock","action":"edit"}'></td>

            <td style="text-align: center">
                                    <div class="layui-btn-group">
                        <button class="layui-btn layui-btn-mini modal"
                                data-params='{"content": "<?=\yii\helpers\Url::toRoute("lp-users/update")?>","area":"800px,800px","title":"编辑","data":"user_id={{item.user_id}}","type":"2"}'>
                            <i class="iconfont">&#xe653;</i>编辑
                        </button>
                    </div>
                                                    <div class="layui-btn-group">
                        <button class="layui-btn layui-btn-mini layui-btn-danger ajax"
                                data-params='{"url": "<?=\yii\helpers\Url::toRoute("lp-users/delete")?>","data":"user_id={{item.user_id}}","action":"del","confirm":"true","title":"您确定要删除这条记录么？"}'>
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
        layui.use(['jquery', 'layer'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        $(".lp-export").on("click", function () {
            var table = top.global['lp-users'];
            var url = table.options.url;
            url = url.replace("index&", "exportexcel&");
            var index = layer.msg('加载中', {
                icon: 16
                , shade: 0.4,
                time: 20000,
            });
            var $form = $('<form method="POST"></form>');
            $form.attr('action', url);
            $form.appendTo($('body'));
            $form.submit();
            layer.close(index);
        })


    })

    </script>

</html>
