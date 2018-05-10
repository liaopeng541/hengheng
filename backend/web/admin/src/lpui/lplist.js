/**
 * Created by liao on 2018/4/24.
 */
layui.define(["table","jquery"], function (e) {
    var $ = layui.jquery;
    var table=layui.table
    function getlpdata(obj) {
        var data = $(obj).attr("lp-data");
        if(data)
        {
            return eval('('+data+')');
        }else{
            return null;
        }


    }
    $(function () {
        $(".lp-sear-btn").on('click', function () {
            if (parseInt($(this).prev(".lp-search-box").css("width")) > 0) {
                $(this).prev(".lp-search-box").animate({width: 0})
                $(this).prev(".lp-search-box").children(".lp-search-title").children(".lp-search-close").animate({width: 0})
                $(this).prev(".lp-search-box").children(".lp-search-sub-btn").hide();
            } else {
                $(this).prev(".lp-search-box").animate({width: 380}, function () {
                    $(this).children(".lp-search-sub-btn").show();
                })
                $(this).prev(".lp-search-box").children(".lp-search-title").children(".lp-search-close").animate({width: 40})

            }
        })
        $(".lp-search-close").on('click', function () {
            $(this).parent().parent(".lp-search-box").animate({width: 0})
            $(this).parent().parent(".lp-search-box").children(".lp-search-title").children(".lp-search-close").animate({width: 0})
            $(this).parent().parent(".lp-search-box").children(".lp-search-sub-btn").hide();

        })


        function resizeTable()
        {
            $(document.body).find('.layui-table[lay-data]').each(function (index,eles) {
                var data=$(eles).attr("lay-data");
                var lay_f=$(eles).attr("lay-filter");
                data=eval('(' + data + ')');
                data.localreload=true;
                layui.table.init(lay_f,data)

            })
        }
        var timer = 0;
        $(window).resize(function (e) {
            clearTimeout(timer);
            timer=setTimeout(resizeTable, 200);
        })
        $(document.body).find('.layui-table[lay-data]').each(function (index,eles) {
            var lay_data=$(eles).attr("lay-data");
            var lay_f=$(eles).attr("lay-filter");
            lay_data=eval('(' + lay_data + ')');
            layui.table.on('sort('+lay_f+')', function(obj){
                var sort=obj.field + "|" + obj.type//排序字段
                if(!obj.type) {
                    sort="";
                }
                layui.table.reload(lay_data.id, {
                    initSort: obj
                    , where: {
                        sort: sort
                    }
                });
            });
            layui.table.on('tool('+lay_f+')', function(obj){
                var data=getlpdata(obj.elem)
                if(obj.event=='detail')
                {
                    var theid=obj.data[data.key];
                    data.content+='&id='+theid
                    var l = layer.open(
                        data
                    );
                    if(data.full)
                    {
                        layer.full(l)
                    }
                }else if(obj.event=='edit')
                {
                    var theid=obj.data[data.key];
                    data.content+='&id='+theid
                    var l =layer.open(
                        data
                    );
                    if(data.full)
                    {
                        layer.full(l)
                    }

                }else if(obj.event=='del')
                {
                    var l = layer.confirm('你确认删除本条数据么？', {
                        btn: ['确定','取消'] //按钮
                    }, function(){
                        var load=layer.msg('加载中', {
                            icon: 16
                            ,shade: 0.01,
                            time:0,
                        });
                        var id=obj.data[data.key];
                        $.post(data.url,{id:id},function (res) {
                            if(res.status==0)
                            {
                                layer.close(l)
                                obj.del();
                            }
                            layer.msg(res.msg);
                        })
                    }, function(){


                    });
                }else if(obj.event=='show_detail')
                {
                    var data=getlpdata(obj.elem);
                    var theid=obj.data[data.key];
                    data.content+='&id='+theid
                    layer.open(data)
                }

            });


            layui.form.on('switch('+lay_data.id+')',function (s_data) {
                var lpdata=getlpdata(s_data.elem)
                var setdata=this.checked?lpdata.on:lpdata.off
                var title_text=$(s_data.elem).attr("lay-text");
                var field=$(s_data.elem).attr("name");
                title_text=title_text.split("|");
                var title=this.checked?title_text[0]:title_text[1]
                var that=this
                var load=layer.msg('加载中', {
                    icon: 16
                    ,shade: 0.01,
                    time:0,
                });
                var subdata={
                    field:field,
                    value:setdata,
                    id:lpdata.id,
                    title:title
                }

                $.post(lpdata.url,subdata,function (msg) {
                    if(msg.status==0)
                    {
                        //更新缓存
                        var index=$(that).parents("tr").attr("data-index");
                        table.cache[lpdata.table][index][field]=setdata;
                    }else{
                        //还原视图
                        $(that).prop("checked",!that.checked)
                        layui.form.render('checkbox');
                    }
                    layer.msg(msg.msg);
                })


            })

            layui.form.on('checkbox('+lay_data.id+')',function (s_data) {
                var lpdata=getlpdata(s_data.elem)
                var setdata=this.checked?lpdata.on:lpdata.off
                var title_text=$(s_data.elem).attr("lay-text");
                var field=$(s_data.elem).attr("name");
                title_text=title_text.split("|");
                var that=this;
                var title=this.checked?title_text[0]:title_text[1]
                var load=layer.msg('加载中', {
                    icon: 16
                    ,shade: 0.01,
                    time:0,
                });
                var subdata={
                    field:field,
                    value:setdata,
                    id:lpdata.id,
                    title:title
                }

                $.post(lpdata.url,subdata,function (msg) {
                    if(msg.status==0)
                    {
                        //更新缓存
                        var index=$(that).parents("tr").attr("data-index");
                        table.cache[lpdata.table][index][field]=setdata;
                        //更新视图
                        $(s_data.elem).attr("title",title)


                    }else{
                        //还原视图
                        $(that).prop("checked",!that.checked)
                    }
                    layui.form.render('checkbox');
                    layer.msg(msg.msg);
                })
            })
        })

    })

    $(".lp-all-set").click(function () {
        var data=getlpdata(this);
        var checklist = table.checkStatus(data.table)
        var checked=data.checked=='on'?true:false
        var that=this;
        if(checklist.data.length>0) {
            //ajax请求
            var load=layer.msg('加载中', {
                icon: 16
                ,shade: 0.01,
                time:0,
            });
            var ids="";
            var ids_qz="";
            for(var i=0;i<checklist.index.length;i++)
            {
                if(i>0)
                {
                    ids_qz=",";
                }
                ids+=ids_qz+table.cache[data.table][checklist.index[i]][data.key];
            }
            var postdata={
                id:ids,
                field:data.field,
                value:data.value,
                title:data.title
            }
            $.post(data.url,postdata,function (msg) {
                if(msg.status==0)
                {
                    //更新缓存数据
                    for(var i=0;i<checklist.index.length;i++)
                    {
                        table.cache[data.table][checklist.index[i]][data.field]=data.value;
                    }
                    //更新视图
                    var thetop=$(that).parents(".lp-grid").find("table[class=layui-table]");
                    thetop.find("input:checkbox[name="+data.field+"]").each(function (index,ele) {

                        if($.inArray(index,checklist.index)!=-1)
                        {
                            $(ele).prop("checked",checked)
                            $(ele).attr("title",data.title)
                        }
                    })
                    layui.form.render("checkbox")
                }
                layer.msg(msg.msg)
            })









        }else{
            layer.msg("请选择要操作的行")
        }

    })
    $(".lp-all-del").click(function () {
        var data=getlpdata(this);
        var checklist = table.checkStatus(data.table)
        var ids="";
        var that=this
        if(checklist.data.length>0) {
            for (var i = 0; i < checklist.data.length; i++) {
                if(i==0){
                    ids +=""+checklist.data[i][data.key];
                }else{
                    ids +=","+checklist.data[i][data.key];
                }
            }

        var l = layer.confirm('你确认删除'+checklist.data.length+'条数据么？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var load=layer.msg('加载中', {
                icon: 16
                ,shade: 0.01,
                time:0,
            });

            $.post(data.url,{id:ids},function (res) {
                if(res.status==0)
                {
                    var thetop=$(that).parents(".lp-grid");
                    //删除行
                    var j=0;
                    for(var i=0;i<checklist.index.length;i++)
                    {
                        $(thetop).find("tr[data-index="+checklist.index[i]+"]").remove();
                        table.cache[data.table].splice(checklist.index[i]-j,1)
                        j++;
                    }
                    $(thetop).find("tr[data-index]").each(function (index,ele) {
                        $(ele).attr("data-index",index);
                    })
                    layer.close(l)
                }
                layer.msg(res.msg);

            })




        }, function(){


        });




        }else{
            layer.msg("请选择要操作的行")
        }


    })
$(".lp-drop-box dl dd").click(function () {
    var load=layer.msg('加载中', {
        icon: 16
        ,shade: 0.01,
        time:0,
    });
    var data = getlpdata(this)
    var thetable = table.lastpage[data.table]
    var where=thetable.where;
    var $form = $('<form method="POST"></form>');
    $form.attr('action', data.url);
    $form.appendTo($('body'));
    for(var key in where)
    {
        $form.append('<input type="hidden" name="'+key+'" value="'+where[key]+'"/>')
    }
    $form.submit();
    layer.close(load);





})

    layui.form.on('submit(search)', function(data){
        layui.table.reload($(this).attr("lp-table"), {
            where: data.field
            ,page: {
                curr: 1 //重新从第 1 页开始
            }
        });
        return false;
    });







    e("lplist")
})