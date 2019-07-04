(function (W) {
    var _RSSC = function () {
        this.param = {};
    };

    _RSSC.prototype = {
        /**
        * @description 获取url参数值 
        * @extends {window}
        * @param {string} name 为参数名字 
        */
        Init: function () { 
            var _Agent = navigator.userAgent.toLowerCase(); 
            //IE浏览器(json 兼容处理 IE7以下)
            if (_Agent.indexOf("msie") > 0) {
                var _regStr_ie = /msie [\d.]+;/gi;
                var _theBrowser = _Agent.match(_regStr_ie);
                var _theBanben = (_theBrowser + "").replace(/[^0-9.]/ig, "");
                _theBanben = isNaN(parseInt(_theBanben)) ? 9 : parseInt(_theBanben);
                if (_theBanben < 8) {
                    //处理兼容性问题
                    var _JS_JSON2 = "<script id='json_jr'  type='text/javascript' src='/templates/SSC/js/JSON2.js?" + parseInt(Math.random() * 100000) + "'><\/script>";
                    $("body").append($(_JS_JSON2));
                }
            }
            //处理Console的兼容性
            this.InitConsole();
        },
        /**
        * @description 处理console的兼容问题  
        */
        InitConsole: function () {
            var method;
            var noop = function () { };
            var methods = [
                'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
                'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
                'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
                'timeStamp', 'trace', 'warn'
            ];
            var length = methods.length;
            var console = (window.console = window.console || {});
            while (length--) {
                method = methods[length];
                if (!console[method]) {
                    console[method] = noop;
                }
            }
        },
        /**
        * @description 获取url参数值 
        * @extends {window}
        * @param {string} name 为参数名字 
        */
        getQueryString:function getQueryString(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]); return null;
        },
        /**
        * @description 数学阶乘运算,相当于数学公式（num！）
        * @extends {window}
        * @param {Number} num 阶乘基数 
        */
        ruiec_mathfactorial: function (num) {
            if (num <= 1) {
                return 1;
            } else {
                return num * arguments.callee(num - 1);   //用arguments对象的callee属性来指向外层函数调用自己
            }
        }, 
        /**
		* @description 概率组合计算，相当于数学C(n,m)
		* @extends {window}
		* @param {Number} n, m 对应公式C(n,m)两个参数 
		*/
        ruiec_mathCombin: function (n, m) {
            if (n == "" || m == "" || n == "-" || m == "-" || n == 0 || m == 0 || isNaN(n) || isNaN(m)) {
                oResult = 0;  //返回的结果
            }
            else {
                //m必须大于n,如果小于则返回0;
                oResult = parseInt(this.ruiec_mathfactorial(n) / (this.ruiec_mathfactorial(n - m) * this.ruiec_mathfactorial(m)));
            }
            return oResult;
        },
        /**
        * @description 把数组转换成String字符串
		* @extends {window}
        * @param {Array} arr 数组
        * @param {String} str 数组元素之间的链接字符串  
        */
        GetArray_ToString: function (arr, str) { 
            if (arr == undefined) { arr = []; }
            if (str == undefined) { arr = ''; }
            //var _resultString = "";
            //for (var i = 0 ; i < arr.length ; i++) {
            //    _resultString += arr[i];
            //    if (i + 1 < arr.length) {  //除了最后一个 都要一字符串链接
            //        _resultString += str;
            //    }
            //}
            return arr.join(str);
        },
        /**
        * @description 获取随机数组  
		* @extends {window}
        * @example ruiec_returnRandom(5,0,10,true);
        * @param {Number} oNum（获取随机数量）
        * @param {Number} oMin（随机数最小值）
        * @param {Number} oMax（随机数最大值）
        */
        ruiec_returnRandomArry: function (oNum, oMin, oMax, oRepeat) {
            var oResult = new Array();
            if (oRepeat)  //重复
            {
                for (var i = 0; i < oNum; i++) {
                    var oRandom = parseInt((oMax + 1) * (Math.random()));
                    if (oRandom < oMin) {
                        oRandom = oMin;
                    };
                    oResult.push(oRandom);
                };
                return oResult;
            }
            else	  //不可重复
            {
                var oRandomArray = new Array();  //不可重复的数组
                for (var a = oMin; a <= oMax; a++) {
                    oRandomArray.push(a);
                };
                for (var i = 0; i < oNum; i++) {
                    var oLength = oRandomArray.length;
                    var oRandom_num = parseInt(oLength * (Math.random()));
                    oRandom = oRandomArray[oRandom_num];
                    if (oRandom < oMin) {
                        oRandom = oMin;
                    };
                    oRandomArray.splice(oRandom_num, 1);
                    oResult.push(oRandom);
                };
                return oResult;

            };
        },
        /**
        * @description 验证数组是否有重复元素 
        * @param {Array} arr 数组
        * @return  有重复返回true；否则返回false 
        */
        Verify_Arrat_Repeat: function (arr) {

            if (arr == undefined) { arr = []; }
            var theReturn = false; //默认是没有的  
            for (var i = 0 ; i < arr.length ; i++) {
                var theValue = arr[i];
                for (var j = 0 ; j < arr.length ; j++) {
                    //当前元素与后面的所有元素都不相等；迭代  
                    if (i != j && theValue == arr[j]) {
                        theReturn = true;
                        j = arr.length;
                        i = arr.length;
                    }
                }
            }

            return theReturn;
        },
        /**
        * @description 去除数组中重复的值 
        * @param {Array} arr 数组
        * @return  {Array} 去除重复后的数组 
        */
        Del_Arrat_RepeatInfos: function (arr) {
            var theReturn = false; //默认是没有的
            if (arr == undefined) { arr = []; }
            //arr.sort();  //数组排序
            var New_Array = new Array();
            for (var i = 0 ; i < arr.length ; i++) {

                var theReturn = false; //默认是没有的
                var theValue = arr[i];
                if (i == 0) { New_Array.push(theValue); } //第一个不是重复的 
                for (var j = 0 ; j < arr.length ; j++) {  //当前元素与后面的所有元素都不相等；迭代  
                    if (i != j && theValue == arr[j]) {
                        theReturn = true;
                        j = arr.length;
                    }
                }
                if (!theReturn && i != 0) {
                    New_Array.push(theValue);
                }
            }
            return New_Array;
        },
        /**
        * @description 二维数组的排列组合,一维数组 
        * @param {Array} arr2 二维数组
        * @return {Array} 一维数组
        */
        TwoD_ArrayCombination: function (arr2) {
            if (arr2.length < 1) {
                return [];
            }
            var w = arr2[0].length,
				h = arr2.length,
				i, j,
				m = [],
				n,
				result = [],
				_row = [];

            m[i = h] = 1;

            while (i--) {
                m[i] = m[i + 1] * arr2[i].length;
            }
            n = m[0];
            for (i = 0; i < n; i++) {
                _row = [];
                for (j = 0; j < h; j++) {
                    _row[j] = arr2[j][~~(i % m[j] / m[j + 1])];
                }
                result[i] = _row;
            }
            return result;
        },
        /**
        * @description 去除结果集中的重复项和豹子（递归） 
        * @return  有重复返回true；否则返回false
        * @param arr 一维数组
        * @param len 数组的长度
        * @param num 数组的起始值
        * @param saveArray 回调数组 
        */
        RemoveDoubleLeopard: function (arr, len, num, saveArray) {
            var me = this,
                saveArray = saveArray || [],
                num = num || 0,
                len = len || arr.length;

            if (num == len) {
                return saveArray;
            } else {
                if (arr[num][0] != arr[num][1] && arr[num][0] != arr[num][2] && arr[num][1] != arr[num][2]) {
                    saveArray.push(arr[num]);
                }
                num++;
                return this.RemoveDoubleLeopard(arr, len, num, saveArray);
            }
        },
        /**
        * @description 把字符串转成JSON对象   
        * @param {String} StrData 需要转换的字符串 
        */
        GetJsonData: function (StrData) {
            if (StrData != undefined && StrData != "") {
                var Jsdata;
                if (JSON != undefined) {
                    Jsdata = JSON.parse(StrData);
                }
                else {
                    Jsdata = jQuery.parseJSON(StrData);
                }

                return Jsdata;
            }
            else {
                return {};
            }
        },
        /**
        * @description JSON对象转换成String类型对象  
        * @param {Json} JSONObj 
        */
        Json_To_String: function (JSONObj) {
            var Result = "";
            if (JSONObj != undefined) {
                if (JSON != undefined) {
                    Result = JSON.stringify(JSONObj);
                }
                else {
                    Result = JSONObj.toString();
                }
            }
            return Result;
        },
        /**
        * @description 获取随机数值 
        * @param s开始值，e结束值  
        */
        GetRandomValue: function (s, e) {
            return parseInt(Math.random() * (e - s + 1) + s);
        },
        /**
        * @description 验证字符串是否存在与数组中 
        * @param {String} str 字符串
        * @param {Array} arry 匹配数组  
        */
        CheckStrInArray: function (str, arry) {

            arry = arry || [];
            str = str || "";
            if (str != "") {
                var theState = false;
                var theArrayStr = "$@$"+arry.join("$@$");
                var IndexOf_Str = "$@$" + str;
                if (theArrayStr.indexOf(IndexOf_Str)>=0) {
                    theState = true;
                }
                 
                //for (var i = 0 ; i < arry.length; i++) {
                //    if (arry[i] == str) {
                //        i = arry.length;
                //        theState = true;
                //    }
                //}

                return theState;
            } else {
                return true;
            }

         
            
            
        }, 
        /**
        * @description 数组去重  
        * @param Array 输入的数组
        */
        ruiec_ArrayNoRepeat: function (Array) {
            var hash = {};
            var result = {};
            var rightArray = [];  //不重复的数组
            var errorArray = [];  //重复的数组
            var errorIndex = [];  //重复的索引值数组
            if (Array) {
                for (var i = 0; i < Array.length; i++) {
                    if (!hash[Array[i]]) {
                        hash[Array[i]] = true;
                        rightArray.push(Array[i]);
                    }
                    else {
                        errorArray.push(Array[i]);
                        errorIndex.push(i);
                    };
                }
                result.rightArray = rightArray;
                result.errorArray = errorArray;
                result.errorIndex = errorIndex;
                return result;
            };
        },
        /**
        * @description 时间戳转日期时间（公用），调用例子[ruiec_DateToTime(1398250549490,1)] 
        * @param {Time} Date需要转化的时间戳,
        * @param {Number} show=0时所有格式、show=1时转化成日期格式、show=2时转化为时间格式 
        */
        ruiec_DateToTime: function (oDate, show) {
            // 例子，比如需要这样的格式：yyyy-MM-dd hh:mm:ss
            oDate = parseInt(oDate);
            var date = new Date(oDate);
            Y = date.getFullYear() + '-';
            M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
            D = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate()) + ' ';
            h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
            m = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
            s = (date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds());
            if (show == 1) {
                var oCallBackTime = Y + M + D;
            } else if (show == 2) {
                var oCallBackTime = h + m + s;
            }
            else if (show == 3) {
                var oCallBackTime = Y + M + D + h + m + s
            }
            else if (show == 4) {
                var oCallBackTime = h + m + s
            } else {
                var oCallBackTime = M + D + h + m + s
            }
            return oCallBackTime;
        },
        /**
        * @description 日期转化成时间戳（公用），调用例子[ruiec_TimeToDate('2014-04-23 18:55:49:123')]  
        * @example 2014-04-23 18:55:49
        * @param oTime需要转化的时间格式，如'2014-04-23 18:55:49:123' 
        */
        ruiec_TimeToDate: function (oTime, type) {
            /*var isChrome = window.navigator.userAgent.indexOf("Chrome") !== -1 
        	console.log(isChrome)*/
            var oDate = 0;
            if (type == "time") { 
                var oTime = oTime.split(":");
                oDate = oDate + parseInt(oTime[0]) * 3600 + parseInt(oTime[1]) * 60 + parseInt(oTime[2]);
            } else {
                // 例子：yyyy-MM-dd hh:mm:ss 》》1398250549490
                var t1 = oTime.split(" ")[0];
                var t2 = oTime.split(" ")[1];
                var y = t1.split("-")[0];
                var m = t1.split("-")[1] - 1;
                var d = t1.split("-")[2];
                var h = t2.split(":")[0];
                var mm = t2.split(":")[1];
                var s = t2.split(":")[2];
                date = new Date(y, m, d, h, mm, s);
                oDate = date.getTime();
            };
            return oDate;
        },
        /**
        * @description 返回n天后的时间戳 
        * @param {Number} nextNum天(可正负)
        */
        ruiec_returnNextDayTime: function (nextNum) {
            if (nextNum == "" || nextNum == undefined) {
                nextNum = 0;
            };
            var today = new Date();
            today.setHours(0);
            today.setMinutes(0);
            today.setSeconds(0);
            today.setMilliseconds(0);

            var todayTime = today.getTime();
            var oNextTime = 0;
            var n = 1000 * 60 * 60 * 24;  //一天的时间戳
            oNextTime = todayTime + n * nextNum;
            return oNextTime;
        },
        /**
        * @description 字符串去除分隔符 
        * @param {String} string需要处理的字符串（例如：2015-11-12）,
        * @param {String} cut是分隔符，例如（“-”） 
        */
        ruiec_removeSplit: function (string, cut) {
            var oString = string || ""; 
            var oString_split = oString.split(cut);
            var newString = "";
            for (var a in oString_split) {
                newString = newString + oString_split[a];
            };
            return newString;
        },
        /**
        * @description 取得cookie  中指定的值 
        * @param {String} name 获取cookie里的执行的键值
        */
        getCookie: function (name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');    //把cookie分割成组    
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];                      //取得字符串    
                while (c.charAt(0) == ' ') {          //判断一下字符串有没有前导空格    
                    c = c.substring(1, c.length);      //有的话，从第二位开始取    
                }
                if (c.indexOf(nameEQ) == 0) {       //如果含有我们要的name    
                    return unescape(c.substring(nameEQ.length, c.length));    //解码并截取我们要值    
                }
            }
            return false;
        },
        /**
        * @description 清除cookie  中指定的值 
        * @param {String} name 获取cookie里的执行的键值
        */
        clearCookie: function (name) {
            this.setCookie(name, "", -1);
        },
        /**
        * @description 设定cookie的值 
        * @param {String} name 设定cookie里的键值
        * @param {String} value 设定cookie里指定键的值
        * @param {String} seconds 设定cookie的存活时间秒为单位
        */
        setCookie: function (name, value, seconds) {
            seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。    
            var expires = "";
            if (seconds != 0) {      //设置cookie生存时间    
                var date = new Date();
                date.setTime(date.getTime() + (seconds * 1000));
                expires = "; expires=" + date.toGMTString();
            }
            document.cookie = name + "=" + escape(value) + expires + "; path=/";   //转码并赋值    
        }, 
        /**
        * @description 公用AJAX方法，便于后期优化   
        * @param {String} type 设定Ajax的提交类型
        * @param {String} url 设定Ajax提交的接口
        * @param {String} data 设定Ajax提交的数据 
        * @param {String} dataType 设定Ajax提交的数据的返回值遵循的数据格式
        * @param {Callback} success_call 设定成功后的回调函数  
        * @param {Callback} error_call 设定失败后的回调函数  
        */
        RAjax:function(type,url,data,dataType,success_call,error_call){
            if(type == undefined)  type = 'POST';
            if(url == undefined)  url = '';
            if(data == undefined)  data = {};
            if(dataType == undefined)  dataType = 'JSON';
            if(success_call == undefined){
                success_call = function(data){
                    console.log(data); 
                } 
            }
            if(error_call == undefined){
                error_call = function(error){
                    console.log(error);
                } 
            } 
            $.ajax({
                type: type,
                url: url,
                data: data,
                dataType: dataType,
                error: function (error) {
                    error_call(error);
                },
                success: function (data) {
                    success_call(data)
                }
            });
        }, 
        /**
        * @description 获取JSON数据   
        * @param url 接口地址
        * @param data 传参
        * @param 回调函数
        */
        RGetJSON:function(url,data,success_call){
            $.getJSON(url,data,function(results){
                success_call(results);
            });
        },
        /**
        * @description 重写windows alert   
        * @param url 接口地址
        * @param data 传参
        * @param 回调函数
        */
        alert: function (str, type, success, error) {

            type = type || "";
            switch(type){
                case 'comfirm':
                    artDialog({
                        icon: "warning",
                        content: str,
                        ok: function () {
                            if (success != undefined && success) {
                                success();
                            }
                        },
                        cancel: function () {
                            if (error != undefined && error) {
                                error();
                            } 
                        },
                        lock: true
                    })
                    break;
                case "SureInfo":
                    artDialog({
                        content: str,
                        ok: function () {
                            if (success != undefined && success) {
                                success();
                            }
                        },
                        lock: true
                    })
                    break;
                case 'CountDown':
                    art.dialog({
                        icon: "warning",
                        id: 'testID2',
                        content: str,
                        lock: true,
                        cancelVal: '关闭',
                        cancel: true
                    }); 
                    if (typeof success == "number") {
                        art.dialog({ id: 'testID2' }).title('3秒后关闭').time(success);
                    } else {
                        art.dialog({ id: 'testID2' }).title('3秒后关闭').time(3);
                    }
                    
                    break;
                case 'error':
                    art.dialog({
                        icon: "warning",
                        id: 'testID3',
                        content: str,
                        lock: true,
                        cancelVal: '关闭',
                        cancel: true
                    }); 
                    if (typeof success == "number") {
                        art.dialog({ id: 'testID3' }).title('3秒后关闭').time(success);
                    } else {
                        art.dialog({ id: 'testID3' }).title('3秒后关闭').time(3);
                    }

                    break;
                case "":
                default:
                    alert(str);
                    break;
            } 
        }
    }

    var RCP = new _RSSC(); 
    RCP.Init();
     
    W.RCP = _RSSC.prototype;
    
})(window); 

 