<include file="Public/headermember" />
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/bankCard.css">
    <link rel="stylesheet" href="__CSS2__/userInfo.css">
	 <link rel="stylesheet" href="__CSS2__/reset.css">
<style>
    .input-text{
        border: 1px solid #ccc;
    }
    .checked{
        border: 1px solid #4aa9db !important;
    }
    .bankcard_item .bank_middle{
        height: 59px;
    }
    .r_right {
        position: absolute;
        width: 0px;
        height: 0px;
        bottom: 0;
        right: 0;
        font-size: 12px;
        border-bottom: 20px solid #4aa9db;
        border-left: 20px solid transparent;
        display: none;
    }
    .r_right .r_right_con {
        position: absolute;
        font-size: 14px;
        color: #fff;
        top: 1px;
        right: 0px;
    }
    .default_bank_text{
        height: 24px;
    }
</style>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
    <include file="Member/side" />
    <div class="pull-right vip_info_pan">
        <div class="vip_info_title">
            银行卡管理
        </div>
        <div class="vip_info_content bankCard_main">
            <div class="bankcard_item_box  clearfix ">
                <if condition="is_array($banklist)">
                    <volist name="banklist" id="vo">
                <div class="bankcard_item <eq name='vo[isdefault]' value='1'>checked</eq> default_bank"  style="position:relative;">
                    <div class="bankcare_title clearfix">
						<span class="pull-left">
							 <img src="__ROOT__/resources/images/bank/{$vo.banklogo}" width="20" height="20" />
							{$vo.bankname}
						</span>
                        <em class="pull-right">尾号 {$vo.banknumber|substr=-4}</em>
                    </div>
                    <div class="bank_middle clearfix">
						<span class="pull-left">
							储存卡
							<i class="bank_triangle"></i>
						</span>
                        <p class="pull-right default_bank_text" style="color:#4aa9db" >
                            <eq name="vo.state" value="1">
                            <if condition="$vo.isdefault eq '1'">默认<else /><em onclick="setdefault({$vo.id})">设置默认</em></if>
                            <else />
                               <em class="text-muted">未审核</em>
                            </eq>

                        </p>
                    </div>
                    <div class="bank_footer clearfix">
						<span class="pull-left">
							绑卡日期：
							<em>{$vo.date|substr=0,10}</em>
						</span>
						<span class="pull-right">
							<em>{$vo.accountname}</em><?php for($i=1;$i<=$vo['sartnum'];$i++){echo '*';}?>
						</span>
                    </div>
                    <div class="r_right">
                        <span class="r_right_con">√</span>
                    </div>
                </div>
                    </volist>
                </if>
   <!--               <?php if(count($banklist)<3) {?>
                  <a href="{:U('Member/addBank')}" class="add_bankCard pull-left">立即添加银行卡</a>
                 <?php }?>--> 
                <lt name="banklist|count" value="3">
                <a href="javascript:void(0);" class="add_bankCard pull-left">立即添加银行卡</a>
                </lt>
            </div>
            <div class="prompt">
                <i class="iconfont">&#xe659;</i>
                温馨提示：已绑定{$banklist|count}张银行卡，一共可以绑定3张银行卡。为了您的资金安全，成功绑定的银行卡会自动锁定，无法删除和修改。
            </div>
        </div>
    </div>
</div>
<include file="Public/footer" />
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
            </div>
            <div class="modal-body">
                您还未设置资金密码，请先设置资金密码?
                <div>（资金密码用于提现等操作，可保障资金安全）</div>
            </div>
            <div class="modal-footer">
                <a href="setSecurity.html" class="btn btn-default login_btn">确认</a>
                <a href="" class="btn btn-default register_btn">取消</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade addTrueName" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">绑定真实姓名</h4>
        </div>
        <div class="modal-body">
            <div class="submitComfire tips" style="width:352px;margin:0 auto;">
                <ul class="ui-form">
                    <li>
                        <label for="question1" class="ui-label">提示：</label>
                        <span class="mark">真实姓名绑定后不得修改</span>
                    </li>
                    <li>
                        <label class="ui-label">真实姓名：</label>
                        <input class="input-text inline box-shadow radius size-L" type="text" value="" id="bindrealname_realname" way-data="bindrealname.realname">
                        <span id="addtrueName_text1" style="color:red;display:none;">真实姓名不能为空</span>
                    </li>
                    <li>
                        <label class="ui-label">资金密码：</label>
                        <input class="input-text inline box-shadow radius size-L" type="password" id="bindrealname_tradepassword" way-data="bindrealname.tradepassword">
                        <span id="addtrueName_text2" style="color:red;display:none;">资金密码不能为空</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
        <a href="javascript:void(0);" id="addtrueName_btn" class="btn common_btn">确定</a>
        <button class="btn" style="background:#999;padding:0 15px !important;height:32px;" data-dismiss="modal">取消</button>
        </div>
    </div>
    </div>
</div>

<script>
    //设置默认
    function setdefault(id) {
         $.ajax({
             url : "{:U('Apijiekou/defaultuserbankcard')}",
             type : "POST",
             data : {
                 id : id 
             },
             success : function (data) {
                 if(data.sign==1)
                 {
                     alt(data.message);
                     window.location.reload();

                 }else{
                     alt(data.message);
                 }
             }
         })
    }
    var name = null;
    var pass = null;
    var userbankname = "{$userbankname}";
    var patt = /^[\u4e00-\u9fa5 ]{2,10}$/;

    $('.add_bankCard').click(function () {
        if(userbankname==""){
            $('.addTrueName').modal();
        }else{
            window.location.href="{:U('Member/addBank')}";
        }
    })
    $('#addtrueName_btn').click(function () { 
        name = $('#bindrealname_realname').val();
        pass = $('#bindrealname_tradepassword').val();
        if(!name || name == ''){
            alert('真实姓名不能为空');
            //$('#addtrueName_text1').show();
            return;
        }
        if(name.length!=0){
            reg=/^[\u0391-\uFFE5]+$/;
            if(!reg.test(name)){
                alert("请输入真实中文姓名");
                return false;
            }
        }
        if(!pass || pass == ''){
            alert('资金密码不能为空');
           //$('#addtrueName_text2').show();
            return;
        }
                    
        if(!patt.test(name)){
            alert('真实姓名格式错误');
            return;
        }

        $.ajax({
             type : "POST",
             url : "{:U('Member/binduserbankname')}",
             data : {
               userbankname :   name,
               tradepassword : pass,
             },
             success : function (data) { 
                 if(data==1){
                     alert ('真实姓名绑定成功');
                    window.location.href="{:U('Member/addBank')}";
                 }else{
                     if(data['status']==0){
                         alert("资金密码错误")
                     }else{
                         alert('真实姓名绑定失败');
                     }

                 }
             }
        })
    })

    $('.default_bank').click(function () {
        $(this).addClass('checked').siblings('.bankcard_item').removeClass('checked');
        $(this).find('.r_right').show().
            parents('.default_bank').siblings('.bankcard_item').find('.r_right').hide();
        //$(this).find('.default_bank_text').text('默认使用');
        //$(this).siblings('.bankcard_item').find('.default_bank_text').hide('设置为默认');

        $.ajax({
            type: '',
            dataType: '',
            url: '',
            data: {},
            success: function (data) {

            }   
        })
    })

    if($('.default_bank').hasClass('checked')){
        //(this).find('.default_bank_text').text('默认使用');
        $(this).find('.r_right').show();
    }
</script>
</body>
</html>