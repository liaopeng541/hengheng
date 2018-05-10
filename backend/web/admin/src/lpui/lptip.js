/**
 * Created by liao on 2018/4/24.
 */
layui.define(['jquery'], function (e) {
    var $ = layui.jquery;
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
        if (ntop < 0) {
            ntop = 0;
        }
        if ((left + w) > dw) {
            left = ($(this).offset().left - pad) - w;
        }

        $("#" + tipdiv).css({top: ntop, left: left})

    }, function () {
        $("#" + tipdiv).css({left: "10000px"})
    })
    e("lptip")
})