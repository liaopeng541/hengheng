/**
 * Created by liao on 2018/4/24.
 */
layui.define(['jquery'], function (e) {

    var $ = layui.jquery;
    $(".lp-sear-btn").on('click', function () {
        var searbox=$(this).prev(".lp-search-box");
        if (parseInt(searbox.css("width")) > 0) {
            searbox.animate({width: 0})
            searbox.children(".lp-search-title").children(".lp-search-close").animate({width: 0})
            searbox.children(".lp-search-sub-btn").hide();
            $(this).parents(".lp-grid").unbind("click",hidesearch)
        } else {
            searbox.animate({width: 380}, function () {
                $(this).children(".lp-search-sub-btn").show();
            })
            searbox.children(".lp-search-title").children(".lp-search-close").animate({width: 40})
            $(this).parents(".lp-grid").bind("click",hidesearch)
        }
    })
    $(".lp-search-close").on('click', function () {
        var searbox=$(this).parent().parent(".lp-search-box")
        searbox.animate({width: 0})
        searbox.children(".lp-search-title").children(".lp-search-close").animate({width: 0})
        searbox.children(".lp-search-sub-btn").hide();
        $(this).parents(".lp-grid").unbind("click",hidesearch)
    })
    function hidesearch(e) {
        if(!$(e.target).hasClass("lp-search-box")&&$(e.target).parents(".lp-search-box").length<1&&!$(e.target).hasClass("lp-sear-btn")&&$(e.target).parents(".lp-sear-btn").length<1)
        {
            var elem=  $(e.target).parents(".lp-grid").find(".lp-search-box");
            if(elem.length>0){
                elem.animate({width: 0})
                elem.children(".lp-search-title").children(".lp-search-close").animate({width: 0})
                elem.children(".lp-search-sub-btn").hide();
            }
        }
    }

    e("lpsearchbox");
})