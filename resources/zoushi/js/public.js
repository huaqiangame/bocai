
var allLotteryType = [{type:'K3', code: 1407 }, {type:'SSC', code:1000 }, {type:'SYX5', code:1100 }, {type:'PK10', code:1303 },
// {type:'XYNC', code:1304 },
    {type:'KL8', code:1302 }, {type:'FC3D', code:1201 }, {type:'PL35', code:1202 }];

var _Tool = {
        obscure : {
            Base: function(s,f,e,m) {
                var l = m||s.length-f-e,j='';
                for(var i = l;i>0;i--){
                    j+='*';
                }
                s=s.substring(0,f)+j+s.slice(-e);
                return s;
            },
            Mail: function(s) {
                s=s.split('@');

                return this.Base(s[0],2,1)+'@'+s[1];
            },
            Mobile:function(s){
                return this.Base(s,2,2);
            }
        },
        commonDom:{
            Load:'<div class="iconLoadingCon" style="transform: scale(.6);"> <span class="iconLoadingText" style="left:0;color:#253646;">&#xe647;</span> <div class="iconLoadingMove"></div> </div>',
            NoData:'<i class="iconfont"></i>暂无记录',
            Warp:function(s){
                return '<div class="notContent" style="padding:100px 0;">'+s+'</div>'
            }
        }
    }
;(function(){
    for(var k in _Tool.commonDom){
        if (k!=="Warp") {
            _Tool.commonDom[k]=_Tool.commonDom.Warp(_Tool.commonDom[k])
        }
    }
})()
//对账号进行模糊,如果boolean为真，则模糊后的账号和原账号等长
function fuzzyUsername(str,boolean){
    if(!String.prototype.repeat){
        String.prototype.repeat = function(num){
            if(num<0)return;
            var str = '';
            for(var i = 0;i < num; i++){
                str += this;
            }
            return str;
        }
    }

    if(str){
        var len = str.length;
        if(len > 3 && len <=6 ){
            return str = str.slice(0,2) + '*'.repeat(len - 3) + str.slice(-1);
        }else if(len > 6){
            return str = str.slice(0,2) + '*'.repeat(boolean ? (len-3):3) + str.slice(-1);
        }else{
            return str;
        }
    }
}

/**
 * [InfoCard 名片类]
 * @param {[数组]} delta [名片相对于触发dom的相对位移]
 * 现在名片与风云榜解耦了，可以自己选择触发父元素，也可以自己设相对位置
 */
function InfoCard(delta){
    this.delta = delta || [0, -300];        //有默认位置的
    this.showFlag = [0,0];
    this.showTimer = null;
    this.layerIndex = 0;
}

/**
 * [render 名片类渲染函数]
 * @param  {[int]} id  [用于获取名片信息所需的id,获取自己的名片传0]
 * @param  {[dom]} dom [父元素的dom节点]
 */
InfoCard.prototype.render = function(id, dom){
    var that = this;
    if(sessionStorage.getItem('infoCard'+id)){
        //如果有在sessionStorage的话，就直接从sessionStorage获取数据
        if(!that.showFlag[0] && !that.showFlag[1]){
            return;
        }

        var card = JSON.parse(sessionStorage.getItem('infoCard'+id));
        var cardStr = createCardStr(card);  //将名片对象填充到dom结构里，生成一个可渲染的字符串
        // console.log(cardStr)
        showCard(dom, cardStr);         //渲染名片
    }else{
        //缓存没找到的话就用ajax获取
        ajaxCard(id);
    }

    /**
     * [ajaxCard 使用ajax去获取名片，并调用各个函数渲染]
     * @param  {[type]} id [获取名片使用的id]
     */
    function ajaxCard(id){
        $.ajax({
            data:{
                "Action" : "GetCard",
                "UserId": id
            },
            success:function(data){
                if(data.Code === 1 || data.Code === 0){
                    if(!that.showFlag[0] && !that.showFlag[1]){
                        return;
                    }

                    data = data.BackData;
                    console.log(data);
                    var card = createCard(data);        //将获得的数据处理后，生成一个名片对象
                    var cardStr = createCardStr(card);  //将名片对象填充到dom结构里，生成一个可渲染的字符串
                    // console.log(cardStr)
                    showCard(dom, cardStr);         //渲染名片
                    sessionStorage.setItem('infoCard'+id, JSON.stringify(card));
                }else{
                    console.log(data.StrCode);
                }
            }
        });
    }

    /**
     * [createCard 对获得的数据进行处理，形成卡片对象]
     * @param  {[obj]} data [ajax返回的数据]
     * @return {[str]}      [卡片对象]
     */
    function createCard(data){
        console.log(data)

        var sexArr = ['女','男','保密'];
        var card = {};
        card.award = parseInt(data.Award) || 0;                              				//累计投注
        card.groupTitle = data.GroupTitle || '';                                    //等级
        card.lotteryList = data.LotteryType ? data.LotteryType.split(',') : [];     //已玩彩种列表
        card.nickname = data.NickName;                                              //昵称
        card.rank = data.Rank || '';                                                //头衔
        card.sex = data.Sex ? sexArr[data.Sex] : '保密';                            //性别
        card.username = data.UserName;                                              //账号
        card.fizzyUsername = fuzzyUsername(card.username,true);                     //模糊后的账号
        card.userPhoto = _Path.Host.img + _Path.path.photos+data.UserPhoto;         //用户头像
        return card;
    }

    /**
     * [createCardStr 将卡片对象生成可渲染的字符串]
     * @param  {[obj]} card [卡片对象]
     * @return {[type]}      [可渲染的字符串]
     */
    function createCardStr(card){
        //名片左上
        console.log(card)
        var photo = card.userPhoto || 'defaultHeadImg.png'; //默认头像
        card.nickname = card.nickname || '昵称未设置';
        var cardLeftStr = '<div class="cardLeft">\
            <img src="'+ photo+'" alt="" title="' + card.lotteryList.LotteryName+ '" width="80" height="80">\
            <h6>'+card.nickname+'</h6>\
        </div>';

        //名片右上
        var cardInfoStr = '<div class="cardInfo">\
            <ul>\
                <li>性别：'+card.sex+'</li>\
                <li>账号：'+card.fizzyUsername+'</li>\
                <li>等级：'+card.groupTitle+'</li>\
                <li>头衔：'+card.rank+'</li>\
                <li>累计中奖：'+card.award+'</li>\
            </ul>\
        </div>';

        //下方已玩彩种列表
        var arr = card.lotteryList;
        var unactiveArr = []; //存放亮的icon
        var activeArr = []; //存放暗的icon
        //已经更新的彩种
        var pathConfig = {
            K3: '/lottery_k3.html?lottery=',
            SSC: '/lottery_ssc.html?lottery='
        }
        for(var i = 0; i < allLotteryType.length;i++){
            var isActive = 'noActive';
            for(var j = 0;j < card.lotteryList.length;j++){
                if(card.lotteryList[j].toLowerCase() === allLotteryType[i].type.toLowerCase()){
                    isActive = '';
                }
            }
            var lotteryUrl = pathConfig[allLotteryType[i].type] || '/gameBet_cqssc.html?lottery=';
            var str = '<li><a href="'+ lotteryUrl + allLotteryType[i].code +'"><i class="iconfont L_'+ allLotteryType[i].type +' '+ isActive +'"></i></a></li>';
            isActive ? unactiveArr.push(str) : activeArr.push(str);
        }
        //把亮的放前面，暗的放后面
        var cardIconStr = '<ul class="cardIcon fix">' + activeArr.join('') + unactiveArr.join('') +'</ul>';
        // console.log(cardIconStr)
        return '<div class="card fix"  >'+ cardLeftStr + cardInfoStr + cardIconStr + '</div>';
    }

    /**
     * [showCard 使用layer生成名片并绑定事件]
     * @param  {[dom]} dom     [触发元素的dom节点]
     * @param  {[str]} cardStr [用以渲染的字符串]
     */
    function showCard(dom, cardStr){
        var offset = $(dom).offset();
        var scrollTop = window.pageYOffset|| document.documentElement.scrollTop || document.body.scrollTop;
        var scrollLeft = window.pageXOffset|| document.documentElement.scrollLeft || document.body.scrollLeft;
        layer.open({
            type:1,
            closeBtn:0,
            shift:5,
            shade:0,
            title:false,
            content:cardStr,
            skin:'cardCon',
            offset:[offset.top - scrollTop + that.delta[0],offset.left - scrollLeft + that.delta[1]],
            success:function(layero, index){
                that.layerIndex = index;
                that.layer = layero;
                layero.on("mouseenter",function(e){
                    that.showFlag[1] = 1;
                    console.log(that.layerIndex, that.showFlag)
                }).on("mouseleave",function(e){
                    that.showFlag[1] = 0;
                    if (!that.showFlag[0] && !that.showFlag[1]) {
                        layer.closeAll();
                        that.layer = null;
                    }
                });
            }
        });
    }

}
/**
 * [bind 为触发元素绑定触发名片事件]
 * @param  {[jq对象]} $dom [触发元素的父框]
 * @param  {[str]} item [触发元素的子框，用字符串表示，使用jq可识别的方式即可]
 */
InfoCard.prototype.bind = function($dom, item){
    var that = this;
    $dom.css('cursor', 'pointer').on("mouseenter", item, function(){
        that.showFlag[0] = 1;
        layer.closeAll();
        var ths=this;
        //悬浮500s后再触发渲染名片的程序
        showTimer = setTimeout(function(){
            //从轮播图上获取头像，昵称，账号等信息
            if(that.showFlag[0] + that.showFlag[1]){
                var id = $(ths).attr('data-id');
                that.render(id,ths);  //从ajax获得剩余数据，并渲染卡片于页面
                clearTimeout(showTimer)
            }
        },500);
    }).on("mouseleave", item,function(e){
        that.showFlag[0] = 0;
        clearTimeout(showTimer)
        setTimeout(function(){
            if (!that.showFlag[0] && !that.showFlag[1]) {
                layer.closeAll();
            }
        },100);
    }).on('mouseleave',function(){
        //1s后如果既不在轮播图上，也不在名片上，就关闭所有页面
        setTimeout(function(){
            if(!that.showFlag[0] && !that.showFlag[1]){
                layer.closeAll();
            }
        },400);
    });
}
/*名片类结束*/


/**
 * [hoverShow description]
 * @param  {[dom]} show [关联鼠标移入的区域]
 * @param  {[dom]} hide [原本隐藏,移入show区域后显示]
 * @return {[无]}      [description]
 */
function hoverShow(show,hide) {
    var hideDom = $(hide)
    $(show).hover(function(){
        hideDom.show()
    },function(){
        hideDom.hide()
    })
}
/**
 * [hoverShow description]
 * @param  {[dom]} show [关联鼠标点击的区域]
 * @param  {[dom]} hide [原本隐藏,点击show区域后显示]
 * @return {[无]}      [description]
 */
function clickShow(show,hide) {
    var showDom = $(show)
    showDom.children('i').click(function(){
        $(hide).show()
        showDom.hide()
    })
}
/**
 * [W_GetRequest 获取url上的参数,比如]
 * @param {string} url [(可选)基本不传]
 * @return {json} 返回参数对象,如?a=1&b=2 返回的为 {a:1,b:2}
 */
function W_GetRequest(url) {
    url=url||location.pathname;
    strs=url.split("/");
    return strs[3];
}
/**
 * [withdrawBtnCheck 提现按钮判断]
 * @param {obj} data [ajax返回的数据]
 */
function withdrawBtnCheck(data){
    if(data.UserHasSafePwd === '1'){
        if(data.UserFirstCardInfo && data.UserFirstCardInfo.length && data.UserFirstCardInfo[0]){
            location.href= '/withdraw.html';
        }else{
            //用户没有银行卡
            layer.confirm('您还未绑定银行卡，请先绑定银行卡?', function(){
                location.href = '/setBankcard.html?Q=withdraw';
            },function(){
                layer.close();
            });
        }
    }else{
        //用户没有安全密码
        layer.confirm('您还未设置安全密码，请先设置安全密码?<br/>（安全密码用于提现等操作，可保障资金安全）', function(){
            location.href = '/setSafePwd.html?Q=withdraw';
        },function(){
            layer.close();
        });
    }
}


/**
 * [format 为Date对象追加format方法]
 * @param  {[string]} format [设置要输出的目标格式 如"yyyy-MM-dd hh:mm:ss" ]
 * @return {[string]}        [按格式输出的时间字符串]
 * 示例console.log(new Date().format("yyyyMd hh:mm:ss")) 输出2016816 14:12:17;
 */
Date.prototype.format = function(format) {
    var date = {
        "M+": this.getMonth() + 1,
        "d+": this.getDate(),
        "h+": this.getHours(),
        "m+": this.getMinutes(),
        "s+": this.getSeconds(),
        "q+": Math.floor((this.getMonth() + 3) / 3),
        "S+": this.getMilliseconds()
    };
    if (/(y+)/i.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
    }
    for (var k in date) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
        }
    }
    return format;
}
var aDayTime = 24 * 60 * 60 * 1000,//一天的总毫秒值
    GMTdif = new Date().getTimezoneOffset()*60*1000;//本地时间和格林威治的时间差,比如中国差了8小时即480分钟


var _Path = {
        Host: {
            img: "http://imagess-google.com"
        },
        path: {
            thisPath:location.pathname.toLowerCase(),
            photos: '/system/common/headimg/',
        },
        IsLottery:false
    }
;(function(){
    var script = document.getElementsByTagName("script");
    if(_Path.path.thisPath.search(/lottery_\w+.html/)>-1||_Path.path.thisPath==="/gamebet_cqssc.html"){
        _Path.IsLottery=true
    }
    _Path.path.serLink = script[script.length-1].src.replace("js/public.js",'');
})()

/*var _AJAXUrl = '/tools/ssc_ajax.ashx'; //AJAX目标地址
var _UnLogin,_PublicRenData={};
$.ajaxSetup({
	dataType: "json",
	type: "post",
	url: _AJAXUrl,
	cache:false,
	beforeSend: function(xhr) {
		if (this.load) {
			layer.load(0,{shade:.17});
		}
	},
	complete:function(){
		if (this.load) {
			layer.closeAll('loading');
		}
	},
	error:function(){
		console.error(this);
	}
});*/
var userCardLayer={show:0};
var sexArr = ['女','男','保密'];
var _FomatConfig = {
    ImgCode: {
        Name: "验证码",
        Reg: /^[0-9a-zA-Z]{4}$/,
    },
    SmsCode: {
        Name: "短信验证码",
        Reg: /^\d{4}$/
    },
    MailCode:{
        Name: "邮箱验证码",
        Reg: /^\d{4}$/
    },
    UserName: {
        Name: "账号",
        Reg: /^[\w|\d]{4,16}$/
    },
    Password: {
        Name: "密码",
        ErrMsg:"密码应为6-16位字符",
        Reg: /^[\w!@#$%^&*.]{6,16}$/
    },
    Mobile: {
        Name: "手机号",
        ErrMsg:"请输入13|14|15|17|18开头的11位手机号码",
        Reg: /^1[3|4|5|7|8]\d{9}$/,
    },
    RealName: {
        Name: "姓名",
        Reg: /^[\u4e00-\u9fa5|·]{2,16}$|^[a-zA-Z|\s]{2,20}$/,
    },
    BankNum: {
        Name: "银行卡号",
        Reg: /^\d{10,19}$/
    },
    Money: {
        Name: "金额",
        Reg: /^\d{1,}(\.\d{1,2})?$/,
        Between: [100, 500000] //100~50w之间
    },
    Answer:{
        Name: "答案",
        Reg: /^\S+$/
    }
    ,
    Mail:{
        Name:"邮箱",
        Reg:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
    },

}
_FomatConfig['SafePassword'] = _FomatConfig['Password'];

var _InputJson = {};
var _DomObj = {
    Input: _InputJson,
    Radio: {},
    Select: {},
    getAjaxData: function(data) {
        data = data || {};
        var isErr = false;
        for (var t in this.Input) {
            // console.log(t);
            t = this.Input[t];
            // console.log(t.isErr);
            if (t.isErr === undefined) {
                t.check();
            }
            if (t.isErr) {
                isErr = t;
                break;
            } else if (!t.isRepeat) {
                // 重复确认的值不用传入结果
                if (t.val) {
                    data[t.name] = t.val;
                }
            }
        }
        return [data, isErr];
    },
    returnAjaxData:function(data){
        data = this.getAjaxData(data);
        if(data[1]){
            layer.msgWarn(data[1].tipMsg[data[1].isErr]);
            return [data[0],false];
        }else{
            return [data[0],true];
        }
    }
}

function SetInput(ths) {
    if (ths.name&&!ths.getAttribute('disabled')) {
        var t = new FomatDom(ths);
        t.setShowMsg();
    }
}
function FomatDom(dom) { //目前包含输入框和select
    this.dom = dom; //本<input>的JQ对象
    this.name = dom.name; //name
    this.val = dom.value; //用于AJAX取值
    this.isErr; //0表示正确,1表示为空错误,2表示格式错误,3表示超出范围或重复输入不相同
    this.tipMsg; //根据isErr设置匹配的提示信息;
    this.canNull = dom.className.search("CanNull") > -1;
}
/**
 *1. 将值更新到对象的val中
 *2.判断是否是重复输入的对象(isRepeat)  如果是,则和原对象值比较,并生成isErr状态
 *3.判断值是否为空
 *   如果为空判断是否可以为空(canNull)
 *   不为空就去从配置中获取正则进行判断 如果错误则isErr=2
 *     如果正则正确,判断是否配置中有between,进行判断值域有效性,可以报错,也可以改成强制变为合法值
 */
FomatDom.prototype.check = function(fun) {
    var v = this.val = this.dom.value;
    if (this.isRepeat) {
        this.isErr = 3 * (v !== _InputJson[this.isRepeat].dom.value);
    } else if (v) {
        var f = _FomatConfig[this.name];
        this.isErr = !f.Reg.test(v) * 2;
        //正则错误则阻止进一步判断
        if (this.isErr != 2) {
            var b = f.Between;
            v = parseFloat(v);
            if (b) {
                this.isErr = (v < b[0] || v > b[1]) * 3;
            }
        }
    } else {
        this.isErr = 1 - this.canNull;
    }
    showMsg(this.dom, !this.isErr, this.tipMsg[this.isErr]);
}
/*
 *1.先判断是否为重复确认的对象 如果是,将确认的对象Name存给isRepeat
 *2.判断是否有配置,没配置的进行调试报错预警
 *3.为提示语句数组(修改tipMsg)设置初始值(包括正确,为空,格式错误)
 *4.判断如果是重复确认的对象,修改tipMsg,并同时为要确认的对象增加事件,让这两个对象绑定校验.
 *5.判断是否有值域要求,设置tipMsg
 */
FomatDom.prototype.setShowMsg = function() {
    var name = this.name;
    this.isRepeat = name.search('check') > -1;
    if (this.isRepeat) {
        this.isRepeat = name = name.split('check')[1];
    }

    var b = _FomatConfig[name];

    if (b) {
        var ths = this;
        ErrMsg=b.ErrMsg,
            name = b.Name;
        b = b.Between;
        this.tipMsg = ["", name + "不能为空", ErrMsg||(name + "格式错误")];
        if (this.isRepeat) {
            this.tipMsg[0] = '';
            this.tipMsg[1] = "请再次输入" + name;
            this.tipMsg.push("两次" + name + "不相同");
            _DomObj.Input[this.isRepeat].dom.addEventListener('change', function() {
                ths.check();
            })
        } else if (b) {
            this.tipMsg.push(name + "必须在" + b[0] + "与" + b[1] + "之间");
        }
        ths.dom.addEventListener('blur', function() {
            ths.check(showMsg);
        });
        // ths.check();
        _DomObj.Input[ths.name] = ths;

    } else {
        // console.err(this.name);
        console.log(this.name + '的名字没在表里')
    }
}

function showMsg(dom, isRight, msg) {
    $(dom).next('em').text(msg).attr("class", isRight ? 'verifyRight' : 'verifyWrong').prepend('<i></i>');
}

$.fn.addInputCheck = function(fun) {
    this.each(function() {
        // console.log(this)
        var name = this.name;
        if (!name) {
            return;
        }
        var type = this.type.toLowerCase();
        switch (type) {
            case "radio":
            case "checkbox":
            case "select":
                break;
            default:
                SetInput(this);
        }
    })
    return this;
}


//检测浏览器对localstorage的支持
function hasLocalStorage() { //返回boolean
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}
var CacheData = localStorage.getItem('CacheData');
CacheData = CacheData?JSON.parse(localStorage.getItem('CacheData')):{};
var VerifyCacheArr = [//需要校验更新版本的列表
    'lotteryConfig', //所有彩种列表
    'lotteryList' //所有彩种信息
//    'ActivityConfig',//活动种类及数据
//    'FooterConfig',//底部连接设置
//    'HelpConfig',//帮助指南
//    'SiteConfig',//网站属性设置
//    'BannerList',//首页轮播
//    'HallBanner',//购彩大厅轮播
//    'GradeList',//等级体系
//    'LoginGreet',//登录页面问候语列表
//    'DefaultPhotoList',//默认头像组
//    'RewardData',//每日加奖设置
//    'AbstractType',
//    'PayLimit',
//    'CloudUrl'//大发云链接
];
var DailyCacheArr = [
//    'serviceRating',
    'rankingList'
]
var VerifyUserArr = [
//    'UserHasSafePwd', //返回是否已经设置安全密码,1为有,0为没有设置
//    'UserSafeQuestions', //返回设置的密保问题,如果没设置可以返回0或者空数组
//    'UserMobile', //返回已绑定手机的模糊状态,如未绑定,返回空字符串或0
//    'UserMail', //返回已绑定手机的模糊状态,如未绑定,返回空字符串或0
]
var UserCacheArr = [
//    'userName', //返回对应的账号,未登陆用户返回空字符串
//    "userNickName"//用户昵称
//    'UserPhoto', //返回用户头像的图片地址,暂时还未开放头像功能
//    'UserFirstCardInfo', //返回绑定的第一张银行卡的模糊信息
//    'UserUpGradeBonus',
//    'NoticeData',//网站公告
//    'AgentRebate'//获取代理人返点情况
];
var UserNoCacheArr = [
//    'UserUnread',
    'userBalance'
]
// localStorage.removeItem('NoticeData');
var paraArr = DailyCacheArr.concat(VerifyCacheArr);
/*if (UserName) {
    paraArr = paraArr.concat(VerifyUserArr,UserCacheArr);
}else{
    clearlocalStorage(UserCacheArr);
}*/
var today = new Date().format('YYYYMMdd');
if (localStorage.getItem('Today')!==today) {
    localStorage.setItem('rankingList','');
    if (new Date().format('hhmm')*1>20) {
        clearlocalStorage(DailyCacheArr);
        localStorage.setItem('Today',today);
        paraArr.concat(DailyCacheArr);
    }
}
(function(){
    var k;
    for (var i = VerifyCacheArr.length - 1; i >= 0; i--) {
        k=VerifyCacheArr[i];
        if(localStorage.getItem(k)!=null&&!CacheData[k]){
            CacheData[k]=1;
        }
    }
    clearlocalStorage(UserNoCacheArr);
})()
function clearlocalStorage(arr){
    for (var i = arr.length - 1; i >= 0; i--) {
        localStorage.removeItem(arr[i]);
        if (CacheData[arr[i]]) {
            delete CacheData[arr[i]];
        }
    }
    localStorage.setItem('CacheData',JSON.stringify(CacheData));
}
function RenDataFilter(data){
    for(var k in data){
        if(data[k]==null){
            data[k]='';
        }
    }
    if (data.GradeList&&data.GradeList.length) {
        for (var i = data.GradeList.length - 1; i >= 0; i--) {
            data.GradeList[i].Grade=Number(data.GradeList[i].Grade);
            data.GradeList[i].GradeGrow=Number(data.GradeList[i].GradeGrow);
            data.GradeList[i].Bonus=Number(data.GradeList[i].Bonus);
            data.GradeList[i].JumpBonus=Number(data.GradeList[i].JumpBonus);
        }
    }
    var lotteryList = data.lotteryList;
    if (lotteryList) {
        if (lotteryList.length) {
            data.lotteryList = {};
            for (var i = lotteryList.length - 1; i >= 0; i--) {
                data.lotteryList[lotteryList[i].lotteryCode] = lotteryList[i]
                delete lotteryList[i].lotteryCode
            }
        } else {
            delete data.lotteryList;
        }
    }
    if(data.serviceRating){
        data.serviceRating.WithdrawTime=data.serviceRating.WithdrawTime*1;
        data.serviceRating.RechargeTime=data.serviceRating.RechargeTime*1;
        if(data.serviceRating.WithdrawTime<0) data.serviceRating.WithdrawTime=0;
        if(data.serviceRating.RechargeTime<0) data.serviceRating.RechargeTime=0;
    }
    if(data.lotteryConfig&&!data.lotteryConfig.length){
        delete data.lotteryConfig;
    }
    return data;
}
function RenDefault(data){
    ;(function(d){
        if (!d||d.State) {return}
        layer.open({
            shadeClose: false,
            title: "恭喜",
            content: '恭喜您成功晋级，当前等级为VIP'+d.Grade+'，<br/>赶紧到活动中心领取奖励吧。',
            className: "layerConfirm",
            btn: ["领取奖励", "留在本页"],
            end:function(){
                sessionStorage.setItem('UpGradeReaded',1);
            },
            yes: function(Lindex) {
                layer.close(Lindex);
                location.href = "/activity.html";
            }
        })
    })(data.UserUpGradeBonus)
    /*if (data.lotteryConfig) {
        for (var i = 0; i < data.lotteryConfig.length; i++) {
            if (data.lotteryConfig[i].LotteryClassID=="14") {
                (function(lotteryList){
                    function GetLotteryPlan(lottery_code) {
                      $.ajax({
                        data: {
                          Action: "GetLotteryPlan",
                          Qort: lottery_code
                        },
                      })
                      .done(function(data) {
                        if (data.Code === 1) {
                          localStorage.setItem("lotteryPlan"+lottery_code, JSON.stringify(data.Data));
                        }
                      })
                    }
                    function saveLotteryPlan(){
                      for (var i = lotteryList.length - 1; i >= 0; i--) {
                        if (!localStorage.getItem("lotteryPlan"+lotteryList[i])) {
                          GetLotteryPlan(lotteryList[i]);
                        }
                      }
                    }
                    saveLotteryPlan();
                })(data.lotteryConfig[i].lotteryList)
            }
        }
    }*/
    ;(function(F){
        if (F) {
            function LogOut(){
                $.ajax({
                    data: { action: "LogOut" },
                    async:false,
                    load:true,
                    success: function(data) {
                        if (data.Code == "1") {
                            alert(F);
                            location.href='/login.html'
                            /*layer.alert(F,{
                              end:function(){
                                location.href='/login.html'
                              }
                            })*/
                        } else {
                            LogOut();
                        }
                    }
                });
            }
            LogOut();
        }
    })(data.UserFreeze)
}
/**
 * [ajaxGetRenData 通过ajax去获取首屏数据,并进行缓存,如果有回调则执行回调函数]
 * @param  {[数组]} Arr        [需要获取的数据有哪些]
 * @param  {[函数]} fun        [得到数据后的处理方式]
 * @param  {int} time          [(可选),最多查询几次]
 * @return {[无]}
 */
function ajaxGetRenData(Arr, fun, time) {
    /*time = time || 0;
    time++;
    if (time == 2) {
        console.log("GetInitData error");
        return;
    } else if (time > 1) {
        console.log("GetInitData time " + time);
    }
    var url = '';
    var len = Arr.length,
        renderData = {},
        ajaxArr = [],
        ajaxData={
            "cacheData":localStorage.getItem('cacheData')
        };
    // console.log(ajaxData);
    for(var k in Arr){
        $.ajax({
            url:"/bet/lottery/"+Arr[k],
            data:ajaxData,
            dataType:"json",
            success: function(data) {
                if (data.code == 1||data.code == 0) {
            sessionStorage.setItem('NeedGetRenData',0);
                    var resultArr = RenDataFilter(data.backData);
                    for(var k in resultArr){
                        renderData[k] = resultArr[k];
                        //如果参数在paraArr数组中存在，才存储至localStorage，否则不存储
                        if ($.inArray(k, paraArr) > -1) {
                            if (data.cacheData&&data.cacheData[k]) {
                              CacheData[k]=data.cacheData[k];
                            }
                            if (typeof(resultArr[k])=='object') {
                            localStorage.setItem(k, JSON.stringify(resultArr[k]));
                            }else{
                            localStorage.setItem(k, resultArr[k]);
                            }
                        }
                    }
                    // console.log(CacheData);
                    localStorage.setItem('CacheData',JSON.stringify(CacheData));
                    RenDefault(resultArr);
                    fun(renderData);
                    /*if (data.Code!=localStorage.getItem('Login')) {
                        var newArr = UserCacheArr.concat(VerifyUserArr,UserNoCacheArr)
                      if (data.Code === 0) {
                        clearlocalStorage(newArr);
                      }else{
                        ajaxGetRenData(newArr,function(){});
                      }
                      localStorage.setItem('Login',data.Code);
                    }
                } else {
                    ajaxGetRenData(ajaxArr, fun, time);
                    console.log('返回数据错误');
                }
            }

        })
    }*/

}


/**
 * [getRenData 获取首屏渲染数据]
 * @param  {[数组]} Arr     [需要获取的数据有哪些]
 * @param  {[函数]} fun     [得到数据后的处理方式]
 * @return {[无]}
 * 调用方法：
 * getRenData(arr,function(renderData){
 *     console.log(renderData);
 * });
 */
function getRenData(Arr, fun) {
    var len = Arr.length,
        renderData = {},
        ajaxArr = [];
    for (var i = 0; i < len; i++) {
        if (localStorage.getItem(Arr[i])!==null) { //如果localStorage中有，则localStorage中获取
            try {
                renderData[Arr[i]] = JSON.parse(localStorage.getItem(Arr[i]));
            } catch (e) {
                renderData[Arr[i]] = localStorage.getItem(Arr[i]);
            }
        } else { //如果没有，把剩下的参数压入一个数组，用以ajax获取
            ajaxArr.push(Arr[i]);
        }
    }
    fun(renderData)

    if (ajaxArr.length) {
        ajaxGetRenData(ajaxArr, fun)
    } else {
        console.log("已全部缓存");
    }
}

function alwaysMid(value, total, min ,max){
    var t,rate = value/total;
    if(rate >= min && rate <= max){
        t = total;
    }else if(rate > max){
        t = value/max;
    }else if(rate > 0 && rate < min){
        t = value/min
    }else{
        t = total;
    }
    return Math.floor(t);
}

$(function() {
    /*new一个名片对象*/
    $('._personalInfo').attr('data-id', 0);
    var selfCard = new InfoCard([30,-100]);                //自己的名片卡,卡片出现位置和别的地方卡片不一样
    selfCard.bind($('.userName'), '._personalInfo');
    /*调用名片完结*/

    ;(function(){
        //确认导航位置
        var navIndex;
        if($(".slideUser").length){
            navIndex='navSecurityCenter';
        }else{
            switch(_Path.path.thisPath){
                case '/index.html':navIndex='navIndex';break;
                case '/lottery.html':navIndex='navLottery';break;
                case '/activity.html':navIndex='navActivity';break;
                case '/mobile.html':navIndex='navMobile';break;
                case '/helpcenter.html':navIndex='navHelp';break;
            }
        }
        navIndex&&$("#"+navIndex).addClass('curr');
    })()
    $('._no_paste').on('paste', function() { return false }) //禁用粘贴
    // document.body.oncontextmenu=function(){ return false;}  //全屏禁用右键

    /*顶部使用的下拉列表,显示金额 star*/
    hoverShow('.HoverShow','.HoverShowContent')
    $('#unreadMsgNum').hover(function(){
        $(this).attr('data-on',1);
        var ths = this;
        setTimeout(function(){
            if($(ths).attr('data-on')){
                $('.MessageShowContent').show()
            }
        },500)
    },function(){
        $(this).removeAttr('data-on');
        setTimeout(function(){
            if(!$('.MessageShowContent').attr('data-on')){
                $('.MessageShowContent').hide();
            }
        },500)
    })

    $('.MessageShowContent').hover(function(){
        $(this).attr('data-on',1);
    },function(){
        $(this).removeAttr('data-on').hide();
    })
    // hoverShow('#unreadMsgNum','.MessageShowContent')

    clickShow('.ShowMoney','.GetMoney')
    //点击隐藏
    $('.GetMoney i:last').on('click',function(){
        $('.ShowMoney').show();
        $('.GetMoney').hide();
    })
    //点击刷新公用头部的余额
    $('.GetMoney i.iconfont').on('click', function(){
        var self=this;
        self.className+=" refreshMove";
        setTimeout(function(){
            self.className = "iconfont";
        },500);
        getRenData(['userBalance'],function(renderData){
            var balance = renderData.userBalance;
            if(balance){
                $('.GetMoney em').text(balance);
            }
        })
    })
    /*顶部使用的下拉列表,显示金额 end*/

    ;(function(){
        var hasSafePwd; //是否有安全密码
        var firstCard;   //第一张银行卡信息
        var aboutArr;   //关于我们的列表
        var helpArr;    //新手教程的列表
        paraArr=UserName?paraArr.concat(UserNoCacheArr):paraArr;
        var _count = 0;
        // console.log(paraArr)
        getRenData(paraArr,function(renderData){
            if (UserName) {
                (function(d){
                    if (d&&d.length) {
                        d=d[0];
                        // console.log(d);
                        if (sessionStorage.getItem('dontLookOldNotive')==d.ID) {return;}
                        var NoticeBar = "<div class='notice'><div class='noticCon'>\
                    <h3>网站最新公告 <a class='iconfont closeNotice'>&#xe618;</a></h3>\
                    <ul><li><a class='MustLogin' href='NoticeDetail.html?id="+d.ID+"'><i></i>"+d.Title+"<br>["+d.Add_Time+"]</a></li>\
                    </ul></div></div>";
                        NoticeBar = $(NoticeBar);
                        NoticeBar.appendTo("body").find(".closeNotice").on("click",function(){
                            NoticeBar.remove();
                            sessionStorage.setItem('dontLookOldNotive',d.ID);
                        });
                    }
                })(renderData.NoticeData)
                ;(function(data){
                    if (!data) {return}
                    console.log(data);
                    var len=data.length,
                        lenNum=len>=5?"5+":len;
                    var dataArr=['<dt>\
                      <p>我的未读消息(<small>'+lenNum+'</small>)</p>\
                      <a href="letter.html">更多</a>\
                      </dt>\
                      <dd>'];
                    for(var i=0;i<len;i++){
                        var lidata=data[i];
                        dataArr.push('<p class="mList"><a href="letterDetail.html?id='+lidata.ID+'">'+lidata.Title+'</a></p>')
                    }
                    dataArr.push('</dd>');
                    $("#unreadMsgNum").text(lenNum);
                    $(".MessageShowContent dl").html(dataArr.join(''));
                })(renderData.UserUnread)
            }
            if (UserName&&renderData.UserPhoto) {
                $(".userName ").find("img").attr("src",_Path.Host.img+_Path.path.photos+renderData.UserPhoto);
            }
            /*帮助中心与关于我们start*/
            aboutArr = renderData.FooterConfig;
            helpArr = renderData.HelpConfig;
            if(aboutArr && aboutArr.length){
                var str = [];
                for(var i = 0; i < aboutArr.length;i++){
                    str.push('<a href="./about.html?' + aboutArr[i].ID + '">' +aboutArr[i].Title + '</a>');
                }
                $('._about p').eq(0).html(str.join('|'));
            }
            if(helpArr&&helpArr.length){
                var guide = document.getElementById("guide");
                if (guide) {
                    guide.href='/helpCenter.html?' + helpArr[0].ID;
                    guide.parentNode.style.display='block';
                    if (!UserName&&_Path.path.thisPath==='/index.html') {
                        $(".help").on('click',function(){
                            location.href=document.getElementById("guide").href;
                        })
                    }
                }
            }
            /*帮助中心与关于我们end*/
            (function(SiteConfig){
                if(!SiteConfig) return;
                var title = document.getElementsByTagName('title')[0],
                    tStr=title.innerText,
                    Name = SiteConfig.Name,
                    Service = SiteConfig.Service,
                    Logo = SiteConfig.PCLogo;
                if (Name) {
                    $(".siteName").html(Name);
                    var Hi = document.getElementById('Hi');
                    if(_Path.IsLottery){
                        Hi.href='/';
                    }else{
                        Hi.innerText="Hi，欢迎来到"+Name+"！";
                    }
                    var lottery = W_GetRequest().lottery;
                    if(lottery){
                        document.title = Name+'-'
                        getRenData(['lotteryList'],function(lotteryList){
                            lotteryList=lotteryList.lotteryList;
                            if(lotteryList){
                                lottery=lotteryList[lottery].LotteryName;
                                document.title = document.title+lottery
                            }
                        })
                    }else{
                        document.title = Name+'-'+tStr;
                    }
                }
                if (_Path.path.thisPath==='/index.html'&&SiteConfig.Title) {
                    document.title = SiteConfig.Title;
                }
                if (Logo) {
                    var L1= document.getElementById('Logo1');
                    if(L1){
                        L1.src=_Path.Host.img+Logo.logo1;
                        L1.style.display='block';
                    }
                    var L2= document.getElementById('Logo2');
                    if(L2){
                        L2.src=_Path.Host.img+Logo.logo2;
                        L2.style.display='block';
                    }
                }
                if (Service) {
                    $('.ServiceBtn').on('click', function(event) {
                        var h=window.screen.height-80,w=window.screen.width,t,l;
                        if (w<Service.Width) {Service.Width=w*0.9}
                        if (h<Service.Height) {Service.Height=h*0.9}
                        t= ( h-Service.Height)/2;
                        l= (w-Service.Width)/2;
                        window.open(Service.Url, '_blank', 'top='+t+',left='+l+',width='+Service.Width+',height='+Service.Height);
                    });
                }
            })(renderData.SiteConfig)
            if (renderData.AgentRebate) {
                $('.slideUser').find('ul:eq(3)').show();
                $('.accountList').find('a:gt(2)').show();
            }
            if(renderData.CloudUrl){
                $('#dafaCloud').attr({href:renderData.CloudUrl,target:"_blank"});
            }
            ;(function(data){
                if(!data)return;
                var arr = [{
                    now: 0,
                    finish: data.RechargeTime
                }, {
                    now: 0,
                    finish: data.WithdrawTime
                }];
                arr[0].max=Math.round(arr[0].finish*2/60)*60;
                arr[1].max=Math.round(arr[1].finish*2/60)*60;
                arr[0].max=arr[0].max||60;
                arr[1].max=arr[1].max||60;
                var duration=1500,Frames=24;
                var speed=100000/(duration*Frames),count=0,footBar=$(".footBar");
                var rBar = footBar.eq(0).find('span'),
                    wBar = footBar.eq(1).find('span'),
                    rTxt = footBar.eq(0).next().get(0),
                    wTxt = footBar.eq(1).next().get(0);
                var Inter = setInterval(function() {
                    count++;
                    var p = 100-Math.abs(100-count*speed);
                    arr[0].now = Math.round(p*arr[0].max/100);
                    arr[1].now = Math.round(p*arr[1].max/100);
                    if(count*speed>100){
                        if(arr[0].now<arr[0].finish){
                            arr[0].now=arr[0].finish
                        }
                        if(arr[1].now<arr[1].finish){
                            arr[1].now=arr[1].finish
                        }
                        if(arr[0].now==arr[0].finish&&arr[1].now==arr[1].finish){
                            clearInterval(Inter);
                        }
                    }
                    arr[0].minutes = Math.floor(arr[0].now/60)>0?Math.floor(arr[0].now/60)+"'":"";
                    arr[1].minutes = Math.floor(arr[1].now/60)>0?Math.floor(arr[1].now/60)+"'":"";
                    arr[0].seconds = arr[0].now%60>10?arr[0].now%60:"0"+arr[0].now%60;
                    arr[1].seconds = arr[1].now%60>10?arr[1].now%60:"0"+arr[1].now%60;
                    arr[0].text =[arr[0].minutes,arr[0].seconds];
                    arr[0].text=arr[0].text.join("");
                    arr[1].text =[arr[1].minutes,arr[1].seconds];
                    arr[1].text=arr[1].text.join("");
                    rBar.css('width',arr[0].now*100/arr[0].max+'%');
                    rTxt.innerText=arr[0].text;
                    wBar.css('width',arr[1].now*100/arr[1].max+'%');
                    wTxt.innerText=arr[1].text;
                },1000/Frames)
            })(renderData.serviceRating)
            //更多彩种
            ;(function(lotteryConfig){
                _count ++
                if(_count < 2){
                    var path = _Path.path.thisPath;
                    if(path === '/gamebet_cqssc.html'){
                        $('.gameBet').prepend('<table class="betMoreList"></table>')
                    }else{
                        $('.container.bet').prepend('<table class="betMoreList"></table>')
                    }

                    //更多彩种--显隐
                    $('.betNavMore').on('mouseenter', function(){
                        if($('.betMoreList').css('display') == 'none'){
                            $('.betNavMore').addClass('active')
                            $('.betMoreList').show();
                        }
                    });

                    var rData = {}; //用来渲染的数据

                    if(lotteryConfig){
                        getRenData(['lotteryList'],function(data){
                            var lConfig = lotteryConfig;
                            var lList = data.lotteryList;
                            var baseArr = lConfig.map(function(item){
                                item = item.lotteryClassName;
                                if(item === '热门')return;
                                return item;
                            })
                            // console.log(lConfig, lList)
                            baseArr.forEach(function(item){
                                lConfig.forEach(function(group){
                                    if(item === group.lotteryClassName){
                                        rData[item] = group.lotteryList.map(function(stuff){
                                            return {'code': stuff, 'name': lList[stuff].lotteryName, 'href': '/bet/lottery/'+stuff+'/index'}
                                        })
                                    }
                                })
                            })

                            actualRen();

                            function actualRen(){
                                var titleStr = '';
                                var bodyStr = '';
                                var table = {
                                    'k3': '快3',
                                    'ssc': '时时彩'
                                }
                                var type = table[path.replace(/\/lottery_(\w+).html/, '$1')];
                                var columnNum = [];

                                for(var item in rData){
                                    titleStr += '<th>' + item + '</th>';
                                    //是不是本彩种的
                                    if(item === type){
                                        var tdStr = '';
                                        rData[item].forEach(function(un){
                                            var name = un.name === '内蒙古快3' ? '内蒙快3' : un.name;
                                            tdStr += '<a class = "_selfMode" data = "' + un.code + '">' + name + '</a>';
                                        });
                                        bodyStr += '<td>' + tdStr + '</td>';
                                        columnNum.push(rData[item].length)
                                    }else{
                                        var tdStr = '';
                                        rData[item].forEach(function(un){
                                            var name = un.name === '内蒙古快3' ? '内蒙快3' : un.name;
                                            tdStr += '<a href = "' + un.href + '">' + name + '</a>'
                                        });
                                        bodyStr += '<td>' + tdStr + '</td>';
                                        columnNum.push(rData[item].length)
                                    }
                                }
                                //整个表格的渲染字符串
                                var str = '<tr>' + titleStr +'</tr>' + '<tr>' + bodyStr +'</tr>';
                                var $betList = $('.betMoreList');
                                $betList.html(str);

                                columnNum.forEach(function(item, index){
                                    var width = 33
                                    var col = Math.ceil(item/5);

                                    width += col * 60;
                                    if(col > 1){
                                        $betList.find('th:eq('+index+')').css('width', (width+1) + 'px');
                                    }
                                })

                                $betList.on('click', '._selfMode', function(){
                                    var code = this.getAttribute('data');
                                    $('.betNav li[data="'+code+'"]').trigger('click');
                                    $betList.hide();
                                }).on('mouseleave', function(){
                                    $('.betNavMore').removeClass('active');
                                    $betList.hide()
                                })
                            }
                        })
                    }

                }
            })(renderData.lotteryConfig)
            ;(function(level){
                level=level&&(level.Grade>2)
                if (level&&!_Path.IsLottery) {
                    $('.betNavMore').show().text("线路切换").css("color","#e4393c").attr('href','/Ping.html').addClass('pingLink').prev().show()
                }
            })(renderData.UserUpGradeBonus)
        })
    })()

    $('#toWithdraw').on('click', function(){
        ajaxGetRenData(['UserHasSafePwd','UserFirstCardInfo'],function(data){
            withdrawBtnCheck(data);
        })
    })

    $(".LoginOut").on("click", function() {
        $.ajax({
            data: { action: "LogOut" },
            load:true,
            success: function(data) {
                if (data.Code == "1") {
                    var CanPc = sessionStorage.getItem('CanPc');
                    sessionStorage.clear();
                    if(CanPc){
                        sessionStorage.setItem('CanPc',1);
                    }
                    localStorage.setItem('Login',0);
                    clearlocalStorage(UserCacheArr.concat(VerifyUserArr))       //清除缓存
                    window.location.href = "login.html";
                } else {
                    layer.msgWarn(data.StrCode);
                }
            }
        });
    })

    $(document).delegate(".MustLogin","click",function(e){
        if (!UserName) {
            e.preventDefault();
            layer.confirm('非常抱歉！您还未登录，请先登录。',{
                title:"温馨提示",
                shadeClose:true,
                btn:['立即登录','用户注册']
            },function(i){
                if (location.href.search('login')===-1) {
                    location.href="login.html";
                }else{
                    layer.close(i)
                }
            },function(){
                if (location.href.search('register')===-1) {
                    location.href="register.html";
                }
            })
        }
    }).on("click",".ClickShade",function(e){
        var $this=$(this);
        var off=$this.offset(),
            T=off.top,
            L=off.left,
            W=$this.outerWidth(),
            H=$this.outerHeight(),
            l=e.clientX+$(window).scrollLeft(),
            t=e.clientY+$(window).scrollTop();
        var Newdiv = $("<div>").css({
            position: "absolute",
            top:T,
            left:L,
            width:W,
            height:H,
            overflow:"hidden",
            "z-index":10
        }).appendTo('body');
        W=W>H?W:H;
        var bowen = $("<div>").css({
            position: "absolute",
            width:2*W,
            height:2*W,
            top:t-T-W,
            left:l-L-W,
            "border-radius": "100%",
            transform: "scale(.01)",
            transition:"transform .5s",
            background:"rgba(69,84,103,.2)"
        }).appendTo(Newdiv);
        setTimeout(function(){
            bowen.css({
                transform: "scale(1.414)"
            });
            setTimeout(function(){
                Newdiv.remove();
            },500)
        },100)
    })
    /* if (!localStorage.getItem('Difftime')) {
         getServerTime(function(serTime){
             localStorage.setItem('Difftime',new Date().getTime()-serTime+GMTdif);
         });
     }*/
    ;(function(){
        // 强制踩点功能
        if(UserName) return;
        var t = sessionStorage.getItem('NeedGetRenData');
        console.log(t);
        if (!t||t==4) {
            ajaxGetRenData(['CloudUrl'],function(){});
        }else{
            sessionStorage.setItem('NeedGetRenData',t*1+1);
        }
    })()
})

//刷新缓存数据
function refreshData(arr,fun){
    clearlocalStorage(arr);
    ajaxGetRenData(arr,fun)
}
function how2play(code){
    var h=window.screen.height-80,w=window.screen.width,t,l;
    var Ww=1040,Wh=h*0.9;
    if (w<Ww) {Ww=w*0.9}
    // if (h<Wh) {Wh=h*0.9}
    t= ( h-Wh)/2;
    l= (w-Ww)/2;
    window.open("/howtoplay.html?id="+code, '_blank', 'top='+t+',left='+l+',width='+Ww+',height='+Wh);
}
/*获取服务器时间*/
function getServerTime(fun) {
    $.ajax({
        url : "/bet/getServerTimeMillisecond",
        success:function(data){
            if (data.code === 1) {
                fun(Number(data.data[0]));
            } else {
                cantGetTime++;
                if (cantGetTime > 4) {
                    layer.msgWarn("因无法同步服务器时间,您将无法投注,请检查网络情况")
                } else {
                    getServerTime();
                }
            }
        }
    })
}