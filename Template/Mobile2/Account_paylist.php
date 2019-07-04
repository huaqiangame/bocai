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
         if(strstr($_SERVER['PHP_SELF'],"bankRecharge")) {
           $bankRecharge = 'class="active"';
         };
				    if(strstr($_SERVER['PHP_SELF'],"jbfRecharge")) {
						$jbfRecharge = 'class="active"';
					};
				 
				 ?>
				<ul class="tab clearfix recharge_main_tab">
          <li {$zfbRecharge} style="width:120px;"><a href="{:U('Account/zfbRecharge')}" style="width:100px;">支付宝扫码充值</a></li>
          <li {$wxRecharge}><a href="{:U('Account/wxRecharge')}">微信扫码充值</a></li>
          <li {$bankRecharge}><a href="{:U('Account/bankRecharge')}">银行转账</a></li>
    <!--
          <li {$quickRecharge}><a href="{:U('Account/quickRecharge')}">银行转账</a></li>
    <li {$qqRecharge}><a href="{:U('Account/qqRecharge')}">QQ扫码充值</a></li>
   <!--<li style="width:120px;"><a href="{:U('Account/fourRecharge')}" style="width:100px;">四合一在线充值</a></li>-->
          <!--
					<li style="width:180px;">	<?php   include($_SERVER["DOCUMENT_ROOT"].'/mcbpay/mcbconfig.php');?><a href="//<?php echo MCB_PAYDOMAIN;?>/pay/?appid=<?php echo MCB_APPID;?>&payno={$userinfo.username}&pt=pc&back_url=<?php echo urlencode('//'.$_SERVER['HTTP_HOST'].'/#');?>" target="_blank" style="width:180px;">支付宝/微信/手Q扫码</a></li>
				-->
				</ul>