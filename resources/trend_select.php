<script>
    var lotteryname = "{$lotteryname}";
    function MM_jumpMenu(targ,selObj,restore){ //v3.0
        if(selObj.options[selObj.selectedIndex].value){
            eval(targ+".location='__ROOT__"+selObj.options[selObj.selectedIndex].value+"'");
            if (restore) selObj.selectedIndex=0;
        }
    }
    $(function(){
        selectlettery();
    });
    function selectlettery(){
        if(!lotterylist){
            return false;
        }
        if(lotterylist.length>0){
            var opts = '';
            for(var o in lotterylist){
                var selected = '';
                if(lotteryname==lotterylist[o].name){
                    selected = 'selected';
                }
                console.log(lotterylist)
                if(lotterylist[o].name.indexOf("k3")>1){
                    opts += '<option '+selected+' value="/Trend.trend_k3.code.'+lotterylist[o].name+'">'+lotterylist[o].title+'</option>';
                }else if(lotterylist[o].name.indexOf("ssc")>1){
                    opts += '<option '+selected+' value="/Trend.trend_ssc.code.'+lotterylist[o].name+'">'+lotterylist[o].title+'</option>';
                }else if(lotterylist[o].name.indexOf("x5")>1){
                    opts += '<option '+selected+' value="/Trend.trend_x5.code.'+lotterylist[o].name+'">'+lotterylist[o].title+'</option>';
                }else if(lotterylist[o].name.indexOf("pk10")>1){
                    opts += '<option '+selected+' value="/Trend.trend_pk10.code.'+lotterylist[o].name+'">'+lotterylist[o].title+'</option>';
                }else if(lotterylist[o].name.indexOf("keno")>1){
                    opts += '<option '+selected+' value="/Trend.trend_keno.code.'+lotterylist[o].name+'">'+lotterylist[o].title+'</option>';
                }else if(lotterylist[o].name =='pl3' || lotterylist[o].name =='fc3d'){
                    opts += '<option '+selected+' value="/Trend.trend_dpc.code.'+lotterylist[o].name+'">'+lotterylist[o].title+'</option>';
                }else if(lotterylist[o].name=='lhc' || lotterylist[o].name=='dflhc' ){
                    opts += '<option '+selected+' value="/Trend.trend_lhc.code.'+lotterylist[o].name+'">'+lotterylist[o].title+'</option>';
                }
            };
            $("#selectlettery").html(opts);
        }
    }

</script>