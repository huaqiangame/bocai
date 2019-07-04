
$(function() {
    var signFun = function() {

        //var dateArray = [1, 2,3,4,5,29,30,22] // 假设已经签到的
        
        var $dateBox = $("#js-qiandao-list"),
            $currentDate = $(".current-date"),
            $qiandaoBnt = $("#js-just-qiandao"),
            _html = '',
            _handle = true,
            myDate = new Date();
        $currentDate.text(myDate.getFullYear() + '年' + parseInt(myDate.getMonth() + 1) + '月' + myDate.getDate() + '日');

        var monthFirst = new Date(myDate.getFullYear(), parseInt(myDate.getMonth()), 1).getDay();

        var d = new Date(myDate.getFullYear(), parseInt(myDate.getMonth() + 1), 0);
        var totalDay = d.getDate(); //获取当前月的天数

        for (var i = 0; i < 42; i++) {
            _html += ' <li><div class="qiandao-icon"></div></li>'
        }
        $dateBox.html(_html) //生成日历网格
        var $dateLi = $dateBox.find("li");
        for (var i = 0; i < totalDay; i++) {
            $dateLi.eq(i + monthFirst).addClass("date" + parseInt(i+1));
			for (var j = 0; j < dateArray.length; j++) {
				if (i+1 == dateArray[j]) {
					$dateLi.eq(i + monthFirst).addClass("qiandao");
				}
			}
        } //生成当月的日历且含已签到
		/*for (var j = 0; j < dateArray.length; j++) {
			if (i == dateArray[j]) {
				$dateLi.eq(i + monthFirst-1).addClass("qiandao");
			}
		}*/

        $(".date" + myDate.getDate()).addClass('able-qiandao');

        $dateBox.on("click", "li", function() {
                if ($(this).hasClass('able-qiandao') && _handle) {
                    $(this).addClass('qiandao');
                    qiandaoFun();
                }
            }) //签到

        $qiandaoBnt.on("click", function() {
            if (_handle) {
                qiandaoFun();
            }
        }); //签到

        function qiandaoFun() {
			if(ISLOGIN==null || ISLOGIN=='undefined' || ISLOGIN==''){
				alt('请先登录');
				return false;
			}
			$.post(qiandaourl,{}, function(data){
				if(data.status==1){
					$(".qiandao-notic span").text(parseInt($(".qiandao-notic span").text())+1);
					$("#js-just-qiandao").addClass('actived');
					alt(data.info,'success');
					_handle = false;
				}if(data.status==2){
					$qiandaoBnt.addClass('actived');
					$(".yiqiandao span").text(data.num);
					$(".qiandao-jiangli-num b").text(data.jlamount);
					openLayer("qiandao-active", qianDao);
					_handle = false;
				}else{
					alt(data.info);
				}
			}, "json");
        }

        function qianDao() {
            $(".date" + myDate.getDate()).addClass('qiandao');
        }
    }();

    function openLayer(a, Fun) {
        $('.' + a).fadeIn(Fun)
    } //打开弹窗

    var closeLayer = function() {
            $("body").on("click", ".close-qiandao-layer", function() {
                $(this).parents(".qiandao-layer").fadeOut()
            })
        }() //关闭弹窗

    $("#js-qiandao-history").on("click", function() {
        openLayer("qiandao-history-layer", myFun);

        function myFun() {
            console.log(1)
        } //打开弹窗返回函数
    })

})
