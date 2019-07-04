var userid = $("#userid").val();
var cdndomain = $("#CDNDomain").val();
var protocol = location.protocol.replace(':', '');
var host = location.host;
var port = location.port;
/*if (host == "localhost:22222") {
    host = "localhost";
}*/
if ((protocol != "" || protocol != null) && port != "80" && port != "8080" && port != "2566") {
    var hosturl = protocol + "://" + host + ":" + port + "/";
} else {
    var hosturl = protocol + "://" + host + "/";
}
function getapi(name) {
    var url;
    var gameurl = {
        "MG": "Mobile/Gamelist?type=0",
        "AE": "Mobile/Gamelist?type=5",
        "CQ9": "Mobile/GBlist",
        "GPI": "Mobile/Gamelist?type=2",
        "HB": "Mobile/Gamelist?type=3",
        "DT": "Mobile/Gamelist?type=4",
        "BBINDZ": "Mobile/Gamelist?type=6",
        "QT": "Mobile/Gamelist?type=7",
        "PS": "Mobile/Gamelist?type=8",
        "SG": "Mobile/Gamelist?type=9",
        "FG": "Mobile/Gamelist?type=10",
        "AG": "Mobile/Gamelist?type=11"
    }
    if (name in gameurl) {
        var gurl = gameurl[name];
    }
    url = hosturl + gurl;
    return url;
}
function getname(name) {
    var gamename = {
        "MG": "MG",
        "AE": "AMB",
        "CQ9": "CQ9",
        "GPI": "GPI",
        "HB": "HB",
        "DT": "DT",
        "QT": "QT",
        "BBINDZ": "BBINDZ",
        "PS": "PS",
        "SG": "SG",
        "FG": "FG",
        "AG": "AG"
    }
    if (name in gamename) {
        var gname = gamename[name];
    }
    return gname;
}
function getimgname(name) {
    var imgname = {
        "MG": "mg",
        "AE": "amb",
        "CQ9": "gb",
        "GPI": "gp",
        "HB": "hb",
        "DT": "dt",
        "QT": "qt",
        "BBINDZ": "bbin",
        "PS": "ps",
        "SG": "sg",
        "FG": "fg",
        "AG": "ag"
    }
    if (name in imgname) {
        var iname = imgname[name];
    }
    return iname;
}
function getimgtype(name, str) {
    var imgtype = {
        "MG": "",
        "AE": ".png",
        "CQ9": ".png",
        "GPI": ".jpg",
        "HB": ".jpg",
        "DT": ".png",
        "QT": ".png",
        "BBINDZ": ".png",
        "PS": ".png",
        "SG": ".png",
        "FG": ".png",
        "AG": ".png"

    }
    if (str.indexOf(".") > 0) {
        return str;
    } else {
        if (name in imgtype) {
            var itype = imgtype[name];
        }
        return str + itype;
    }
}
function isElementInViewport(el) {
    var rect = el[0].getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /*or $(window).height() */
        rect.right <= (window.innerWidth || document.documentElement.clientWidth) /*or $(window).width() */
    );
}
function getGameList(name) {
    $(".AppSlot-gamelist").html("");
    var gamedata = [];
    // var gbgamecn = [{ 1: "钻石水果王", 2: "棋圣", 3: "血之吻", 4: "森林泰后", 5: "金大款", 6: "1945", 7: "跳起来", 8: "甜蜜蜜", 9: "钟馗运财", 10: "五福临门", 11: "梦游仙境2", 12: "金玉满堂", 13: "樱花妹子", 14: "绝赢巫师", 15: "金鸡报喜", 16: "五行", 17: "祥狮献瑞", 18: "雀王", 19: "风火轮", 20: "发发发", 21: "野狼传说", 22: "庶务西游二课", 23: "金元宝", 24: "跳起来2", 25: "扑克拉霸", 26: "777", 27: "魔法世界", 28: "食神", 29: "水世界", 30: "三国序", 31: "武圣", 32: "通天神探狄仁杰", 33: "火烧连环船", 34: "地鼠战役", 35: "疯狂哪吒", 36: "夜店大亨", 37: "", 38: "舞力全开", 39: "飞天", 40: "镖王争霸", 41: "水球大战", 42: "福尔摩斯", 43: "恭贺新禧", 44: "豪华水果王", 45: "超级发", 46: "狼月", 47: "法老宝藏", 48: "莲", 49: "寂寞星球", 50: "鸿福齐天", 51: "嗨爆大马戏", 52: "跳高高", 53: "来电99", 54: "火爆草泥马", 55: "魔龙传奇", 56: "黯夜公爵", 57: "神兽争霸", 58: "金鸡报喜2", 59: "夏日猩情", 60: "丛林舞会", 61: "天天吃豆", 62: "非常钻", 63: "寻龙诀", 64: "宙斯", 65: "足球世界杯", 66: "火爆777", 67: "赚金蛋", 68: "悟空偷桃", 69: "发财神", 70: "万饱龙", 71: "摆脱", 72: "好运年年", 74: "聚宝盆", 75: "金宝熊", 77: "火凤凰", 78: "阿波罗", 79: "变色龙", 80: "传奇海神", 81: "金银岛", 83: "火之女王", 84: "奇幻魔术", 85: "牛牛抢红包", 86: "牛逼快跑", 87: "集电宝", 88: "金喜鹊桥", 89: "雷神", 92: "2018世界杯", 93: "世界杯明星", 94: "世界杯球衣", 95: "世界杯球鞋", 96: "足球宝贝", 97: "世界杯球场", 98: "世界杯全明星", 99: "跳更高", 100: "宾果消消消", 101: "星星消消乐", 102: "水果派对", 103: "宝石配对", 104: "海滨消消乐", 105: "单手跳高高", 106: "横转跳高高", 201: "拳霸", 202: "舞媚娘", 203: "嗨起来", 204: "百宝箱", 205: "蹦迪", 1010: "五福临门", 1067: "赚金蛋", 1074: "聚宝盆", "AA301": "战西游", "AB1": "皇金渔场2", "AB3": "皇金渔场", 108: "直式跳更高", 109: "单手跳起来", 110: "横转跳起来", 119: "飞单跳起来", 120: "飞单跳高高", 221: "狄仁杰之四大天王" }];
    var datacookie = sessionStorage.getItem(name + "Mdata");
    if (datacookie == null || datacookie == "[]") {
        var apiurl = "/Index.game_list.line." + name + ".do";
        $.ajax({
            type: 'POST',
            url: apiurl,
            dataType: 'json',
            async: false,
            xhrFields: {withCredentials: true},
            success: function (data) {
                var gdata = data.data;
                if (data != null) {
                    $.each(gdata, function (k, v) {
                        var str = JSON.stringify(v);
                        sessionStorage.setItem(k + "Mdata", str);
                    });
                }
            }, error: function (data) {
                var erromsg = data.msg;
                $(document).dialog({
                    type: 'notice',
                    infoText: name + "电子临时维护中，请稍后再试！",
                    autoClose: 1500,
                    position: 'center'
                });
            }
        });
    } else {
        var storage_data = sessionStorage.getItem(name + "Mdata");
         gamedata = $.parseJSON(storage_data);
    }
    var filterhtml = "";
    var htmls = "";
    var gtoname = getname(name);
    var picname = getimgname(name);
    var a = [];
    $.each(gamedata, function (i) {
        var gameid = '';
        var picurl = '';
        var gametitle = '';
        var gametypeid = '';
        gameid = i;
        picurl = '../resources/images/real_person/game_images/' + name + "/" + gamedata[i]['img'];
        gametitle = gamedata[i].name;
        gametypeid = gamedata[i].typeid;
     //   http://m.lt.com/
        htmls += '<a href="/Zhenren.jump_url.game_type.'+name+'.page.egame.do?game_num='+gameid+'"  target="_blank" class="gameitem">';
        htmls += '<span class="gameicon ' + name + '" data-picurl="' + picurl + '"></span>';
        htmls += '<span class="gametitle">' + gametitle + '</span></a>';
        /*if (a.indexOf(gametypeid) == -1) {
            a.push(gametypeid);
        }*/
    });

    filterhtml += '<div class="filter-btn">';
    filterhtml += '<a class="active" onclick="typegame(\'' + name + '\',\'全部\')">全部</a>';
    filterhtml += '<a onclick="typegame(\'' + name + '\',\'热门\')">热门</a>';
    filterhtml += '<a onclick="typegame(\'' + name + '\',\'最新\')">最新</a>';
    filterhtml += '<a class="more">更多<span class="icon-more-down">';
    filterhtml += '<svg class="icon" aria-hidden="true">';
    filterhtml += '<use xlink:href="#icon-more-down"></use>';
    filterhtml += '</svg>';
    filterhtml += '</span><span class="icon-more-up">';
    filterhtml += '<svg class="icon" aria-hidden="true">';
    filterhtml += '<use xlink:href="#icon-more-up"></use>';
    filterhtml += '</svg>';
    filterhtml += '</span>';
    filterhtml += '<ul class="morebtn">';
 /*   if (name == "CQ9") {
        $.each(a, function (i) {
            if (a[i] == "fish") {
                filterhtml += '<li onclick="typegame(\'' + name + '\',\'' + a[i] + '\')">捕鱼机</li>';
            }
            if (a[i] == "slot") {
                filterhtml += '<li onclick="typegame(\'' + name + '\',\'' + a[i] + '\')">老虎机</li>';
            }
        });
    } else {*/
        $.each(a, function (i) {
            filterhtml += '<li onclick="typegame(\'' + name + '\',\'' + a[i] + '\')">' + a[i] + '</li>';
        });
    //}

    filterhtml += '</ul>';
    filterhtml += '</a>';
    filterhtml += '</div>';
    filterhtml += '<div class="filter-search">';
    filterhtml += '<div class="search">';
    filterhtml += '<input class="searchinput" type="text" name="seachname" id="seachname" maxlength="16" placeholder="请输入游戏名称">';
    filterhtml += '<span class="icon-search">';
    filterhtml += '<svg class="icon" aria-hidden="true">';
    filterhtml += '<use xlink:href="#icon-sousuo"></use>';
    filterhtml += '</svg>';
    filterhtml += '</span>';
    filterhtml += '</div>';
    filterhtml += '</div>';
    $(".AppSlot-gamelist").html(htmls);
    $(".AppSlot-filter").html("");
    $(".AppSlot-filter").html(filterhtml);

    loadimg();
    window.onscroll = function () {
        loadimg()
        if ($(this).scrollTop() > 300) {
            $("#fhdb").fadeIn(700);
        } else {
            $("#fhdb").fadeOut(700);
        }
    }
    $(".icon-search").click(function () {
        var gamename = name;
        var seachname = $("#seachname").val();
        searchgame(gamename, seachname);
    });
    $(".filter-btn a").each(function () {
        $(this).click(function () {
            if (!$(this).hasClass('more')) {
                $(".morebtn li").removeClass('on');
            }
            $(".filter-btn a").removeClass('active');
            $(this).addClass('active');
        });
    });
    $(".morebtn li").each(function () {
        $(this).click(function () {
            $(".morebtn li").removeClass('on');
            $(this).addClass('on');
        });
    });
    var flag = 0;
    $(".more").click(function () {
        if (flag == 0) {
            flag = 1;
            $(".icon-more-down").hide();
            $(".icon-more-up").show();
            $(".morebtn").slideDown();
        } else {
            flag = 0;
            $(".icon-more-down").show();
            $(".icon-more-up").hide();
            $(".morebtn").slideUp();
        }
    });
}
function typegame(name, value) {
    var gamedata = sessionStorage.getItem(name + "Mdata");
    if (gamedata == null) {
        $(document).dialog({
            type: 'notice',
            infoText: name + "数据异常，请刷新后再试，如未解决请联系客服！",
            autoClose: 1500,
            position: 'center'
        });
        return false;
    }
     gamedata = $.parseJSON(gamedata);


    var htmls = "";
    var gtoname = getname(name);
    var picname = getimgname(name);
    if (value == "全部") {
        $.each(gamedata, function (i) {
            var gameid = '';
            var photourl = '';
            var gametitle = '';
            var gametypeid = '';


            gameid = gamedata[i].real;
            photourl = getimgtype(name, gamedata[i].ButtonImagePath);
            gametitle = gamedata[i].name;
            gametypeid = gamedata[i].typeid;
            htmls += '<a href="' + hosturl + 'Mobile/GotoGame?GameType=' + gtoname + '&uid=' + userid + '&gameid=' + gameid + '"   target="_blank" class="gameitem">';
            htmls += '<span class="gameicon ' + name + '" data-picurl="' + cdndomain + '/cl/tpl/GameList/images/' + picname + '/' + photourl + '"></span>';
            htmls += '<span class="gametitle">' + gametitle + '</span></a>';
        });
        $(".AppSlot-gamelist").html("");
        $(".AppSlot-gamelist").html(htmls);
    }
    else if (value == "最新") {
        $.each(gamedata, function (i) {
            var gameid = '';
            var photourl = '';
            var gametitle = '';
            var gametypeid = '';

            if (name == "CQ9") {
                gamedata = gamedata.sort(getSortFun('asc', 'gamecode'));
                gameid = gamedata[i].gamecode + "_" + gamedata[i].gamehall + "_mobile_" + gamedata[i].gametech + "_" + gamedata[i].gametype;
                photourl = getimgtype(name, gamedata[i].gamecode);
                gametitle = gamedata[i].gamecn;
                gametypeid = gamedata[i].gametype;
            } else {
                gamedata = gamedata.sort(getSortFun('asc', 'Id'));
                gameid = gamedata[i].real;
                photourl = getimgtype(name, gamedata[i].ButtonImagePath);
                gametitle = gamedata[i].DisplayName;
                gametypeid = gamedata[i].typeid;
            }
            htmls += '<a href="' + hosturl + 'Mobile/GotoGame?GameType=' + gtoname + '&uid=' + userid + '&gameid=' + gameid + '"  target="_blank" class="gameitem">';
            htmls += '<span class="gameicon ' + name + '" data-picurl="' + cdndomain + '/cl/tpl/GameList/images/' + picname + '/' + photourl + '"></span>';
            htmls += '<span class="gametitle">' + gametitle + '</span></a>';
        });
        $(".AppSlot-gamelist").html("");
        $(".AppSlot-gamelist").html(htmls);

    }
    else if (value == "热门") {
        $.each(gamedata, function (i) {
            var gameid = '';
            var photourl = '';
            var gametitle = '';
            var gametypeid = '';

            if (name == "CQ9") {
                gameid = gamedata[i].gamecode + "_" + gamedata[i].gamehall + "_mobile_" + gamedata[i].gametech + "_" + gamedata[i].gametype;
                photourl = getimgtype(name, gamedata[i].gamecode);
                gametitle = gamedata[i].gamecn;
                gametypeid = gamedata[i].gametype;
            } else {
                gamedata = gamedata.sort(getSortFun('asc', 'HotOrder'));
                gameid = gamedata[i].real;
                photourl = getimgtype(name, gamedata[i].ButtonImagePath);
                gametitle = gamedata[i].DisplayName;
                gametypeid = gamedata[i].typeid;
            }
            htmls += '<a href="' + hosturl + 'Mobile/GotoGame?GameType=' + gtoname + '&uid=' + userid + '&gameid=' + gameid + '"   target="_blank" class="gameitem">';
            htmls += '<span class="gameicon ' + name + '" data-picurl="' + cdndomain + '/cl/tpl/GameList/images/' + picname + '/' + photourl + '"></span>';
            htmls += '<span class="gametitle">' + gametitle + '</span></a>';
        });
        $(".AppSlot-gamelist").html("");
        $(".AppSlot-gamelist").html(htmls);
    } else {
        if (name == "CQ9") {
            $.each(gamedata, function (i) {
                if (this.gametype == value) {
                    htmls += '<a href="' + hosturl + 'Mobile/GotoGame?GameType=' + gtoname + '&uid=' + userid + '&gameid=' + gamedata[i].gamecode + '_' + gamedata[i].gamehall + '_mobile_' + gamedata[i].gametech + '_' + gamedata[i].gametype + '"     target="_blank" class="gameitem">';
                    htmls += '<span class="gameicon ' + name + '" data-picurl="' + cdndomain + '/cl/tpl/GameList/images/' + picname + '/' + getimgtype(name, gamedata[i].gamecode) + '"></span>';
                    htmls += '<span class="gametitle">' + gamedata[i].gamecn + '</span></a>';
                }
            });
        } else {
            $.each(gamedata, function (i) {
                if (this.typeid == value) {
                    htmls += '<a href="' + hosturl + 'Mobile/GotoGame?GameType=' + gtoname + '&uid=' + userid + '&gameid=' + gamedata[i].real + '"    target="_blank" class="gameitem">';
                    htmls += '<span class="gameicon ' + name + '" data-picurl="' + cdndomain + '/cl/tpl/GameList/images/' + picname + '/' + getimgtype(name, gamedata[i].ButtonImagePath) + '" ></span>';
                    htmls += '<span class="gametitle">' + gamedata[i].DisplayName + '</span></a>';
                }
            });
        }

        $(".AppSlot-gamelist").html("");
        $(".AppSlot-gamelist").html(htmls);
    }
    loadimg()
}
function searchgame(name, value) {
    var gamedata = sessionStorage.getItem(name + "Mdata");
    if (gamedata == null) {
        $(document).dialog({
            type: 'notice',
            infoText: name + "数据异常，请刷新后再试，如未解决请联系客服！",
            autoClose: 1500,
            position: 'center'
        });
        return false;
    }
    gamedata = $.parseJSON(gamedata);
    var htmls = "";
    var gtoname = getname(name);
    var picname = getimgname(name);

    $.each(gamedata, function (i) {
        if (name == "CQ9") {
            if (this.gamecn.indexOf(value) >= 0 || this.gamename.toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                htmls += '<a href="' + hosturl + 'Mobile/GotoGame?GameType=' + gtoname + '&uid=' + userid + '&gameid=' + gamedata[i].gamecode + '_' + gamedata[i].gamehall + '_mobile_' + gamedata[i].gametech + '_' + gamedata[i].gametype + '"   target="_blank"  class="gameitem">';
                htmls += '<span class="gameicon ' + name + '" data-picurl="' + cdndomain + '/cl/tpl/GameList/images/' + picname + '/' + getimgtype(name, gamedata[i].gamecode) + '" ></span>';
                htmls += '<span class="gametitle">' + gamedata[i].gamecn + '</span></a>';
            }
        } else {
            if (this.DisplayName.indexOf(value) >= 0 || this.EnglishName.toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                htmls += '<a href="' + hosturl + 'Mobile/GotoGame?GameType=' + gtoname + '&uid=' + userid + '&gameid=' + gamedata[i].real + '"  target="_blank" class="gameitem">';
                htmls += '<span class="gameicon ' + name + '" data-picurl="' + cdndomain + '/cl/tpl/GameList/images/' + picname + '/' + getimgtype(name, gamedata[i].ButtonImagePath) + '"></span>';
                htmls += '<span class="gametitle">' + gamedata[i].DisplayName + '</span></a>';
            }
        }

    });
    if (htmls == "") {
        $(document).dialog({
            type: 'notice',
            infoText: "对不起，没有找到匹配的游戏！",
            autoClose: 1500,
            position: 'center'
        });
        return false;
    }
    $(".AppSlot-gamelist").html("");
    $(".AppSlot-gamelist").html(htmls);
    loadimg()
}

function loadimg() {
    $(".AppSlot-gamelist a").each(function () {
        if (isElementInViewport($(this).find(".gameicon"))) {
            if ($(this).attr("style") == undefined) {
                var purl = $(this).find(".gameicon").data("picurl");
                $(this).find(".gameicon").css("background-image", "url('" + purl + "')");
            }
        }
    });
}
function getSortFun(order, sortBy) {
    var ordAlpah = (order == 'asc') ? '>' : '<';
    var sortFun = new Function('a', 'b', 'return a.' + sortBy + ordAlpah + 'b.' + sortBy + '?1:-1');
    return sortFun;
}
function cut(arr, c) {
    var list = [], a = [];
    for (var i = 0; i < arr.length; i++) {
        if (i % c == 0) {
            a = [];
            list.push(a);
        }
        a.push(arr[i]);
    }
    return list;
}
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) c_end = document.cookie.length;
            return decodeURI(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}
function setCookie(name, value, path, expiresHours) {
    var cookieString = name + "=" + escape(value);
    if (path && path != "")
        cookieString = cookieString + "; path=" + path;
    else
        cookieString = cookieString + "; path=/";
    if (expiresHours && expiresHours > 0) {
        var date = new Date();
        date.setTime(date.getTime + expiresHours * 3600 * 1000);
        cookieString = cookieString + "; expires=" + date.toGMTString();
    } else {
        var date = new Date();
        date.setFullYear(date.getFullYear() + 1);
        cookieString = cookieString + "; expires=" + date.toGMTString();
    }
    document.cookie = cookieString;
}