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
                <form action="<?= \yii\helpers\Url::toRoute('build-curd/index') ?>" method="post">
                    <div class="layui-form">
                        <div class="layui-inline">
                            <label class="layui-form-label">选择表</label>
                            <div class="layui-input-inline">
                                <select name="table_name" lay-search="">
                                    <option value="">选择或输入</option>
                                    <?
                                    foreach ($table as $val) {
                                        if (isset($_POST['table_name']) && $_POST['table_name'] == $val) {
                                            echo '<option value="' . $val . '" selected>' . $val . '</option>';
                                        } else {
                                            echo '<option value="' . $val . '">' . $val . '</option>';
                                        }

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn">确定</button>
                        </div>

                        <? if($lables){?>
                            <div class="layui-inline" style="float: right;margin-left: 20px">
                                <div data="config"  class="layui-btn layui-btn-info buildpage">生成配置页</div>
                            </div>
                        <div class="layui-inline" style="float: right;margin-left: 20px">
                            <div data="treecrud"  class="layui-btn layui-btn-info buildpage">生成树型列表</div>
                        </div>

                        <div class="layui-inline" style="float: right;margin-left: 20px">
                            <div  data="crud" class="layui-btn layui-btn-normal buildpage">生成列表页</div>
                        </div>
                        <div class="layui-inline" style="float: right">
                            <div id="savemodel" class="layui-btn layui-btn-danger">保存模型</div>
                        </div>
                        <?}?>


                    </div>
                </form>
            </section>
            <? if ($lables) { ?>
                <form class="panel panel-padding layui-form" id="formtable">
                    <div style="width: 40%;float: left;">
                    <div class="layui-form-item" >
                        <label class="layui-form-label">表头按钮</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="top_btn[add_btn]" lay-skin="primary" title="新增" <?if(isset($giishow['top_btn']['add_btn']) || !$giishow){echo 'checked';}?>>

                            <input type="checkbox" name="top_btn[del_btn]" lay-skin="primary" title="删除" <?if(isset($giishow['top_btn']['del_btn']) || !$giishow){echo 'checked';}?>>
                            <input type="checkbox" name="top_btn[dis_btn]" lay-skin="primary" title="启|禁" <?if(isset($giishow['top_btn']['dis_btn'])){echo 'checked';}?>>
                            <input type="checkbox" name="bottom_btn[export_btn]" lay-skin="primary" title="导出" <?if(isset($giishow['bottom_btn']['export_btn']) || !$giishow){echo 'checked';}?>>
                        </div>
                    </div>
                    </div>
                    <div style="width: 40%;float: right;">
                    <div class="layui-form-item" >
                        <label class="layui-form-label">操作列按钮</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="column_btn[detail_btn]" lay-skin="primary" title="详情" <?if(isset($giishow['column_btn']['detail_btn']) || !$giishow){echo 'checked';}?>>
                            <input type="checkbox" name="column_btn[edt_btn]" lay-skin="primary" title="编辑" <?if(isset($giishow['column_btn']['edt_btn']) || !$giishow){echo 'checked';}?>>
                            <input type="checkbox" name="column_btn[del_btn]" lay-skin="primary" title="删除" <?if(isset($giishow['column_btn']['del_btn']) || !$giishow){echo 'checked';}?>>

                            <!--<input type="checkbox" name="column_btn[dis_btn]" lay-skin="primary" title="启|禁" <?if(isset($giishow['column_btn']['dis_btn']) || !$giishow){echo 'checked';}?>>-->
                        </div>
                    </div>
                    </div>
                    <input type="hidden" name="table_name" value="<?=$_POST['table_name']?>">
                    <table class="layui-table">
                        <thead>
                        <tr>
                            <th width="70">顺序</th>
                            <th width="140">字段</th>
                            <th width="140">显示名</th>
                            <th width="60">排序</th>
                            <th width="160">展示方式</th>
                            <th width="60">详情</th>
                            <th width="60">小表</th>
                            <th width="160">新增方式</th>
                            <th width="60">快搜</th>
                            <th width="160">查询方式</th>
                            <th>关联</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?
                        $num = 0;
                        foreach ($lables as $key => $val) {
                            $num++;
                            ?>
                            <tr>
                                <td><input type="text" name="table[<?= $key ?>][sort]" value="<? if($giishow){echo $giishow['table'][$key]['sort']; }else{echo $num;} ?>" class="layui-input"></td>
                                <td><?= $key ?></td>
                                <td><input type="text" name="table[<?= $key ?>][show_name]" value="<?= $val ?>" class="layui-input"></td>


                                <td><input type="checkbox" name="table[<?= $key ?>][order]" lay-skin="primary" value="1" class="layui-input" <? if(isset($giishow['table'][$key]["order"])){
                                        echo 'checked';
                                    } ?>></td>
                                <td><select  name="table[<?= $key ?>][show_mode]">
                                        <option value="不展示" <?if($giishow && $giishow['table'][$key]['show_mode']=='不展示'){
                                            echo 'selected';
                                        } ?>>不展示</option>
                                        <option value="文本" <? if (!$giishow && $num < 8) {
                                            echo 'selected';
                                        }else if($giishow && $giishow['table'][$key]['show_mode']=='文本'){
                                            echo 'selected';
                                        } ?>>文本
                                        </option>
                                        <option value="图片" <?if($giishow && $giishow['table'][$key]['show_mode']=='图片'){
                                            echo 'selected';
                                        } ?>>图片</option>
                                        <option value="关联文本" <?if($giishow && $giishow['table'][$key]['show_mode']=='关联文本'){
                                            echo 'selected';
                                        } ?>>关联文本</option>
                                        <option value="开关" <?if($giishow && $giishow['table'][$key]['show_mode']=='开关'){
                                            echo 'selected';
                                        } ?>>开关</option>
                                        <option value="勾选框" <?if($giishow && $giishow['table'][$key]['show_mode']=='勾选框'){
                                            echo 'selected';
                                        } ?>>勾选框</option>
                                        <option value="日期时间" <?if($giishow && $giishow['table'][$key]['show_mode']=='日期时间'){
                                            echo 'selected';
                                        } ?>>日期时间</option>
                                        <option value="可编辑" <?if($giishow && $giishow['table'][$key]['show_mode']=='可编辑'){
                                            echo 'selected';
                                        } ?>>可编辑</option>
                                    </select>
                                </td>
                                <td><input type="checkbox" name="table[<?= $key ?>][detail]" lay-skin="primary" value="1" class="layui-input" <? if(isset($giishow['table'][$key]["detail"])){
                                        echo 'checked';
                                    } ?>></td>
                                <td><input type="checkbox" name="table[<?= $key ?>][mini_table]" lay-skin="primary" value="1" class="layui-input" <? if(isset($giishow['table'][$key]["mini_table"])){
                                        echo 'checked';
                                    } ?>></td>
                                <td><select name="table[<?= $key ?>][add_mode]">
                                        <option value="不新增" <?if($giishow && $giishow['table'][$key]['add_mode']=='不新增'){
                                            echo 'selected';
                                        } ?>>不新增</option>
                                        <option value="文本框" <?if($giishow && $giishow['table'][$key]['add_mode']=='文本框'){
                                            echo 'selected';
                                        } ?>>文本框
                                        </option>
                                        <option value="密码框" <?if($giishow && $giishow['table'][$key]['add_mode']=='密码框'){
                                            echo 'selected';
                                        } ?>>密码框
                                        </option>
                                        <option value="文本域" <?if($giishow && $giishow['table'][$key]['add_mode']=='文本域'){
                                            echo 'selected';
                                        } ?>>文本域</option>
                                        <option value="开关" <?if($giishow && $giishow['table'][$key]['add_mode']=='开关'){
                                            echo 'selected';
                                        } ?>>开关</option>
                                        <option value="下拉选择" <?if($giishow && $giishow['table'][$key]['add_mode']=='下拉选择'){
                                            echo 'selected';
                                        } ?>>下拉选择</option>
                                        <option value="树型下拉选择" <?if($giishow && $giishow['table'][$key]['add_mode']=='树型下拉选择'){
                                            echo 'selected';
                                        } ?>>树型下拉选择</option>
                                        <option value="日期" <?if($giishow && $giishow['table'][$key]['add_mode']=='日期'){
                                            echo 'selected';
                                        } ?>>日期</option>
                                        <option value="日期时间" <?if($giishow && $giishow['table'][$key]['add_mode']=='日期时间'){
                                            echo 'selected';
                                        } ?>>日期时间</option>
                                        <option value="时间" <?if($giishow && $giishow['table'][$key]['add_mode']=='时间'){
                                            echo 'selected';
                                        } ?>>时间</option>
                                        <option value="复选框" <?if($giishow && $giishow['table'][$key]['add_mode']=='复选框'){
                                            echo 'selected';
                                        } ?>>复选框</option>
                                        <option value="单选框" <?if($giishow && $giishow['table'][$key]['add_mode']=='单选框'){
                                            echo 'selected';
                                        } ?>>单选框</option>
                                        <option value="图片" <?if($giishow && $giishow['table'][$key]['add_mode']=='图片'){
                                            echo 'selected';
                                        } ?>>图片</option>
                                        <option value="图集" <?if($giishow && $giishow['table'][$key]['add_mode']=='图集'){
                                            echo 'selected';
                                        } ?>>图集</option>
                                        <option value="富文本" <?if($giishow && $giishow['table'][$key]['add_mode']=='富文本'){
                                            echo 'selected';
                                        } ?>>富文本</option>
                                    </select>
                                </td>
                                <td><input type="checkbox" name="table[<?= $key ?>][mini_search_mode]" lay-skin="primary" value="1" class="layui-input" <? if(isset($giishow['table'][$key]["mini_search_mode"])){
                                        echo 'checked';
                                    } ?>></td>
                                <td><select name="table[<?= $key ?>][search_mode]">
                                        <option value="不搜索" <?if($giishow && $giishow['table'][$key]['search_mode']=='不搜索'){
                                            echo 'selected';
                                        } ?>>不搜索</option>
                                        <option value="文本框" <?if($giishow && $giishow['table'][$key]['search_mode']=='文本框'){
                                            echo 'selected';
                                        } ?>>文本框
                                        </option>
                                        <option value="关联文本框" <?if($giishow && $giishow['table'][$key]['search_mode']=='关联文本框'){
                                            echo 'selected';
                                        } ?>>关联文本框
                                        </option>
                                        <option value="下拉选择" <?if($giishow && $giishow['table'][$key]['search_mode']=='下拉选择'){
                                            echo 'selected';
                                        } ?>>下拉选择</option>
                                        <option value="树型下拉选择" <?if($giishow && $giishow['table'][$key]['search_mode']=='树型下拉选择'){
                                            echo 'selected';
                                        } ?>>树型下拉选择</option>
                                        <option value="日期" <?if($giishow && $giishow['table'][$key]['search_mode']=='日期'){
                                            echo 'selected';
                                        } ?>>日期</option>
                                        <option value="日期时间" <?if($giishow && $giishow['table'][$key]['search_mode']=='日期时间'){
                                            echo 'selected';
                                        } ?>>日期时间</option>
                                        <option value="时间" <?if($giishow && $giishow['table'][$key]['search_mode']=='时间'){
                                            echo 'selected';
                                        } ?>>时间</option>
                                    </select>
                                </td>
                                <td style="padding-right: 0px;">
                                    <div class="layui-inline" style="width: 75%">
                                    <input type="text" name="table[<?= $key ?>][f_key]" class="layui-input" title="" placeholder="txt:1=v1,2=v2或设置外键" <? if($giishow && $giishow['table'][$key]['f_key']){ echo "value='".$giishow['table'][$key]['f_key']."'";}?>/>
                                    </div>
                                    <div class="layui-inline">
                                        <div class="layui-btn add-f-key" data="<?=$key?>">
                                            外键
                                        </div>
                                    </div>
                                    <div class="layui-inline">
                                        <div class="layui-btn add-f-txt" data="<?=$key?>">
                                            文本
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>


        <div style="clear: both"></div>
                </form>
                <form id="buildset"  class="add-subcat layui-form">
                    <input type="hidden" name="table_name" value="<?=$_POST['table_name']?>">

                    <div class="layui-form-item">
                        <label class="layui-form-label">生成路径</label>
                        <div class="layui-input-block">
                            <div class="layui-input-inline">
                                <select name="build[app]" lay-filter="seleceprj">
                                    <option value="">项目</option>
                                    <? foreach (json_decode($prj) as $key => $val) {

                                        echo '<option value="' . $key . '">' . $key . '</option>';
                                    } ?>

                                </select>
                            </div>
                            <div class="layui-input-inline">
                                <select name="build[module]" id="modules">
                                    <option value="">模块</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item lp-menu">
                        <label class="layui-form-label">控制器</label>
                        <div class="layui-input-block">
                            <input type="text" name="controller" jq-error="请输入控制器" placeholder="请输入控制器"
                                   autocomplete="off" class="layui-input " value="<?=$controller?>">
                        </div>
                    </div>
                    <div class="layui-form-item lp-menu">
                        <label class="layui-form-label">父菜单</label>
                        <div class="layui-input-block">
                            <div class="layui-input-inline">
                                <select name="menu[pid]">
                                    <option value="0">顶级菜单</option>
                                    <?
                                    foreach ($menu as $key => $val) {
                                        echo '<option value="' . $key . '">' . $val . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item lp-menu">
                        <label class="layui-form-label">菜单名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="menu[name]" jq-error="请输入模块名" placeholder="请输入模块名"
                                   autocomplete="off" class="layui-input ">
                        </div>
                    </div>
                    <div class="layui-form-item lp-menu">
                        <label class="layui-form-label">图标</label>
                        <div class="layui-input-block">
                            <input type="hidden" name="menu[iconfont]" id="iconinput" />

                            <i class="iconfont" style="font-size: 36px;line-height: 100%;height: 100%;float: left"
                               id="icondata" data=""></i>

                            <div style="float: left;width: 50%;height: 36px;line-height: 36px;padding-left: 20px">
                                <div id="changeicon" class="layui-btn" style="margin: 0 auto;">
                                    更换
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="layui-form-item lp-menu">
                        <label class="layui-form-label">是否显示</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="menu[display]" lay-skin="switch" lay-text="是|否" value="1" checked>
                        </div>
                    </div>
                    <div class="layui-form-item lp-menu">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" name="menu[sort]" jq-error="排序" placeholder="排序" autocomplete="off"
                                   class="layui-input " value="50">
                        </div>
                    </div>
                </form>
                <form class="layui-form layui-form-pane add-subcat" id="add_f_key">
                    <div class="layui-form-item">
                        <label class="layui-form-label">关联表</label>
                        <div class="layui-input-block">
                            <select name="f_table" id="f_table" lay-search="" lay-filter="selecttable">
                                <option value="">选择或输入表</option>
                                <?
                                foreach ($table as $val) {
                                        echo '<option value="' . $val . '">' . $val . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" >关联字段</label>
                        <div class="layui-input-block">
                            <select name="f_field" id="f_field" lay-search="">
                                <option value="">选择或输入</option>


                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">展示字段</label>
                        <div class="layui-input-block">
                            <select name="s_field" id="s_field" lay-search="">
                                <option value="">选择或输入</option>


                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">关系</label>
                        <div class="layui-input-block">
                            <select name="f_c">
                                <option value="一对一">一对一</option>
                                <option value="一对多">一对多</option>
                            </select>
                        </div>
                    </div>



                </form>
            <? } ?>
        </div>
    </div>
</div>


</body>

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
        echarts: 'lib/echarts',
        webuploader: 'lib/webuploader',
        jqcitys: "jqmodules/jqcitys",
    })
</script>
<script>
    layui.use(['jquery', 'layer', 'form'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        $("#buildallmodel").on("click", function () {
            var index = layer.load(1, {shade: 0.3});
            layer.close(index);
        })
        var prj = JSON.parse('<?=$prj?>')

        var form = layui.form();
        form.on('select(seleceprj)', function (data) {
            $("#modules").empty();
            $("#modules").append('<option value="">模块</option>')
            for (var modu in prj[data.value]) {
                $("#modules").append('<option value="' + prj[data.value][modu] + '">' + prj[data.value][modu] + '</option>')
            }
            form.render('select');
        });

        $(".add-f-key").on('click',function () {

            var data = $(this).attr('data');
            var index =layer.open({
                type: 1,
                title: "生成页面",
                shade: 0.5,
                shadeClose: true,
                area: ['400px', '550px'],
                content: $("#add_f_key"),
                btn: ['添加'],
                btnAlign: 'c',
                yes: function (index, layero) {
                    var name='table['+data+'][f_key]'


                    var formdata={};
                    var formtable=$("#add_f_key").serializeArray();
                    $.each(formtable,function(){
                        formdata[this.name]=this.value;
                    })
                    var val="key:"+formdata.f_table+":"+formdata.f_field+">"+data+":"+formdata.f_field+">"+formdata.s_field+":"+formdata.f_c;
                    $("input[name='"+name+"']").val(val);
                    $("input[name='"+name+"']").attr("title",val);
                    layer.close(index);

                }
            });


        })

        $(".add-f-txt").on("click",function () {
            var data = $(this).attr('data');
            var name='table['+data+'][f_key]'
            $("input[name='"+name+"']").val("txt:1=v1,2=v2");
            $("input[name='"+name+"']").attr("title","txt:1=v1,2=v2");

        })
        form.on('select(selecttable)', function (data) {

            $("#f_field").empty();
            $("#s_field").empty();
            var table=data.value;
            $("#f_field").append('<option value="">选择或输入</option>')
            $("#s_field").append('<option value="">选择或输入</option>')
            $.post("<?=\yii\helpers\Url::toRoute("build-curd/getfield")?>",{'table':table},function (result) {
                //result=JSON.parse(result);
                for(var i=0;i<result.length;i++)
                {
                    $("#f_field").append('<option value="' + result[i] + '">' + result[i] + '</option>')
                    $("#s_field").append('<option value="' + result[i] + '">' + result[i] + '</option>')

                }
                form.render('select');
            })



            /*
            for (var modu in prj[data.value]) {
                $("#modules").append('<option value="' + prj[data.value][modu] + '">' + prj[data.value][modu] + '</option>')
            }
            */




        });

        $("#savemodel").on("click",function () {
            var index = layer.load(1, {shade: 0.3});

            var data={};
            var formtable=$("#formtable").serializeArray();
            $.each(formtable,function(){
                data[this.name]=this.value;
            })
            $.post("<?=\yii\helpers\Url::toRoute("build-curd/savemodel")?>",data,function (result) {
                if(result.code==0)
                {
                    layer.msg('保存成功', {icon: 1});
                }
                layer.close(index);
            })


        })
        $(".buildpage").on("click",function () {
            var att=($(this).attr("data"))
            var index =layer.open({
                type: 1,
                title: "生成页面",
                shade: 0.5,
                shadeClose: true,
                area: ['600px', '550px'],
                content: $("#buildset"),
                btn: ['确定生成'],
                btnAlign: 'c',
                yes: function (index, layero) {
                    var l = layer.load(1, {shade: 0.3});
                    var data={};
                    var formtable=$("#buildset").serializeArray();
                    $.each(formtable,function(){
                        data[this.name]=this.value;
                    })

                    data['build_type']=att;

                    $.post("<?=\yii\helpers\Url::toRoute("build-curd/buildpage")?>",data,function (result) {
                        if(result.status==0)
                        {
                            layer.msg('生成成功', {icon: 1});
                            layer.close(index);
                        }else{
                            layer.msg(result.message, {icon: 2});
                        }
                        layer.close(l);
                    })


                },
            });

        })



        $("#changeicon").on("click", function () {
            layer.open({
                type: 2,
                title: '选择图标',
                shadeClose: true,
                shade: 0,
                area: ['700px', '600px'],
                content: '<?=\yii\helpers\Url::toRoute("build-modules/icon")?>',
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


    });
    //  layui.use('list');


</script>

</html>
