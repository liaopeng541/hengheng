/**
 * Created by liao on 2018/4/24.
 */
layui.define(['table', 'element', 'jquery'], function (e) {

    var $ = layui.jquery;
    var table=layui.table;
    var element=layui.element;

    function getow(obj) {
        var ow = obj.css("width");
        ow = ow.replace("px", "");
        return parseInt(ow);
    }
    var child = $("<div class='drag-box' style='background: #cccccc;z-index: 999'></div>");

    if($(".ew-resize-right").length>0) {
        var w = 0;
        var point = $(".ew-resize-right").offset().left;
        var now_width = getow($(".lp-right-detail"));

        function MouseMove(el) {
            w = point - el.clientX;
            if ((now_width + w) < 500 && (now_width + w) > 200) {
                child.css("left", el.clientX);
            }
        }

        function MouseUp(el) {
            child.remove();
            var nw = getow($(".lp-right-detail")) + w;
            nw = nw > 500 ? 500 : nw;
            nw = nw < 200 ? 200 : nw;
            var drag = $(".ew-resize-right");
            $(".lp-right-detail").css("width", nw + "px");
            drag.css("right", nw + "px")

            $(".lp-center-box").css("right", (nw + 5) + "px");
            element.render({})
            $("body").removeClass("lp-disable-select");
            rendertable($(".c-c-box"))
            rendertable($(".c-b-box"))
            $(document).unbind("mousemove", MouseMove).unbind("mouseup", MouseUp)
        }



        $(".ew-resize-right").mousedown(function () {
            now_width = getow($(".lp-right-detail"));
            point = $(this).offset().left
            $("body").addClass("lp-disable-select");
            child.css("left", $(this).css("left"))
            $(this).before(child);
            $(document).bind("mousemove", MouseMove).bind("mouseup", MouseUp)
        })
    }
    if($(".ew-resize-left").length>0) {
        var l_w = 0;
        var l_point = $(".ew-resize-left").offset().left;
        var l_now_width = getow($(".lp-left-detail"));

        function L_MouseMove(el) {
            l_w = el.clientX - l_point;
            if ((l_now_width + l_w) > 150 && (l_now_width + l_w) < 350) {
                child.css("left", el.clientX);
            }
        }

        function L_MouseUp(el) {
            child.remove();
            var nw = getow($(".lp-left-detail")) + l_w;
            nw = nw > 350 ? 350 : nw;
            nw = nw < 150 ? 150 : nw;
            var drag = $(".ew-resize-left");
            $(".lp-left-box").css("width", nw + "px");
            drag.css("left", nw + "px")

            $(".lp-center-box").css("left", (nw + 5) + "px");
            $(".lp-tree-body").css("width", nw + "px");
            element.render({})
            $("body").removeClass("lp-disable-select");
            rendertable($(".c-c-box"))
            rendertable($(".c-b-box"))
            $(document).unbind("mousemove", L_MouseMove).unbind("mouseup", L_MouseUp)
        }


        $(".ew-resize-left").mousedown(function () {
            l_now_width = getow($(".lp-left-detail"));
            l_point = $(this).offset().left
            $("body").addClass("lp-disable-select");
            child.css("left", $(this).css("left"))
            $(this).before(child);
            $(document).bind("mousemove", L_MouseMove).bind("mouseup", L_MouseUp)
        })
    }

    function getowH(obj) {
        var ow= obj.css("height");
        ow=ow.replace("px","");
        return parseInt(ow);
    }
    if($(".b-drag-box").length>0){
    var b_child=$('<div class="b-drag-box" style="background: #cccccc;z-index: 999"></div>')
    var b_now_height=getowH($(".c-b-box"));
    var b_point= $(".b-drag-box").offset().top;
    var b_w=0;
    function B_MouseMove(el) {
        b_w=b_point-el.clientY;
        if((b_now_height+b_w)>200 && (b_now_height+b_w)<500 )
        {
            b_child.css("top", el.clientY);
        }
    }
    function rendertable(obj) {
        obj.find('.layui-table[lay-data]').each(function (index,eles) {
            var data=$(eles).attr("lay-data");
            var lay_f=$(eles).attr("lay-filter");
            data=eval('(' + data + ')');
            data.localreload=true;
            $(eles).attr("lay-data",JSON.stringify(data));
            table.init(lay_f,data)
        })
    }
    function B_MouseUp(el) {
        b_child.remove();
        var nw=getowH($(".c-b-box"))+b_w;
        nw=nw>500?500:nw;
        nw=nw<200?200:nw;
        var drag=$(".b-drag-box");
        drag.css("bottom",nw+"px")
        $(".c-b-box").css("height",(nw)+"px");
        $(".c-c-box").find('.layui-table[lay-data]').each(function (index,eles) {
            var data=$(eles).attr("lay-data");
            var lay_f=$(eles).attr("lay-filter");
            data=eval('(' + data + ')');
            data.height="full-"+(nw+40);
            data.localreload=true;
            $(eles).attr("lay-data",JSON.stringify(data));
            table.init(lay_f,data)
        })
        $(".c-b-box").find('.layui-table[lay-data]').each(function (index,eles) {
            var data=$(eles).attr("lay-data");
            var lay_f=$(eles).attr("lay-filter");
            data=eval('(' + data + ')');
            data.height=nw-41;
            data.localreload=true;
            $(eles).attr("lay-data",JSON.stringify(data));
            table.init(lay_f,data)
        })

        element.render({})
        $("body").removeClass("lp-disable-select");
        $(document).unbind("mousemove", B_MouseMove).unbind("mouseup", B_MouseUp)
    }
    $(".b-drag-box").mousedown(function () {
        b_now_height=getowH($(".c-b-box"));
        b_point=$(this).offset().top
        $("body").addClass("lp-disable-select");
        b_child.css("bottom",$(this).css("bottom"))
        $(this).before(b_child);
        $(document).bind("mousemove", B_MouseMove).bind("mouseup", B_MouseUp)
    })
    }
    e("lpresize");
})