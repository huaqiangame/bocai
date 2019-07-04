$('.kuaijie').click( function()
{
    var amount = $(this).attr('val');
    $('input[name="order_amount"]').val( amount );
    return false;
});
//// 获取新的银行
//$.get(getBankViewUrl,{},function( newView ){
//    $("#getNewBackgroup").html( newView );
//},'html');


//$("#username").blur(function() {
//    var v = $(this).val();
//    if( cur_user != v ) {
//        var load =layer.load(0,{shade: [0.5,'#000']});
//        // 获取新的银行
//        $.get(getBankViewUrl,{username:v},function( newView ){
//            layer.close(load);
//            $("#getNewBackgroup").html( newView );
//        },'html');
//    }
//});


$(".oclass").change(function() {
    $("#other").val($(this).val());
});


$(".pay-label").live('click',function() {

    $(this).siblings('input').attr('checked', true);

    $("#bank_code").val( $("input[type=radio]:checked").attr('btype') );

    if ($("input[type=radio]:checked").attr('ctrname') == 'Gerenzhifubao') {
        $("#zhifubaozhanghao").show();
    } else {
        $("#zhifubaozhanghao").hide();
        $("#other").val('')
    }
    if ($("input[type=radio]:checked").attr('ctrname') == 'Gerenweixin') {
        $("#weixinzhanghao").show();
    } else {
        $("#weixinzhanghao").hide();
        $("#other").val('')
    }
    if ($("input[type=radio]:checked").attr('ctrname') == 'Gerenqq') {
        $("#qqzhanghao").show();
    } else {
        $("#qqzhanghao").hide();
        $("#other").val('')
    }
});


$(".pay-label label").live('click',function() {

    $("#bank_code").val( $("input[type=radio]:checked").attr('btype') );


    $(this).siblings('input').attr('checked', true);
    if ($("input[type=radio]:checked").attr('ctrname') == 'Gerenzhifubao') {
        $("#zhifubaozhanghao").show();
    } else {
        $("#zhifubaozhanghao").hide();
        $("#other").val('')
    }
    if ($("input[type=radio]:checked").attr('ctrname') == 'Gerenweixin') {
        $("#weixinzhanghao").show();
    } else {
        $("#weixinzhanghao").hide();
        $("#other").val('')
    }

    if ($("input[type=radio]:checked").attr('ctrname') == 'Gerenqq') {
        $("#qqzhanghao").show();
    } else {
        $("#qqzhanghao").hide();
        $("#other").val('')
    }
});


// 支付
$("#querenzhifu").click( function()
{
	var username = $("#username").val();
    var coin = $("#coin").val();
    var bankco = $("input[type=radio]:checked").val();
    var rusername = $("#rusername").val();

    if (username == null || username == "") {
        alert("[提示]用户名不能为空！");
        return false;
    }
    if (rusername == null || rusername == "" || rusername != username) {
        alert("[提示]2次用户输入不一致！");
        return false;
    }

    if (isNaN(coin)) {
        alert("[提示]存款额度非有效数字！");
        return false;
    }
    if (coin < zuidi || coin == '') {
        alert("[提示]"+zuidi+"元以上或者"+zuidi+"元才能存款！");
        return false;
    }

    if (coin > zuida) {
        alert("[提示]存款金额不能超过"+zuida+"！");
        return false;
    }
    if (bankco == null || bankco == "") {
        alert("[提示]支付银行不能为空！");
        return false;
    }
    
    if ($("#zhifubaozhanghao").css('display') != 'none') {
        if ($("#zhifubaozhanghao").find('input').val() == '') {
            alert('[提示]支付宝昵称不能为空!');
            return false;
        }
    }

    if ($("#weixinzhanghao").css('display') != 'none') {
        if ($("#weixinzhanghao").find('input').val() == '') {
            alert('[提示]微信昵称不能为空!');
            return false;
        }
    }

    if ($("#qqzhanghao").css('display') != 'none') {
        if ($("#qqzhanghao").find('input').val() == '') {
            alert('[提示]QQ账号不能为空!');
            return false;
        }
    }

    var data = $("#pay").serialize();
    var act = $("#pay").attr('action');
    var load =layer.load(0,{shade: [0.5,'#000']});
    $.post(act, data,
    function(res) {
        var res =  JSON.parse(res)
        layer.close(load);
        if (res.status == 1) {
            window.location = res.url;
        } else {
            alert(res.info);
        }
    });
    return false;
});

if ( window != top )
{
    top.location.href = location.href;
}


if( ! window.navigator.cookieEnabled){
   alert("浏览器配置错误，Cookie不可用！请开启Cookie以便带来更好的体验效果");  
}

// 关闭弹窗
$("#tips-close").click(function() {
    $(".tips-plane").hide();
});
var i = 10;
setInterval(function() {
    if (i > 0) {
        i--;
    } else {
        $("#tips-close").click();
    }
    $("#paytime").text(i);
},
1000);