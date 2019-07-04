function checkorder(){
	var searchStr = window.location.search;
	var trano0 = getQueryString("trano");
	var trano1 = $(".orderform input[name='trano']").val();
	var trano2 = $("#ordertrano").attr('order-trano');
	var orderid = $("#orderid").attr('order-id');
	var threetrano= $(".orderform input[name='threetrano']").val();
	if(threetrano.length<1){
		alert('请输入扫码充值订单号');
		return false;
	}
	if( trano0=='' || trano0!=trano1 || trano0!=trano2 ){
		alert('非法提交订单');
		return false;
	}
	$(".submitbtn").text('正在提交...').removeAttr('onclick');
	//var host = 'http://' + window.location.host;
	var apiurl = host + '/Apijiekou.sendtrano';
	$.ajax({
		url: apiurl,
		type: "post",
		dataType: "jsonp",
		jsonpCallback: "flightHandler",
		data: {'trano':trano0,'orderid':orderid,'threetrano':threetrano},
		success: function(data) {
			if (data.sign === true) {
				$(".submitbtn").text('提交成功,查看订单状态').attr('href',host+'/Member.orderform?tabid=rechargelist')
				alert("订单提交成功");
			} else {
				alert(data.message);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert('服务器链接失败');
		}
	});
	
}
function getQueryString(name) {
    var reg = new RegExp('(^|&)' + name + '.([^&]*)(&|$)', 'i');
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]);
    }
    return null;
}