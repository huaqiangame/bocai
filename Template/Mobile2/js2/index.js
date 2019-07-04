function alt(content,icon){
	if(icon==0){
		art.dialog({
			id: 'testID2',
			content: content,
			lock: true,
			cancelVal: '关闭',
			cancel: true
		});
	}else{
		if(icon=='success'){
			icon = 'success';
		}else{
			icon = 'warning';
		}
		art.dialog({
			icon: icon,
			id: 'testID2',
			content: content,
			lock: true,
			cancelVal: '关闭',
			cancel: true
		});
	}
};
if(ISLOGIN!='')window.setInterval("cheklogin();",10000);
function cheklogin(){
	$.getJSON(Webconfigs['ROOT']+"/index.php?m=Mobil&c=User&a=checklogin", function(json){
		if(json.status!=1)return false;
		$("#show_money").html(json.money);
		$("#show_point").html(json.point);
		
	}); 
}
function Order_chedan(id,trano,obj){
	artDialog({
		content:'确定撤单吗',
		cancel:function(){},
		ok:function(){
		$.post(Webconfigs['ROOT']+"/index.php?m=Mobil&c=User&a=OrderChedan",{'id':id,'trano':trano}, function(json){
				if(json.status==1){
					alt('撤单成功','success');
					$(obj).html('<span style="color:grey">已撤单</span>');
				}else{
					alt(json.info);
				}
			},'json'); 

		},
		lock:true
	})
	
};

$(function () {
    //默认点击
    $(".ui-tab-content li.current").trigger("click")
    //首页滚动
    if ($(".rui-least-open").size() > 0) {
        
        Scroll_Top_Item();

        function Scroll_Top_Item() {
            var _theScrollContainer = $(".rui-least-open");
            var _theFirstObj = _theScrollContainer.find(".learst_openNumber").eq(0);
            var _theHeight = _theFirstObj.height() + 20;
            _theFirstObj.stop(true,true).animate({
                "margin-top":"-"+_theHeight+"px"
            }, 1000, function () { 
                _theScrollContainer.append(_theFirstObj);
                _theFirstObj.removeAttr("style");
                setTimeout(function () {
                    Scroll_Top_Item();
                },10000);
            });
        } 
    }

    //彩票投注大厅
    if ($(".choice_lottery_playdetail").size() > 0) {
        $(".choice_lottery_playdetail .rui-icon-slide").click(function () {
            $(".play_select_container").slideToggle();
        })

        $(".play_select_tit li").click(function () {
            if ($("#j_play_select").hasClass("show_child_PlayCont")) {
                return true;
            } else { 
                var _theTitle = $(this).text();
                $(".choice_lottery_playdetail").find(".choice_playName").eq(0).empty().text(_theTitle);
                $(".play_select_container").slideUp();
            }
        }); 
       
        $(".look_detail_btn").click(function () {
            $(".betting-record-container").stop(true, true).animate({
                "left":"0px"
            }, 300)
        });
        $("#continue_choice").click(function () {
            $(".betting-record-container").stop(true, true).animate({
                "left": "100%"
            },300)
        });

        
    }

    $("#foget_btn").click(function () {
        var foget_type = $("#foget_type").val(); /*验证类型*/
        var foget_name = $("#foget_name").val(); /*用户名*/
        var foget_par1 = $("#foget_par1").val(); /*密文参数1*/
        var foget_par2 = $("#foget_par2").val(); /*密文参数2*/
        var foget_paw1 = $("#foget_paw1").val(); /*密码*/
        var foget_paw2 = $("#foget_paw2").val(); /*密码2*/
        var oData = {};
        oData.pas1 = foget_paw1;
        oData.pas2 = foget_paw2;
        oData.type = foget_type;

        var _Reqx = /^(?![^a-zA-Z]+$)(?!\D+$).{6,15}$/;
        var _theForms = $(this).parents("form").eq(0);
        if (!_Reqx.test(foget_paw1)) {
            alert("密码格式有误，请填写6~15位数字与字母组合的密码。");
            $("#foget_paw1").focus();
            return false;
        }

        oData.action = "updatePassword";
        if (foget_type == 1) {
            oData.par1 = foget_par1;
            oData.par2 = foget_par2;
            oData.user_name = foget_name;
        }
        var oLink = window.location.href;
        $.ajax({
            type: "POST",
            url: "../../../../tools/ssc_ajax.ashx",
            data: oData,
            dataType: "json",
            success: function (data) {
                var aData = data;
                var aCode = aData.Code;
                var aStrCode = aData.StrCode;
                if (aCode == 1) {
                    alert(aStrCode);
                    var _localtionName = window.location.host == undefined ? '/index.html' : window.location.host;
                    setTimeout(function () {
                        window.location.href = "//" + _localtionName + "/login.html";
                    }, 2000)
                } else {
                    alert(aStrCode);
                }
            }
        });
    });


});


  














































