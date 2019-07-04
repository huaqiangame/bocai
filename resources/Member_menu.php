<?php
$unloginMenus = [
	[
		'title'  => '个人中心',
		'ctrl'   => 'Member',
		'act'    => 'ucenter',
	],
	[
		'title'  => '财务中心',
		'ctrl'   => 'Member',
		'act'    => 'finance',
	],
	[
		'title'  => '代理中心',
		'ctrl'   => 'Member',
		'act'    => 'agent',
	],
	[
		'title'  => '报表中心',
		'ctrl'   => 'Member',
		'act'    => 'orderform',
	],
	/*[
		'title'  => '消息中心',
		'ctrl'   => 'Member',
		'act'    => 'message',
	],*/
];
?>

<ul>
<volist name="unloginMenus" id="vo">
<li {if condition="(strtolower(CONTROLLER_NAME) eq strtolower($vo[ctrl])) and (strtolower(ACTION_NAME) eq strtolower($vo[act]))"}class="cur"{/if}><a href="{:url($vo[ctrl].'/'.$vo[act])}">{$vo[title]}</a></li>
	</volist>
</ul> 	