/*
 * @Author: Paco
 * @Date:   2017-02-15
 * @lastmodify 2017-02-24
 * +----------------------------------------------------------------------
 * | jqadmin [ jq酷打造的一款懒人后台模板 ]
 * | Copyright (c) 2017 http://jqadmin.jqcool.net All rights reserved.
 * | Licensed ( http://jqadmin.jqcool.net/licenses/ )
 * | Author: Paco <admin@jqcool.net>
 * +----------------------------------------------------------------------
 */

layui.define(['jquery', 'jqform', 'jqelem'], function(exports) {
    var $ = layui.jquery,
        form = layui.jqform;
    form.init({ form: "#form1"});
    form.on('submit(login)', function(data){
       var  button = $(this),
            elem = button.parents('.layui-form')
            url = elem.attr("action");
            var l;
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            data: data.field,
            timeout: 10000,
            beforeSend: function() {
                    l = layer.load(1);
            },
            error: function(XMLHttpRequest, status, thrownError) {
                layer.msg('网络繁忙，请稍后重试...', { icon: 2 });
            },
            success: function(msg) {
                if(msg.status==0)
                {
                    layer.msg('登陆成功', { icon: 1 });
                    setTimeout(function () {
                        window.location.reload();
                    },500)
                }else{
                    layer.msg(msg.message, { icon: 2 });
                    var src=$("#codeimage").attr('src');
                    if(src.indexOf("&refresh=1")==-1)
                    {
                        src+="&refresh=1";
                    }
                    $.get(src,function (data,status) {
                        $("#codeimage").attr('src',data.url)
                    })
                }

            },
            complete: function() {
                    layer.close(l);

            }
        });


        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });

    exports('simpleform', {});
});