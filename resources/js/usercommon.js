$(function(){
    //换皮肤
    var userskin = HTMLDecode(getCookie('userskin'));
    var skincssurl = HTMLDecode(getCookie('skincssurl'));
    if(userskin!=undefined && userskin!=""){
        $('#currskin').attr("class","bg"+userskin);
        $('.skincsslittle').attr("href",skincssurl);
    }
    $('.sub-skins a').click(function(){
        var cdndomain=$("#cdndomain").val();
        $(".sub-skins").hide();
        var skinbg = $(this).find("span").data("color");
        if(skinbg=="random"){
            var randomnum = RandomNum('0','36');
            $('#currskin').attr("class","bg"+skinbg);
            var skincssurl = cdndomain+"/cl/tpl/newcenter/css/random"+randomnum+".css";
            $('.skincsslittle').attr("href",skincssurl);
            setCookie('userskin',skinbg,360);
            setCookie('skincssurl',skincssurl,360);
        }else{
            $('#currskin').attr("class","bg"+skinbg);
            var skincssurl = cdndomain+"/cl/tpl/newcenter/css/"+skinbg+".css";
            $('.skincsslittle').attr("href",skincssurl);
            setCookie('userskin',skinbg,360);
            setCookie('skincssurl',skincssurl,360);
        }

    });
    $('#currskin').parent().hover(function(){
        $(".sub-skins").show();
    });
    $('.sub-skins a').parent().hover(function(){
        $(".sub-skins").show();
    },function(){
        $(".sub-skins").hide();
    });

    //左侧菜单收缩
    $(".sidebar").on('click.targetP', '.nav-title', function (e) {
        $(this).next().slideToggle(100);
    });
    var mainh=$(window).height()-115;
    $(".tabbox").css("max-height",mainh);

    gopage();

});
$(window).resize(function(event) {
    var mainh=$(window).height()-115;
    $(".tabbox").css("max-height",mainh);
});
window.onload = function(){
  function scrollHandle (e){
    var scrollTop = this.scrollTop;
    this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
  }
  $(".tablelist").each(function(){
    $(this).on('scroll',scrollHandle);
  });
};
$(window).on("hashchange", function() {//兼容ie8+和手机端
    gopage();
});

function RandomNum(minNum,maxNum){ 
    switch(arguments.length){ 
        case 1: 
            return parseInt(Math.random()*minNum+1,10); 
        break; 
        case 2: 
            return parseInt(Math.random()*(maxNum-minNum+1)+minNum,10); 
        break; 
            default: 
                return 0; 
            break; 
    } 
}

function gopage(){
    //判断当前页面
    var webpage = window.location.href;
    if(webpage.indexOf("#")>-1){
        var webhash = window.location.hash;
        webhash=webhash.replace("#","");
        $(".tabmenu a").removeClass('active');
        $(".tabmenu a[data-url='"+webhash+"']").addClass('active');
        $(".tabbox .tabform").hide();
        $(".tabbox .record").hide();
        $(".tabbox .tabform[data-url='"+webhash+"']").show();
        $(".tabbox .record[data-url='"+webhash+"']").show();
        $(".nav-sub li").removeClass("active");
        $(".nav-sub li[data-page='"+webhash+"']").addClass("active");
        $(".nav-title").removeClass('current');
        $(".nav-sub li[data-page='"+webhash+"']").parent().prev().addClass('current');
    }else{
        if(webpage.indexOf("QuickDesposit")>-1){
            $(".nav-sub li").removeClass("active");
            $(".nav-sub li[data-page='QuickDesposit']").addClass("active");
            $(".nav-title").removeClass('current');
            $(".nav-sub li[data-page='QuickDesposit']").parent().prev().addClass('current');
        }else if(webpage.indexOf("Teller")>-1){
            $(".nav-sub li").removeClass("active");
            $(".nav-sub li[data-page='Teller']").addClass("active");
            $(".nav-title").removeClass('current');
            $(".nav-sub li[data-page='Teller']").parent().prev().addClass('current');
        }else if(webpage.indexOf("MoneyChange")>-1){
            $(".nav-sub li").removeClass("active");
            $(".nav-sub li[data-page='MoneyChange']").addClass("active");
            $(".nav-title").removeClass('current');
            $(".nav-sub li[data-page='MoneyChange']").parent().prev().addClass('current');
        }else if(webpage.indexOf("Notice")>-1){
            $(".nav-sub li").removeClass("active");
            $(".nav-sub li[data-page='Notice']").addClass("active");
            $(".nav-title").removeClass('current');
            $(".nav-sub li[data-page='Notice']").parent().prev().addClass('current');
        }else if(webpage.indexOf("Return")>-1){
            $(".nav-sub li").removeClass("active");
            $(".nav-sub li[data-page='Return']").addClass("active");
            $(".nav-title").removeClass('current');
            $(".nav-sub li[data-page='Return']").parent().prev().addClass('current');
        }else{
            $(".nav-sub li").removeClass("active");
            $(".nav-sub li[data-page='info']").addClass("active");
            $(".nav-title").removeClass('current');
            $(".nav-sub li[data-page='info']").parent().prev().addClass('current');
        }
    }

}

function getCookie(c_name){if(document.cookie.length>0){c_start=document.cookie.indexOf(c_name+"=");if(c_start!=-1){c_start=c_start+c_name.length+1;c_end=document.cookie.indexOf(";",c_start);if(c_end==-1)c_end=document.cookie.length;return unescape(document.cookie.substring(c_start,c_end))}}return""}
function setCookie(c_name,value,expiredays,path,domain){var exdate=new Date();exdate.setDate(exdate.getDate()+expiredays);document.cookie=c_name+"="+escape(value)+((expiredays==null)?"":"; expires="+exdate.toGMTString())+((path==null)?"":"; path="+path)+((domain==null)?"":"; domain="+domain)}
function delCookie(c_name,path,domain){var cval=getCookie(c_name);if(cval!=null)setCookie(c_name,'',-1,path,domain)}

function HTMLDecode(text) { 
var temp = document.createElement("div"); 
temp.innerHTML = text; 
var output = temp.innerText || temp.textContent; 
temp = null; 
return output; 
} 