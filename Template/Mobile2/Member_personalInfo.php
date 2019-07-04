<include file="Public/header" />
<style>
	body{
		background-color: #fff;}
</style>
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<div class="winners_tab am-header-title">
			<em class="active" data-title="0">个人资料</em><eq name="userinfo['proxy']" value="0"><em data-title="1">等级头衔</em></eq>
		</div>
	</header>
	<div class="personalInfo1 personalInfo">
		<form class="am-form register_form" method="post" url="" checkby_ruivalidate id="register_form" onsubmit="return checkform(this)">
			<ul class="my_set_list personalInfo_top margin_0">
				 <input type="hidden" class="faceinput" style="width: 700px" name="info[face]" value="{$userinfo['face']}" />
				<li class="am-cf am-vertical-align special faceimg" data-am-modal="{target: '#my-actions'}">
					<i class="iconfont icon-arrowright"></i>
					<img class="am-fr padding_lr_5 personalInfo_header am-radius" src="__ROOT__{$userinfo['face']}" style="float:right;" alt="">
					<span style="width:90%;">头像<a href="###" style="font-size: 0.9em;color:#ccc !important;float:right;">点击修改头像</a></span>
				</li>
<!--		 <li class="am-cf">
					<span>昵称</span>
					<i class="iconfont icon-arrowright"></i>
					<input type="text" value="{$userinfo.username}" class="personalInfo_input am-fr padding_lr_5" placeholder="请设置昵称">
				</li>-->
				<li class="am-cf" style="border-bottom:1px solid #ccc">
					<span>账号</span>
					<i class="iconfont icon-arrowright"></i>
					<em class="personalInfo_text am-fr padding_lr_5">{$userinfo.username}</em>
				</li>
			</ul>
			<ul class="my_set_list personalInfo_top margin_0" >
				<li class="am-cf " >
					<span>真实姓名</span>
					<i class="iconfont icon-arrowright"></i>
					<em class="personalInfo_text am-fr padding_lr_5">
						<!-- <?php if(empty($userinfo['userbankname'])){echo "去绑定";}else{ echo substr_replace($userinfo['userbankname'],'****',3,4);}?> -->
						<eq name="userinfo['userbankname']"  ><a href="{:U('Account/userbankname')}">去绑定</a><else /><a href="{:U('Account/userbankname')}">{$userinfo['userbankname']|substr_replace='*',3,3}</a></eq>
					</em>
				</li>
				<li class="am-cf " >
					<span>手机</span>
					<i class="iconfont icon-arrowright"></i>
					<em class="personalInfo_text am-fr padding_lr_5">
					<!-- <?php if(empty($userinfo['tel'])){echo "去绑定";}else{ echo substr_replace($userinfo['tel'],'****',3,4);}?> -->
<eq name="userinfo['tel']"><a href="{:U('Member/safephone')}">去绑定</a><else /><a href="{:U('Member/safephone')}">{$userinfo['tel']|substr_replace='****',3,4}</a></eq>
					</em>
				</li>
				<li class="am-cf">
					<span>邮箱</span>
					<i class="iconfont icon-arrowright"></i>
					<em class="personalInfo_text am-fr padding_lr_5">
						<eq name="userinfo['email']"><a href="{:U('Member/bindmail')}">去绑定</a><else /><a href="{:U('Member/bindmail')}">{$userinfo['email']|substr_replace='****',3,4}</a></eq>
					</em>
				</li>
				<li class="am-cf">
					<span>QQ</span>
					<i class="iconfont icon-arrowright"></i>
			       			        <input type="text" name="info[setqq]" id="setqq" value="<notempty name='userinfo[qq]'>{$userinfo['qq']|substr_replace='******',0,4}</notempty>" class="personalInfo_input am-fr padding_lr_5" autocomplete="on" style="width:50%;border:none;" onblur="yzqq(this)" onfocus="rego(this);"  placeholder="请设置QQ号码" />

					<input type="hidden" name="info[qq]" id="qq" value="{$userinfo['qq']}" />
					<script>
						var v  = document.getElementById("setqq").value;
						var qq = document.getElementById("qq");
						var v2 = qq.value;
						function rego(obj) {
							obj.value="";
						}
						function yzqq(obj) {
							if(obj.value==""){
							   obj.value = v;
							   document.getElementById("qq").value=v2;
							}else{
								pattern="[1-9][0-9]{4,14}";
								var fag = obj.value.match(pattern);
								if(fag==null){
									alert('请输入正确的QQ号码');
									obj.value = v;
									document.getElementById("qq").value= v2;
									return false;
								}else{
									document.getElementById("qq").value=obj.value;
								}
							}
						}
					</script>
				</li>
				<!--<li class="am-cf">
					<span>性别</span>
					<i class="iconfont icon-arrowright"></i>
					<div class="am-form-group am-fr sex">
						<select id="doc-select-1">
							<option value="1" >男</option>
							<option value="0"  >女</option>
							<option value="2" >保密</option>
						</select>
					</div>
				</li>
				<li class="am-cf">
					<span>生日</span>
					<i class="iconfont icon-arrowright"></i>
					<div class="am-input-group am-datepicker-date am-fr" data-am-datepicker="{$userinfo['birthday']}">
					  	<input name="info[birthday]" style="background:none;" type="text" class="am-form-field am-datepicker-add-on"  value="{$userinfo['birthday']}" readonly="readonly">
					</div>
				</li>-->
			</ul>

			<button type="submit" class="am-btn am-btn-danger am-btn-block am-radius btn_red personalInfo_sbumit">提交</button>
		</form>
	</div>

	<div class="personalInfo2 personalInfo">
		<div class="personalInfo2_box">
			<div class="personalInfo2_h">
				<div class="am-cf personalInfo2_t">
					<div class="img am-fl">
						<img class="am-circle" src="__ROOT__{$userinfo.face}" alt="头像">
					</div>
					<div class="am-fl user_name_box">
						<p><strong class="user_name">{$userinfo.username}</strong> <span class="user_vip">&nbsp;&nbsp;{$userinfo.groupname}</span></p>
						<p><span class="user_grade">头衔：{$userinfo.touhan} </span><em class="user_fraction"> 成长值{$userinfo.point}分</em></p>
					</div>
				</div>
				<div class="personalInfo2_b">
					<p class="am-text-center">
						<switch name="userinfo.groupid">
							<case value="1">
								距离下一级还要{$userinfo['point']-1000|abs}分
							</case>
							<case value="2">
								距离下一级还要{$userinfo['point']-2000|abs}分
							</case>
							<case value="3">
								距离下一级还要{$userinfo['point']-5000|abs}分
							</case>
						</switch>
						         每充值1元加1分</p>
					<div class="y_progress">
						<em class="y_progress_l">{$userinfo.groupname}</em>
						<div class="am-progress am-inline-block" style="height:14px;">
							<switch name="userinfo.groupid">
								<case value="1">
									<div class="am-progress-bar" style="width:{$userinfo['point']/$GROUPMSG[1]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[1]['shengjiedu']*100|round=2}%</div>
								</case>
								<case value="2">
									<div class="am-progress-bar" style="width:{$userinfo['point']/$GROUPMSG[2]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[2]['shengjiedu']*100|round=2}%</div>
								</case>
								<case value="3">
									<div class="am-progress-bar" style="width:{$userinfo['point']/$GROUPMSG[3]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[3]['shengjiedu']*100|round=2}%</div>
								</case>
								<case value="4">
									<div class="am-progress-bar" style="width:{$userinfo['point']/$GROUPMSG[4]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[4]['shengjiedu']*100|round=2}%</div>
								</case>
								<case value="5">
									<div class="am-progress-bar" style="width:{$userinfo['point']/$GROUPMSG[5]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[5]['shengjiedu']*100|round=2}%</div>
								</case>
								<case value="6">
									<div class="am-progress-bar" style="width:{$userinfo['point']/$GROUPMSG[6]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[6]['shengjiedu']*100|round=2}%</div>
								</case>
								<case value="7">
									<div class="am-progress-bar" style="width:{$userinfo['point']/$GROUPMSG[7]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[7]['shengjiedu']*100|round=2}%</div>
								</case>
								<case value="8">
									<div class="am-progress-bar" style="width:{$userinfo['point']/$GROUPMSG[8]['shengjiedu']*100|round=2}% !important;">{$userinfo['point']/$GROUPMSG[8]['shengjiedu']*100|round=2}%</div>
								</case>
								<case value="8">
									<div class="am-progress-bar" style="width:100% !important;">100%</div>
								</case>
								<default />
								<div class="am-progress-bar" style=	"width:0% !important;">0%</div>
							</switch>

						</div>
						<switch name="userinfo.groupid">
							<case value="1"><em class="y_progress_l">{$GROUPMSG[1]['groupname']}</em></case>
							<case value="2"><em class="y_progress_l">{$GROUPMSG[2]['groupname']}</em></case>
							<case value="3"><em class="y_progress_l">{$GROUPMSG[3]['groupname']}</em></case>
							<case value="4"><em class="y_progress_l">{$GROUPMSG[4]['groupname']}</em></case>
							<case value="5"><em class="y_progress_l">{$GROUPMSG[5]['groupname']}</em></case>
							<case value="6"><em class="y_progress_l">{$GROUPMSG[6]['groupname']}</em></case>
							<case value="7"><em class="y_progress_l">{$GROUPMSG[7]['groupname']}</em></case>
							<case value="8"><em class="y_progress_l">{$GROUPMSG[8]['groupname']}</em></case>
							<default />default	 
					</switch>
					</div>
				</div>
			</div>
			<div class="personalInfo2_f">
				<div class="personalInfo2_h2">
					<i class="iconfont icon-wenhao1"></i>
					<h2 class="am-inline-block">等级机制</h2>
				</div>
				<table class="am-table am-table-bordered">
					<thead>
						<tr>
							<th>等级</th>
							<th>头衔</th>
							<th>成长积分</th>
						</tr>
					</thead>
					<tbody>
					<volist name="GROUPMSG" id="value" key="key" >
						<if condition="$value.groupname neq '普通代理'">
						<tr>
							<td class="am-text-left" style="padding-left:15%;">{$value.groupname}</td>
							<td>{$value.touhan}</td>
							<td> <!--<eq name="value['shengjiedu']" value="申请"><a href="###">申请</a><else/>-->{$value.shengjiedu}<!--</eq>--></td>
						</tr>
						</if>
					</volist>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<include file="User/face" />
	<include file="Public/footer" />
	<script>
		function checkform(obj){
			$.post($(obj).attr('action'),$(obj).serialize(), function(json){
				if(json.status==1){
					alert(json.info);
					window.location.reload();
				}else{
					alert(json.info);
				};
			},'json');
			return false;
		};
	</script>
</body>
</html>