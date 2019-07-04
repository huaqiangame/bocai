var imgwidth=100//图片宽度
var imgheight=143//图片高度
var hongbaoCount=10;//每次红包个数
var loadindex=0;
var loadtime=1500;//多少毫秒掉1次红包
var slideSpeed=new Array(8000,12000)//红包掉落速度（毫秒），取此之间的随机数
$(function()
{alert(123);
    LoadHongBao();//首次打开网页 先执行1次下红包
    setInterval(LoadHongBao,loadtime)//定时执行下红包
	
	//加载抢红包记录
	$.post("hongbao/list",{req:"post"},function(data)
	{
		$("#scrollobj").html(data)
		// console.log(data);
	})
	
	$("#msg").click(function()
	{
		closeMsg()
	})
})
//生成指定范围随机数
function FunMath(startSize,endSize)
{
    return Math.floor(Math.random()*(endSize-startSize+1)+startSize);
}

//掉红包
function LoadHongBao()
{alert(13);
    loadindex++;
    var width=$(window).width();
	var height=$(window).height();
    var hongbaostr="";
	for(i=0;i<hongbaoCount;i++)
	{
	    hongbaostr+="<img src="hongbao.png" style=\"width:"+FunMath(50,imgwidth)+"px; top:-"+FunMath(imgheight,500)+"px; left:"+FunMath(0,width-imgwidth)+"px\" onclick=\"qing()\" />"
	}
	$(".hongbao").append(hongbaostr)
	for(i=0;i<hongbaoCount;i++)
	{
	    $(".hongbao img").eq((loadindex-1)*i).animate({top:height},FunMath(slideSpeed[0],slideSpeed[1]),function()
		{
			$(this).attr("src","").hide()
		})
	}
}


function qing()
{
	showMsg("抢红包…")
	$.post("hongbao/get",{req:"post"},function(data)
	{
		/*返回Json对象
		---Result---
		0:成功
		1:参数错误
		2:未登陆
		3:抢红包失败
		
		---Message---
		消息内容
		*/
		if(data.status ==0)
		{
			showMsg("抢到红包<strong>"+data.message+"</strong>元")
		}
		else
		{
			showMsg(data.message)
		}
	})
}

/*往上*/ 
function scroll(obj) {
var tmp = (obj.scrollTop)++; 
if (obj.scrollTop == tmp) { 
 obj.innerHTML += obj.innerHTML; 
} 
if (obj.scrollTop >= obj.firstChild.offsetWidth) { 
 obj.scrollTop = 0; 
} 
} 
var _timer = setInterval("scroll(document.getElementById('scrollobj'))", 40); 
function _stop() { 
if (_timer != null) { 
clearInterval(_timer); 
} 
} 
function _start() { 
_timer = setInterval("scroll(document.getElementById('scrollobj'))", 40); 
}

function showMsg(str)
{
	$("#msg span").html(str)
	$("#msg").fadeIn(200);
}

function closeMsg()
{
	$("#msg").fadeOut(200);
}