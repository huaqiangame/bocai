<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body class="bg_fff">
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<h1 class="am-header-title activity_h1">
			交易记录
		</h1>
		<div class="am-header-right am-header-nav">
			<a href="javascript:void(0);" data-am-modal="{target: '#my-actions'}">
				<em class="bill_day">全部</em>
				<i class="iconfont icon-jiantouxia"></i>
			</a>
		</div>
	</header>
	<div class="bank_recharge" style="width:100%;position:absolute;top:48px;">

	<!--<div class="AppList-container"> 
	   <div class="AppList-item" id="jyjl" data-url="trade" style="display: block;">
                    <div class="AppList-search">
                        <div class="AppList-searchrow">
                            <div class="searchitem">
                                <label>交易日期：</label>
                                <div class="inputtxt">
                                    <span class="date-icon">
                                        <svg class="icon" aria-hidden="true">
                                            <use xlink:href="#icon-rili1"></use>
                                        </svg>
                                    </span>
                                    <input class="date" type="date" id="tradestarttime" name="tradestarttime" placeholder="开始时间" value="2018-11-17">
                                </div>
                            </div>
                            <span class="has-space">-</span>
                            <div class="searchitem">
                                <div class="inputtxt">
                                    <span class="date-icon">
                                        <svg class="icon" aria-hidden="true">
                                            <use xlink:href="#icon-rili1"></use>
                                        </svg>
                                    </span>
                                    <input class="date" type="date" id="tradeendtime" name="tradeendtime" placeholder="结束时间" value="2018-11-19">
                                </div>
                            </div>
                        </div>
                        <div class="AppList-searchrow has-top">
                            <div class="searchitem">
                                <div class="inputtxt">
                                    <select class="search-select" id="searchcash">
                                        <option value="">全部</option>
                                        <option value="1001">银行卡入款</option>
                                        <option value="1002">在线入款</option>
                                        <option value="1003">系统返水</option>
                                        <option value="1004">系统取消出款</option>
                                        <option value="1005">新注册优惠</option>
                                        <option value="1006">优惠券</option>
                                        <option value="1007">额度转换补单</option>
                                        <option value="2001">出款</option>
                                        <option value="2002">返水冲销</option>
                                        <option value="3001">人工存入</option>
                                        <option value="3002">存款优惠</option>
                                        <option value="3005">返点优惠</option>
                                        <option value="3006">活动奖金</option>
                                        <option value="3007">体育投注余额</option>
                                        <option value="3008">其他</option>
                                        <option value="4003">会员负数回冲</option>
                                        <option value="4004">手动申请出款</option>
                                        <option value="4005">扣除非法下注派彩</option>
                                        <option value="4008">_其他</option>
                                        <option value="6007">彩票下注</option>
                                        <option value="6008">彩票结算</option>
                                        <option value="50021">系统转AG</option>
                                        <option value="50023">AG转系统</option>
                                        <option value="50031">系统转BBIN</option>
                                        <option value="50033">BBIN转系统</option>
                                        <option value="50041">系统转MG</option>
                                        <option value="50043">MG转系统</option>
                                        <option value="50061">系统转GP</option>
                                        <option value="50063">GP转系统</option>
                                        <option value="50071">系统转LEBO</option>
                                        <option value="50073">LEBO转系统</option>
                                        <option value="50101">系统到BG</option>
                                        <option value="50103">BG到系统</option>
                                        <option value="50131">系统到HB电子</option>
                                        <option value="50133">HB电子到系统</option>
                                        <option value="50141">系统到捕鱼达人</option>
                                        <option value="50143">捕鱼达人到系统</option>
                                        
                                        <option value="50171">系统到MW捕鱼</option>
                                        <option value="50173">MW捕鱼到系统</option>
                                        <option value="50191">系统到IM体育</option>
                                        <option value="50193">IM体育到系统</option>
                                        <option value="50201">系统到CQ9电子</option>
                                        <option value="50203">CQ9电子到系统</option>
                                        <option value="50211">系统到QT电子</option>
                                        <option value="50213">QT电子到系统</option>
                                        <option value="50241">系统到DT电子</option>
                                        <option value="50243">DT电子到系统</option>
                                        <option value="50251">系统到皇朝电竞</option>
                                        <option value="50253">皇朝电竞到系统</option>
                                        <option value="50261">系统到AMB电子</option>
                                        <option value="50263">AMB电子到系统</option>
                                        <option value="50271">系统转沙巴体育</option>
                                        <option value="50273">沙巴体育转系统</option>
                                        <option value="50281">系统转SG电子</option>
                                        <option value="50283">SG电子转系统</option>
                                        <option value="50291">系统转加多宝电子</option>
                                        <option value="50293">加多宝电子转系统</option>
                                        <option value="50301">系统转开元棋牌</option>
                                        <option value="50303">开元棋牌转系统</option>
                                        <option value="50311">系统转WM视讯</option>
                                        <option value="50313">WM视讯转系统</option>
                                        <option value="50321">系统转PS电子</option>
                                        <option value="50323">PS电子转系统</option>
                                        <option value="50331">系统转368体育</option>
                                        <option value="50333">368体育转系统</option>
                                        <option value="50381">系统转JJ棋牌</option>
                                        <option value="50383">JJ棋牌转系统</option>
                                        <option value="50361">系统转FG电子</option>
                                        <option value="50363">FG电子转系统</option>
                                        <option value="50391">系统转泛亚电竞</option>
                                        <option value="50393">泛亚电竞转系统</option>
                                        <option value="50371">系统转乐游棋牌</option>
                                        <option value="50373">乐游棋牌转系统</option>
                                        <option value="50351">系统转eBET视讯</option>
                                        <option value="50353">eBET视讯转系统</option>
                                        <option value="50411">系统转EG棋牌</option>
                                        <option value="50413">EG棋牌转系统</option>
                                    </select>
                                </div>
                            </div>
                            <span class="has-space">&nbsp;</span>
                            <div class="searchitem">
                                <a class="seachbtn bigsearch" id="cashlist">搜索</a>
                            </div>
                        </div>
                    </div>
                    <div class="AppList-allinfo">
                        <div class="allinfo-item">
                            <span class="tit">总交易额度：</span>
                            <span class="val" id="jiaoyiedu">￥0.00</span>
                        </div>
                        <div class="allinfo-item">
                            <span class="tit">总优惠额度：</span>
                            <span class="val" id="youhuiedu">￥0.00</span>
                        </div>
                    </div>
                    <div class="AppList-warp">
                        <div class="AppList-list" id="traderecordlist">

                        </div>
                    </div>
            </div>
		</div>-->
	<div data-am-widget="" class="am-tabs am-tabs-d2 billrecord_main">
		<ul class="am-tabs-nav am-cf am-avg-sm-3" style="text-align:center;">
			<li class="am-active"><a href="{:U('Mobile/Account/dealRecord')}">所有类型</a></li>
			<li class=""><a href="{:U('Mobile/Account/dealRecord2')}">充值记录</a></li>
			<li class=""><a href="{:U('Mobile/Account/dealRecord3')}">提现记录</a></li>
		</ul>

		<?php $typearray = AbstractType();?>
		<div class="am-tabs-bd">
			<div data-tab-panel-0 class="am-tab-panel am-active">
				<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
					<div class="am-list-news-bd">
						<ul class="am-list">
							<volist name="mxlist" id="vo">
							<li class="am-g am-list-item-dated">
								<p class="am-cf">
									<span class="what_type am-fl">{$vo['typename']}</span>
									<em class="money am-fr">金额:{$vo.amount}</em>
								</p>
								<p class="am-cf billrecord_time">
									<span class="am-fl">{$vo.oddtime|date="Y-m-d H:i:s",###}</span>
									<em class="am-fr">可用余额:{$vo.amountafter}</em>
								</p>
							</li>
							</volist>
						</ul>
						<div class="page">{$pageshow}</div>
					</div>
				</div>
			</div>


			<div data-tab-panel-1 class="am-tab-panel ">
				<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
					<div class="am-list-news-bd">
						<ul class="am-list">
							<li class="am-g am-list-item-dated">
								<p class="am-cf">
									<span class="what_type am-fl">中国银行</span>
									<em class="money am-fr">-123</em>
								</p>
								<p class="am-cf billrecord_time">
									<span class="am-fl">2017-03-15 10:01:05</span>
									<em class="am-fr">提现中</em>
								</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div data-tab-panel-2 class="am-tab-panel ">
				<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
					<div class="am-list-news-bd">
						<ul class="am-list">
							<li class="am-g am-list-item-dated">
								<p class="am-cf">
									<span class="what_type am-fl">微信支付</span>
									<em class="money am-fr">+23</em>
								</p>
								<p class="am-cf billrecord_time">
									<span class="am-fl">2017-03-15 10:01:05</span>
									<em class="am-fr">充值中</em>
								</p>
							</li>
							<li class="am-g am-list-item-dated">
								<p class="am-cf">
									<span class="what_type am-fl">微信支付</span>
									<em class="money am-fr">+23</em>
								</p>
								<p class="am-cf billrecord_time">
									<span class="am-fl">2017-03-15 10:01:05</span>
									<em class="am-fr">充值中</em>
								</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="am-modal-actions billrecord_day" id="my-actions">
		<div class="am-modal-actions-group">
			<ul class="am-list">
				<li class="am-modal-actions-header" onclick="chaxun(0);">全部</li>
				<li class="am-modal-actions-header" onclick="chaxun(1);">今天</li>
				<li class="am-modal-actions-header" onclick="chaxun(2);">昨天</li>
				<li class="am-modal-actions-header" onclick="chaxun(3);">七天</li>
			</ul>
		</div>
		<div class="am-modal-actions-group">
			<button class="am-btn am-btn-secondary am-btn-block btn_red" data-am-modal-close>取消</button>
		</div>
	</div>
	<include file="Public/footer" />
	<script>
		setTimeout(function () {
			var test = window.location.href;
			var str = test.substr(test.length-7);
			switch (str){
				case 'atime=1':
					$('.bill_day').html('今天');
					break;
				case 'atime=2':
					$('.bill_day').html('昨天');
					break;
				case 'atime=3':
					$('.bill_day').html('七天');
					break;

			}
		})
		function chaxun(t){
//			var type = $('#type').val();
			var atime = t;
			var url = "__ROOT__/?m=Mobile&c=Account&a=dealRecord&atime="+atime/*+"&type="+type*/;
			window.location.href = url;
		}
	</script>
</body>
</html>