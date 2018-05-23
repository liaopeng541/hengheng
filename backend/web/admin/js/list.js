/*
 * @Author: Paco
 * @Date:   2017-07-19
 * @lastModify 2017-07-24
 * +----------------------------------------------------------------------
 * | jqadmin [ jq酷打造的一款懒人后台模板 ]
 * | Copyright (c) 2017 http://jqadmin.jqcool.net All rights reserved.
 * | Licensed ( http://jqadmin.jqcool.net/licenses/ )
 * | Author: Paco <admin@jqcool.net>
 * +----------------------------------------------------------------------
 */

layui.define(['jquery', "jqtable", 'jqbind', 'jqajax', 'jqdate', 'upload', 'jqform'], function(exports) {
    var $ = layui.jquery,
        table = layui.jqtable,
        jqbind = layui.jqbind,
        form = layui.jqform,
        list = new table();
    list.init({ tplid: "#list-tpl" });
    top.global[list.options.dataName] = list;
    form.init();

    form.on("select(pid-select)", function(data) {
        var level = $(data.elem).find("option:selected").data("level");
        $(data.elem).parents("form").find("input[name=level]").val(level + 1);
    })

    //如果是文章列表，则提前取出分类数据缓存到本地
    if (list.options.dataName == "article") {
        var locationData = layui.data("articleCat"),
            record = locationData.list ? locationData.list : "";
        if (!record) {
            var jqajax = layui.jqajax,
                ajax = new jqajax();
            ajax.options.url = "./data/cat.json";
            ajax.ajax(ajax.options);
            ajax.complete = function(ret, options) {
                if (ret.status = 200) {
                    record = ret.data.list;
                    layui.data("articleCat", {
                        key: "list",
                        value: record
                    });
                }
            }
        }
    }

    //自定义表单填充
    // jqbind.setVal = function(options) {
    //     options.content.find("form")[0].reset();
    //     $.each(options.data, function(i, n) {
    //         options.content.find("select[name=" + i + "]").val(n);
    //         if (i == "level") {
    //             if (options.content.find("input[name=" + i + "]").length > 0) {
    //                 options.content.find("input[name=" + i + "]").val(n);
    //             } else {
    //                 var html = "<input type='hidden' name='" + i + "' value=" + n + " />";
    //                 options.content.children("form").append(html);
    //             }

    //         }
    //     })
    // }

    //上传文件设置
    layui.upload({
        url: '/admin/web/index.php?r=/index/upload',
        before: function(input) {
            box = $(input).parent('form').parent('div').parent('.layui-input-block');
            index = layer.load(1, {
                shade: [0.1,'#000000'] //0.1透明度的白色背景
            });
        },
        success: function(res) {
            if (res.status == 200) {
                if (box.next('div').length > 0) {
                    box.next('div').html('<div class="imgbox" style="margin: 0px"><p>加载中...</p></div>');
                } else {
                    box.after('<div class="layui-input-block" style="margin: 0px"><div class="imgbox"><p>加载中...</p></div></div>');
                }
                box.next('div').find('div.imgbox').html('<img src="' + res.url + '" alt="..." class="img-thumbnail" style="max-width: 100%;max-height: 100%">');
                box.find('input[type=hidden]').val(res.url);
                layer.close(index)
            } else {
                box.next('div').hide();
                layer.msg("上传失败",{icon:5})
                layer.close(index)
            }
        }
    });


    exports('list', {});
});