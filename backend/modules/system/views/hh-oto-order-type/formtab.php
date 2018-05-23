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
<div class="container-fluid ">
    <form id="form1" style="background: #ffffff;padding-bottom: 20px" class="layui-form layui-form-pane"
          data-params='{"dataName":"lp-goods","key":"goods_id","action":"add"}'
          action="/build/web/index.php?r=build%2Flp-goods%2Fadd"
          method="POST">
        <div class="layui-tab layui-tab-card" lay-filter="check" style="min-height: 500px" >
            <ul class="layui-tab-title">
                <li lay-id="1" class="layui-this">基本信息</li>
                <li lay-id="2">商品图片</li>
                <li lay-id="3">商品详情</li>
                <li lay-id="4">商品属性</li>
                <li lay-id="5">商品规格</li>
            </ul>
            <div class="layui-tab-content" >
                <div class="layui-tab-item layui-show">
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类</label>
                        <div class="layui-input-block">
                            <select name="cat_id" required jq-verify="required" jq-error="分类不能为空" placeholder="请输入分类">
                                <option value="0">顶级分类</option>


                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">品牌</label>
                        <div class="layui-input-block">
                            <select name="brand_id" required jq-verify="required" jq-error="品牌不能为空" placeholder="请输入品牌">
                                <option value="">请选择品牌</option>


                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">商品名称</label>
                        <div class="layui-input-block">
                            <input class="layui-input" name="goods_name" required jq-verify="required" jq-error="商品名称不能为空"
                                   placeholder="请输入商品名称"/>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品简述</label>
                        <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="goods_remark" class="layui-textarea" required jq-verify="required"
                          jq-error="商品简单描述不能为空" placeholder="请输入商品简单描述"></textarea>
                        </div>
                    </div>

                </div>
                <div class="layui-tab-item">
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品缩略图</label>
                        <div class="layui-input-block" style="border: 1px solid #e6e6e6; background: #ffffff">
                            <div style="padding: 5px" id="original_img_box">
                                <input class="lp_upfile_input" name="original_img_file" lp-type="file" type="file"
                                       style="display: none">
                                <ul class="lp_upfile_list">
                                    <div class="img-thumbnail lp_uploadfilebtn">+</div>
                                    <div style="clear: both"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品图集</label>
                        <div class="layui-input-block" style="border: 1px solid #e6e6e6; background: #ffffff">
                            <div style="padding: 5px" id="detail_images_box">
                                <input class="lp_upfile_input" name="detail_images_file" lp-type="files" type="file"
                                       style="display: none">
                                <ul class="lp_upfile_list">
                                    <div class="img-thumbnail lp_uploadfilebtn">+</div>
                                    <div style="clear: both"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item">
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品详细描述</label>
                        <div class="layui-input-block">
                            <script id="goods_content_edit" name="goods_content" type="text/plain"></script>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item">
                    <div class="layui-form-item" pane="">
                        <label class="layui-form-label">是否上架</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" class="layui-input " value="1"
                                   name="is_on_sale" checked/>
                        </div>
                    </div>
                    <div class="layui-form-item" pane="">
                        <label class="layui-form-label">是否热卖</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" class="layui-input " value="1" name="is_hot"
                                   checked/>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block" style="padding: 0px;margin: 0 auto; text-align: center">
                                    <button class="layui-btn" jq-tab="true" jq-submit jq-filter="submit" lp-sub>立即提交</button>
                    <button type="reset" lp-reset class="layui-btn layui-btn-primary">重置</button>
                            </div>
        </div>
    </form>
</div>
</body>
<script src="admin/js/layui/layui.js"></script>
<script src="admin/js/lib/ueditor/ueditor.config.js"></script>
<script src="admin/js/lib/ueditor/ueditor.all.min.js"></script>
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
    layui.use('lp_edit');
        UE.getEditor("goods_content_edit");
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
            var table = top.global['lp-goods'];
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

    toolbars: [
        [
            //   'anchor', //锚点
            'undo', //撤销
            'redo', //重做
            'bold', //加粗
            'indent', //首行缩进
            //'snapscreen', //截图
            'italic', //斜体
            'underline', //下划线
            'strikethrough', //删除线
            'subscript', //下标
            'fontborder', //字符边框
            'superscript', //上标
            'formatmatch', //格式刷
            //  'source', //源代码
            // 'blockquote', //引用
            'pasteplain', //纯文本粘贴模式
            'selectall', //全选
            //   'print', //打印
            //  'preview', //预览
            'horizontal', //分隔线
            'removeformat', //清除格式
            'time', //时间
            'date', //日期
            'unlink', //取消链接
            //'insertrow', //前插入行
            //'insertcol', //前插入列
            //'mergeright', //右合并单元格
            //'mergedown', //下合并单元格
            //'deleterow', //删除行
            //'deletecol', //删除列
            //'splittorows', //拆分成行
            //'splittocols', //拆分成列
            //'splittocells', //完全拆分单元格
            //'deletecaption', //删除表格标题
            //'inserttitle', //插入标题
            // 'mergecells', //合并多个单元格
            //'deletetable', //删除表格
            'cleardoc', //清空文档
            //   'insertparagraphbeforetable', //"表格前插入行"
            //    'insertcode', //代码语言
            'fontfamily', //字体
            'fontsize', //字号
            'paragraph', //段落格式
            'simpleupload', //单图上传
            'insertimage', //多图上传
            //       'edittable', //表格属性
            //   'edittd', //单元格属性
            'link', //超链接
            //     'emotion', //表情
            //    'spechars', //特殊字符
            //    'searchreplace', //查询替换
            //   'map', //Baidu地图
            //     'gmap', //Google地图
            'insertvideo', //视频
            //     'help', //帮助
            'justifyleft', //居左对齐
            'justifyright', //居右对齐
            'justifycenter', //居中对齐
            'justifyjustify', //两端对齐
            'forecolor', //字体颜色
            'backcolor', //背景色
            'insertorderedlist', //有序列表
            'insertunorderedlist', //无序列表
            //    'fullscreen', //全屏
            //    'directionalityltr', //从左向右输入
            //     'directionalityrtl', //从右向左输入
            'rowspacingtop', //段前距
            'rowspacingbottom', //段后距
            //      'pagebreak', //分页
            //      'insertframe', //插入Iframe
            'imagenone', //默认
            'imageleft', //左浮动
            'imageright', //右浮动
            'attachment', //附件
            'imagecenter', //居中
            'wordimage', //图片转存
            'lineheight', //行间距
            //      'edittip ', //编辑提示
            //      'customstyle', //自定义标题
            'autotypeset', //自动排版
            //      'webapp', //百度应用
            'touppercase', //字母大写
            'tolowercase', //字母小写
            'background', //背景
            //     'template', //模板
            //      'scrawl', //涂鸦
            'music', //音乐
            //      'inserttable', //插入表格
            //      'drafts', // 从草稿箱加载
            //      'charts', // 图表
        ]
    ],

</script>

</html>
