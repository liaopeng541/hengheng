/**
 * Created by liao on 2018/4/27.
 */
layui.define(["lpui","jquery","form","laydate","lp_upimages"], function(exports) {
    var $=layui.jquery;
    var layer=layui.layer
    function getlpdata(obj) {
        return eval('('+$(obj).attr("lp-data")+')');
    }
    $(".layui-form").each(function (index,ele) {
        var lpdata=getlpdata(ele)
        var theForm=$(ele)
        if(lpdata && lpdata.type=='edit')
        {
            var load=parent.layer.msg('加载中', {
                icon: 16
                ,shade: 0.01,
                time:0,
            });

            var data=top.table.cache[lpdata.table]
            if(data) {
                for (var k = 0; k  < data.length; k ++) {

                    var record = data[k ];
                    if (record[lpdata.key] == lpdata.value) {
                        var inputHtml = "";
                        for (var key in record) {

                            var obj = theForm.find('input[name=' + key + ']'),
                                inputHtml;
                            if (obj.length > 0) {
                                if (obj.prop('type') == "text" || obj.prop('type') == "hidden" || obj.prop('type') == "password") {


                                    // if (theForm.find('.img[name=' + key + ']').length > 0) {
                                    //     if (record[key]) {
                                    //         var html = '<div class="layui-input-block" style="margin: 0px"><div class="imgbox"><img src="' + record[key] + '" alt="..." class="img-thumbnail" style="max-width: 100%;max-height: 100%"></div></div>';
                                    //         theForm.find('.img[name=' + key + ']').parents("div.layui-input-block").after(html);
                                    //     }
                                    //
                                    // }
                                    // if (theForm.find('.imgs[name=' + key + ']').length > 0) {
                                    //     var html = '<div class="layui-input-block" style="margin: 0px">';
                                    //     if (record[key].length > 0) {
                                    //         for (var i = 0; i < record[key].length; i++) {
                                    //             html += '<div class="imgbox"><img src="' + record[key][i] + '" alt="..." class="img-thumbnail" style="max-width: 100%;max-height: 100%"></div>'
                                    //         }
                                    //         html += "</div>";
                                    //
                                    //         theForm.find('.imgs[name=' + key + ']').parents("div.layui-input-block").after(html);
                                    //     }
                                    // }
                                    if (obj.next("#icondata").length > 0) {
                                        obj.next("#icondata").html(record[key]);
                                        obj.next("#icondata").attr("data", record[key])
                                    }
                                    obj.val(record[key]);
                                } else if (obj.prop('type') == "checkbox" || obj.prop('type') == "radio") {
                                    obj.each(function (i, n) {
                                        if ($(n).val() == record[key]) {
                                            $(n).prop("checked", true);
                                        } else {
                                            $(n).prop("checked", false);
                                        }
                                    })
                                }
                            } else if (theForm.find('input[name=' + key + '_file]').length > 0) {
                                var __this = theForm.find('input[name=' + key + '_file]').parent();
                                var initarr = [];
                                var name;
                                if (theForm.find('input[name=' + key + '_file]').attr("lp-type") == "file") {
                                    if (record[key]) {
                                        initarr[0] = record[key];
                                    }
                                    name = key;
                                } else {
                                    initarr = record[key]
                                    name = key + '[]';
                                }

                                if (initarr) {
                                    for (var i = 0; i < initarr.length; i++) {
                                        if (i == 0) {
                                            __this.find(".lp_upfile_input").attr("id", "");
                                        }

                                        var htmltemp = '<li id="item-' + i + '" class="lp_upfile_itme"><span class="lp_upfile_fault">上传失败</span><img id="item-img-' + i + '" src="' + initarr[i] + '" class="lp-img"><input type="hidden"  class="itme-input-' + i + '" name="' + name + '" value="' + initarr[i] + '"><div class="lp_upfile_progress"><div class="lp_upfile_progressbar" style="width: 100%;"></div></div><a class="delfilebtn">x</a></li>';

                                        __this.find(".lp_uploadfilebtn").before(htmltemp);
                                        __this.find("#item-img-" + i).show();
                                        __this.find("#item-" + i + " .lp_upfile_progress").hide();

                                    }

                                }


                            } else if ($("#" + key + "_edit").length > 0) {
                                var edt_value = record[key];
                                var ue = UE.getEditor(key + "_edit");
                                ue.addListener('ready', function () {
                                    if (edt_value) {
                                        ue.setContent(edt_value);
                                    }
                                });
                            } else if (theForm.find('textarea[name=' + key + ']').length > 0) {
                                theForm.find('textarea[name=' + key + ']').val(record[key]);
                            } else if (theForm.find('select[name=' + key + ']').length > 0) {
                                theForm.find('select[name=' + key + ']').val(record[key]);
                            } else {


                            }
                        }
                        theForm.append(inputHtml);
                        layui.form.render();
                        parent.layui.layer.close(load)
                    }
                }
            }

        }






    })


    /**处理图片上传***/
    var lp_upimages=layui.lp_upimages
    $(".layui-form").find("[lp-type=files]").each(function () {
        var field=$(this).attr("lp-key");
        var content=$(this).parent().attr("id");
        var bind=$(this).attr("bind");
        lp_upimages.init({
            "field":field,
            "multi":true,
            "url":"/backend/web/index.php?r=index/lpupload",
            "initarr":[],
            "initid":"",
            "content":"#"+content
        })
    })
    $(".layui-form").find("[lp-type=file]").each(function () {
        var field=$(this).attr("lp-key");
        var content=$(this).parent().attr("id");
        var bind=$(this).attr("bind");
        lp_upimages.init({
            "field":field,
            "multi":false,
            "url":"/backend/web/index.php?r=index/lpupload",
            "initarr":[],
            "initid":"",
            "content":"#"+content
        })
    })
    //处理多日期
    $(".layui-form").find(".lp-date").each(function(k,d){
        var id="lp-date"+k
        $(d).prop("id",id)
        layui.laydate.render({
            elem: '#'+id,
            format: 'yyyy-MM-dd',
            type: 'date'
        });
    })
    $(".layui-form").find(".lp-time").each(function(k,d){
        var id="lp-time"+k
        $(d).prop("id",id)
        layui.laydate.render({
            elem: '#'+id,
            format: 'HH:mm:ss',
            type: 'time'
        });
    })
    $(".layui-form").find(".lp-date_time").each(function(k,d){
        var id="lp-date_time"+k
        $(d).prop("id",id)
        layui.laydate.render({
            elem: '#'+id,
            format: 'yyyy-MM-dd HH:mm:ss',
            type: 'datetime'
        });
    })
    //处理提交
    layui.form.on('submit(edit)', function(data){
        var load=parent.layer.msg('加载中', {
            icon: 16
            ,shade: 0.01,
            time:0,
        });
        var lpdata=getlpdata(data.form)
        var url=$(data.form).attr("action")
        data.field.id=lpdata.value
        //请求数据
        $.post(url,data.field,function (msg) {
            if(msg.status==0)
            {
                //更新视图
                top.table.reload(lpdata.table)
                parent.layer.closeAll();
            }
            parent.layer.msg(msg.msg);
        })
        return false;
    });
    layui.form.on('submit(add)', function(data){
        var load=parent.layer.msg('加载中', {
            icon: 16
            ,shade: 0.01,
            time:0,
        });
        var lpdata=getlpdata(data.form)
        var url=$(data.form).attr("action")
        data.field.id=lpdata.value
        //请求数据
        $.post(url,data.field,function (msg) {
            if(msg.status==0)
            {
                //更新视图
                top.table.reload(lpdata.table)
                parent.layer.closeAll();
            }
            parent.layer.msg(msg.msg);
        })
        return false;
    });
    $(".lp-export").on("click",function () {
        var table = top.global['<?= $generator->controllerID ?>'];
        var url=table.options.url;
        url=url.replace("index&","exportexcel&");
        var index=layer.msg('加载中', {
            icon: 16
            ,shade: 0.4,
            time:20000,
        });
        var $form = $('<form method="POST"></form>');
        $form.attr('action', url);
        $form.appendTo($('body'));
        $form.submit();
        layer.close(index);
    })


    //输出接口
    exports('lpform');
});