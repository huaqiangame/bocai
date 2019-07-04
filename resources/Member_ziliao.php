 <include file="Public/headermember" />
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/reset.css">
    <link rel="stylesheet" href="__CSS2__/userInfo.css">
 <script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
 <script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
 <script type="text/javascript" src="__ROOT__/resources/main/index.js"></script>
 <script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
    <include file="Member/side" />
    <div class="pull-right vip_info_pan">
        <div class="vip_info_title">
            个人信息
        </div>
        <div class="vip_info_content">
            <ul class="tab clearfix">
                <li class="active">个人资料</li>
                // <eq name="userinfo['proxy']" value="0"><li>等级头衔</li></eq>
            </ul>
            <div class="tab_content">
                <div class="tab1 clearfix">
                    <div class="img pull-left">
                        <img src="__ROOT__{$userinfo['face']}" alt="" class="up_header_img">
                        <a href="javascript:void(0);" class="update_header">修改头像</a>
                    </div>
                    <div class="tab_content_right pull-right">
                        <form class="am-form register_form" method="post" url="" checkby_ruivalidate id="register_form" onsubmit="return checkform(this)">
                             <input type="hidden" class="up_header_img_input" name="info[face]" value="{$userinfo['face']}" />
                            <p>

                                <span>账号：</span>
                                <em class="no_info">{$userinfo.username}</em>
                            </p>
                            <p>
                                <span>等级：</span>
                                <em class="no_info">{$userinfo.groupname}</em>
                            </p>
                          <eq name="userinfo['proxy']" value="0">  <p>
                                <span>头衔：</span>
                                <em class="no_info">{$userinfo.touhan}</em>
                            </p></eq>
                            <p>
                                <span>真实姓名：</span>
                                <eq name="userinfo[userbankname]" value="">
                                    你还没有绑定真实姓名
                                    <a class="bd" href="javascript:void(0);" onclick="gobind();">去绑定</a>
                                    <else />
                                  {$userinfo.userbankname}
                                </eq>
                            </p>
<!--                            <p>
                                <span>昵称：</span>
                                <input class="input_text" type="text" name="" placeholder="昵称为1-5位汉字，设置后不能修改">
                            </p>-->
                            <p>
                                <span>手机：</span>
                                <eq name="userinfo[tel]">
                                    <input  class="input_text" type="text" name="tel" value=""  disabled="disabled">
                                    <a class="bd" href="{:U('Member/safephone')}">绑定</a>
                                    <else />
                                <input  class="input_text" type="text" name="tel" value="{$userinfo.tel|substr_replace='****',3,4}"  disabled="disabled">
                                    <a class="bd" href="">已绑定</a>
                                </eq>
                            </p>
                            <p>
                                <span>邮箱：</span>
                                 <eq name="userinfo[email]">
                                     <input class="input_text" type="text" name="emial" value="" disabled="disabled">
                                     <a class="bd" href="{:U('Member/bindmail')}">绑定</a>
                                     <else/>
                                <input class="input_text" type="text" name="emial" value="{$userinfo.email|substr_replace='****',1,4}" disabled="disabled">
                                     <a class="bd" href="">已绑定</a>
                                 </eq>
                            </p>
                            <p>
                                <span>QQ：</span>
                                <eq name="userinfo[qq]" value="">
                                    <input class="input_text" type="text" id="showqq" onchange="changeToinfoqq();" name="showqq" value="" >
                                  <else />
                                  <input class="input_text" type="text" id="showqq" onchange="changeToinfoqq();" name="showqq" value="{$userinfo.qq|substr_replace='****',1,4}" >
                                </eq>
                                <input class="input_text" type="hidden" name="info[qq]" id="qq" value="{$userinfo.qq}" >
                            </p>
                            <p>
                                <span>性别：</span>
                                <label class="sex_box">
                                    <i class="checked"></i>
                                    男
                                    <input type="radio" name="info[sex]" value="1" <eq name="userinfo['sex']" value="1">checked="checked"</eq>    style="display: none;" >
                                </label>
                                <label class="sex_box">
                                    <i class="checked"></i>
                                    女
                                    <input type="radio"  name="info[sex]" value="0" <eq name="userinfo['sex']" value="0">checked="checked"</eq> style="display: none;">
                                </label>
                                <label class="sex_box">
                                    <i class="checked"></i>
                                    保密
                                    <input type="radio" name="info[sex]" value="2" <eq name="userinfo['sex']" value="2">checked="checked"</eq> style="display: none;" >
                                </label>
                            </p>



                            <script>
                               function changeToinfoqq(){
                                   $('#qq').val($('#showqq').val());
                               }
                            </script>
                            <button type="submit" class="btn vip_info_save ty_btn sub_btn ty_submit">保存</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
 <include file="Public/footer" />
 <include file="Public/face" />
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
<!--  <script type="text/javascript">_init_area();</script>-->
 <script>
     $(".groupRemark").click(function () {
         art.dialog({
             'title': 'VIP说明',
             'width': '260px',
             'height': '106px',
             'padding': '10px 20px',
             'content': "<p style=\"margin-top: 14%; font-size: 15px;\">想了解更多VIP信息，请咨询客服</p>",
             cancel: true,
         });
     });
     function checkform(obj){
         $.post($(obj).attr('action'),$(obj).serialize(), function(json){
             if(json.status==1){
                   alert(json.info,'success');
                     window.location.reload();
             }else{
                 alert(json.info);
             };
         },'json');
         return false;
     };
    function gobind(){
        $('.addTrueName').modal();
    }
     var name = null;
     var pass = null;
     var userbankname = "{$userbankname}";
     var patt = /^[\u4e00-\u9fa5 ]{2,10}$/;
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
                 alert("请输入真实中文姓名");//请将“字符串类型”要换成你要验证的那个属性名称！
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
                     location.reload();
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
 </script>
</body>
</html>