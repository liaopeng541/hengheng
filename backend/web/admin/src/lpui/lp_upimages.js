
layui.define('jquery', function(exports) {
    var $=layui.jquery;
    var lp_upimages={};
    lp_upimages.init=function (fd) {
        var __this = $(fd.content);
        var multi=fd.multi?true:false;
        var url=fd.url;
        var field=fd.field;
        var initarr=fd.initarr;
        if(multi)
        {
            field=field+"[]";
        }else{
            if(initarr!=""){
                initarr[0]=initarr;
            }
        }
        for(var i=0;i<initarr.length;i++)
        {
            if(i==0){
                __this.find(".lp_upfile_input").attr("id","");
            }

            var htmltemp='<li id="item-'+i+'" class="lp_upfile_itme"><span class="lp_upfile_fault">上传失败</span><img id="item-img-'+i+'" src="'+initarr[i]+'" class="lp-img"><input type="hidden"  class="itme-input-'+i+'" name="'+field+'" value="'+initarr[i]+'"><div class="lp_upfile_progress"><div class="lp_upfile_progressbar" style="width: 100%;"></div></div><a class="delfilebtn">x</a></li>';

            __this.find(".lp_uploadfilebtn").before(htmltemp);
            __this.find("#item-img-"+i).show();
            __this.find("#item-"+i+" .lp_upfile_progress").hide();

        }

        __this.find(".lp_upfile_list").on("click",".lp_upfile_itme .delfilebtn",function () {
            $(this).parent().remove()
            if(__this.find(".lp_upfile_itme").length==0)
            {

                __this.find(".lp_upfile_input").val("");
            }

        })
        if(multi)
        {
            __this.find(".lp_upfile_input").attr("multiple",true);

        }
        __this.find(".lp_uploadfilebtn").click(function () {
            __this.find(".lp_upfile_input").trigger("click");
        })
        __this.find(".lp_upfile_input").on("change", function (e) {
            var files = e.target.files || e.dataTransfer.files;
            var filecont=0;
            var index=__this.find("li").last().attr("id");
            if(index)
            {
                filecont=parseInt(index.replace("item-", ""));
                filecont++;
            }
            if(!multi)
            {
                __this.find(".lp_upfile_itme").remove();
            }
            for(var i=0;i<files.length;i++)
            {
                file=files[i];
                file.index=filecont+i;
                var htmltemp='<li id="item-'+file.index+'" class="lp_upfile_itme"><span class="lp_upfile_fault">上传失败</span><img id="item-img-'+file.index+'" src="uploads/0.jpg"><input type="hidden" class="itme-input-'+file.index+'" name="'+field+'" value="uploads/0.jpg"><div class="lp_upfile_progress"><div class="lp_upfile_progressbar" style="width: 100%;"></div></div><a class="delfilebtn">×</a></li>';

                __this.find(".lp_uploadfilebtn").before(htmltemp);
                (function(file) {
                    var xhr = new XMLHttpRequest();
                    if (xhr.upload) {
                        var eleProgress = __this.find('#item-'+file.index+' .lp_upfile_progress');
                        xhr.upload.addEventListener("progress", function (e) {

                            percent = (e.loaded / e.total * 100).toFixed(2) + '%';
                            eleProgress.find('.lp_upfile_progressbar').css('width',percent);
                            if(e.total-e.loaded<500000){e.loaded = e.total;}//解决四舍五入误差
                        }, false);
                        xhr.onreadystatechange = function (e) {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200) {
                                    __this.find("#item-img-"+file.index).attr("src",xhr.responseText).show();
                                    eleProgress.hide();
                                    __this.find(".itme-input-"+file.index).val(xhr.responseText);
                                    __this.find(".lp_upfile_input").attr("id","");
                                } else {
                                    __this.find(".itme-input-"+file.index).remove();
                                    eleProgress.hide();
                                    __this.find(".lp_upfile_fault").show();
                                }
                            }
                        }
                        xhr.open("POST", url, true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.setRequestHeader("X-FILENAME", encodeURI(file.name));

                        xhr.send(file);
                    }
                })(file)
            }
            $(this).val("");
        })
    }


    exports('lp_upimages', lp_upimages);
});