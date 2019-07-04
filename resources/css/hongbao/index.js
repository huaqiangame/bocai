    // 
	function lunTopFn(obj,time){
        time = time ? time: 30;
        $(obj).children('ul').append($(obj).children('ul').children().clone(true))
        var len = $(obj).children('ul').height()/2;
        var times = null;
        if($(obj)[0]){
            times = window.setInterval(function(){
                var t = $(obj).children('ul').css('top');
                t = t.replace('px','');
                if(t > -len){
                    t--;
                    $(obj).children('ul').css({top: t})
                }else{
                    $(obj).children('ul').css({top: 0})
                }
            },time)
            $(obj).children('ul').hover(function(){
                window.clearInterval(times);
            },function(){
                times = window.setInterval(function(){
                    var t = $(obj).children('ul').css('top');
                    t = t.replace('px','');
                    if(t > -len){
                        t--;
                        $(obj).children('ul').css({top: t})
                    }else{
                        $(obj).children('ul').css({top: 0})
                    }
                },time)
            })
        }
    }

$(document).ready(function(){
   window.setTimeout(function () {
    $(".loading").fadeOut(500)
  }, 400);
    // 
     $(".cha").click(function(){
        $(".kef").hide();
    });
    $(".chag").click(function(){
        $(".gonggao").hide();
    });
	$(".xiao").click(function(){
        $(".gonggao").toggleClass("cur");
    });

    // 
    $(window).scroll(function(){
        var sc = $(window).scrollTop();
        $('.kef').stop().animate({
            top: 80+sc
        },150)
        
    })
    //lunTopFn('.luntop2',50);
    lunTopFn('.luntop1',50);
  $(".chainpt").each(function(){
		$(this).attr("oldval",$(this).val())
		$(this).focus(function(){
			if($(this).val() == $(this).attr("oldval")){
				$(this).val("")
				if($(this).attr("typeval") ==  "password"){
					$(this).attr("type","password")
				}
			}
			
		}).blur(function(){
			if($(this).val() == ""){
				$(this).val($(this).attr("oldval"))
				if($(this).attr("typeval") ==  "password"){
					$(this).attr("type","text")
				}
			}
		})
	})
});

