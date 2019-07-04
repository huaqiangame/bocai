<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >

	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/record.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
	<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="__JS__/artDialog.js"></script>

	<script>
		var ISLOGIN = "{$userinfo.id}";
	</script>
	<script src="__JS__/index.js"></script>
</head>
<body>
<include file="Public/header" />
	<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="vip_info clearfix container">
		<include file="Member/side" />
		<div class="pull-right vip_info_pan">
			<div class="vip_info_title">
			</div>
			<div class="vip_info_content betRecord_main">
				<div class="betRecord_top">
					<span>帐户余额：<em>{$balance}元</em></span>
					<span>AG余额：<em ><i class="ag">{$agBalance}</i>元</em></span>
					<span>BB余额：<em ><i class="bbin">{$bbBalance}</i>元</em></span>
					<span>体育余额：<em ><i class="ss">{$ssBalance}</i>元</em></span>					
					<span>开元余额：<em ><i class="ky">{$kyBalance}</i>元</em></span>
				</div>
				<div class="betRecord_tab clearfix" style="height:auto">
					<div class="category >
						<em class="tle">转让类型：</em>
						<div class="form-group">
							<select name="quota_type" id="quota_type"  class="form-control" id="" style="width:150px">
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
						</div>>
					</div>
					<div class="category >
						<em class="tle">转让额度：</em>
						<div class="form-group">
						
							<input type ="number" name="amout" id="amout" onkeyup="this.value=this.value.replace(/[^\d]/g,'');"
							style="border-radius: 4px;border: 1px solid #cccccc;padding: 0px 5px;width: 280px;height: 36px;background-color: #fff;color: #A9A9A9;font-size: 12px;"/>
						</div>
					</div>
					<div class="category >
						
						<div class="form-group">
						<input value="转让" class="btn-danger active sub_btn btn-sm" id="save" style="width:8em;height:2.3em;font-size: 1.3em" type="button">
							
						<input value="刷新" class=" active sub_btn btn-sm" id="refresh" style="width:6em;height:2.3em;font-size: 1.3em;" type="button">
						</div>
					</div>
				
				</div>
				
				


			</div>
		</div>
	</div>
<include file="Public/footer" />


<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="__JS__/artDialog.js"></script>
	<script type="text/javascript" src="__JS__/index.js"></script> 
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