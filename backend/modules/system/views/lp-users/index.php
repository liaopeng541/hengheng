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
                                        <button class="layui-btn layui-btn-sm layui-btn-danger lp-all-del"
                        lp-data="{table:'lp-users',key:'user_id',url:'<?=\yii\helpers\Url::toRoute("lp-users/delete")?>'}"
                        style="background: #D35400"><i class="layui-icon"></i>删除
                </button>
                                                                <button class="layui-btn layui-btn-sm lp-all-set"
                                lp-data="{table:'lp-users','field':'is_lock',value:1,checked:'on',key:'user_id',title:'冻结',url:'<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>'}"
                                style="background:#27AE60"><i class="layui-icon">&#xe658;</i>冻结                        </button>
                        <button lp-data="{table:'lp-users','field':'is_lock',value:0,checked:'off',key:'user_id',title:'正常',url:'<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>'}"
                                class="lp-all-set layui-btn layui-btn-sm layui-btn-danger" style="background:#E74C3C"><i
                                    class="layui-icon">&#xe600;</i>正常                        </button>

                        

                                        <button class="layui-btn layui-btn-sm lp-drop-btn" style="background:#9B59B6"><i
                            class="layui-icon"></i>导出<i class="layui-icon">&#xe625;</i>
                    <div class="lp-drop-box">
                        <dl>
                            <dd lp-data="{table:'lp-users',url:'<?=\yii\helpers\Url::toRoute("lp-users/exportexcel")?>'}">
                                <i class="layui-icon">&#xe62d;</i><span>excel文件</span></dd>
                        </dl>
                    </div>
                </button>
            

        </div>
                    <form class="layui-form lp-search-form" action="#">


                <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="mobile" placeholder="手机号码" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="sex" placeholder="性别">
                                    <option value="">请选择性别</option>
                                    <option value="0">保密</option>
<option value="1">男</option>
<option value="2">女</option>

                                </select>
                            </div>
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
                                        <th lay-data="{field:'user_id',sort: true}">用户id</th>

                                                <th lay-data="{field:'sex',templet:'#sexTpl'}">性别</th>

                                                <th lay-data="{field:'user_money'}">用户金额</th>

                                                <th lay-data="{field:'reg_time',templet:'#reg_timeTpl'}">注册时间</th>

                                                <th lay-data="{field:'mobile'}">手机号码</th>

                                                <th lay-data="{field:'level',templet:'#levelTpl'}">会员等级</th>

                                                <th lay-data="{field:'is_lock',templet:'#is_lockTpl'}">状态</th>

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
                            <label class="layui-form-label">会员等级</label>
                            <div class="layui-input-block">
                                <select name="level" placeholder="会员等级">
                                    <option value="">请选择会员等级</option>
                                    <? foreach ($lp_user_level_level_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-block">
                                <select name="is_lock" placeholder="状态">
                                    <option value="">请选择状态</option>
                                    <option value="0">正常</option>
<option value="1">冻结</option>

                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机号码</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="mobile" placeholder="手机号码" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">性别</label>
                            <div class="layui-input-block">
                                <select name="sex" placeholder="性别">
                                    <option value="">请选择性别</option>
                                    <option value="0">保密</option>
<option value="1">男</option>
<option value="2">女</option>

                                </select>
                            </div>
                        </div>
                        

                        <button style="display: none" lp-table="lp-users" lay-submit
                                lay-filter="search"
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

                    <script type="text/html" id="sexTpl">
                <div class="lp-col-center">
                    {{ d.sex_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="levelTpl">
                <div class="lp-col-detail" lay-event="show_detail"
                     lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("lp-user-level/detail")?>',area: ['893px', '600px'],title:'详情',key:'level'}">
                    {{ d.level_lp }}
                </div>
            </script>
        
        
            <script type="text/html" id="is_lockTpl">
                <div class="lp-col-center ">
                    <input type="checkbox"
                           lp-data="{url:'<?=\yii\helpers\Url::toRoute("lp-users/setstatus")?>',id:{{d.user_id}},on:'1',off:'0',key:'user_id',table:'lp-users'}"
                           name="is_lock" lay-skin="switch" lay-filter="lp-users"
                           title="开关" lay-text="冻结|正常" {{# if(d.is_lock==1){ }} checked {{# }}}>
                </div>
            </script>

        
    <script type="text/html" id="barDemo">
                    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-users/detail")?>',key:'user_id',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"
               class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
                <i class="layui-icon">&#xe60a;</i> 查看
            </a>
                            <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("lp-users/update")?>',key:'user_id',type:2,maxmin:true,area: ['893px', '600px'],title:'编辑'}"
               class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
            </a>
                            <a lp-data="{table:'lp-users',key:'user_id',url:'<?=\yii\helpers\Url::toRoute("lp-users/delete")?>'}"
               class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
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
        lplist: "src/lpui/lplist",
        lp_upimages: "src/lpui/lp_upimages",
        lpform: "src/lpui/lpform"
    })
</script>
<script>
    layui.use(['lpsearchbox', 'jquery', 'element', 'lpui', 'lpzoom', 'lplist', 'lpform'])
</script>

</html>

