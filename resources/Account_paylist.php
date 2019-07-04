				 <?php 
				    if(strstr($_SERVER['PHP_SELF'],"quickRecharge")) {
						$quickRecharge = 'class="active"';
					};
				    if(strstr($_SERVER['PHP_SELF'],"zfbRecharge")) {
						$zfbRecharge = 'class="active"';
					};
				    if(strstr($_SERVER['PHP_SELF'],"wxRecharge")) {
						$wxRecharge = 'class="active"';
					};
				    if(strstr($_SERVER['PHP_SELF'],"jbfRecharge")) {
						$jbfRecharge = 'class="active"';
					};
				 
				 ?>
				<ul class="tab clearfix recharge_main_tab">
				    
					 <li {$zfbRecharge} style="width:120px;"><a href="{:U('Account/zfbRecharge')}" style="width:100px;">支付宝扫码充值</a></li>
					 <li {$wxRecharge}><a href="{:U('Account/wxRecharge')}">微信扫码充值</a></li>
		 
					 
					<li><a href="{:U('Account/recharge')}">银行转账</a></li>
					<!--<li style="width:120px;"><a href="{:U('Account/ysfcode')}" style="width:100px;">云闪付</a></li>-->
				</ul>