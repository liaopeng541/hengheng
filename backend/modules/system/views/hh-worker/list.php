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
        </div>
                    <form class="layui-form lp-search-form" action="#">



                <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="status" placeholder="人员流动">
                                    <option value="">请选择人员流动</option>
                                    <option value="0">在职</option>
<option value="1">离职</option>

                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="job_id" placeholder="岗位">
                                    <option value="">请选择岗位</option>
                                    <? foreach ($lp_job_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="worker_status" placeholder="工作状态">
                                    <option value="">请选择工作状态</option>
                                    <option value="0">空闲</option>
<option value="1">忙碌</option>

                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <select name="branch_id" placeholder="部门">
                                    <option value="">请选择部门</option>
                                    <? foreach ($hh_branch_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            
                            <div class="layui-input-inline">
                                <input class="layui-input" name="real_name" placeholder="名字" />
                            </div>
                        </div>
                        

                <div class="layui-input-inline">
                    <button lay-submit lp-table="hh-worker" lay-filter="search"
                            class="layui-btn layui-btn-sm layui-btn-default"><i
                                class="layui-icon">&#xe615;</i>搜索
                    </button>
                    <div lp-reset-mini-search lp-table="hh-worker"
                         class="layui-btn layui-btn-sm layui-btn-primary"><i
                                class="layui-icon">&#xe639;</i>重置
                    </div>
                </div>

            </form>
            </div>
    <div class="c-c-box">
        <table class="layui-table" lay-filter="hh-worker-filter" lay-size="sm" lay-data="{cellMinWidth: 80,height:'full-40', page: true,sort:'server', limit:30, url:'<?=\yii\helpers\Url::toRoute("hh-worker/index")?>','id':'hh-worker'}">
            <thead>
            <tr>
                <th lay-data="{type:'checkbox'}"></th>
                                        <th lay-data="{field:'id',sort: true}">ID</th>

                                                <th lay-data="{field:'real_name'}">名字</th>

                                                <th lay-data="{field:'entry_time',sort: true,templet:'#entry_timeTpl'}">入职时间</th>

                                                <th lay-data="{field:'header_pic',templet:'#header_picTpl'}">照片</th>

                                                <th lay-data="{field:'mobile'}">手机号</th>

                                                <th lay-data="{field:'store_id',templet:'#store_idTpl'}">所属门店</th>

                                                <th lay-data="{field:'sex',templet:'#sexTpl'}">性别</th>

                                                <th lay-data="{field:'branch_id',templet:'#branch_idTpl'}">部门</th>

                                                <th lay-data="{field:'job_id',templet:'#job_idTpl'}">岗位</th>

                                                <th lay-data="{field:'status',templet:'#statusTpl'}">人员流动</th>

                                                <th lay-data="{field:'worker_status',templet:'#worker_statusTpl'}">工作状态</th>

                                    </tr>
            </thead>
        </table>
        
    </div>
</div>


</body>
<script src="admin/src/layui.js"></script>

            <script type="text/html" id="header_picTpl">
                <div class="lp-col-center ">
                    <div {{# if(d.header_pic){}}class="lp-zoom"{{# }}}>
                        <img src="{{# if(d.header_pic){}}{{d.header_pic}}{{# }else{}}admin/images/avatar.png{{# }}}" jqimg="{{# if(d.header_pic){}}{{d.header_pic}}{{# }else{}}admin/images/avatar.png{{# }}}" {{# if(d.header_pic){}} class="lp-img" {{# }}}>
                    </div>
                </div>
            </script>
                            <script type="text/html" id="store_idTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-store/detail")?>',area: ['893px', '600px'],title:'详情',key:'store_id'}" >
                    {{ d.store_id_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="sexTpl">
                <div class="lp-col-center">
                    {{ d.sex_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="branch_idTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("hh-branch/detail")?>',area: ['893px', '600px'],title:'详情',key:'branch_id'}" >
                    {{ d.branch_id_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="job_idTpl">
                <div class="lp-col-detail" lay-event="show_detail" lp-data="{type:2,content:'<?=\yii\helpers\Url::toRoute("lp-job/detail")?>',area: ['893px', '600px'],title:'详情',key:'job_id'}" >
                    {{ d.job_id_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="statusTpl">
                <div class="lp-col-center">
                    {{ d.status_lp }}
                </div>
            </script>
        
                            <script type="text/html" id="worker_statusTpl">
                <div class="lp-col-center">
                    {{ d.worker_status_lp }}
                </div>
            </script>
        
        
    <script type="text/html" id="barDemo">
                    <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-worker/detail")?>',key:'id',type:2,maxmin:true,area: ['893px', '600px'],title:'详情'}"  class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">
                <i class="layui-icon">&#xe60a;</i> 查看
            </a>
                            <a lp-data="{content:'<?=\yii\helpers\Url::toRoute("hh-worker/update")?>',key:'id',type:2,maxmin:true,area: ['893px', '600px'],title:'编辑'}" class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑
            </a>
                            <a lp-data="{table:'hh-worker',key:'id',url:'<?=\yii\helpers\Url::toRoute("hh-worker/delete")?>'}" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除
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
    layui.use(['lpsearchbox', 'jquery', 'element', 'lpui', 'lpzoom', 'lplist','lpform'])
</script>

</html>

