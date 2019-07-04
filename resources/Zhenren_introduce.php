<!DOCTYPE html>
<html lang="zh">
<head>
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/spin.css">
    <link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
    <script type="text/javascript" src="__JS__/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="__JS2__/bootstrap.min.js"></script>
    <script type="text/javascript" src="__JS2__/layer/layer.js"></script>
    <script type="text/javascript" src="__JS2__/spin.js"></script>
    <style type="text/css">

        .title{font-weight: bold;}
        .desc{font-size: 15px;height: 60%;overflow:hidden;}
        .trans{height: 200px;margin-top: 10px;}
        .trans li{list-style-type: none;width: 150px;display: inline-block;}
        .trans-user-info{height: 50px;}
        .trans-user-info>div{width: }
        .trans input{height: 30px;}
    </style>
</head>
<body>
    <div class="prd-cont">
        <div class="prd-desc">
            <div class="title">{$data['name']}介绍：</div>
            <div class="desc">{$data['desc']}</div>
        </div>
        <div class="trans">
            <div class="trans-user-info">
                <ul>
                    <li>余额:{$userinfo['balance']}</li>
                    <li>{$data['name']}余额：
                        <?php if($balance['code']){
                        echo $balance['balance'];
                        }else{echo '---';} ?></li>
                    <li></li>
                </ul>
            </div>
            <div>
                <div class="trans-in">
                    转入：<input type="number" name="trans_in" id="trans_in"  > <button class="btn" onclick="trans_money('in')">转入</button>
                    转出：<input type="number" name="trans_out" id="trans_out" > <button class="btn"  onclick="trans_money('out')">转出</button>
                </div>
                <div>
                    <if condition="$data['name'] eq 'BBIN'">
                        <a class="btn btn-primary" onclick="link_win('{:U('Zhenren/jump_url','game_type='.$data['name'])}')" >进入游戏</a>
                        <else/>
                        <if condition="$balance['code'] eq 1">
                            <button class="btn btn-primary" onclick="link_win('{$balance['login_url']}')" >进入游戏</button>
                            <else/>
                            <button class="btn btn-primary" onclick="link_win('')" >进入游戏</button>
                        </if>
                    </if>

                </div>
            </div>

        </div>
    </div>
    <div id="foo"></div>
<script type="text/javascript">


        function link_win(url) {
            if(url){
              window.open(url);
            }
            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
            parent.layer.close(index);  // 关闭layer
        }
        function trans_money(type) {
            var trans_point = 0;
            var msg = '';
            if(type=='in'){
                trans_point = $("#trans_in").val();
                msg = '您确定转入？';
            }else{
                trans_point = $("#trans_out").val();
                msg = '您确定转出？';
            }
            if(parseInt(trans_point)<=0){
                layer.msg('金额能为0或者小于0');
                return ;
            }
            layer.confirm(msg, {
                btn: ['确定','取消'] //按钮
            }, function(index){
                layer.close(index);
                ajax_submit_data(type,trans_point);
            }, function(index){
                layer.close(index);
            });
        }
        function ajax_submit_data(type,trans_point) {
            var spinner = undefined;
            $.ajax({
                url:"{:U('Zhenren/trans_point')}",
                data:{'type':type,'point':trans_point,'game_tp':'AG'},
                type:'post',
                dataType:'json',
                beforeSend: function () {
                    var option = {
                        lines: 9, // 花瓣数目
                        length: 1, // 花瓣长度
                        width: 10, // 花瓣宽度
                        radius: 15, // 花瓣距中心半径
                        shadow: true,
                        opacity:1/8
                    };
                    var target = document.getElementById('foo');
                    spinner = new Spinner(option).spin(target);//显示加载
                },
                success:function (res) {
                    if(res != null){
                        layer.msg(res.msg);
                    }
                },complete: function () {
                    spinner.spin();//移除加载
                },error:function (a,b,c) {
                    console.log(a.responseText);
                    layer.msg('网页开小差了，请联系管理员！');
                }
            })
        }
</script>
</body>
</html>
