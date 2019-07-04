{include file="Public/meta" /}
<title>基本设置</title>
</head>
<body>
<div class="page-container">
	<form class="form form-horizontal" id="AjaxPostForm" method="post" action="{:url('System/settingdo')}" confirm="确定吗修改系统配置吗？">
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl"><span class="current">赠送活动</span></div>
            
            <div class="tabCon">
                
				<!--<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">注册赠送活动：</label>
					<div class="formControls col-xs-8 col-sm-9">
新注册用户赠送本人：<input type="text" class="input-text" name="info[newregamount]" value="{$setlist.newregamount}" style="width:60px;">元，0为关闭活动 
					</div>
				</div>-->
                
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">绑定银行赠送活动：</label>
					<div class="formControls col-xs-8 col-sm-9">
绑定银行账户赠送本人：<input type="text" class="input-text" name="info[bindcardamount]" value="{$setlist.bindcardamount}" style="width:60px;">元，0为关闭活动 (后台银行卡审核成功后赠送)
					</div>
				</div>
                
                
                
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">单次充值赠送活动(不累计)：</label>
					<div class="formControls col-xs-8 col-sm-9">
1、单次充值满：<input type="text" name="info[activity_cz0_money]" class="input-text" value="{$setlist.activity_cz0_money}" style="width:150px;">元，赠送：<input type="text" name="info[activity_cz0_zsmoney]" class="input-text" value="{$setlist.activity_cz0_zsmoney}" style="width:60px;">%
<br><br>
2、单次充值满：<input type="text" name="info[activity_cz1_money]" class="input-text" value="{$setlist.activity_cz1_money}" style="width:150px;">元，赠送：<input type="text" name="info[activity_cz1_zsmoney]" class="input-text" value="{$setlist.activity_cz1_zsmoney}" style="width:60px;">%
<br><br>
3、单次充值满：<input type="text" name="info[activity_cz2_money]" class="input-text" value="{$setlist.activity_cz2_money}" style="width:150px;">元，赠送：<input type="text" name="info[activity_cz2_zsmoney]" class="input-text" value="{$setlist.activity_cz2_zsmoney}" style="width:60px;">%
<br><br>
4、单次充值满：<input type="text" name="info[activity_cz3_money]" class="input-text" value="{$setlist.activity_cz3_money}" style="width:150px;">元，赠送：<input type="text" name="info[activity_cz3_zsmoney]" class="input-text" value="{$setlist.activity_cz3_zsmoney}" style="width:60px;">%
<br><br>
5、单次充值满：<input type="text" name="info[activity_cz4_money]" class="input-text" value="{$setlist.activity_cz4_money}" style="width:150px;">元，赠送：<input type="text" name="info[activity_cz4_zsmoney]" class="input-text" value="{$setlist.activity_cz4_zsmoney}" style="width:60px;">%
<br><br>

					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">每日消费赠送活动：</label>
					<div class="formControls col-xs-8 col-sm-9">
1、日消费满：<input type="text" name="info[riCommissionBase0_0]" class="input-text" value="{$setlist.riCommissionBase0_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[riCommissionBase0_1]" class="input-text" value="{$setlist.riCommissionBase0_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[riCommissionBase0_2]" class="input-text" value="{$setlist.riCommissionBase0_2}" style="width:60px;">%
<br><br>
2、日消费满：<input type="text" name="info[riCommissionBase1_0]" class="input-text" value="{$setlist.riCommissionBase1_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[riCommissionBase1_1]" class="input-text" value="{$setlist.riCommissionBase1_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[riCommissionBase1_2]" class="input-text" value="{$setlist.riCommissionBase1_2}" style="width:60px;">%
<br><br>
3、日消费满：<input type="text" name="info[riCommissionBase2_0]" class="input-text" value="{$setlist.riCommissionBase2_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[riCommissionBase2_1]" class="input-text" value="{$setlist.riCommissionBase2_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[riCommissionBase2_2]" class="input-text" value="{$setlist.riCommissionBase2_2}" style="width:60px;">%

					</div>
				</div>
                
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">每月消费赠送活动：</label>
					<div class="formControls col-xs-8 col-sm-9">
1、月消费满：<input type="text" name="info[yueCommissionBase0_0]" class="input-text" value="{$setlist.yueCommissionBase0_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[yueCommissionBase0_1]" class="input-text" value="{$setlist.yueCommissionBase0_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[yueCommissionBase0_2]" class="input-text" value="{$setlist.yueCommissionBase0_2}" style="width:60px;">%
<br><br>
2、月消费满：<input type="text" name="info[yueCommissionBase1_0]" class="input-text" value="{$setlist.yueCommissionBase1_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[yueCommissionBase1_1]" class="input-text" value="{$setlist.yueCommissionBase1_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[yueCommissionBase1_2]" class="input-text" value="{$setlist.yueCommissionBase1_2}" style="width:60px;">%
<br><br>
3、月消费满：<input type="text" name="info[yueCommissionBase2_0]" class="input-text" value="{$setlist.yueCommissionBase2_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[yueCommissionBase2_1]" class="input-text" value="{$setlist.yueCommissionBase2_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[yueCommissionBase2_2]" class="input-text" value="{$setlist.yueCommissionBase2_2}" style="width:60px;">%

					</div>
				</div>
                
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">日亏损赠送活动：</label>
					<div class="formControls col-xs-8 col-sm-9">
1、日亏损满：<input type="text" name="info[riKuisunBase0_0]" class="input-text" value="{$setlist.riKuisunBase0_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[riKuisunBase0_1]" class="input-text" value="{$setlist.riKuisunBase0_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[riKuisunBase0_2]" class="input-text" value="{$setlist.riKuisunBase0_2}" style="width:60px;">%
<br><br>
2、日亏损满：<input type="text" name="info[riKuisunBase1_0]" class="input-text" value="{$setlist.riKuisunBase1_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[riKuisunBase1_1]" class="input-text" value="{$setlist.riKuisunBase1_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[riKuisunBase1_2]" class="input-text" value="{$setlist.riKuisunBase1_2}" style="width:60px;">%
<br><br>
3、日亏损满：<input type="text" name="info[riKuisunBase2_0]" class="input-text" value="{$setlist.riKuisunBase2_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[riKuisunBase2_1]" class="input-text" value="{$setlist.riKuisunBase2_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[riKuisunBase2_2]" class="input-text" value="{$setlist.riKuisunBase2_2}" style="width:60px;">%
<br><br>


					</div>
				</div>
                
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">月亏损赠送活动：</label>
					<div class="formControls col-xs-8 col-sm-9">
1、月亏损满：<input type="text" name="info[yueKuisunBase0_0]" class="input-text" value="{$setlist.yueKuisunBase0_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[yueKuisunBase0_1]" class="input-text" value="{$setlist.yueKuisunBase0_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[yueKuisunBase0_2]" class="input-text" value="{$setlist.yueKuisunBase0_2}" style="width:60px;">%
<br><br>
2、月亏损满：<input type="text" name="info[yueKuisunBase1_0]" class="input-text" value="{$setlist.yueKuisunBase1_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[yueKuisunBase1_1]" class="input-text" value="{$setlist.yueKuisunBase1_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[yueKuisunBase1_2]" class="input-text" value="{$setlist.yueKuisunBase1_2}" style="width:60px;">%
<br><br>
3、月亏损满：<input type="text" name="info[yueKuisunBase2_0]" class="input-text" value="{$setlist.yueKuisunBase2_0}" style="width:150px;">元，本人赠送：<input type="text" name="info[yueKuisunBase2_1]" class="input-text" value="{$setlist.yueKuisunBase2_1}" style="width:60px;">%，上家赠送：<input type="text" name="info[yueKuisunBase2_2]" class="input-text" value="{$setlist.yueKuisunBase2_2}" style="width:60px;">%
<br><br>


					</div>
				</div>
                
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">代理分红设置：</label>
					<div class="formControls col-xs-8 col-sm-9">
1、月下线亏损满：<input type="text" name="info[agentBonusBase0_0]" class="input-text" value="{$setlist.agentBonusBase0_0}" style="width:150px;">元，赠送：<input type="text" name="info[agentBonusBase0_1]" class="input-text" value="{$setlist.agentBonusBase0_1}" style="width:60px;">%
<br><br>
2、月下线亏损满：<input type="text" name="info[agentBonusBase1_0]" class="input-text" value="{$setlist.agentBonusBase1_0}" style="width:150px;">元，赠送：<input type="text" name="info[agentBonusBase1_1]" class="input-text" value="{$setlist.agentBonusBase1_1}" style="width:60px;">%
<br><br>
3、月下线亏损满：<input type="text" name="info[agentBonusBase2_0]" class="input-text" value="{$setlist.agentBonusBase2_0}" style="width:150px;">元，赠送：<input type="text" name="info[agentBonusBase2_1]" class="input-text" value="{$setlist.agentBonusBase2_1}" style="width:60px;">%
<br><br>
4、月下线亏损满：<input type="text" name="info[agentBonusBase3_0]" class="input-text" value="{$setlist.agentBonusBase3_0}" style="width:150px;">元，赠送：<input type="text" name="info[agentBonusBase3_1]" class="input-text" value="{$setlist.agentBonusBase3_1}" style="width:60px;">%
<br><br>


					</div>
				</div>
                
                
            </div>
            
			
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
{include file="Public/footer" /}
<script>
	setTimeout(function(){
		$('.tabBar').find('span').click();
	}) 
</script>
</body>
</html>