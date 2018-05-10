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

<div class="lp-grid">
    <div class="lp-table-top">
        <div class="layui-btn-group">
                        <button class="layui-btn layui-btn-sm lp-modal"
                    lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-users/add")?>',type:2,maxmin:true,area: ['893px', '600px'],title:'添加' ,full:true}"
                    style="background: #2980B9"><i class="layui-icon"></i>添加
            </button>
                                    <button class="layui-btn layui-btn-sm layui-btn-danger lp-all-del"
                    lp-data="{table:'lp-users',key:'user_id',url:'<?=\yii\helpers\Url::toRoute("lp-users/delete")?>'}" style="background: #D35400"><i class="layui-icon"></i>删除
            </button>
                                                                    <button class="layui-btn layui-btn-sm lp-all-set"
                                    lp-data="{table:'lp-users','field':'is_lock',value:1,checked:'on',key:'user_id',title:'启用',url:'<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>'}" style="background:#27AE60"><i class="layui-icon"></i>启用                            </button>
                            <button lp-data="{table:'lp-users','field':'is_lock',value:0,checked:'off',key:'user_id',title:'禁用',url:'<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>'}" class="lp-all-set layui-btn layui-btn-sm layui-btn-danger" style="background:#E74C3C"><i class="layui-icon"></i>禁用                            </button>

                            


                                    <button class="layui-btn layui-btn-sm lp-drop-btn" style="background:#9B59B6"><i
                        class="layui-icon"></i>导出<i class="layui-icon">&#xe625;</i>
                <div class="lp-drop-box">
                    <dl>
                        <dd lp-data="{table:'lp-users'}"><i class="layui-icon">&#xe62d;</i><span>excel文件</span></dd>
                    </dl>
                </div>
            </button>
            

        </div>
                <form class="layui-form lp-search-form" action="#">

            <div class="layui-input-inline">
                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题"
                       class="layui-input">
            </div>


            <div class="layui-input-inline">
                <input type="text" name="mobile" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <button lay-submit lp-table="lp-users" lay-filter="search"
                        class="layui-btn layui-btn-sm layui-btn-default"><i
                            class="layui-icon">&#xe615;</i>搜索
                </button>
                <div lp-reset-mini-search lp-table="lp-users"
                     class="layui-btn layui-btn-sm layui-btn-primary"><i
                            class="layui-icon">&#xe639;</i>重置
                </div>
            </div>

        </form>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="lp-users-filter"
               lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("lp-users/index")?>','id':'lp-users'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                                        <th lay-data="{field:'user_id',sort: true}">编号</th>

                                                <th lay-data="{field:'email',templet:'#emailTpl'}">邮件</th>

                                                <th lay-data="{field:'sex',templet:'#sexTpl'}">性别</th>

                                                <th lay-data="{field:'user_money',sort: true,edit: 'text'}">用户金额</th>

                                                <th lay-data="{field:'pay_points',sort: true}">积分</th>

                                                <th lay-data="{field:'reg_time',sort: true,templet:'#reg_timeTpl'}">注册时间</th>

                                                <th lay-data="{field:'mobile',sort: true}">手机号码</th>

                                                <th lay-data="{field:'head_pic',sort: true,templet:'#head_picTpl'}">头像</th>

                                                <th lay-data="{field:'level',sort: true,templet:'#levelTpl'}">会员等级</th>

                                                <th lay-data="{field:'level_end_time',sort: true,templet:'#level_end_timeTpl'}">等级失效时间</th>

                                                <th lay-data="{field:'is_lock',sort: true,templet:'#is_lockTpl'}">冻结</th>

                                            <th lay-data="{fixed: 'right',  align:'center',width:220, toolbar: '#barDemo'}"></th>
                

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
                <form class="layui-form layui-form-pane" action="#" style="padding: 5px">
                    <div class="layui-form-item">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-block">
                            <input type="text" name="mobile" placeholder="请输入标题"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>


                    <button style="display: none" lp-table="userb" lay-submit lay-filter="search"
                            lp-search-submit></button>

                </form>


            </div>

            <div class="lp-search-sub-btn">
                <button class="layui-btn layui-btn-sm layui-btn-default" lp-search-btn><i
                            class="layui-icon">&#xe615;</i>搜 索
                </button>
                <button class="layui-btn layui-btn-sm layui-btn-primary" lp-search-box-reset><i
                            class="layui-icon">&#xe639;</i>重 置
                </button>


            </div>


        </div>
        <div class="lp-sear-btn lp-tip" lp-tip-box="lp-tip">
            <i class="layui-icon">&#xe615;</i> 更多搜索
        </div>

    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>

<td>{{# if(item.user_id != null && item.user_id != undefined){}}{{ item.user_id}}{{#}}}</td>
            <script type="text/html" id="emailTpl">
                <div class="lp-col-detail">
                    <input lp-data="{url:'<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>',id:{{d.user_id}},field:'email',on:'1',off:'0',key:'user_id',table:'lp-users'}" lay-filter="lp-users" class="lp-table-checkbox" type="checkbox" name="mobile" title="上架" checked="" lay-text="上架|下架">
                </div>
            </script>
                    <script type="text/html" id="sexTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("lp-users/index")?>',area: ['893px', '600px'],title:'详情'}" >
                    {{ d.sex }}
                </div>
            </script>
        <td>{{# if(item.user_money != null && item.user_money != undefined){}}{{ item.user_money}}{{#}}}</td>
<td>{{# if(item.pay_points != null && item.pay_points != undefined){}}{{ item.pay_points}}{{#}}}</td>
<td>{{# if(item.reg_time != null && item.reg_time != undefined){}}{{ item.reg_time}}{{#}}}</td>
<td>{{# if(item.mobile != null && item.mobile != undefined){}}{{ item.mobile}}{{#}}}</td>
            <script type="text/html" id="head_picTpl">
                <div class="lp-col-center ">
                    <div {{# if(d.head_pic){}}class="lp-zoom"{{# }}}>
                        <img src="{{# if(d.head_pic){}}{{d.head_pic}}{{# }else{}}admin/images/avatar.png{{# }}}" jqimg="{{# if(d.head_pic){}}{{d.head_pic}}{{# }else{}}admin/images/avatar.png{{# }}}" {{# if(d.head_pic){}} class="lp-img" {{# }}}>
                    </div>
                </div>
            </script>
                    <script type="text/html" id="levelTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("lp-users/index")?>',area: ['893px', '600px'],title:'详情'}" >
                    {{ d.level }}
                </div>
            </script>
        <td>{{# if(item.level_end_time != null && item.level_end_time != undefined){}}{{ item.level_end_time}}{{#}}}</td>

            <script type="text/html" id="is_lockTpl">
                <div class="lp-col-center ">
                    <input type="checkbox" lp-data="{url:'<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>',id:{{d.user_id}},on:'1',off:'0',key:'user_id',table:'lp-users'}" name="is_lock" lay-skin="switch" lay-filter="lp-users"  title="开关" lay-text="启用|禁用">
                </div>
            </script>

        
    <script type="text/html" id="barDemo">
                <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-users/detail")?>',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"  class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
            <i class="layui-icon">&#xe60a;</i> 查看
        </a>
                        <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-users/update")?>',type:2,maxmin:true,area: ['893px', '600px'],title:'编辑',full:true}" class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
        </a>
                        <a lp-data="{table:'lp-users',key:'user_id',url:'<?=\yii\helpers\Url::toRoute("lp-users/delete")?>'}" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
        </a>
            </script>






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
    layui.use(['lpsearchbox', 'jquery', 'element', 'lpui', 'lpzoom', 'lplist'])
</script>

</html>

