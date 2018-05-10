/**
 * Created by liao on 2018/4/24.
 */
layui.define("jquery", function (e) {
    var $ = layui.jquery;
    function _getRandomString(len) {
        len = len || 32;
        var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
        var maxPos = $chars.length;
        var pwd = '';
        for (i = 0; i < len; i++) {
            pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
        }
        return pwd;
    }


    /**
     * 下拉按钮
     * @param e
     */
    $(".lp-drop-btn").each(function (i,el) {
        var ts=_getRandomString(15);
        $(el).attr("box-id",ts)
    })
    function hidemenu(e) {
        if ($(e.target).hasClass("lp-drop-box") || $(e.target).parents(".lp-drop-box").length > 0) {
            e.stopPropagation();
            return
        }
        $(".lp-drop-box").css("left", 9999);
        $(document).unbind("mousemove", hidemenu)
    }


    $(".lp-drop-btn").mousemove(function (e) {
        var dbox=$(this).children(".lp-drop-box");
        var boxid=$(this).attr("box-id");
        if(dbox.length>0)
        {
            dbox.attr("id",boxid);
            $(document.body).append(dbox);
        }
        $(".lp-drop-box[id!="+boxid+"]").css("left",9999);
        dbox=$("#"+boxid);
        var nl = dbox.css("left");
        nl = parseInt(nl.replace("px", ""));

        var top = $(this).offset().top + $(this).height();
        var left = $(this).offset().left - 1;
        if (nl > 5000 && nl != left) {
            dbox.css({top: top, left: left})
        }
        e.stopPropagation();
        $(document).bind("mousemove", hidemenu)
    })
    /**
     * 鼠标移动显示层
     */
    var tipdiv
    $(".lp-tip").hover(function () {
        tipdiv = $(this).attr("lp-tip-box");
        var pad = $(this).css("padding-left");
        pad = parseInt(pad.replace("px", ""))
        var left = $(this).offset().left + $(this).width() + pad;
        var top = $(this).offset().top + $(this).height() / 2;
        var w = $("#" + tipdiv).width();
        var h = $("#" + tipdiv).height() / 2;
        var ntop = top - h;
        var dh = $(document).height();
        var dw = $(document).width();
        var he = h + top;
        if (he > dh) {
            ntop = top - h - (he - dh)
        }
        if (ntop < 3) {
            ntop = 3;
        }
        if ((left + w) > dw) {
            left = ($(this).offset().left - pad) - w;
        }

        $("#" + tipdiv).css({top: ntop, left: left})

    }, function () {
        $("#" + tipdiv).css({left: "10000px"})
    })
    function hideiframe(e) {
        if ($(e.target).hasClass("layui-layer") || $(e.target).hasClass("layui-layer-move") || $(e.target).hasClass("layui-layer-resize") || $(e.target).parents(".layui-layer").length > 0 || $(e.target).is("body")) {
            e.stopPropagation();
            return
        }
        layer.closeAll();
        $(".lp-drop-table").removeAttr("open");
        $(document).unbind("click", hideiframe)

    }
    $(".lp-drop-table").click(function () {
        var data = $(this).attr("lp-data")
        var __this = $(this);
        data = eval('(' + data + ')');
        data.o = data.o ? data.o : "bottom";
        data.width = data.width ? data.width : "200px";
        data.height = data.height ? data.height : "200px";
        var left = 9999;
        var top = 0;
        if (!data.url) {
            layer.alert('请设置URL');
            return;
        }
        switch (data.o) {
            case "bottom":
                left = __this.offset().left + 1;
                top = __this.offset().top + $(__this).height() + 2;
                break;
        }
        if (__this.attr("open")) {
            __this.removeAttr("open");
            layer.closeAll()

        } else {
            setTimeout(function () {
                layer.open({
                    title: false,
                    type: 2,
                    anim: -1,
                    isOutAnim: false,
                    shade: 0,
                    closeBtn: 0,
                    move: false,
                    scrollbar: false,
                    content: data.url,
                    offset: [top + 'px', left + 'px'],
                    area: [data.width, data.height],
                    success: function () {
                        $(document).bind("click", hideiframe)
                        __this.attr("open", 1);
                    }
                })
            },50)

        }
    })
    function getlpdata(obj) {
        return eval('('+$(obj).attr("lp-data")+')');
    }

    $(".lp-modal").click(function () {
        var data=getlpdata(this);
        var l =  layer.open(data)
        if(data.full)
        {
            layer.full(l)
        }
    })
    $("[lp-search-box-reset]").on('click',function () {
        var thefrom=$(this).parents(".lp-search-box").find(".layui-form").find(".layui-form-item");
        $(thefrom).each(function (index,ele) {
            $(ele).find("input:text").val("");
            $(ele).find("input:checkbox").prop("checked",false);
            $(ele).find("input:radio").prop("checked",false);
            $(ele).find("input:radio:first").prop("checked",true);
            $(ele).find("select option").prop("selected",false);
            $(ele).find("select option:first").prop("selected",true);
        })
        layui.form.render();
    })
    $("[lp-reset-mini-search]").on('click',function () {
        var thefrom=$(this).parents(".layui-form").find(".layui-input-inline");
        $(thefrom).each(function (index,ele) {
            $(ele).find("input:text").val("");
            $(ele).find("input:checkbox").prop("checked",false);
            $(ele).find("input:radio").prop("checked",false);
            $(ele).find("input:radio:first").prop("checked",true);
            $(ele).find("select option").prop("selected",false);
            $(ele).find("select option:first").prop("selected",true);
        })
        layui.form.render();
    })
    $("[lp-search-btn]").on('click',function () {
        var thebtn=$(this).parents(".lp-search-box").find(".layui-form").find("[lp-search-submit]");
        $(thebtn).trigger('click')

    })
    $("[lp-close]").on('click',function () {
        layer.closeAll();
        parent.layer.closeAll();
    })

    e("lpui")
})