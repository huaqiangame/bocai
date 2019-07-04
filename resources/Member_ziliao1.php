<include file="Public/uc_header"/>

    <div class="pull-right vip_info_pan">
        <div class="vip_info_content">
            <ul  id="tab" class="tab clearfix" role="tablist">
                <li class="active">个人资料</li>
                 <eq name="userinfo['proxy']" value="0"><li>等级头衔</li></eq>
            </ul>
            <div class="tab_content">
                <div class="tab1 clearfix tabpanel"  role="tabpanel">
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
                                    <a class="bd" href="{:U('Member/safephone')}">修改</a>
                                </eq>
                            </p>
                            <p>
                                <span>邮箱：</span>
                                 <eq name="userinfo[email]">
                                     <input class="input_text" type="text" name="emial" value="" disabled="disabled">
                                     <a class="bd" href="{:U('Member/bindmail')}">绑定</a>
                                     <else/>
                                <input class="input_text" type="text" name="emial" value="{$userinfo.email|substr_replace='****',1,4}" disabled="disabled">
                                     <a class="bd" href="{:U('Member/bindmail')}">修改</a>
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
                        <!--    <p>
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
                            </p>-->



                            <script>
                               function changeToinfoqq(){
                                   $('#qq').val($('#showqq').val());
                               }
                            </script>
                            <!--<p>
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
                            <p>
                                <span>生日：</span>
                                <select class="sel_year" name="info[year]" rel="{$userinfo['birthday']|substr=0,4}"></select> 年
                                <select class="sel_month" name="info[month]" rel="{$userinfo['birthday']|substr=5,2}"> </select> 月
                                <select class="sel_day"  name="info[day]" rel="{$userinfo['birthday']|substr=8,2}"> </select> 日
                            </p>-->
                            <button type="submit" class="btn vip_info_save ty_btn sub_btn ty_submit">保存</button>
                        </form>
                    </div>
                </div>
                <eq name="userinfo['proxy']" value="0">
                <div class="tab2 tabpanel" style="display: none;" role="tabpanel">
                    <div class="tab2_top clearfix"  >
                        <div class="img pull-left">
                            <img src="__ROOT__{$userinfo.face}" alt="" class="up_header_img">
                            <a href="javascript:void(0);" class="update_header">修改头像</a>
                        </div>
                        <div class="tab2_top_right pull-left">
                            <p><em>账</em>号：{$userinfo.username}</p>
                            <p><em>等</em>级：{$userinfo.groupname}</p>
                            <p><em>头</em>衔：{$userinfo.touhan}</p>
                            <p>成长值：{$userinfo.point}分</p>
                            <p style="color:#999999">每充值1元加1分</p>
                        </div>
                    </div>
                    <p class="vip_bar">

                         <switch name="userinfo.groupid">
                            <case value="1">
                                 <span class="" style="width:{$userinfo['point']/$GROUPMSG[1]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[1]['shengjiedu']*100|round=2}%</span>
                             </case>
                            <case value="2">
                                <span style="width:{$userinfo['point']/$GROUPMSG[2]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[2]['shengjiedu']*100|round=2}%</span>
                            </case>
                            <case value="3">
                                <span style="width:{$userinfo['point']/$GROUPMSG[3]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[3]['shengjiedu']*100|round=2}%</span>
                            </case>
                             <case value="4">
                                 <span style="width:{$userinfo['point']/$GROUPMSG[4]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[4]['shengjiedu']*100|round=2}%</span>
                             </case>
                             <case value="5">
                                 <span style="width:{$userinfo['point']/$GROUPMSG[5]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[5]['shengjiedu']*100|round=2}%</span>
                             </case>
                             <case value="6">
                                 <span style="width:{$userinfo['point']/$GROUPMSG[6]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[6]['shengjiedu']*100|round=2}%</span>
                             </case>
                             <case value="7">
                                 <span style="width:{$userinfo['point']/$GROUPMSG[7]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[7]['shengjiedu']*100|round=2}%</span>
                             </case>
                             <case value="8">
                                 <span style="width:{$userinfo['point']/$GROUPMSG[8]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[8]['shengjiedu']*100|round=2}%</span>
                             </case>
                             <case value="8">
                                 <span style="width:100% !important;">100%</span>
                             </case>
                            <default />
                             <span style="width:0% !important;">0%</span>
                        </switch>
                    </p>
                    <div class="vip_upgrade clearfix">
                        <em class="pull-left">{$userinfo.groupname}</em>
							<span style="text-align:center;">
                            <switch name="userinfo.groupid">
                                <case value="1">
                                    <i>{$userinfo.point}</i>
                                    /{$GROUPMSG[1]['shengjiedu']} 距离下一级还要{$userinfo['point']-$GROUPMSG[1]['shengjiedu']|abs}分
                                </case>
                                <case value="2">
                                    <i>{$userinfo.point}</i>
                                    /{$GROUPMSG[2]['shengjiedu']} 距离下一级还要{$userinfo['point']-$GROUPMSG[2]['shengjiedu']|abs}分
                                </case>
                                <case value="3">
                                    <i>{$userinfo.point}</i>
                                    /{$GROUPMSG[3]['shengjiedu']} 距离下一级还要{$userinfo['point']-$GROUPMSG[3]['shengjiedu']|abs}分
                                </case>
                                <case value="4">
                                    <i>{$userinfo.point}</i>
                                    /{$GROUPMSG[4]['shengjiedu']} 距离下一级还要{$userinfo['point']-$GROUPMSG[4]['shengjiedu']|abs}分
                                </case>
                                <case value="5">
                                    <i>{$userinfo.point}</i>
                                    /{$GROUPMSG[5]['shengjiedu']} 距离下一级还要{$userinfo['point']-$GROUPMSG[5]['shengjiedu']|abs}分
                                </case>
                                <case value="6">
                                    <i>{$userinfo.point}</i>
                                    /{$GROUPMSG[6]['shengjiedu']} 距离下一级还要{$userinfo['point']-$GROUPMSG[6]['shengjiedu']|abs}分
                                </case>
                                <case value="7">
                                    <i>{$userinfo.point}</i>
                                    /{$GROUPMSG[7]['shengjiedu']} 距离下一级还要{$userinfo['point']-$GROUPMSG[7]['shengjiedu']|abs}分
                                </case>
                                <case value="8">
                                    <i>{$userinfo.point}</i>
                                    /{$GROUPMSG[8]['shengjiedu']} 距离下一级还要{$userinfo['point']-$GROUPMSG[8]['shengjiedu']|abs}分
                                </case>
                                <default />default
                            </switch>
							</span>
                        <em class="pull-right">
                            <switch name="userinfo.groupid">
                                <case value="1">{$GROUPMSG[1]['groupname']}</case>
                                <case value="2">{$GROUPMSG[2]['groupname']}</case>
                                <case value="3">{$GROUPMSG[3]['groupname']}</case>
                                <case value="4">{$GROUPMSG[4]['groupname']}</case>
                                <case value="5">{$GROUPMSG[5]['groupname']}</case>
                                <case value="6">{$GROUPMSG[6]['groupname']}</case>
                                <case value="7">{$GROUPMSG[7]['groupname']}</case>
                                <case value="8">{$GROUPMSG[8]['groupname']}</case>
                                <default />default
                            </switch>
                        </em>
                    </div>
                    <h4 class="grade_title">等级机制</h4>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>等级</th>
                            <th>头衔</th>
                            <th>成长积分</th>
                            <th>晋级奖励(元)</th>
                            <th>跳级奖励(元)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <volist name="GROUPMSG" id="value" key="key" >
                            <if condition="$value.groupname neq '普通代理'">
                        <tr>
                            <td>{$value.groupname}</td>
                            <td>{$value.touhan}</td>
                            <td>{$value.shengjiedu}</td>
                            <td>{$value.jjje}</td>
                            <td>{$value.tiaoji}</td>
                        </tr>
                            </if>
                        </volist>
                        </tbody>
                    </table>
                </div>
                </eq>
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

<!--  <script type="text/javascript">_init_area();</script>-->
 <script type="text/javascript">
     $(function () {
         $('#tab li').click(function (e) {
             e.preventDefault();//阻止a链接的跳转行为
             $(this).tab('show');//显示当前选中的链接及关联的content
             var idx = $("#tab li").index(this);
             $('.tabpanel').hide();

             $(".tab_content .tabpanel").eq(idx).show();
         });

     });
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
                   alt(json.info,'success');
                     window.location.reload();
             }else{
                 alt(json.info);
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

<include file="Public/uc_footer" />