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
		<div class=" am-header-title">
			额度转换</eq>
		</div>
	</header>
	<div class="personalInfo1 personalInfo">
		
			<ul class="my_set_list personalInfo_top margin_0">
				 <input type="hidden" class="faceinput" style="width: 700px" name="info[face]" value="{$userinfo['face']}" />
				<li class="am-cf am-vertical-align special faceimg" data-am-modal="{target: '#my-actions'}">
					
					<img class="am-fr padding_lr_5 personalInfo_header am-radius" src="__ROOT__{$userinfo['face']}" style="float:right;" alt="">
					<span style="width:90%;">头像</span>
				</li>
				<li class="am-cf" style="border-bottom:1px solid #ccc">
					<span>平台余额</span>
					
					<em class="personalInfo_text am-fr padding_lr_5">{$balance}</em>
				</li>
			</ul>
			<ul class="my_set_list personalInfo_top margin_0" >
				<li class="am-cf " >
					<span>AG余额</span>
				
					<em class="personalInfo_text am-fr padding_lr_5">
                              {$agBalance}

					</em>
				</li>
				<li class="am-cf " >
					<span>BB余额</span>
					<em class="personalInfo_text am-fr padding_lr_5">
					{$bbBalance}
					</em>
				</li>
				<li class="am-cf " >
					<span>开元余额</span>
					<em class="personalInfo_text am-fr padding_lr_5">
					{$kyBalance}
					</em>
				</li>
				<li class="am-cf " >
					<span>体育余额</span>
					<em class="personalInfo_text am-fr padding_lr_5">
					{$ssBalance}
					</em>
				</li>				
				<li class="am-cf">
					<span>转换类型</span>
					
					<em class="personalInfo_text am-fr padding_lr_5">
					    <select name="quota_type" id="quota_type"  class="form-control" id="" style="width:11em">
								<option value="0">==请选择==</option> 
								<option value="1">主账号至AG</option>
								<option value="3">主账号至BB</option>	
								<option value="5">主账号至体育</option> 								
								<option value="7">主账号至开元</option> 
								<option value="2">AG至主账号</option> 								
								<option value="4">BB至主账号</option> 
								<option value="6">体育主账号至</option> 								
								<option value="8">开元至主账号</option> 								
								
							</select>
					</em>
				</li>
				<li class="am-cf" style="border-bottom:1px solid #ddd">
					<span>转换金额</span>
					
					<em class="personalInfo_text am-fr padding_lr_5">
					    <input type ="number" name="amout" id="amout" onkeyup="this.value=this.value.replace(/[^\d]/g,'');"
							style="border-radius: 4px;border: 1px solid #cccccc;padding: 0px 5px;width: 11em;height: 36px;"/>
					</em>
				</li>
				
				
			</ul>

			<button  class="am-btn am-btn-danger am-btn-block am-radius btn_red " id="save" style="height:40px;">提交</button>
		
	</div>

	
	<include file="User/face" />
	<include file="Public/footer" />
	<script>
     $(function(){
		 $("#refresh").click(function(){
			  window.location.reload(true) ;
		 });
		$("#save").click(function(){
			var quota_type=$("#quota_type").val();
			if(quota_type<=0){
				loginCengBoxFn("请选择额度转让类型");
				return false;
				
			}
			var amout=$("#amout").val();
			if(quota_type==1||quota_type==2){
				var type='ag';
			}
			if(quota_type==3||quota_type==4){
				var type='bbin';
			}
				if(quota_type==5||quota_type==6){
				var type='ss';
			}
				if(quota_type==7||quota_type==8){
				var type='ky';
			}			
			$(this).unbind("click");
			if(quota_type==1||quota_type==3||quota_type==5||quota_type==7){
				$.post("{:U('Zhenren/deposit')}",{type:type,amount:amout},function(data){
					
					console.log(data);
					if(data.code==1){
						loginCengBoxFn("转让成功");
						 window.location.reload(true) ;
					}else{
						$(this).bind("click");
						loginCengBoxFn("转换失败");
					}
				});
			}
			if(quota_type==2||quota_type==4||quota_type==6||quota_type==8){
				$.post("{:U('Zhenren/withdrawal')}",{type:type,amount:amout},function(data){
					if(data.code==1){
						loginCengBoxFn("转让成功");
						 window.location.reload(true) ;
					}else{
						$(this).bind("click");
						loginCengBoxFn("转换失败");
					}
				});
			}
			
		});
		
	 
	 });
	</script>
</body>
</html>