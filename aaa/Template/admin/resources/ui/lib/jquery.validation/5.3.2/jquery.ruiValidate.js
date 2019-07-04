// JavaScript Document 
// +---------------------------------------------------------------------- 
// | Date: 2015年5月19日 15:00:00
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// | Name: Jquery.ruiValidate.js ( 基于jQuery的表单验证 )
// +----------------------------------------------------------------------
(function($){  
	var rui_validate = function(){
		this.param = "" ;	//内置参数
	} 
	
   /**
	* @content 给对象，创建实例化方法
	* @author  梁汝翔<liangruxiang>   
	* @time 2015年8月20日 10:07:09
	*/
	rui_validate.prototype = {
	   /**
		* @content 表单初始化加载，绑定事件，准备页面结构
		* @author  梁汝翔<liangruxiang>    
		* @time 2015年8月20日 10:07:09
		*/
		initload:function(){ 
			var _this = this ;  //声明当前对象
			
		   /**
			* @content 绑定表单中，初始化“只能输入数字的文本域”keyup事件，过滤非文本数字
			* @example verify=isNumb( 只能输入整数 ); verify=isPhone（手机号码只能输入整数)；verify=isBankCard(银行卡只能是数字)
			* @author  梁汝翔<liangruxiang>    
			* @time 2015年8月20日 10:07:09
			*/
			$("*[verify='isNumb'] , *[verify='isPhone'] , *[verify='isBankCard']").keyup(function(event){
				var _keyCode = event.keyCode == undefined ? 0 :  event.keyCode ;  //获取按键的keycode（编码）
				if(_keyCode != 37 && _keyCode != 39){ //左右箭头除外
					var _val = $(this).val(); 	
					if(_val!="")
					{
						_val = _val.replace(/[^\d]/g,"");  //正则处理非数字的字符进行过滤
						$(this).val(_val);	//赋值过滤后的字符
					}	
				} 
			});	
			
		   /**
			* @content 绑定表单中，初始化“只能输入【浮点数】的文本域”keyup事件，过滤非浮点数的字符
			* @example verify=isFloat( 只能输入【浮点数】,其中只能有一位小数和);
			* @author  梁汝翔<liangruxiang>    
			* @time 2015年8月20日 10:07:09
			*/
			$("*[verify='isFloat']").keyup(function(){
				var _keyCode = event.keyCode == undefined ? 0 :  event.keyCode ;  //获取按键的keycode（编码）
				if(_keyCode != 37 && _keyCode != 39){ //左右箭头除外
					var _val = $(this).val();  //当前金额
					if(_val!="")	//当前字符串不能空
					{ 
						_val = _val.replace(/[^\d|.]/g,""); //正则处理数字和小数点以外的字符进行过滤
						_val = _val.toString();
						var _types =  _val.indexOf(".");   
						if(_types==0)  //第一个字符为.的时候，替换为0.；
						{
							_val = "0"+_val;
						}
						
						var _lasttypes =  _val.lastIndexOf(".");   
						if(_lasttypes != _types) //是否有多个“.”
						{	 
							_val = parseFloat(_val); 
						}  
						$(this).val(_val);
					}	
				}
			}); 
			
		   /**
			* @content 绑定表单中，初始化“只能输入【身份证】的文本域”keyup事件，过滤非数字和X的字符
			* @example verify=isIdCard( 只能输入【身份证】数字和xX);
			* @author  梁汝翔<liangruxiang>    
			* @time 2015年8月20日 10:07:09
			*/
			$("*[verify='isIdcard']").keyup(function(){
				var _keyCode = event.keyCode == undefined ? 0 :  event.keyCode ;  //获取按键的keycode（编码）
				if(_keyCode != 37 && _keyCode != 39){ //左右箭头除外
					var _val = $(this).val();
					if(_val!="")
					{ 
						_val = _val.replace(/[^\d|xX]/g,"");   
						$(this).val(_val);
					}
				}
			});  
			 
		   /**
			* @content 绑定表单中，初始化“只能输入【英文】的文本域”keyup事件，过滤非数字和X的字符
			* @example verify=isEn( 只能输入【英文】a-zA-Z); verify=isABC( 只能输入【英文】a-zA-Z);
			* @author  梁汝翔<liangruxiang>    
			* @time 2015年8月20日 10:07:09
			*/ 
			$("*[verify='isEn'],*[verify='isABC']").keyup(function(){
				var _keyCode = event.keyCode == undefined ? 0 :  event.keyCode ;  //获取按键的keycode（编码）
				if(_keyCode != 37 && _keyCode != 39){ //左右箭头除外
					var _val = $(this).val();
					if(_val!="")
					{ 
						_val = _val.replace(/[^\w]/,"");   
						$(this).val(_val);
					}
				}
			});  
			
		   /**
			* @content 初始化表单提示信息
			* @descript 由于placeholder 的属性在低版本的浏览器中不兼容，因此对这些低版本的浏览器进行了处理（其中典型便是IE8以下内核的浏览器） 
			* @author  梁汝翔<liangruxiang>    
			* @time 2015年8月20日 10:07:09
			*/ 
			$("*[placeholder]").each(function() { 
			    var _initTypes = $(this).attr("type");
			    if (_initTypes == "password") { return false; }   //如果是password类型，直接不处理
			
				var _theBrowser = _this.checkBrowserPublish();   //获取浏览器的版本号
			    var theIeLengthLength = _theBrowser.indexOf("msie");  //判断是否为IE浏览器
				
				if (theIeLengthLength > 0) {  //是否为IE浏览器
					 	
				}
				
			    var _initTs = $(this).attr("placeholder"); 
			    var _initValue = $(this).val();
			    if (theIeLengthLength > 0) {  //是否为IE浏览器
			        //获取浏览器的版本 
			        var theBanben = (_theBrowser +"").replace(/[^0-9.]/ig, "");
			        theBanben = isNaN(parseInt(theBanben)) ? 9 : parseInt(theBanben);
			        if (_initValue == "" && theBanben < 8) {
			            $(this).val(_initTs)
			            $(this).css("color", "#888");
			        }
			    } 
            });
			
		   /**
			* @content 绑定focus事件,处理初始化提示信息 
			* @author  梁汝翔<liangruxiang>    
			* @time 2015年8月20日 15:20:09
			*/ 
			$("*[placeholder],input,textarea").focus(function(){
				//获取是否有初始化信息提示
				var _initTs = $(this).attr("placeholder");
				if( _initTs != undefined && _initTs !="" )
				{
					var theValue = $(this).val();
					if(theValue==_initTs)
					{
						$(this).val("");
						$(this).css("color","");	
					} 	
				} 	
			});
			
		},
	   /**
        * @content 内置属性，继承与扩展
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */
		InitOptions: function (user_options) {
            var default_options = {
	            FocusTip:true,	//获取焦点则进行提示，显示输入规则（ boolen ）
	            BlurChange:true,	//失去焦点再进行提示，显示输入规则（ boolen ）
	            ShowTip: "Bubble",	//显示提示信息的类型：Bubble（气泡）；IconText( 图标加文字 ) ; Text（仅是文字）; Icon（正确或错误的图标）； Highlights 聚焦高亮 ;
	            ShowTipDirection:"right", //提示信息的位置：right：右边，top：上面；bottom：下面；inside：输入框内；
	            FormObj:$("form:eq(0)"),	//验证的表单容器
	            FormIdName: 'form',  //form的ID名称 
	            ShowTipClass:"ts_msg",    //显示提示信息的区域class
	            ShowTipStyle:"",    //显示提示信息的class
	            SubBtn:'sub_btn',   //提交按钮的class
	            CallBack:'' //回调函数
            } 
		    var theValidateOption = jQuery.extend(true, {}, default_options, user_options)
		    return theValidateOption;
		},
	   /**
        * @content 获取不同浏览器的版本号 
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */
		initForm: function (user_options) {
		    var _this = this;  //声明当前对象

		   /**
            * @content 初始化方法参数
            * @author  梁汝翔<liangruxiang>    
            * @time 2015年8月20日 10:07:09
            */
		    var rui_Validate_options = _this.InitOptions(user_options);

		   /**
            * @content 获取焦点
            * @author  梁汝翔<liangruxiang>    
            * @time 2015年8月20日 10:07:09
            */
		    rui_Validate_options.FormObj.find("*[verify]").focus(function () {
		        if (rui_Validate_options.FocusTip) {
		            var _thisMsg = $(this).attr("msg") == undefined ? "" : $(this).attr("msg");
		            if (_thisMsg != undefined && _thisMsg != "") { 
                        //展示提示信息
		                _this.ShowTips(rui_Validate_options, $(this), _thisMsg, "Error_validate");  //默认提示错误信息
		            }
		        }
		    });

		    /**
             * @content 失去焦点
             * @author  梁汝翔<liangruxiang>    
             * @time 2015年8月20日 10:07:09
             */
		    rui_Validate_options.FormObj.find("*[verify]").blur(function () {
		        var theValue = $(this).val();
		        //验证url
		        var theUrl = $(this).attr("url") == undefined ? "" : $(this).attr("url");

		        //验证Name
		        var theName = $(this).attr("name") == undefined ? "" : $(this).attr("name");

		        if (theUrl != "" && theName != "" && theValue != "") {
		            var _Blindthis = $(this);
		            var TheJSon = '{"' + theName + '":"' + theValue + '"}';
		            var JsonData = {};
		            if (JSON) {
		                JsonData = JSON.parse(TheJSon);
		            }else {
		                JsonData = $.parseJSON(TheJSon);
		            } 
		            if (typeof JsonData) {
		                $.ajax({
		                    type: "POST",
		                    url: theUrl,
		                    data: JsonData,
		                    dataType: "JSON",
		                    success: function (data) {
		                        var _State = data.state == undefined ? "0" : data.state;
		                        if (data.state == 1)		//表示格式正确
		                        {
		                            _this.ShowTips(rui_Validate_options, _Blindthis, _thisMsg, "Correct_validate");  //格式正确
		                        }
		                        else {
		                            _this.ShowTips(rui_Validate_options, _Blindthis, _thisMsg, "Error_validate");  //格式正确
		                        }
		                    }
		                });
		            }
		        }
		        else {
		            if (rui_Validate_options.BlurChange) {  //blur就开始验证表单内容
		                var _thisMsg = $(this).attr("msg") == undefined ? "" : $(this).attr("msg");
		                if (_thisMsg != undefined && _thisMsg != "" && theValue != "") {

		                    var theCheckResult = _this.check_objInfo($(this), rui_Validate_options); //验证当前表单内容  
							//console.log("验证结果");
		                    _this.ShowTips(rui_Validate_options, $(this), theCheckResult.msg, theCheckResult.statue);  //展现结果
		                }
		            }
		        }
		    });
		    
		    /**
             * @content 再次验证绑定change事件，由于change事件兼容太差使用，keyup事件
             * @author  梁汝翔<liangruxiang>    
             * @time 2015年8月20日 10:07:09
             */ 
		    rui_Validate_options.FormObj.find("*[verify]").keyup(function () { 
		        var theValue = $(this).val();
		        if (theValue != "") {
		            var _thisMsg = $(this).attr("msg"); //提示信息
		            if (_thisMsg != undefined && _thisMsg != "") { 
		               /**
                        * @content 清除当前表单的错误或正确的提示信息
                        * @author  梁汝翔<liangruxiang>    
                        * @time 2015年8月20日 10:07:09
                        */
		                _this.clearShowTips(rui_Validate_options, $(this));
		            }
		        }
		    });

		   /**
            * @content 再次验证绑定change事件，由于change事件兼容太差使用，keyup事件
            * @author  梁汝翔<liangruxiang>    
            * @time 2015年8月20日 10:07:09
            */
		    rui_Validate_options.FormObj.find("." + rui_Validate_options.SubBtn + " , input[type='submit']").eq(0).click(function () {

		        //提交表单进行验证
		        var check_result = _this.Subvalidation(rui_Validate_options, $(this));  //获取验证结果

		        return false;

		    });
		},
	   /**
        * @content 验证表单对象的格式是否正确
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */
		check_objInfo: function (obj, rui_Validate_options) {

		    var theValue = obj.val();  //当前内容
		    var theValue_type = obj.attr("type");  //表单类型
		    var Verify = obj.attr("verify");
            var result = { statue: "Correct_validate", obj:obj, msg: "" };
		    if (Verify == undefined) { Verify = "isAll"; }
		    switch (Verify) {
		        case "isLoginName":			//登陆用户名 
		            break;
		        case "isName":				//用户名
		            //验证会员的名称是否正确( 以汉字或字母开头 、汉字与字母数字组合的名称,长度为4到16位)
		            var reg = /^[\u4E00-\u9FA5A-Za-z0-9]{4,18}$/;
		            if (!reg.test(theValue)) {
		                result = { statue: "Error_validate", obj: obj, msg: "请输入以汉字或字母、数字组合的名称,长度为4到18位" };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		            }
		            break;
		        case "isEn":				//是英文模式 或数字
		            var reg = /^[A-Za-z|\d]+/g;  //是英文模式或数字
		            if (!reg.test(theValue)) {
		                result = { statue: "Error_validate", obj: obj, msg: "请输入以字母或数字组合的内容" };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		            }
		            break;
		        case "isCN":				//是中文模式
		            var reg = /^[\u4E00-\u9FA5]+/g;  //是中文模式 /^[\u4E00-\u9FA5]/ 汉字，不包括中文
		            if (!reg.test(theValue)) {
		                result = { statue: "Error_validate", obj: obj, msg: "请输入中文内容" };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		            }
		            break;
		        case "isPhone":				//是手机号
		            var reg = /^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9])\d{8}$/;  //手机号格式
		            if (!reg.test(theValue)) { 
		                result = { statue: "Error_validate", obj: obj, msg: "您输入的手机号码格式有误" };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		            }
		            break;
		        case "isPwd":				//密码
		            var reg = /^(?!([^A-Za-z]|\d)+$)[a-zA-Z\d]{6,16}$/;  //请输入字母和数字组合的6到16位字符串
		            if (!reg.test(theValue)) { 
		                result = { statue: "Error_validate", obj: obj, msg: "请输入字母和数字组合的6到16位字符串" };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
                    }
		            break;
		        case "isRPwd":				//重复密码 
		            var reg = /^(?!([^A-Za-z]|\d)+$)[a-zA-Z\d]{6,16}$/;  //请输入字母和数字组合的6到16位字符串
		            if (!reg.test(theValue)) {
		                result = { statue: "Error_validate", obj: obj, msg: "请输入字母和数字组合的6到16位字符串" };
		            }
		            else {
		                var _InitPwd = rui_Validate_options.FormObj.find("*[verify='isPwd']").eq(0).val();
		                if (theValue != _InitPwd) {
		                    result = { statue: "Error_validate", obj: obj, msg: "两次输入的密码不一致" };
		                } else {
		                    result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		                }
		            }
		            break;
		        case "isEmail":				//是邮箱
		            var reg = /^(\w)+(\.\w+)*@(\w|[-])+((\.\w+)+)$/;  //邮箱格式有误
		            if (!reg.test(theValue)) {
		                result = { statue: "Error_validate", obj: obj, msg: "邮箱格式有误" };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		            }
		            break;
		        case "isQQ":				//是QQ号码
		            var reg = /^([1-9])\d{4,13}$/; //4到13位数字
		            if (!reg.test(theValue)) {
		                result = { statue: 'Error_validate', obj: obj, msg: "请填写正确的QQ号码" };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		            }
		            break;
		        case "isIdcard":			//是身份证 
		            var _isCheckResult = this.isIdcard(theValue);
		            if (_isCheckResult.statue == 0)	//状态
		            {
		                result = { statue: "Error_validate", obj: obj, msg: _isCheckResult.msg };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		            }
		            break;
		        case "isBankcard":			//是银行卡
		            var reg = /^[0-9]{16,20}$/;
		            if (!reg.test(theValue)) {
		                result = { statue: "Error_validate", obj: obj, msg: "请输入正确的银行卡号" };
		            } else {
		                result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
		            }
		            break;
		        case "isTime":				//是时间格式  “-” 
		            break;
		        case "isStartTime":			//开始时间 
		            break;
		        case "isEndTime":			//结束时间
		            var _StartTime = rui_Validate_options.FormObj.find("*[verify='isStartTime']").eq(0).val();
		            if (_StartTime != undefined && _StartTime != "") {
		                var Time_guize = this.compareTime(_StartTime, theValue, "-");
		                if (!Time_guize) { 
		                    result = { statue: "Error_validate", obj: obj, msg: "开始时间不得大于结束时间" };
                        } else {
                            result = { statue: "Correct_validate", obj: obj, msg: "通过验证" };
                        }
		            }
		            break;
		        default:
		        case "isAll":
		            break;
		    }
		    return result;  
		}, 
	   /**
        * @content 展示提示信息的方法
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */
		ShowTips: function (rui_Validate_options, obj, msg, state) { 
		    var _this = this;
		    switch (rui_Validate_options.ShowTip) {
		        case "Bubble":	//气泡  
		            var theLineObj = obj.parent();
		            var _theTs_msg_len = theLineObj.find("." + rui_Validate_options.ShowTipClass).length == undefined ? 0 : theLineObj.find("." + rui_Validate_options.ShowTipClass).length;
                     
		            if (_theTs_msg_len < 1) {
		                _this.ShowTips_Bubble(rui_Validate_options, obj, msg, state);
		            } else {
		                if (state == "Error_validate") {
		                    theLineObj.find("." + rui_Validate_options.ShowTipClass).removeClass("Correct_validate").addClass("Error_validate").empty().text(msg).hide();
		                    _this.ShowTips_Bubble(rui_Validate_options, obj, msg, state); 
		                } else { 
		                    theLineObj.find("." + rui_Validate_options.ShowTipClass).removeClass("Error_validate").addClass("Correct_validate").empty().text(msg).hide();
		                    _this.ShowTips_Bubble(rui_Validate_options, obj, msg, state);
		                } 
		            } 
		            break;
		        case "IconText": //图标加文字 
		            var theLineObj = obj.parent();
		            var _theTs_msg_len = theLineObj.find("." + rui_Validate_options.ShowTipClass).length == undefined ? 0 : theLineObj.find("." + rui_Validate_options.ShowTipClass).length;

		            if (_theTs_msg_len < 1) {
		                _this.ShowTips_IconText(rui_Validate_options, obj, msg, state);
		            } else {
		                if (state == "Error_validate") {
		                	obj.removeClass("Correct_validate").addClass("Error_validate");
		                    theLineObj.find("." + rui_Validate_options.ShowTipClass).removeClass("Correct_validate").addClass("Error_validate").empty().text(msg);
		                } else {
		                	obj.removeClass("Error_validate").addClass("Correct_validate");
		                    theLineObj.find("." + rui_Validate_options.ShowTipClass).removeClass("Error_validate").addClass("Correct_validate").empty().text(msg);
		                }
		            }
		            break;
		        case "Text": //文字提示 
		            var theLineObj = obj.parent();
		            var _theTs_msg_len = theLineObj.find("." + rui_Validate_options.ShowTipClass).length == undefined ? 0 : theLineObj.find("." + rui_Validate_options.ShowTipClass).length;

		            if (_theTs_msg_len < 1) {
		                _this.ShowTips_Text(rui_Validate_options, obj, msg, state);
		            } else {
		                if (state == "Error_validate") {
		                	obj.removeClass("Correct_validate").addClass("Error_validate");
		                    theLineObj.find("." + rui_Validate_options.ShowTipClass).removeClass("Correct_validate").addClass("Error_validate").empty().text(msg);
		                } else {
		                	obj.removeClass("Error_validate").addClass("Correct_validate");
		                    theLineObj.find("." + rui_Validate_options.ShowTipClass).removeClass("Error_validate").addClass("Correct_validate").empty().text(msg);
		                }
		            }
		            break;
		        case "Icon": //图标提示
		            var theLineObj = obj.parent();
		            var _theTs_msg_len = theLineObj.find("." + rui_Validate_options.ShowTipClass).length == undefined ? 0 : theLineObj.find("." + rui_Validate_options.ShowTipClass).length;

		            if (_theTs_msg_len < 1) {
		                _this.ShowTips_Icon(rui_Validate_options, obj, msg, state);
		            } else {
		                if (state == "Error_validate") {
		                	obj.removeClass("Correct_validate").addClass("Error_validate");
		                    theLineObj.find("." + rui_Validate_options.ShowTipClass).removeClass("Correct_validate").addClass("Error_validate").empty().text(msg);
		                } else {
		                	obj.removeClass("Error_validate").addClass("Correct_validate");
		                    theLineObj.find("." + rui_Validate_options.ShowTipClass).removeClass("Error_validate").addClass("Correct_validate").empty().text(msg);
		                }
		            }
		            break;
		        case "Highlights": 
		            if (state == "Error_validate") {
		                obj.css({ "border": "1px solid red" });
		                obj.removeClass("Correct_validate").addClass("Error_validate");
		            } else {
		                obj.removeAttr("style");
		                obj.removeClass("Error_validate").addClass("Correct_validate");
		            } 
		            break;
		        default:
		            break;
		    }
		},
	   /**
        * @content 气泡类型的提示信息
        * @author  梁汝翔<liangruxiang>    
        * @param 基本属性参数 rui_Validate_options
        * @param 验证的表单对象
        * @param 验证的表单的提示信息
        * @time 2015年8月20日 10:07:09
        */ 
		ShowTips_Bubble: function (rui_Validate_options, obj, msg, state) {
             
		    var _obj_p = obj.parent(); //当前节点的父节点

		    var _obj_width = obj.width();  //获取当前对象的高度和宽度
		    var _obj_height = obj.height() < 30 ? 30 : obj.height(); //获取当前对象的高度和宽度
             
		    if (_obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").length > 0) {  //是否已有提示信息 
		        _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg .msg").empty().text(msg); 
		        if (state == "Error_validate") {
		            _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").removeClass("Correct_validate").addClass("Error_validate");
		            _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").css("margin-left", (_obj_width + 45) + "px").show()
		            _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").stop(true, true).animate({
		                "margin-left": (_obj_width + 25) + "px"
		            }, 200); 
		        } else {
		            _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").removeClass("Error_validate").addClass("Correct_validate").hide();
		        }
		    }
		    else {
		        if (state == "Error_validate") {
		            var _new_height = 30;
		            if (_obj_height < 30) {
		                _new_height = _obj_height;
		            }
		            //var _style = " position: absolute;width:auto; max-width:" + (_obj_width - 15) + ";  background-color:#fff; padding:0px 15px;height:" + (_new_height - 2) + "px;line-height:" + (_new_height - 2) + "px;border:1px solid #ddd; margin-left:" + (_obj_width + 35) + "px; float:left; box-shadow:2px 2px 2px #ddd; background-color:#fff; margin-top:-" + _obj_height + "px;border-radius:3px;z-index:2;";
		            var _style = " position: absolute;width:auto; max-width:" + (_obj_width - 15) + ";  background-color:#fff; padding:0px 15px;height:" + (_new_height - 2) + "px;line-height:" + (_new_height - 2) + "px;border:1px solid #ddd; margin-left:" + (_obj_width + 35) + "px; float:left; box-shadow:2px 2px 2px #ddd; background-color:#fff; border-radius:3px;z-index:2;";

		            var arrow_style = "border-width:6px 10px 6px 0px;height: 0px;width: 0px; position: absolute;border-color: transparent #ddd transparent  transparent; background:none; border-style: solid; margin-left:-25px;z-index: 3;margin-top:3px;"

		            var arrow_innerstyle = "border-width:6px 10px 6px 0px;height: 0px;width: 0px; position: absolute;border-color: transparent #fff transparent  transparent; border-style: solid; margin-left: 2px; z-index: 3; margin-top:-6px;"


		            var _str = "<div class='" + rui_Validate_options.FormIdName + "_Bubble_ts_msg bgc_wite' style='" + _style + "'><i class='arrow' style='" + arrow_style + "'><b style='" + arrow_innerstyle + "'></b></i><span class='msg'>" + msg + "</span></div>";
		            obj.parent().append($(_str));

		            _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").stop(true, true).animate({
		                "margin-left": (_obj_width + 25) + "px"
		            }, 200);
		        } else {
		            _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").removeClass("Error_validate").addClass("Correct_validate").hide();
		            return false;
		        }
		    }
		},
	   /**
        * @content 图标加文字类型的提示信息
        * @author  梁汝翔<liangruxiang>    
        * @param 基本属性参数 rui_Validate_options
        * @param 验证的表单对象
        * @param 验证的表单的提示信息
        * @param state 正确或者错误的提示信息 正确为 Correct ;
        * @time 2015年8月20日 10:07:09
        */ 
		ShowTips_IconText: function (rui_Validate_options, obj, msg, state) {

		    if (state == undefined) { state == "" }  
		    var _obj_p = obj.parent(); //当前节点的父节点
		    var _obj_width = obj.width();  //获取当前对象的高度和宽度
		    var _obj_height = obj.height() < 30 ? 30 : obj.height(); //获取当前对象的高度和宽度
              
		    if (_obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").length > 0) {
		        _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg .msg").empty().text(msg).show();
		    }
		    else { 
		        var _style = "width:auto; max-width:" + (_obj_width - 15) + "; height:" + (_obj_height -2) + "px;line-height:" + (_obj_height - 2) + "px;  margin-left:5px; float:left; z-index:2;";
		        if (state != "Correct_validate") { 
		            var _str = "<div class='" + rui_Validate_options.FormIdName + "_Bubble_ts_msg IconTextInfo " + state + "' style='" + _style + "'><i class='iconfont' style='padding:0px 3px;'>&times;</i><span class='msg'>" + msg + "</span></div>";
		        } else {
		            var _str = "<div class='" + rui_Validate_options.FormIdName + "_Bubble_ts_msg IconTextInfo " + state + "' style='" + _style + "'><i class='iconfont' style='padding:0px 3px;'>&radic;</i><span class='msg'>" + msg + "</span></div>";
		        } 
		        obj.parent().append($(_str));
		    }
		},
	   /**
        * @content 图标加文字类型的提示信息
        * @author  梁汝翔<liangruxiang>    
        * @param 基本属性参数 rui_Validate_options
        * @param 验证的表单对象
        * @param 验证的表单的提示信息
        * @param state 正确或者错误的提示信息 正确为 Correct ;
        * @time 2015年8月20日 10:07:09
        */
		ShowTips_Text: function (rui_Validate_options, obj, msg, state) {
		    if (state == undefined) { state == "" }
		    var _obj_p = obj.parent(); //当前节点的父节点
		    var _obj_width = obj.width();  //获取当前对象的高度和宽度
		    var _obj_height = obj.height() < 30 ? 30 : obj.height(); //获取当前对象的高度和宽度

		    if (_obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").length > 0) {
		        _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg .msg").empty().text(msg).show();
		    }
		    else {
		        var _style = "width:auto; max-width:" + (_obj_width - 15) + "; height:" + (_obj_height - 2) + "px;line-height:" + (_obj_height - 2) + "px;  margin-left:5px; float:left; z-index:2;";
		        if (state != "Correct_validate") {
		            var _str = "<div class='" + rui_Validate_options.FormIdName + "_Bubble_ts_msg IconTextInfo " + state + "' style='" + _style + "'>" + msg + "</div>";
		        } else {
		            var _str = "<div class='" + rui_Validate_options.FormIdName + "_Bubble_ts_msg IconTextInfo " + state + "' style='" + _style + "'>" + msg + "</div>";
		        }
		        obj.parent().append($(_str));
		    }
		},
	   /**
        * @content 图标加文字类型的提示信息
        * @author  梁汝翔<liangruxiang>    
        * @param 基本属性参数 rui_Validate_options
        * @param 验证的表单对象
        * @param 验证的表单的提示信息
        * @param state 正确或者错误的提示信息 正确为 Correct ;
        * @time 2015年8月20日 10:07:09
        */
		ShowTips_Icon: function (rui_Validate_options, obj, msg, state) {
		    var _obj_p = obj.parent(); //当前节点的父节点
		    var _obj_width = obj.width();
		    var _obj_height = obj.height();
		    //console.log(_obj_width,"_obj_width___",_obj_height,"_obj_height");
		    if (_obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").length > 0) {
		        if (state == "Correct_validate") {
		        	 obj.removeClass("Error_validate").addClass("Correct_validate");
		            _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").removeClass("Error_validate").addClass("Correct_validate");
		        } else {
		        	 obj.removeClass("Correct_validate").addClass("Error_validate");
		            _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg").removeClass("Correct_validate").addClass("Error_validate");
		        }
		        _obj_p.find("." + rui_Validate_options.FormIdName + "_Bubble_ts_msg .msg").empty().text(msg).show();
		    }
		    else {
		        var _new_height = 30;
		        if (_obj_height < 30) {
		            _new_height = _obj_height;
		        }
		        var _style = "position: absolute;width:auto; max-width:" + (_obj_width - 15) + "; height:" + (_new_height - 2) + "px;line-height:" + (_new_height - 2) + "px;  margin-left:" + (_obj_width + 5) + "px; float:left;  margin-top:-" + _obj_height + "px; z-index:2;";

		        var _str = "<div class='" + rui_Validate_options.FormIdName + "_Bubble_ts_msg IcoFontS" + state + "' style='" + _style + "'><i class='iconfont'></i></div>";
		        obj.parent().append($(_str));
		    }
		},
	   /**
        * @content 清除当前表单的错误或正确的提示信息
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */
		clearShowTips: function (rui_Validate_options, obj) {

		    var _obj_p = obj.parent(); //当前节点的父节点 

		    switch (rui_Validate_options.ShowTip) {
		        case "Bubble":	//气泡   
		            _obj_p.find("." + rui_Validate_options.ShowTipClass).stop(true, true).hide();//隐藏提示信息 
		            break;
		        case "IconText": //图标加文字
		            _obj_p.find("." + rui_Validate_options.ShowTipClass).stop(true, true).hide(); //隐藏提示信息
		            break;
		        case "Text": //文字提示
		            _obj_p.find("." + rui_Validate_options.ShowTipClass).stop(true, true).hide(); //隐藏提示信息
		            break;
		        case "Icon": //图标提示
		        	obj.removeClass("Correct_validate").removeClass("Error_validate");
		            _obj_p.find("." + rui_Validate_options.ShowTipClass).stop(true, true).hide(); //隐藏提示信息
		            break;
		        case "Highlights":
		            obj.removeAttr("style");  //去除追加的样式
		            break;
		        default:
		            break;
		    }
		},
	   /**
        * @content 提交表单进行验证
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */ 
		Subvalidation: function (rui_Validate_options, obj) {
		    var validate_this = this;
		    var _result_cont = new Array;
		    var s_key = 0;
		    //获取需要验证的对象
		    rui_Validate_options.FormObj.find("*[isNot]").each(function () {
		        //console.log(_result_cont);
		        if (_result_cont!=null &&_result_cont.length < 1) {
		            var _theIsNot = $(this).attr("isNot");
		            if (_theIsNot == true || _theIsNot == "true") {
		                var theValue = $(this).val();
		                if (theValue == "")	//为空提示信息
		                {
		                    var _thisMsg = $(this).attr("msg") == undefined ? "errork" : $(this).attr("msg");
		                    if (_thisMsg != undefined && _thisMsg != "") {
		                        validate_this.ShowTips(rui_Validate_options, $(this), _thisMsg, "Error_validate");
		                        s_key++;
		                        var theObj = { statue: false, obj: $(this), msg: _thisMsg };
		                        _result_cont.push(theObj);
		                    }
		                    else {
		                        validate_this.clearShowTips(rui_Validate_options, $(this));
		                    }
		                }
		                else {
		                    var theVerify = $(this).attr("verify");	//验证
		                    if (theVerify != undefined || theVerify != "" && theVerify != "false") {
		                        //进行验证 
		                        var this_result = validate_this.checkVerify(theVerify, theValue, $(this), rui_Validate_options);
		                        if (!this_result.statue) {
		                            validate_this.ShowTips(rui_Validate_options, $(this), this_result.msg, "Error_validate");
		                            s_key++; 
		                            _result_cont.push(this_result);
		                        }
		                        else {
		                            validate_this.clearShowTips(rui_Validate_options, $(this));
		                        }
		                    }
		                    else {
		                        validate_this.clearShowTips(rui_Validate_options, $(this));
		                    }
		                }
		            }
		        } 
		    });

		    if (_result_cont.length < 1) {
		        var theFormObjUrl = rui_Validate_options.FormObj.attr("url");

		        var theCollBack = rui_Validate_options.CallBack;
		        if (theCollBack == "") {
		            theCollBack = formSuccess;
		        }
		        //存在链接提交
		        if (theFormObjUrl != "" && theCollBack != "") {
		            var JQ_FormOptions = {
		                url: theFormObjUrl,　　　　　　//form提交数据的地址 
		                type: "POST",　　　  			//form提交的方式(method:post/get)    
		                beforeSubmit: formRequest,　　//提交前执行的回调函数 
		                success: formSuccess,
		                error: formError,　　　　     //提交出错后执行的回调函数  
		                dataType: "json",　　　　　　 //服务器返回数据类型 Null为不限制，json ， script ， xml  ， html ， text
		                clearForm: false,　　　　　　 //提交成功后是否清空表单中的字段值  
		                restForm: false
		            }
		            var _randomid = "_form_ajaxSub" + parseInt(Math.random() * 100);
		            rui_Validate_options.FormObj.attr("id", _randomid);
		            $("#" + _randomid).ajaxSubmit(JQ_FormOptions);
		            return false;
		        }else{
					theCollBack(true);	
				}

		        //默认提交成功的事件处理
		        function formSuccess(data) {
		            if (data) {
		                if (data.status == "1") {
		                    alert(data.msg);
		                    if (data.url != undefined && data.url != "") {
		                        window.location.href = data.url;
		                    }
		                    obj.removeAttr("disabled");
		                    obj.val("修改提交");
		                    return false;
		                }
		                else {
		                    alert(data.msg);
		                    obj.removeAttr("disabled");
		                    obj.val("再次提交");
		                    return false;
		                }
		            }
		        }

		        //提交中
		        function formRequest(formData, jqForm, options) {
		            //formData: 数组对象，提交表单时，Form插件会以Ajax方式自动提交这些数据，格式如：[{name:user,value:val },{name:pwd,value:pwd}]  
		            //jqForm:   jQuery对象，封装了表单的元素     
		            //options:  options对象  
		            obj.prop("disabled", true);
		            obj.val("提交中...");
		        }

		        //提交失败
		        function formError(XMLHttpRequest, textStatus, errorThrown) {
		            alert("状态：" + textStatus + "；出错提示：" + errorThrown);
		            obj.prop("disabled", false);
		            obj.val("再次提交");
		        }
		    } else {
		        //console.log(_result_cont);
		        _result_cont[0].obj.focus();
		    }
		    return false;
		},
	   /**
		* @content 获取不同浏览器的版本号 
		* @author  梁汝翔<liangruxiang>    
		* @time 2015年8月20日 10:07:09
		*/ 
		checkBrowserPublish: function () { 
		    var agent = navigator.userAgent.toLowerCase(); 
		    var regStr_ie = /msie [\d.]+;/gi;
		    var regStr_ff = /firefox\/[\d.]+/gi
		    var regStr_chrome = /chrome\/[\d.]+/gi;
		    var regStr_saf = /safari\/[\d.]+/gi;
		    //IE
		    if (agent.indexOf("msie") > 0) {
		        return agent.match(regStr_ie);
		    } 
		    //firefox
		    if (agent.indexOf("firefox") > 0) {
		        return agent.match(regStr_ff);
		    } 
		    //Chrome
		    if (agent.indexOf("chrome") > 0) {
		        return agent.match(regStr_chrome);
		    } 
		    //Safari
		    if (agent.indexOf("safari") > 0 && agent.indexOf("chrome") < 0) {
		        return agent.match(regStr_saf);
		    }
		},
	   /**
        * @content 验证表单验证的不同项的值 
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */
		checkVerify: function (Verify, theValue, obj, rui_Validate_options) {
		    var result = { statue: true, obj: obj, msg: "" };
		    if (Verify == undefined) { Verify = "isAll"; }
		    switch (Verify) {
		        case "isLoginName":			//登陆用户名 
		            break;
		        case "isName":				//用户名
		            //验证会员的名称是否正确( 以汉字或字母开头 、汉字与字母数字组合的名称,长度为4到16位)
		            var reg = /^[\u4E00-\u9FA5A-Za-z0-9]{4,18}$/;
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "请输入以汉字或字母、数字组合的名称,长度为4到18位" };
		            }
		            break;
		        case "isUrl":				//Url验证
		            //验证会员的名称是否正确( 以汉字或字母开头 、汉字与字母数字组合的名称,长度为4到16位)
		            var reg = "^((https|http|ftp|rtsp|mms)?://)"
		            		+ "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" // ftp的user@
							+ "(([0-9]{1,3}\.){3}[0-9]{1,3}" // IP形式的URL- 199.194.52.184
							+ "|" // 允许IP和DOMAIN（域名）
							+ "([0-9a-z_!~*'()-]+\.)*" // 域名- www.
							+ "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\." // 二级域名
							+ "[a-z]{2,6})" // first level domain- .com or .museum
							+ "(:[0-9]{1,4})?" // 端口- :80
							+ "((/?)|" // a slash isn't required if there is no file name
							+ "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";
							
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "请输入正确的url地址" };
		            }
		            break;
		        case "isEn":				//是英文模式
		            var reg = /^[A-Za-z]+/g;  //是英文模式
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "只能输入英文哦" };
		            }
		            break;
		        case "isPhone":				//是手机号
		            var reg = /^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9])\d{8}$/;  //手机号格式
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "您输入的手机号码格式有误" };
		            }
		            break;
		        case "isPwd":				//密码
		            var reg = /^(?!([^A-Za-z]|\d)+$)[a-zA-Z\d]{6,16}$/;  //请输入字母和数字组合的6到16位字符串
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "请输入字母和数字组合的6到16位字符串" };
		            }
		            break;
		        case "isRPwd":				//重复密码 
		            var reg = /^(?!([^A-Za-z]|\d)+$)[a-zA-Z\d]{6,16}$/;  //请输入字母和数字组合的6到16位字符串
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "请输入字母和数字组合的6到16位字符串" };
		            }
		            else {
		                var _InitPwd = rui_Validate_options.FormObj.find("*[verify='isPwd']").eq(0).val();
		                if (theValue != _InitPwd) {
		                    result = { statue: false, obj: obj, msg: "两次输入的密码不一致" };
		                }
		            }
		            break;
		        case "isEmail":				//是邮箱
		            var reg = /^(\w)+(\.\w+)*@(\w|[-])+((\.\w+)+)$/;  //邮箱格式有误
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "邮箱格式有误" };
		            }
		            break;
		        case "isQQ":				//是QQ号码
		            var reg = /^([1-9])\d{4,13}$/; //4到13位数字
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "请填写正确的QQ号码" };
		            }
		            break;
		        case "isIdcard":			//是身份证 
		            var _isCheckResult = this.isIdcard(theValue);
		            if (_isCheckResult.statue == 0)	//状态
		            {
		                result = { statue: false, obj: obj, msg: _isCheckResult.msg };
		            }
		            break;
		        case "isBankcard":			//是银行卡
		            var reg = /^[0-9]{16,20}$/;
		            if (!reg.test(theValue)) {
		                result = { statue: false, obj: obj, msg: "请输入正确的银行卡号" };
		            }
		            break;
		        case "isTime":				//是时间格式  “-” 
		            break;
		        case "isStartTime":			//开始时间 
		            break;
		        case "isEndTime":			//结束时间
		            var _StartTime = rui_Validate_options.FormObj.find("*[verify='isStartTime']").eq(0).val();
		            if (_StartTime != undefined && _StartTime != "") {
		                var Time_guize = this.compareTime(_StartTime, theValue, "-");
		                if (!Time_guize) {
		                    result = { statue: false, obj: obj, msg: "开始时间不得大于结束时间" };
		                }
		            }
		            break;
		        default:
		        case "isAll":
		            break;
		    }
		    return result;
		},
	   /**
        * @content 验证身份证号码 
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */
		isIdcard: function (str) {
		    var card = str; var vcity = { 11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "新疆", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外" }; var theinfos = checkCard(card); function checkCard(card) { var card = card; var theResult = {}; if (card === "") { theResult.statue = "0"; theResult.msg = "请输入身份证号，身份证号不能为空"; return theResult } if (isCardNo(card) === false) { theResult.statue = "0"; theResult.msg = "您输入的身份证号码不正确，请重新输入"; return theResult } if (checkProvince(card) === false) { theResult.statue = "0"; theResult.msg = "您输入的身份证号码不正确,请重新输入"; return theResult } if (checkBirthday(card) === false) { theResult.statue = "0"; theResult.msg = "您输入的身份证号码生日不正确,请重新输入"; return theResult } if (checkParity(card) === false) { theResult.statue = "0"; theResult.msg = "您的身份证校验位不正确,请重新输入"; return theResult } theResult.statue = "1"; theResult.msg = "格式正确"; return theResult } function isCardNo(card) { var reg = /(^\d{15}$)|(^\d{17}(\d|X)$)/; if (reg.test(card) === false) { return false } return true } function checkProvince(card) { var province = card.substr(0, 2); if (vcity[province] == undefined) { return false } return true } function checkBirthday(card) { var len = card.length; if (len == "15") { var re_fifteen = /^(\d{6})(\d{2})(\d{2})(\d{2})(\d{3})$/; var arr_data = card.match(re_fifteen); var year = arr_data[2]; var month = arr_data[3]; var day = arr_data[4]; var birthday = new Date("19" + year + "/" + month + "/" + day); return verifyBirthday("19" + year, month, day, birthday) } if (len == "18") { var re_eighteen = /^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/; var arr_data = card.match(re_eighteen); var year = arr_data[2]; var month = arr_data[3]; var day = arr_data[4]; var birthday = new Date(year + "/" + month + "/" + day); return verifyBirthday(year, month, day, birthday) } return false } function verifyBirthday(year, month, day, birthday) { var now = new Date(); var now_year = now.getFullYear(); if (birthday.getFullYear() == year && (birthday.getMonth() + 1) == month && birthday.getDate() == day) { var time = now_year - year; if (time >= 3 && time <= 100) { return true } return false } return false } function checkParity(card) { card = changeFivteenToEighteen(card); var len = card.length; if (len == "18") { var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); var arrCh = new Array("1", "0", "X", "9", "8", "7", "6", "5", "4", "3", "2"); var cardTemp = 0, i, valnum; for (i = 0; i < 17; i++) { cardTemp += card.substr(i, 1) * arrInt[i] } valnum = arrCh[cardTemp % 11]; if (valnum == card.substr(17, 1)) { return true } return false } return false } function changeFivteenToEighteen(card) { if (card.length == "15") { var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); var arrCh = new Array("1", "0", "X", "9", "8", "7", "6", "5", "4", "3", "2"); var cardTemp = 0, i; card = card.substr(0, 6) + "19" + card.substr(6, card.length - 6); for (i = 0; i < 17; i++) { cardTemp += card.substr(i, 1) * arrInt[i] } card += arrCh[cardTemp % 11]; return card } return card } return theinfos;
		},
	   /**
        * @content 比较时间大小
        * @param 开始时间
        * @param 结束时间
        * @param 截取字符串
        * @author  梁汝翔<liangruxiang>    
        * @time 2015年8月20日 10:07:09
        */
		compareTime: function (_St, _Et, str) {
		    var _StInt = parseInt(_St.replace(/-/g, ""));
		    var _EtInt = parseInt(_Et.replace(/-/g, ""));
		    if (!isNaN(_StInt) && !isNaN(_EtInt)) {
		        if (_StInt > _EtInt) {
		            return false;
		        }
		        return true;
		    }
		    else {
		        return false;
		    }
		}
	}
	
	$.extend({rui_validate:rui_validate}); 
})(jQuery,window);