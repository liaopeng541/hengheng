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
    <link rel="stylesheet" type="text/css" href="admin/src/lpui/css/lpui.css">
</head>


<body>
<div class="container-fluid " style="padding:10px">
    <form class="layui-form layui-form-pane" action="<? if(isset($_GET["id"])){ echo \yii\helpers\Url::toRoute("hh-worker/update");}else{echo \yii\helpers\Url::toRoute("hh-worker/add");}?>" lp-data="{<?if(isset($_GET["id"])){?>type:'edit',key:'id',value:<?=$_GET["id"]?>,<?}?>table:'hh-worker'}">
        <div class="layui-form-item">
                            <label class="layui-form-label">密码</label>
                            <div class="layui-input-block">
                                <input type="password" class="layui-input" name="password" required lay-verify="required" lay-error="密码不能为空" placeholder="请输入密码" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">性别</label>
                            <div class="layui-input-block">
                                <select name="sex" required lay-verify="required" lay-error="性别不能为空" placeholder="请输入性别">
                                    <option value="">请选择性别</option>
                                    <option value="0">男</option>
<option value="1">女</option>

                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">所属门店</label>
                            <div class="layui-input-block">
                                <select name="store_id" required lay-verify="required" lay-error="所属门店不能为空" placeholder="请输入所属门店">
                                    <option value="">请选择所属门店</option>
                                    <? foreach ($hh_store_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机号</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="mobile" required lay-verify="required" lay-error="手机号不能为空" placeholder="请输入手机号" />
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">照片</label>
                            <div class="layui-input-block"  style="border: 1px solid #e6e6e6; background: #ffffff">
                            <div style="padding: 5px" id="header_pic_box">
                            <input lp-key="header_pic" class="lp_upfile_input" name="header_pic_file" lp-type="file" type="file" style="display: none">
                                <ul class="lp_upfile_list">
                                <div class="img-thumbnail lp_uploadfilebtn">+</div>
                                    <div style="clear: both"></div>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">简介</label>
                            <div class="layui-input-block">
                            <textarea placeholder="请输入内容" name="desc" class="layui-textarea" required lay-verify="required" lay-error="简介不能为空" placeholder="请输入简介"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">人员流动</label>
                            <div class="layui-input-block">
                                <select name="status" required lay-verify="required" lay-error="人员流动不能为空" placeholder="请输入人员流动">
                                    <option value="">请选择人员流动</option>
                                    <option value="0">在职</option>
<option value="1">离职</option>

                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">岗位</label>
                            <div class="layui-input-block">
                                <select name="job_id" required lay-verify="required" lay-error="岗位不能为空" placeholder="请输入岗位">
                                    <option value="">请选择岗位</option>
                                    <? foreach ($lp_job_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">工作状态</label>
                            <div class="layui-input-block">
                                <select name="worker_status" required lay-verify="required" lay-error="工作状态不能为空" placeholder="请输入工作状态">
                                    <option value="">请选择工作状态</option>
                                    <option value="0">空闲</option>
<option value="1">忙碌</option>

                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">部门</label>
                            <div class="layui-input-block">
                                <select name="branch_id" required lay-verify="required" lay-error="部门不能为空" placeholder="请输入部门">
                                    <option value="">请选择部门</option>
                                    <? foreach ($hh_branch_id as $key=>$val)
                {
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">入职时间</label>
                            <div class="layui-input-block">
                                <input class="layui-input lp-date_time" name="entry_time" required lay-verify="required" lay-error="入职时间不能为空" placeholder="请输入入职时间" placeholder="请选择日期时间" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">名字</label>
                            <div class="layui-input-block">
                                <input class="layui-input" name="real_name" required lay-verify="required" lay-error="名字不能为空" placeholder="请输入名字" />
                            </div>
                        </div>
                                <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                <?if(isset($_GET["id"])){?>                    <button class="layui-btn" lay-submit lay-filter="edit">保存修改</button>
                    <div  lp-close class="layui-btn layui-btn-primary">关 闭</div>
                <? }else{?>                    <button class="layui-btn" lay-submit lay-filter="add">立即提交</button>
                    <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
                <?}?>            </div>
        </div>
    </form>
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
        lp_upimages: "src/lpui/lp_upimages",
        lplist: "src/lpui/lplist",
        lpform: "src/lpui/lpform"
    })
</script>
<script>
        layui.use("lpform")



</script>

</html>
