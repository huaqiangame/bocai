(function(q){
	var
	yrates = k3lotteryrates.rates,
	f_g_Number_Section = q.getElementsByClassName('g_Number_Section')[0],
	f_selectMultipInput = q.getElementsByClassName('selectMultipInput')[0],
	f_addtobetbtn = q.getElementsByClassName('addtobetbtn')[0],
	f_yBettingLists = q.getElementsByClassName('yBettingLists')[0],
	f_play_select_tit = document.getElementById('j_play_select'),
	f_p_title = q.getElementsByClassName('bet_filter_item')[0].getElementsByTagName('strong')[0],
	f_p_select = f_p_title.nextElementSibling,
	f_p_tips = q.getElementsByClassName('play_select_prompt')[0].lastElementChild,
	f_p_zhushu = q.getElementsByClassName('zhushu')[0],
	f_lottery_info_number = document.getElementById('f_lottery_info_number'),
	
	f_f_submit_order = document.getElementById('f_submit_order'),
	f_orderlist_clear = document.getElementById('orderlist_clear'),
	f_selectMultipInput = q.getElementsByClassName('selectMultipInput')[0],
	f_selectMultipleOldMoney = q.getElementsByClassName('selectMultipleOldMoney')[0],
	f_p_zhushut = document.getElementById('f_gameOrder_lotterys_num'),
	f_p_amount = document.getElementById('f_gameOrder_amount'),
	f_base_color = ['','red','blue','green'],
	f_orderList = [],
	f_objselect0 = f_play_select_tit.getElementsByTagName('li')[0],
	f_objselect1 = null,
	f_playname = [
		[
			[tmzx, '直选', '从1-49中任选1个或多个号码，每个号码为一注，所选号码中包含特码，即为中奖。 赔率:', 48.8 ],
			[tmlm,'两面', '开奖号码最后一位为特码。大于或等于25为特码大，小于或等于24为特码小；奇数为单，偶数为双；特码两个数相加后得数，奇数为合单，偶数为合双，小于等于6为合小，大于6为合大；尾大尾小即看特码个位数值，小于等于4为小，大于4为大；特码为49时为和，不算任何大小单双，但算波色。', 1]
		],
		[
			[zmrx, '任选', '从1-49中任选1个或多个号码，每个号码为一注，所选号码在开奖号码前六位中存在，即为中奖。 赔率', 8.00 ],
			[zm1t, '正 1 特', '从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第一位相同，即为中奖。 赔率',47.04 ],
			[zm1lm, '正 1 两面', '开奖号码第一位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。', 1 ],
			[zm2t, '正 2 特', '从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第二位相同，即为中奖。 赔率' , 47.04],
			[zm2lm, '正 2 两面', '开奖号码第二位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。' , 1],
			[zm3t, '正 3 特', '从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第三位相同，即为中奖。 赔率'  , 47.04],
			[zm3lm, '正 3 两面', '开奖号码第三位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。' , 1],
			[zm4t, '正 4 特', '从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第四位相同，即为中奖。 赔率' , 47.04 ],
			[zm4lm, '正 4 两面', '开奖号码第四位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。' , 1],
			[zm5t, '正 5 特', '从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第五位相同，即为中奖。 赔率' , 47.04 ],
			[zm5lm, '正 5 两面', '开奖号码第五位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。' , 1],
			[zm6t, '正 6 特', '从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第六位相同，即为中奖。 赔率'  , 47.04],
			[zm6lm, '正 6 两面', '开奖号码第六位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。' , 1]
		],
		[
			[lm3qz, '三全中', '至少选择三个号码，每三个号码为一组合，若三个号码都是开奖号码之正码，即为中奖。 赔率',663.26 ],
			[lm3z2, '三中二', '至少选择三个号码，每三个号码为一组合，若其中至少有两个是开奖号码中的正码，即为中奖。若中两码，叫三中二之中二;若三码全中，叫三中二之中三。' ],
			[lm2qz, '二全中', '至少选择两个号码，每二个码号为一组合，二个号码都是开奖码号之正码（不含特码），即为中奖。 赔率',66.64 ],
			//[lm2zt, '二中特', '至少选择两个号码，每二个号码为一组合，二个号码都是开奖号码（含特码），即为中奖。若两个都是正码，叫二中特之二中。若选号中包含特码，叫二中特之中特。' ],
			[lmtc, '特串', '至少选择两个号码，每二个号码为一组合，其中一个是正码，一个是特别号码，即为中奖。 赔率' ,160]
		],
		[
			[tmbb, '特码半波', '根据特码对应的特性来区分。分为红蓝绿三个波色，以及号码大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；合单合双为开奖号的十位与个位相加后得数的单双。下注内容与号码特性完全吻合即为中奖。特码为49时为和,不算任何大小单双。' ,1]
		],
		[
			[sxtx, '特肖', '从十二生肖中任选1个或多个，每个生肖为一注，所选生肖与特码对应的生肖相同，即为中奖。', 1 ],
			[sx1x, '一肖', '从十二生肖中任选1个或多个，每个生肖为一注，开奖号码（含特码）中含有投注所属生肖，即为中奖。' , 1],
			// [sx2xl, '二肖连', '至少选择两个生肖，每二个生肖为一组合，开奖号码（含特码）中含有投注所属全部生肖，即为中奖。' ],
			// [sx3xl, '三肖连', '至少选择三个生肖，每三个生肖为一组合，开奖号码（含特码）中含有投注所属全部生肖，即为中奖。' ],
			// [sx4xl, '四肖连', '至少选择四个生肖，每四个生肖为一组合，开奖号码（含特码）中含有投注所属全部生肖，即为中奖。' ]
		],
		[
			[wstw, '特码头尾', '选择特码头（十位）尾（个位）的数字进行投注，与特码相同，即为中奖' ],
			// [ws2wl, '二尾连', '至少选择两个尾数，每两个尾数为一组合，开奖号码（含特码）中含有投注对应全部尾数，即为中奖。' ],
			// [ws3wl, '三尾连', '至少选择三个尾数，每三个尾数为一组合，开奖号码（含特码）中含有投注对应全部尾数，即为中奖。' ],
			// [ws4wl, '四尾连', '至少选择四个尾数，每四个尾数为一组合，开奖号码（含特码）中含有投注对应全部尾数，即为中奖。' ]
		],
		[
			[bz5bz, '五不中', '至少选择五个号码，每五个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率' ,2.12],
			[bz6bz, '六不中', '至少选择六个号码，每六个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率' ,2.53],
			[bz7bz, '七不中', '至少选择七个号码，每七个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率' ,3.02],
			[bz8bz, '八不中', '至少选择八个号码，每八个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率' ,3.62],
			[bz9bz, '九不中', '至少选择九个号码，每九个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率' ,4.37],
			[bz10bz, '十不中', '至少选择十个号码，每十个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率' ,5.30]
		]
	], f_select_number = [], f_select_pname = null, f_p_unit = 1, f_p_rate = 2, f_re_cb;
	(function(){
		var sl = f_play_select_tit.getElementsByTagName('li');
		for (var i=0;i<sl.length;++i)
		{
			sl[i].dataset.i = i;
			sl[i].onclick = function(){
				f_objselect0.className = '';
				f_objselect0 = this;
				f_objselect0.className = 'curr';
				f_p_title.innerHTML = this.innerHTML;
				f_p_select0_call(this.dataset.i);
			}
		}
		f_p_title.innerHTML = f_objselect0.innerHTML;
		f_p_select0_call(0);
	}());

	function shengxiao_codes(){
		var
		ll = ['鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪'],
		kk = ((new Date).getFullYear() - 2008) % 12,
		qq = ll.splice(0, kk + 1), ss=[], oo = {};
		ll.push.apply(ll, qq);
		ll.reverse();
		for(var i=0;i<12;++i)
		{
			if(i===0)
			{
				oo[ll[i]] = ss[i] = [1,13,25,37,49];
				continue;
			}
			oo[ll[i]] = ss[i] = [
				ss[i-1][0] + 1,
				ss[i-1][1] + 1,
				ss[i-1][2] + 1,
				ss[i-1][3] + 1
			];
		}
		for(var i in oo){
			oo[i][0]=('0'+oo[i][0]).substr(-2);
			oo[i][1]=('0'+oo[i][1]).substr(-2);
			oo[i][2]=('0'+oo[i][2]).substr(-2);
			oo[i][3]=('0'+oo[i][3]).substr(-2);
		}
		return oo;
	}

	window.f_shengxiao_codes = shengxiao_codes();

	function f_p_select0_call(i){
		var sp = f_playname[i];
		f_p_select.innerHTML = '';
		for(i=0;i<sp.length;++i)
		{
			var span = document.createElement('span');
			span.dataset.i = i;
			span.innerHTML = sp[i][1];
			span.style.cssText = 'display:inline-block';
			if(i==0)//------------------------------------------
			{
				span.className = 'bet_options curr';
				f_objselect1 = span;
				f_p_tips.innerHTML = sp[i][2] + '<span id="spanpl">' + sp[i][3]+'</span>';
				f_select_pname = span.innerHTML;
				f_p_rate = sp[i][3];
				sp[i][0]();
				f_re_cb = sp[i][0];
			}
			else
			{
				span.className = 'bet_options';
			}
			span.onclick = function(){
				f_objselect1.className = 'bet_options';
				f_objselect1 = this;
				f_objselect1.className = 'bet_options curr';
				f_p_tips.innerHTML = sp[this.dataset.i][2] + ' <span id="spanpl">' + sp[this.dataset.i][3]+'</span>';
				f_select_pname = this.innerHTML;
				sp[this.dataset.i][0]();
				f_re_cb = sp[this.dataset.i][0];
			};
			f_p_select.appendChild(span);
		}
	}

	f_selectMultipInput.previousElementSibling.onclick = function()
	{
		var v = this.nextElementSibling.value | 0;
		this.nextElementSibling.value = --v < 1 ? 1 : v;
		f_dspyuan();
	}
	f_selectMultipInput.nextElementSibling.onclick = function()
	{
		var v = this.previousElementSibling.value | 0;
		this.previousElementSibling.value = ++v > 9999 ? 9999 : v;
		f_dspyuan();
	}




	function f_color(num)
	{
		switch(num)
		{
			case 1:case 2:case 7:case 8:case 12:case 13:case 18:case 19:
			case 23:case 24:case 29:case 30:case 34:case 35:case 40:case 45:case 46:
				return 1;
			case 3:case 4:case 9:case 10:case 14:case 15:case 20:case 25:case 26:
			case 31:case 36:case 37:case 41:case 42:case 47:case 48:
				return 2;
			case 5:case 6:case 11:case 16:case 17:case 21:case 22:case 27:case 28:
			case 32:case 33:case 38:case 39:case 43:case 44:case 49:
				return 3;
			default:
				return 0;
		}
	}


	function remove_arr_num(a,n)
	{
		var index = a.indexOf(n);
		if (index > -1) {
			a.splice(index, 1);
		}
	}
	function f_dspyuan()
	{
		var y = (f_select_number.length - 2) * f_selectMultipInput.value * f_p_unit;
		f_selectMultipleOldMoney.innerHTML = y + '.00';
	}
	function f_dspyuan2(num)
	{
		var y = num * f_selectMultipInput.value * f_p_unit;
		f_selectMultipleOldMoney.innerHTML = y + '.00';
	}
	function maketrano(str)
	{
		function h(str)
		{
		    for(var i = 0, len = str.length,hash = 5381; i < len; ++i){
		       hash += (hash << 5) + str.charAt(i).charCodeAt();
		    };
		    return btoa(hash & 0x7fffffff).toString();
		} 
		return (h(String(str)) + h(Math.random().toString())).replace(/(\/\=)+/g,'');
	}
	window.f_get_ddindex = function(q)
	{
		var ordes = f_yBettingLists.getElementsByTagName('dd');
		for(var i=0;i<ordes.length;++i)
		{
			if(ordes[i]===q.parentNode.parentNode)
			{
				return i;
			}
		}
		return 99999;
	}
	window.f_del_orderList = function(q)
	{
		f_orderList.splice(q, 1);
		var dd = f_yBettingLists.getElementsByTagName('dd')[q];
		if(dd)
		{
			if(/^\d+$/.test(dd.dataset.i))
			{
				var ecl;
				if(dd.dataset.e == 'tmlm' && f_g_Number_Section.getElementsByClassName(dd.dataset.e))
				{
					ecl = f_g_Number_Section.getElementsByClassName(dd.dataset.e)[0];
					ecl.childNodes[dd.dataset.i].className = '';
				}
			}
		}
		f_yBettingLists.removeChild(dd);
	}
	function add_orderList(i,e)
	{
		if(f_select_number.length < 3)return;
		var zhushu = (f_p_zhushu.innerHTML|0)?f_p_zhushu.innerHTML:1;

		var ee = document.createElement('dd'), id = f_orderList.length, xx = {
			'trano' : 'YTA2G91NDRZN1Y1BFLK1',
			'playtitle' : f_select_number[0],
			'playid' : f_select_number[1],
			'number' : f_select_number.slice(2).join('|'),
			'zhushu' : zhushu,
			'price' : '1.00',
			'minxf' : '1.00',
			'totalzs' : '100000',
			'maxjj' : '80000',
			'minjj' : '180000.00',
			'maxzs' : '100000',
			'rate' : f_p_rate,
			'beishu' : (f_selectMultipInput.value|0),
			'yjf' : '1'
		};
		f_orderList[id] = xx;

		ee.dataset.i = i;
		ee.dataset.e = e;
		ee.innerHTML = '<div class="numberBox yBettingDiv">'+
                          '<span class="number"><div class="yBettingType">['+f_select_number[0]+'，'+f_select_pname+']</div> <em>'+f_select_number.slice(2).join('|')+'</em></span>'+
                          '<a href="javascript:void(0);" class="numberInfo">详细</a> '+
                        '</div>'+
                        '&nbsp;<div class="yBettingZhushu yBettingDiv">'+
                          '<em>'+zhushu+'</em>注'+
                        '</div>'+
                        '&nbsp;<div class="yBettingTimes yBettingDiv">'+
                          '<em class="yBettingTimess">'+xx.beishu+'</em>倍'+
                        '</div>'+
                        '&nbsp;<div class="rmb yBettingDiv">元</div>'+
                        '&nbsp;<div class="maxMoney yBettingDiv">'+
                          '可中金额'+
                          '<em class="maxMoneyNumber">'+(xx.beishu*f_p_rate)+'元</em>'+
                        '</div>'+
                        '<div class="sc" style="float: right;padding-right: 5px;">'+
                          '<a href="javascript:;" onclick="f_del_orderList(f_get_ddindex(this))">'+
                            '<i class="fa fa-times" style="color: red;"></i>'+
                          '</a>'+
                        '</div>'+
                        '<div id="betting_money" style="display: none;">1</div>';

		f_yBettingLists.appendChild(ee);
	}


	function tmzx()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['特码','tmzx'];
		document.getElementById('spanpl').innerHTML = f_p_rate =yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				f_p_zhushu.innerHTML = f_select_number.length - 2;
				f_dspyuan();
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function tmlm()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['特码','tmlm'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmlm';

		var snu = [	['大'],['小'],['单'],['双'],['大单'],['大双'],['小单'],['小双'],['合大'],['合小'],['合单'],['合双'],['尾大'],['尾小'],['家禽'],['野兽'],['红波'],['绿波'],['蓝波']];
		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'</a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'tmlm');
				}
			}
			box.appendChild(li);
		}
	}
	
	function zmrx()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zmrx'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';

		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				f_p_zhushu.innerHTML = f_select_number.length - 2;
				f_dspyuan();
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function zm1t()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm1t'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				f_p_zhushu.innerHTML = f_select_number.length - 2;
				f_dspyuan();
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function zm1lm()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm1lm'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmlm';

		var snu = [['大'],['小'],['单'],['双'],['大单'],['大双'],['小单'],['小双'],['合大'],['合小'],['合单'],['合双'],['尾大'],['尾小'],['家禽'],['野兽'],['红波'],['绿波'],['蓝波']];


		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'</a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'zm1lm');
				}
			}
			box.appendChild(li);
		}
	}
	function zm2t()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm2t'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				f_p_zhushu.innerHTML = f_select_number.length - 2;
				f_dspyuan();
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function zm2lm()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm2lm'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmlm';

		var snu = [['大'],['小'],['单'],['双'],['大单'],['大双'],['小单'],['小双'],['合大'],['合小'],['合单'],['合双'],['尾大'],['尾小'],['家禽'],['野兽'],['红波'],['绿波'],['蓝波']];


		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'</a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'zm2lm');
				}
			}
			box.appendChild(li);
		}
	}
	function zm3t()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm3t'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				f_p_zhushu.innerHTML = f_select_number.length - 2;
				f_dspyuan();
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function zm3lm()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm3lm'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmlm';

		var snu = [['大'],['小'],['单'],['双'],['大单'],['大双'],['小单'],['小双'],['合大'],['合小'],['合单'],['合双'],['尾大'],['尾小'],['家禽'],['野兽'],['红波'],['绿波'],['蓝波']];


		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'</a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'zm3lm');
				}
			}
			box.appendChild(li);
		}
	}
	function zm4t()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm4t'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				f_p_zhushu.innerHTML = f_select_number.length - 2;
				f_dspyuan();
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function zm4lm()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm4lm'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmlm';

		var snu = [['大'],['小'],['单'],['双'],['大单'],['大双'],['小单'],['小双'],['合大'],['合小'],['合单'],['合双'],['尾大'],['尾小'],['家禽'],['野兽'],['红波'],['绿波'],['蓝波']];


		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'</a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'zm4lm');
				}
			}
			box.appendChild(li);
		}
	}
	function zm5t()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm5t'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				f_p_zhushu.innerHTML = f_select_number.length - 2;
				f_dspyuan();
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function zm5lm()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm5lm'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmlm';

		var snu = [['大'],['小'],['单'],['双'],['大单'],['大双'],['小单'],['小双'],['合大'],['合小'],['合单'],['合双'],['尾大'],['尾小'],['家禽'],['野兽'],['红波'],['绿波'],['蓝波']];


		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'</a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'zm5lm');
				}
			}
			box.appendChild(li);
		}
	}
	function zm6t()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm6t'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				f_p_zhushu.innerHTML = f_select_number.length - 2;
				f_dspyuan();
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function zm6lm()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['正码','zm6lm'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmlm';

		var snu = [['大'],['小'],['单'],['双'],['大单'],['大双'],['小单'],['小双'],['合大'],['合小'],['合单'],['合双'],['尾大'],['尾小'],['家禽'],['野兽'],['红波'],['绿波'],['蓝波']];


		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'</a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'zm6lm');
				}
			}
			box.appendChild(li);
		}
	}
	function lm3qz()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['连码','lm3qz'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num = '';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),3);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function lm2qz()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['连码','lm2qz'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num='';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),2);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function lmtc()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['连码','lmtc'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num = '';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),2);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function tmbb()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['半波','tmbb'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmbb';

		var snu = [	
		['红大', '29 30 34 35 40 45 46'],
		['红小', '01 02 07 08 12 13 18 19 23 24'],
		['红单', '01 07 13 19 23 29 35 45'],
		['红双', '02 08 12 18 23 29 30 34 45'],
		['红合单', '01 07 12 18 23 29 30 34 45'],
		['红合双', '02 08 13 19 24 35 40 46'],
		['绿大', '27 28 32 33 38 39 43 44'],
		['绿小', '05 06 11 16 17 21 22'],
		['绿单', '05 11 17 21 27 33 39 43'],
		['绿双', '06 16 22 28 32 38 44'],
		['绿合单', '05 16 21 27 32 38 43'],
		['绿合双', '06 11 17 22 28 33 39 44'],
		['蓝大', '25 26 31 36 37 41 42 47 48'],
		['蓝小', '03 04 09 10 14 15 20'],
		['蓝单', '03 09 15 25 31 37 41 47'],
		['蓝双', '04 10 14 20 26 36 42 48'],
		['蓝合单', '03 09 10 14 25 36 41 47'],
		['蓝合双', '04 15 20 26 31 37 42 48']];


		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'<div class="bet-item-eg-box">'+snu[i][1]+'</div></a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'tmbb');
				}
			}
			box.appendChild(li);
		}
	}
	function sxtx()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['生肖','sxtx'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmbb';

		var snu = [['鼠'],['牛'],['虎'],['兔'],['龙'],['蛇'],['马'],['羊'],['猴'],['鸡'],['狗'],['猪']];

		var sxhm = shengxiao_codes();
		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'<div class="bet-item-eg-box">'+sxhm[snu[i][0]].join(' ')+'</div></a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'sxtx');
				}
			}
			box.appendChild(li);
		}
	}
	function sx1x()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['生肖','sx1x'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmbb';

		var snu = [['鼠'],['牛'],['虎'],['兔'],['龙'],['蛇'],['马'],['羊'],['猴'],['鸡'],['狗'],['猪']];

		var sxhm = shengxiao_codes();
		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'<div class="bet-item-eg-box">'+sxhm[snu[i][0]].join(' ')+'</div></a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'sx1x');
				}
			}
			box.appendChild(li);
		}
	}
	function wstw()
	{
		document.getElementById('spanpl').style.display='none';
		f_addtobetbtn.style.display = 'none';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['尾数','wstw'];
		var f_wanfa = f_select_number[1];
		var box = f_g_Number_Section.appendChild(document.createElement('ul'));
		box.className = 'tmlm';

		var snu = [	['0头'],['1头'],['2头'],['3头'],['4头'],['0尾'],['1尾'],['2尾'],['3尾'],['4尾'],['5尾'],['6尾'],['7尾'],['8尾'],['9尾']];


		for (var i in snu)
		{
			var li = document.createElement('li');
			li.innerHTML = '<a>'+snu[i][0]+'</a><span>赔率'+yrates[f_wanfa+i].maxjj+'</span>';
			li.dataset.c = snu[i][0];
			li.dataset.rat = yrates[f_wanfa+i].maxjj;
			li.dataset.idx = i;
			li.onclick = function(){
				if( this.className == 'curr')
				{
					this.className = '';
					f_del_orderList(this.dataset.i);
				}
				else
				{
					this.className = 'curr';
					f_select_number[2] = this.dataset.c;
					f_select_number[1] = f_wanfa + this.dataset.idx;
					this.dataset.i = f_orderList.length;
					f_p_rate = this.dataset.rat;
					add_orderList(this.dataset.idx, 'wstw');
				}
			}
			box.appendChild(li);
		}
	}
	function bz5bz()
	{
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['不中','bz5bz'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num = '';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),5);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function bz6bz(){
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['不中','bz6bz'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num = '';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),6);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function bz7bz(){
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['不中','bz7bz'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num = '';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),7);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function bz8bz(){
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['不中','bz8bz'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num = '';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),8);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function bz9bz(){
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['不中','bz9bz'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num = '';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),9);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}
	function bz10bz(){
		f_addtobetbtn.style.display = '';
		f_g_Number_Section.innerHTML = '';
		f_select_number = ['不中','bz10bz'];
		document.getElementById('spanpl').innerHTML = f_p_rate = yrates[f_select_number[1]].maxjj;
		var box = f_g_Number_Section.appendChild(document.createElement('div'));
		box.className = 'f_select0';
		var num = '';
		for(var i = 1;i<=49;++i)
		{
			var dd = document.createElement('span');
			dd.dataset.c = f_color(i);
			dd.className = f_base_color[dd.dataset.c] + '0';

			dd.onclick = function(){
				var down = this.className.substr(-1);
				if( down == 0)
				{
					down = 1;
					f_select_number.push(this.innerHTML);
				}
				else
				{
					remove_arr_num(f_select_number, this.innerHTML);
					down = 0;
				}
				this.className = f_base_color[this.dataset.c] + down;
				num = combine(f_select_number.slice(2),10);
				f_p_zhushu.innerHTML = num;
				f_dspyuan2(num);
			}
			
			dd.innerHTML = i;
			box.appendChild(dd);
		}
	}


	function f_re_select()
	{
		f_select_number.splice(2);
		f_p_zhushu.innerHTML = 0;
		f_selectMultipInput.value = 1;
		f_selectMultipleOldMoney.innerHTML = '0.00';
		f_re_cb();
	}
	//组合算法
	function combine(arr, num) {
	    var r = [];
	    (function f(t, a, n) {
	      if (n == 0) return r.push(t);
	      for (var i = 0, l = a.length; i <= l - n; i++) {
	        f(t.concat(a[i]), a.slice(i + 1), n - 1);
	      }
	    })([], arr, num);
	    return r.length;
	}


	f_addtobetbtn.onclick = function()
	{
		add_orderList();
		f_p_zhushut.innerHTML = f_orderList.length;
		f_p_amount.innerHTML = 3;
		f_re_select();
	}
	f_f_submit_order.onclick = function(){
		f_re_select();
          $.ajax({
            type : "POST",
            url  : '/Apijiekou.cpbuy',
            data : {
              "orderList":f_orderList,
              'expect':f_lottery_info_number.innerHTML,
              'lotteryname':'xglhc'
            },
            beforeSend :  function () {
              $('.looding').show();
            },
            success : function (json) {
              if(json.sign){
                $("#orderlist_clear").click();
                getUserBetsListToday(lotteryname);
                alt('投注成功',1);
              }else{
                alt(json.message,-1);
              }
              $('.looding').hide();
            }
          });
	}
	f_orderlist_clear.onclick = function(){
		f_yBettingLists.innerHTML = '';
		f_orderList = [];
	}

})(document.getElementById('gameBet'))