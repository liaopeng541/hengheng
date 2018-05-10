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


<div class="lp-center-box-main">
    <div class="lp-grid">
        <div class="lp-table-top">
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-sm  lp-drop-table"
                        lp-data="{'width':'500px','height':'300px','o':'bottom','url':'<?=\yii\helpers\Url::toRoute("/shop/lp-goods/select-table")?>'}"
                        style="background: #2980B9"><i class="layui-icon"></i>添加
                </button>
                <button class="layui-btn layui-btn-sm  lp-drop-table"
                        lp-data="{'width':'500px','height':'300px','o':'bottom','url':'<?=\yii\helpers\Url::toRoute("/shop/lp-goods/select-table")?>'}"
                        style="background: #2980B9"><i class="layui-icon"></i>添加
                </button>
                <button class="layui-btn layui-btn-sm layui-btn-normal lp-test"><i class="layui-icon"></i>修改</button>
                <button class="layui-btn layui-btn-sm layui-btn-danger" style="background: #D35400"><i
                            class="layui-icon"></i>删除
                </button>
                <button class="layui-btn layui-btn-sm " style="background:#27AE60"><i class="layui-icon"></i>启用</button>
                <button class="layui-btn layui-btn-sm layui-btn-danger" style="background:#E74C3C"><i
                            class="layui-icon"></i>禁用
                </button>
                <button class="layui-btn layui-btn-sm lp-drop-btn" style="background:#9B59B6"><i
                            class="layui-icon"></i>导出<i class="layui-icon">&#xe625;</i>
                    <div class="lp-drop-box">
                        <dl>
                            <dd><i class="layui-icon">&#xe60b;</i><span>详细情况</span></dd>
                            <dd><i class="layui-icon">&#xe60b;</i><span>详细情况</span></dd>
                            <dd><i class="layui-icon">&#xe60b;</i><span>详细情况</span></dd>
                            <dd><i class="layui-icon">&#xe60b;</i><span>详细情况</span></dd>
                        </dl>
                    </div>
                </button>
                <button class="layui-btn layui-btn-sm lp-drop-btn" style="background:#9B59B6"><i
                            class="layui-icon"></i>导出<i class="layui-icon">&#xe625;</i>
                    <div class="lp-drop-box">
                        <dl>
                            <dd><i class="layui-icon">&#xe60b;</i><span>详细情况</span></dd>
                            <dd><i class="layui-icon">&#xe60b;</i><span>详细情况</span></dd>
                            <dd><i class="layui-icon">&#xe60b;</i><span>详细情况</span></dd>
                            <dd><i class="layui-icon">&#xe60b;</i><span>详细情况</span></dd>
                        </dl>
                    </div>
                </button>
            </div>
            <form class="layui-form lp-search-form" action="" style="display: inline">
                <div class="layui-input-inline">
                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                </div>


                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <button class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                </div>

            </form>
        </div>
        <div class="c-c-box">

            <table class="layui-table" lay-filter="demob"
                   lay-data="{cellMinWidth: 80,height:'full-340', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("lp-users/index")?>','id':'user'}">
                <thead>
                <tr>
                    <th lay-data="{type:'checkbox'}">ID</th>
                    <th lay-data="{field:'user_id', width:100, sort: true}">编号</th>
                    <th lay-data="{field:'sex_lp', width:100}">性别</th>
                    <th lay-data="{field:'user_money', width:100, sort: true}">用户金额</th>
                    <th lay-data="{field:'pay_points', minWidth: 150}">积分</th>
                    <th lay-data="{field:'reg_time', sort: true, align: 'right'}">注册时间</th>
                    <th lay-data="{field:'mobile', sort: true, minWidth: 100, align: 'right'}">手机号码</th>
                </tr>
                </thead>
            </table>
            <div class="lp-search-box">
                <div class="lp-search-title">
                    <div class="lp-search-close">
                        <i class="layui-icon">&#xe65b;</i>
                    </div>
                </div>
                <div class="layui-body lp-search-body">
                    <form class="layui-form layui-form-pane" action="" style="padding: 5px">
                        <div class="layui-form-item">
                            <label class="layui-form-label">姓名</label>
                            <div class="layui-input-block">
                                <input type="text" name="title" required lay-verify="required" placeholder="请输入标题"
                                       autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">签名</label>
                            <div class="layui-input-block">
                                <input type="text" name="title" required lay-verify="required" placeholder="请输入标题"
                                       autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">范围</label>
                                <div class="layui-input-inline" style="width: 100px;">
                                    <input type="text" name="price_min" placeholder="￥" autocomplete="off"
                                           class="layui-input">
                                </div>
                                <div class="layui-form-mid">-</div>
                                <div class="layui-input-inline" style="width: 100px;">
                                    <input type="text" name="price_max" placeholder="￥" autocomplete="off"
                                           class="layui-input">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">输入框</label>
                            <div class="layui-input-block">
                                <input type="text" name="title" required lay-verify="required" placeholder="请输入标题"
                                       autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">单行选择框</label>
                            <div class="layui-input-block">
                                <select name="interest" lay-filter="aihao">
                                    <option value=""></option>
                                    <option value="0">写作</option>
                                    <option value="1" selected="">阅读</option>
                                    <option value="2">游戏</option>
                                    <option value="3">音乐</option>
                                    <option value="4">旅行</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <label class="layui-form-label">单选框</label>
                            <div class="layui-input-block">
                                <input type="radio" name="sex" value="男" title="男" checked="">
                                <input type="radio" name="sex" value="女" title="女">
                                <input type="radio" name="sex" value="禁" title="禁用" disabled="">
                            </div>
                        </div>

                    </form>


                </div>
                <div class="lp-search-sub-btn">
                    <button class="layui-btn layui-btn-sm layui-btn-default">搜 索</button>
                    <button class="layui-btn layui-btn-sm layui-btn-primary">重 置</button>


                </div>

            </div>
            <div class="lp-sear-btn lp-tip" lp-tip-box="lp-tip">
                <i class="layui-icon">&#xe615;</i> 更多搜索
            </div>

        </div>
    </div>
    <div class="b-drag-box">
    </div>
    <div class="c-b-box">
        <div class="layui-tab layui-tab-brief" lay-filter="lp-tow-bottom" style="width: 100%;height: 100%;margin: 0px">
            <ul class="layui-tab-title">
                <li lp-data="{url:'<?=\yii\helpers\Url::toRoute("/shop/lp-goods/select-table")?>'}" class="layui-this">车辆</li>
                <li lp-data="{url:'<?=\yii\helpers\Url::toRoute("/shop/lp-goods/select-table")?>'}">后备箱</li>
                <li lp-data="{url:'<?=\yii\helpers\Url::toRoute("/shop/lp-goods/select-table")?>'}">门店订单</li>
                <li lp-data="{url:'<?=\yii\helpers\Url::toRoute("/shop/lp-goods/select-table")?>'}">商城订单</li>
                <li lp-data="{url:'http://www.baidu.com'}">卡劵记录</li>
                <li lp-data="{url:'http://www.baidu.com'}">充值记录</li>
                <li lp-data="{url:'http://www.baidu.com'}">资金流水</li>
            </ul>
            <div  style="padding: 0px;padding-bottom: 40px;height: 100%;-webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;">

                    <iframe  frameborder="0" name="content" scrolling="no" width="100%"  height="100%" src="<?=\yii\helpers\Url::toRoute("/shop/lp-goods/select-table")?>"></iframe>

            </div>
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
    layui.use(['lpsearchbox',"lpresize", 'jquery', 'lplist','lpui'], function () {
        var $ = layui.jquery;
        layui.table.on('row(demob)', function(obj){




        });
        function getlpdata(obj) {
            return eval('('+$(obj).attr("lp-data")+')');
        }
        layui.element.on('tab(lp-tow-bottom)',function (obj) {
            var ele = $(obj.elem).find("li[lp-data]")[obj.index];
            var data = getlpdata(ele)
            $(obj.elem).find("iframe").attr("src",data.url);

        })






    })

</script>

</html>
