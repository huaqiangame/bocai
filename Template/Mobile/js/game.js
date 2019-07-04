window.onload = function (){
    var oM_btn = document.getElementById('menu-btn');
    var oM_vc = document.getElementById('vc');
    var oM_Li = oM_vc.getElementsByTagName('li');
    var oM_Img = oM_vc.getElementsByTagName('img');
    var oGameList = document.getElementsByClassName('game_list')[0];
    var oG_Li = oGameList.getElementsByTagName('li');
    var oNn = document.getElementById('btn-c');
    var oNc = document.getElementById('btn-y');
    var oSearchTxt = document.getElementById('search-txt');
    var oSearchBtn = document.getElementById('search-btn');
    var oBannerGame = document.getElementsByClassName('banner-game')[1];
    var oA = oBannerGame.getElementsByTagName('a');

    document.getElementById('game_length_all').innerHTML = oG_Li.length;

    //nav
    // for(var i=0;i<oA.length;i++){
    //     oA[i].onclick = function(){
    //         for(var i=0;i<oA.length;i++){
    //             oA[i].className = '';
    //             this.className = 'txt-clr';
    //         }
    //     }
    // }
    //search
    oSearchBtn.onclick = function(){
        if(oSearchTxt.className == ''){
            oSearchTxt.className = 'wir-box';
        } else {
            oSearchTxt.className = '';
        }
    };
    //menu
    oM_btn.onmouseover = function(){
        this.className = 'menu-btn';
        oM_vc.className = 'vc';
    };

    oM_vc.onmouseover = function(){
        oM_btn.className = 'menu-btn';
        this.className = 'vc';
    };

    oM_btn.onmouseout = function(){
        this.className = '';
        oM_vc.className = '';
    };

    oM_vc.onmouseout = function(){
        this.className = '';
        oM_btn.className = '';
    };
    for(var i=0;i<oM_Li.length;i++){
        oM_Li[i].index = i;
        oM_Li[i].onclick = function(){

            var type_name = this.getAttribute('type_name');

            for(var i=0;i<oM_Img.length;i++){
                oM_Img[i].className = '';
                oM_Img[this.index].className = 'active-inco';
            }

            //````````````````````````````````````````````````
            var len = oG_Li.length;
            for(var i=0;i<oG_Li.length;i++){
                oG_Li[i].style.display = 'list-item';

                var game_type = oG_Li[i].getAttribute('game_type').split(",");
                
                if($.inArray(type_name,game_type) < 0){
                    --len;
                    oG_Li[i].style.display = 'none';
                }

                oG_Li[i].className = 'changeStyle';
            }

            if(type_name != '全部游戏'){
                document.getElementById('game_type_name').innerHTML = ') > ' + type_name + ' (';
                document.getElementById('game_type_name').style.display = 'block';
                document.getElementById('game_type_num').innerHTML = len;
                document.getElementById('game_type_num').style.display = 'block';
            }else{
                document.getElementById('game_type_name').style.display = 'none';
                document.getElementById('game_type_num').style.display = 'none';
            }

            this.className = 'active-txt';
            oNn.className = '';

            var h = document.documentElement.scrollTop || document.body.scrollTop;
            window.scrollTo(h, h + 1);
            //``````````````````````````````````````````````
        }
    }

    //games 效果
    oNn.addEventListener("click", function(){
        for(var i=0;i<oG_Li.length;i++){
            if(oNn.className == ''){
                oG_Li[i].className = 'li_list'+' '+'changeStyle';

            }
        }
        this.className = 'active-txt';
        oNc.className = '';
    }, false);

    oNc.addEventListener("click", function(){
        for(var i=0;i<oG_Li.length;i++){
            if(oNc.className == ''){
                oG_Li[i].className = 'changeStyle';

            }
        }
        this.className = 'active-txt';
        oNn.className = '';
    }, false);
    i = i-1;
    oG_Li[i].addEventListener("webkitAnimationEnd", function(){
        for(var i=0;i<oG_Li.length;i++){
            if(oNn.className != ''){
                oG_Li[i].className = 'li_list';
            } else {
                oG_Li[i].className = ' ';
            }
        }
    }, false);
};












function godle(){
    var oM_btn = document.getElementById('menu-btn');
    var oM_vc = document.getElementById('vc');
    var oM_Li = oM_vc.getElementsByTagName('li');
    var oM_Img = oM_vc.getElementsByTagName('img');
    var oGameList = document.getElementsByClassName('game_list')[0];
    var oG_Li = oGameList.getElementsByTagName('li');
    var oNn = document.getElementById('btn-c');
    var oNc = document.getElementById('btn-y');
    var oSearchTxt = document.getElementById('search-txt');
    var oSearchBtn = document.getElementById('search-btn');
    var oBannerGame = document.getElementsByClassName('banner-game')[1];
    var oA = oBannerGame.getElementsByTagName('a');

    document.getElementById('game_length_all').innerHTML = oG_Li.length;

    //nav
    // for(var i=0;i<oA.length;i++){
    //     oA[i].onclick = function(){
    //         for(var i=0;i<oA.length;i++){
    //             oA[i].className = '';
    //             this.className = 'txt-clr';
    //         }
    //     }
    // }
    //search
    oSearchBtn.onclick = function(){
        if(oSearchTxt.className == ''){
            oSearchTxt.className = 'wir-box';
        } else {
            oSearchTxt.className = '';
        }
    };
    //menu
    oM_btn.onmouseover = function(){
        this.className = 'menu-btn';
        oM_vc.className = 'vc';
    };

    oM_vc.onmouseover = function(){
        oM_btn.className = 'menu-btn';
        this.className = 'vc';
    };

    oM_btn.onmouseout = function(){
        this.className = '';
        oM_vc.className = '';
    };

    oM_vc.onmouseout = function(){
        this.className = '';
        oM_btn.className = '';
    };
    for(var i=0;i<oM_Li.length;i++){
        oM_Li[i].index = i;
        oM_Li[i].onclick = function(){

            var type_name = this.getAttribute('type_name');

            for(var i=0;i<oM_Img.length;i++){
                oM_Img[i].className = '';
                oM_Img[this.index].className = 'active-inco';
            }

            //````````````````````````````````````````````````
            var len = oG_Li.length;
            for(var i=0;i<oG_Li.length;i++){
                oG_Li[i].style.display = 'list-item';

                var game_type = oG_Li[i].getAttribute('game_type').split(",");
                
                if($.inArray(type_name,game_type) < 0){
                    --len;
                    oG_Li[i].style.display = 'none';
                }

                oG_Li[i].className = 'changeStyle';
            }

            if(type_name != '全部游戏'){
                document.getElementById('game_type_name').innerHTML = ') > ' + type_name + ' (';
                document.getElementById('game_type_name').style.display = 'block';
                document.getElementById('game_type_num').innerHTML = len;
                document.getElementById('game_type_num').style.display = 'block';
            }else{
                document.getElementById('game_type_name').style.display = 'none';
                document.getElementById('game_type_num').style.display = 'none';
            }

            this.className = 'active-txt';
            oNn.className = '';

            var h = document.documentElement.scrollTop || document.body.scrollTop;
            window.scrollTo(h, h + 1);
            //``````````````````````````````````````````````
        }
    }


    //games 效果
    oNn.addEventListener("click", function(){
        for(var i=0;i<oG_Li.length;i++){
            if(oNn.className == ''){
                oG_Li[i].className = 'li_list'+' '+'changeStyle';

            }
        }
        this.className = 'active-txt';
        oNc.className = '';
    }, false);

    oNc.addEventListener("click", function(){
        for(var i=0;i<oG_Li.length;i++){
            if(oNc.className == ''){
                oG_Li[i].className = 'changeStyle';

            }
        }
        this.className = 'active-txt';
        oNn.className = '';
    }, false);
    i = i-1;
    oG_Li[i].addEventListener("webkitAnimationEnd", function(){
        for(var i=0;i<oG_Li.length;i++){
            if(oNn.className != ''){
                oG_Li[i].className = 'li_list';
            } else {
                oG_Li[i].className = ' ';
            }
        }
    }, false);
};