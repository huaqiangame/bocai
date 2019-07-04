<?php
namespace Lib;
class wanfa {
	//typeid (ssc,k3...)
	function getplayers($typeid){
		$playrules = [];
		$_wfs = $this->$typeid();
		if(!method_exists($this,$typeid)){
			return false;
		}
		foreach($_wfs as $k=>$v){
			foreach($v['list'] as $k1=>$v1){
				$playrules[$v1['playid']] = $v1;
			}
		}
		return $playrules;
	}
	function xy28(){
		$tms = [];
		for($i=0;$i<=27;$i++){
			/*$tm = str_pad($i,2,0,STR_PAD_LEFT);*/
			$tms[] = ['playid'=>'xy28_tm_'.str_pad($i,2,0,STR_PAD_LEFT),'rate'=>1,'title'=>$i];
		}
		$xy28 = [
			'tm'=>[
				'title'=>'特码',
				'list'=>$tms
			],
			'hunhe'=>[
				'title'=>'混合',
				'list'=>[
					['playid'=>'xy28_hunhe_big','rate'=>1,'title'=>'大'],
					['playid'=>'xy28_hunhe_small','rate'=>1,'title'=>'小'],
					['playid'=>'xy28_hunhe_odd','rate'=>1,'title'=>'单'],
					['playid'=>'xy28_hunhe_even','rate'=>1,'title'=>'双'],
					['playid'=>'xy28_hunhe_big_odd','rate'=>1,'title'=>'大单'],
					['playid'=>'xy28_hunhe_small_odd','rate'=>1,'title'=>'小单'],
					['playid'=>'xy28_hunhe_big_even','rate'=>1,'title'=>'大双'],
					['playid'=>'xy28_hunhe_small_even','rate'=>1,'title'=>'小双'],
					['playid'=>'xy28_hunhe_ji_big','rate'=>1,'title'=>'极大'],
					['playid'=>'xy28_hunhe_ji_small','rate'=>1,'title'=>'极小'],
				],
			],
		];
		return $xy28;
	}
	function keno(){
		$zhuzis = [];
		for($i=1;$i<=80;$i++){
			$zhuzi = str_pad($i,2,0,STR_PAD_LEFT);
			$zhuzis[] = ['playid'=>'keno_zhuzi_'.$zhuzi,'title'=>$zhuzi];
		}
		$klc = [
			'rx1'=>[
				'title'=>'任选一',
				'list'=>[
					['playid'=>'bjkl8rx1','title'=>'任选一'],
				],
			],
			'rx2'=>[
				'title'=>'任选二',
				'list'=>[
					['playid'=>'bjkl8rx2','title'=>'任选二'],
				],
			],
			'rx3'=>[
				'title'=>'任选三',
				'list'=>[
					['playid'=>'bjkl8rx3','title'=>'任选三'],
				],
			],
			'rx4'=>[
				'title'=>'任选四',
				'list'=>[
					['playid'=>'bjkl8rx4','title'=>'任选四'],
				],
			],
			'rx5'=>[
				'title'=>'任选五',
				'list'=>[
					['playid'=>'bjkl8rx5','title'=>'任选五'],
				],
			],
			'rx6'=>[
				'title'=>'任选六',
				'list'=>[
					['playid'=>'bjkl8rx6','title'=>'任选六'],
				],
			],
			'rx7'=>[
				'title'=>'任选七',
				'list'=>[
					['playid'=>'bjkl8rx7','title'=>'任选七'],
				],
			],
			'quw'=>[
				'title'=>'趣味',
				'list'=>[
					['playid'=>'bjkl8sxp','title'=>'上下盘'],
					['playid'=>'bjkl8jop','title'=>'奇偶盘'],
					['playid'=>'bjkl8dxds','title'=>'大小单双'],
				],
			],
			/*'zhuzi'=>[
				'title'=>'珠仔',
				'list'=>$zhuzis
			],*/
		];
		return $klc;
	}
	function lhc(){
		$lhc = [
			'tmzx'=>[
				'title'=>'特码直选',
				'list'=>[
					['playid'=>'tmzx','rate'=>'48.51','title'=>'直选A'],
                    ['playid'=>'tmzx2','rate'=>'42.00','title'=>'直选B'],
				],
			],
			'tmlm'=>[
				'title'=>'特码两面',
				'list'=>[
					['playid'=>'tmlmda',          'rate'=>'1.980','title'=>'特码大'],
					['playid'=>'tmlmxiao',        'rate'=>'1.980','title'=>'特码小'],
					['playid'=>'tmlmdan',         'rate'=>'1.980','title'=>'特码单'],
					['playid'=>'tmlmshuang',      'rate'=>'1.980','title'=>'特码双'],
					['playid'=>'tmlmdadan',       'rate'=>'3.960','title'=>'特码大单'],
					['playid'=>'tmlmdashuang',    'rate'=>'3.960','title'=>'特码大双'],
					['playid'=>'tmlmxiaodan',     'rate'=>'3.960','title'=>'特码小单'],
					['playid'=>'tmlmxiaoshuang',  'rate'=>'3.960','title'=>'特码小双'],
					['playid'=>'tmlmheda',        'rate'=>'1.980','title'=>'特码合大'],
					['playid'=>'tmlmhexiao',      'rate'=>'1.980','title'=>'特码合小'],
					['playid'=>'tmlmhedan',       'rate'=>'1.980','title'=>'特码合单'],
					['playid'=>'tmlmheshuang',    'rate'=>'1.980','title'=>'特码合双'],
					['playid'=>'tmlmweida',       'rate'=>'1.980','title'=>'特码尾大'],
					['playid'=>'tmlmweixiao',     'rate'=>'1.980','title'=>'特码尾小'],
					['playid'=>'tmlmjiaqin',      'rate'=>'1.901','title'=>'特码家禽'],
					['playid'=>'tmlmyeshou',      'rate'=>'1.980','title'=>'特码野兽'],
					['playid'=>'tmlmhongbo',      'rate'=>'2.795','title'=>'特码红波'],
					['playid'=>'tmlmlvbo',        'rate'=>'2.970','title'=>'特码绿波'],
					['playid'=>'tmlmlanbo',       'rate'=>'2.970','title'=>'特码蓝波'],
				],
			],
			'lhc_zm'=>[
				'title'=>'正码',
				'list'=>[
					['playid'=>'zmrx','rate'=>'8.00','title'=>'任选'],
					['playid'=>'zm1t','rate'=>'47.04','title'=>'正1特'],
					['playid'=>'zm2t','rate'=>'47.04','title'=>'正2特'],
					['playid'=>'zm3t','rate'=>'47.04','title'=>'正3特'],
					['playid'=>'zm4t','rate'=>'47.04','title'=>'正4特'],
					['playid'=>'zm5t','rate'=>'47.04','title'=>'正5特'],
					['playid'=>'zm6t','rate'=>'47.04','title'=>'正6特'],
				],
			],
			'zm1lm'=>[
				'title'=>'正1两面',
				'list'=>[
					['playid'=>'zm1lmda',           'rate'=>'1.980','title'=>'正1大'],
					['playid'=>'zm1lmxiao',         'rate'=>'1.980','title'=>'正1小'],
					['playid'=>'zm1lmdan',          'rate'=>'1.980','title'=>'正1单'],
					['playid'=>'zm1lmshuang',       'rate'=>'1.980','title'=>'正1双'],
					['playid'=>'zm1lmdadan',        'rate'=>'3.960','title'=>'正1大单'],
					['playid'=>'zm1lmdashuang',     'rate'=>'3.960','title'=>'正1大双'],
					['playid'=>'zm1lmxiaodan',      'rate'=>'3.960','title'=>'正1小单'],
					['playid'=>'zm1lmxiaoshuang',   'rate'=>'3.960','title'=>'正1小双'],
					['playid'=>'zm1lmheda',         'rate'=>'1.980','title'=>'正1合大'],
					['playid'=>'zm1lmhexiao',       'rate'=>'1.980','title'=>'正1合小'],
					['playid'=>'zm1lmhedan',        'rate'=>'1.980','title'=>'正1合单'],
					['playid'=>'zm1lmheshuang',     'rate'=>'1.980','title'=>'正1合双'],
					['playid'=>'zm1lmweida',        'rate'=>'1.980','title'=>'正1尾大'],
					['playid'=>'zm1lmweixiao',      'rate'=>'1.980','title'=>'正1尾小'],
					['playid'=>'zm1lmjiaqin',       'rate'=>'1.901','title'=>'正1家禽'],
					['playid'=>'zm1lmyeshou',       'rate'=>'1.980','title'=>'正1野兽'],
					['playid'=>'zm1lmhongbo',       'rate'=>'2.795','title'=>'正1红波'],
					['playid'=>'zm1lmlvbo',         'rate'=>'2.970','title'=>'正1绿波'],
					['playid'=>'zm1lmlanbo',        'rate'=>'2.970','title'=>'正1蓝波'],
				],
			],
			'zm2lm'=>[
				'title'=>'正2两面',
				'list'=>[
					['playid'=>'zm2lmda',           'rate'=>'1.980','title'=>'正2大'],
					['playid'=>'zm2lmxiao',         'rate'=>'1.980','title'=>'正2小'],
					['playid'=>'zm2lmdan',          'rate'=>'1.980','title'=>'正2单'],
					['playid'=>'zm2lmshuang',       'rate'=>'1.980','title'=>'正2双'],
					['playid'=>'zm2lmdadan',        'rate'=>'3.960','title'=>'正2大单'],
					['playid'=>'zm2lmdashuang',     'rate'=>'3.960','title'=>'正2大双'],
					['playid'=>'zm2lmxiaodan',      'rate'=>'3.960','title'=>'正2小单'],
					['playid'=>'zm2lmxiaoshuang',   'rate'=>'3.960','title'=>'正2小双'],
					['playid'=>'zm2lmheda',         'rate'=>'1.980','title'=>'正2合大'],
					['playid'=>'zm2lmhexiao',       'rate'=>'1.980','title'=>'正2合小'],
					['playid'=>'zm2lmhedan',        'rate'=>'1.980','title'=>'正2合单'],
					['playid'=>'zm2lmheshuang',     'rate'=>'1.980','title'=>'正2合双'],
					['playid'=>'zm2lmweida',        'rate'=>'1.980','title'=>'正2尾大'],
					['playid'=>'zm2lmweixiao',      'rate'=>'1.980','title'=>'正2尾小'],
					['playid'=>'zm2lmjiaqin',       'rate'=>'1.901','title'=>'正2家禽'],
					['playid'=>'zm2lmyeshou',       'rate'=>'1.980','title'=>'正2野兽'],
					['playid'=>'zm2lmhongbo',       'rate'=>'2.795','title'=>'正2红波'],
					['playid'=>'zm2lmlvbo',         'rate'=>'2.970','title'=>'正2绿波'],
					['playid'=>'zm2lmlanbo',        'rate'=>'2.970','title'=>'正2蓝波'],
				],
			],
			'zm3lm'=>[
				'title'=>'正3两面',
				'list'=>[
					['playid'=>'zm3lmda',           'rate'=>'1.980','title'=>'正3大'],
					['playid'=>'zm3lmxiao',         'rate'=>'1.980','title'=>'正3小'],
					['playid'=>'zm3lmdan',          'rate'=>'1.980','title'=>'正3单'],
					['playid'=>'zm3lmshuang',       'rate'=>'1.980','title'=>'正3双'],
					['playid'=>'zm3lmdadan',        'rate'=>'3.960','title'=>'正3大单'],
					['playid'=>'zm3lmdashuang',     'rate'=>'3.960','title'=>'正3大双'],
					['playid'=>'zm3lmxiaodan',      'rate'=>'3.960','title'=>'正3小单'],
					['playid'=>'zm3lmxiaoshuang',   'rate'=>'3.960','title'=>'正3小双'],
					['playid'=>'zm3lmheda',         'rate'=>'1.980','title'=>'正3合大'],
					['playid'=>'zm3lmhexiao',       'rate'=>'1.980','title'=>'正3合小'],
					['playid'=>'zm3lmhedan',        'rate'=>'1.980','title'=>'正3合单'],
					['playid'=>'zm3lmheshuang',     'rate'=>'1.980','title'=>'正3合双'],
					['playid'=>'zm3lmweida',        'rate'=>'1.980','title'=>'正3尾大'],
					['playid'=>'zm3lmweixiao',      'rate'=>'1.980','title'=>'正3尾小'],
					['playid'=>'zm3lmjiaqin',       'rate'=>'1.901','title'=>'正3家禽'],
					['playid'=>'zm3lmyeshou',       'rate'=>'1.980','title'=>'正3野兽'],
					['playid'=>'zm3lmhongbo',       'rate'=>'2.795','title'=>'正3红波'],
					['playid'=>'zm3lmlvbo',         'rate'=>'2.970','title'=>'正3绿波'],
					['playid'=>'zm3lmlanbo',        'rate'=>'2.970','title'=>'正3蓝波'],
				],
			],
			'zm4lm'=>[
				'title'=>'正4两面',
				'list'=>[
					['playid'=>'zm4lmda',           'rate'=>'1.980','title'=>'正4大'],
					['playid'=>'zm4lmxiao',         'rate'=>'1.980','title'=>'正4小'],
					['playid'=>'zm4lmdan',          'rate'=>'1.980','title'=>'正4单'],
					['playid'=>'zm4lmshuang',       'rate'=>'1.980','title'=>'正4双'],
					['playid'=>'zm4lmdadan',        'rate'=>'3.960','title'=>'正4大单'],
					['playid'=>'zm4lmdashuang',     'rate'=>'3.960','title'=>'正4大双'],
					['playid'=>'zm4lmxiaodan',      'rate'=>'3.960','title'=>'正4小单'],
					['playid'=>'zm4lmxiaoshuang',   'rate'=>'3.960','title'=>'正4小双'],
					['playid'=>'zm4lmheda',         'rate'=>'1.980','title'=>'正4合大'],
					['playid'=>'zm4lmhexiao',       'rate'=>'1.980','title'=>'正4合小'],
					['playid'=>'zm4lmhedan',        'rate'=>'1.980','title'=>'正4合单'],
					['playid'=>'zm4lmheshuang',     'rate'=>'1.980','title'=>'正4合双'],
					['playid'=>'zm4lmweida',        'rate'=>'1.980','title'=>'正4尾大'],
					['playid'=>'zm4lmweixiao',      'rate'=>'1.980','title'=>'正4尾小'],
					['playid'=>'zm4lmjiaqin',       'rate'=>'1.901','title'=>'正4家禽'],
					['playid'=>'zm4lmyeshou',       'rate'=>'1.980','title'=>'正4野兽'],
					['playid'=>'zm4lmhongbo',       'rate'=>'2.795','title'=>'正4红波'],
					['playid'=>'zm4lmlvbo',         'rate'=>'2.970','title'=>'正4绿波'],
					['playid'=>'zm4lmlanbo',        'rate'=>'2.970','title'=>'正4蓝波'],
				],
			],
			'zm5lm'=>[
				'title'=>'正5两面',
				'list'=>[
					['playid'=>'zm5lmda',           'rate'=>'1.980','title'=>'正5大'],
					['playid'=>'zm5lmxiao',         'rate'=>'1.980','title'=>'正5小'],
					['playid'=>'zm5lmdan',          'rate'=>'1.980','title'=>'正5单'],
					['playid'=>'zm5lmshuang',       'rate'=>'1.980','title'=>'正5双'],
					['playid'=>'zm5lmdadan',        'rate'=>'3.960','title'=>'正5大单'],
					['playid'=>'zm5lmdashuang',     'rate'=>'3.960','title'=>'正5大双'],
					['playid'=>'zm5lmxiaodan',      'rate'=>'3.960','title'=>'正5小单'],
					['playid'=>'zm5lmxiaoshuang',   'rate'=>'3.960','title'=>'正5小双'],
					['playid'=>'zm5lmheda',         'rate'=>'1.980','title'=>'正5合大'],
					['playid'=>'zm5lmhexiao',       'rate'=>'1.980','title'=>'正5合小'],
					['playid'=>'zm5lmhedan',        'rate'=>'1.980','title'=>'正5合单'],
					['playid'=>'zm5lmheshuang',     'rate'=>'1.980','title'=>'正5合双'],
					['playid'=>'zm5lmweida',        'rate'=>'1.980','title'=>'正5尾大'],
					['playid'=>'zm5lmweixiao',      'rate'=>'1.980','title'=>'正5尾小'],
					['playid'=>'zm5lmjiaqin',       'rate'=>'1.901','title'=>'正5家禽'],
					['playid'=>'zm5lmyeshou',       'rate'=>'1.980','title'=>'正5野兽'],
					['playid'=>'zm5lmhongbo',       'rate'=>'2.795','title'=>'正5红波'],
					['playid'=>'zm5lmlvbo',         'rate'=>'2.970','title'=>'正5绿波'],
					['playid'=>'zm5lmlanbo',        'rate'=>'2.970','title'=>'正5蓝波'],
				],
			],
			'zm6lm'=>[
				'title'=>'正6两面',
				'list'=>[
					['playid'=>'zm6lmda',           'rate'=>'1.980','title'=>'正6大'],
					['playid'=>'zm6lmxiao',         'rate'=>'1.980','title'=>'正6小'],
					['playid'=>'zm6lmdan',          'rate'=>'1.980','title'=>'正6单'],
					['playid'=>'zm6lmshuang',       'rate'=>'1.980','title'=>'正6双'],
					['playid'=>'zm6lmdadan',        'rate'=>'3.960','title'=>'正6大单'],
					['playid'=>'zm6lmdashuang',     'rate'=>'3.960','title'=>'正6大双'],
					['playid'=>'zm6lmxiaodan',      'rate'=>'3.960','title'=>'正6小单'],
					['playid'=>'zm6lmxiaoshuang',   'rate'=>'3.960','title'=>'正6小双'],
					['playid'=>'zm6lmheda',         'rate'=>'1.980','title'=>'正6合大'],
					['playid'=>'zm6lmhexiao',       'rate'=>'1.980','title'=>'正6合小'],
					['playid'=>'zm6lmhedan',        'rate'=>'1.980','title'=>'正6合单'],
					['playid'=>'zm6lmheshuang',     'rate'=>'1.980','title'=>'正6合双'],
					['playid'=>'zm6lmweida',        'rate'=>'1.980','title'=>'正6尾大'],
					['playid'=>'zm6lmweixiao',      'rate'=>'1.980','title'=>'正6尾小'],
					['playid'=>'zm6lmjiaqin',       'rate'=>'1.901','title'=>'正6家禽'],
					['playid'=>'zm6lmyeshou',       'rate'=>'1.980','title'=>'正6野兽'],
					['playid'=>'zm6lmhongbo',       'rate'=>'2.795','title'=>'正6红波'],
					['playid'=>'zm6lmlvbo',         'rate'=>'2.970','title'=>'正6绿波'],
					['playid'=>'zm6lmlanbo',        'rate'=>'2.970','title'=>'正6蓝波'],
				],
			],
			'lm'=>[
				'title'=>'连码',
				'list'=>[
					['playid'=>'lm3qz','rate'=>'663.26','title'=>'三全中'],
					['playid'=>'lm3z2','rate'=>'20.88|109.62','title'=>'三中二'],
					['playid'=>'lm2qz','rate'=>'66.64','title'=>'二全中'],
					['playid'=>'lm2zt','rate'=>'53.31|33.2','title'=>'二中特'],
					['playid'=>'lmtc','rate'=>'160.72','title'=>'特串'],
				],
			],
			'tmbb'=>[
				'title'=>'特码半波',
				'list'=>[
					['playid'=>'hongda','rate'=>'6.650','title'=>'红大'],
					['playid'=>'hongxiao','rate'=>'4.655','title'=>'红小'],
					['playid'=>'hongdan','rate'=>'5.818','title'=>'红单'],
					['playid'=>'hongshuang','rate'=>'5.172','title'=>'红双'],
					['playid'=>'honghedan','rate'=>'5.172','title'=>'红合单'],
					['playid'=>'hongheshuang','rate'=>'5.818','title'=>'红合双'],
					['playid'=>'lvda','rate'=>'5.818','title'=>'绿大'],
					['playid'=>'lvxiao','rate'=>'6.650','title'=>'绿小'],
					['playid'=>'lvdan','rate'=>'5.818','title'=>'绿单'],
					['playid'=>'lvshuang','rate'=>'6.650','title'=>'绿双'],
					['playid'=>'lvhedan','rate'=>'6.650','title'=>'绿合单'],
					['playid'=>'lvheshuang','rate'=>'5.818','title'=>'绿合双'],
					['playid'=>'landa','rate'=>'5.172','title'=>'蓝大'],
					['playid'=>'lanxiao','rate'=>'6.650','title'=>'蓝小'],
					['playid'=>'landan','rate'=>'5.818','title'=>'蓝单'],
					['playid'=>'lanshuang','rate'=>'5.818','title'=>'蓝双'],
					['playid'=>'lanhedan','rate'=>'5.818','title'=>'蓝合单'],
					['playid'=>'lanheshuang','rate'=>'5.818','title'=>'蓝合双'],
				],
			],
			'sxtx'=>[
				'title'=>'特肖',
				'list'=>[
					['playid'=>'sxtxshu','rate'=>'11.63','title'=>'特肖鼠'],
					['playid'=>'sxtxniu','rate'=>'11.63','title'=>'特肖牛'],
					['playid'=>'sxtxhu','rate'=>'11.63','title'=>'特肖虎'],
					['playid'=>'sxtxtu','rate'=>'11.63','title'=>'特肖兔'],
					['playid'=>'sxtxlong','rate'=>'11.63','title'=>'特肖龙'],
					['playid'=>'sxtxshe','rate'=>'11.63','title'=>'特肖蛇'],
					['playid'=>'sxtxma','rate'=>'11.63','title'=>'特肖马'],
					['playid'=>'sxtxyang','rate'=>'11.63','title'=>'特肖羊'],
					['playid'=>'sxtxhou','rate'=>'11.63','title'=>'特肖猴'],
					['playid'=>'sxtxji','rate'=>'9.31','title'=>'特肖鸡'],
					['playid'=>'sxtxgou','rate'=>'11.63','title'=>'特肖狗'],
					['playid'=>'sxtxzhu','rate'=>'11.63','title'=>'特肖猪'],
				],
			],
			'sx1x'=>[
				'title'=>'一肖',
				'list'=>[
					['playid'=>'sx1xshu','rate'=>'2.013','title'=>'一肖鼠'],
					['playid'=>'sx1xniu','rate'=>'2.013','title'=>'一肖牛'],
					['playid'=>'sx1xhu','rate'=>'2.013','title'=>'一肖虎'],
					['playid'=>'sx1xtu','rate'=>'2.013','title'=>'一肖兔'],
					['playid'=>'sx1xlong','rate'=>'2.013','title'=>'一肖龙'],
					['playid'=>'sx1xshe','rate'=>'2.013','title'=>'一肖蛇'],
					['playid'=>'sx1xma','rate'=>'2.013','title'=>'一肖马'],
					['playid'=>'sx1xyang','rate'=>'2.013','title'=>'一肖羊'],
					['playid'=>'sx1xhou','rate'=>'2.013','title'=>'一肖猴'],
					['playid'=>'sx1xji','rate'=>'1.715','title'=>'一肖鸡'],
					['playid'=>'sx1xgou','rate'=>'2.013','title'=>'一肖狗'],
					['playid'=>'sx1xzhu','rate'=>'2.013','title'=>'一肖猪'],
				],
			],
			'sx2xl'=>[
				'title'=>'二肖连',
				'list'=>[
					['playid'=>'sx2xl','rate'=>'3.62|4.28','title'=>'二肖连'],
				],
			],
			'sx3xl'=>[
				'title'=>'三肖连',
				'list'=>[
					['playid'=>'sx3xl','rate'=>'9.17|10.93','title'=>'三肖连'],
				],
			],
			'sx4xl'=>[
				'title'=>'四肖连',
				'list'=>[
					['playid'=>'sx4xl','rate'=>'26.57|31.97','title'=>'四肖连'],
				],
			],
			'wstw'=>[
				'title'=>'特码头尾',
				'list'=>[
					['playid'=>'lingtou','rate'=>'5.17','title'=>'0头'],
					['playid'=>'yitou','rate'=>'4.65','title'=>'1头'],
					['playid'=>'ertou','rate'=>'4.65','title'=>'2头'],
					['playid'=>'santou','rate'=>'4.65','title'=>'3头'],
					['playid'=>'sitou','rate'=>'4.65','title'=>'4头'],
					['playid'=>'lingwei','rate'=>'11.63','title'=>'0尾'],
					['playid'=>'yiwei','rate'=>'9.31','title'=>'1尾'],
					['playid'=>'erwei','rate'=>'9.31','title'=>'2尾'],
					['playid'=>'sanwei','rate'=>'9.31','title'=>'3尾'],
					['playid'=>'siwei','rate'=>'9.31','title'=>'4尾'],
					['playid'=>'wuwei','rate'=>'9.31','title'=>'5尾'],
					['playid'=>'liuwei','rate'=>'9.31','title'=>'6尾'],
					['playid'=>'qiwei','rate'=>'9.31','title'=>'7尾'],
					['playid'=>'bawei','rate'=>'9.31','title'=>'8尾'],
					['playid'=>'jiuwei','rate'=>'9.31','title'=>'9尾'],
				],
			],
			'ws2wl'=>[
				'title'=>'二尾连',
				'list'=>[
					['playid'=>'ws2wl','rate'=>'3.62|3.06','title'=>'二尾连'],
				],
			],
			'ws3wl'=>[
				'title'=>'三尾连',
				'list'=>[
					['playid'=>'ws3wl','rate'=>'7.69|6.45','title'=>'三尾连'],
				],
			],
			'ws4wl'=>[
				'title'=>'四尾连',
				'list'=>[
					['playid'=>'ws4wl','rate'=>'18.36|15.28','title'=>'四尾连'],
				],
			],
			'bz'=>[
				'title'=>'不中',
				'list'=>[
					['playid'=>'bz5bz','rate'=>'2.12','title'=>'五不中'],
					['playid'=>'bz6bz','rate'=>'2.53','title'=>'六不中'],
					['playid'=>'bz7bz','rate'=>'3.02','title'=>'七不中'],
					['playid'=>'bz8bz','rate'=>'3.62','title'=>'八不中'],
					['playid'=>'bz9bz','rate'=>'4.37','title'=>'九不中'],
					['playid'=>'bz10bz','rate'=>'5.30','title'=>'十不中'],
				],
			],


		];
		return $lhc;
	}
	function dpc(){
		$dp3 = [
			'x3'=>[
				'title'=>'直选',
				'list'=>[
					['playid'=>'pl3zxfs','title'=>'三星直选复式'],
					['playid'=>'pl3zxds','title'=>'三星直选单式'],
				],
			],
			'zx'=>[
				'title'=>'组选',
				'list'=>[
					['playid'=>'pl3zux3','title'=>'三星组三'],
					['playid'=>'pl3zux6','title'=>'三星组六'],
					['playid'=>'pl3zuxhh','title'=>'三星混合组选'],
					/*					['playid'=>'pl3zux3dt','title'=>'三星组三拖胆'],
                                        ['playid'=>'pl3zux6dt','title'=>'三星组六拖胆'],*/
					['playid'=>'pl3zuxbd','title'=>'三星组选包胆'],
					['playid'=>'pl3zsds','title'=>'三星组三单式'],
					['playid'=>'pl3zlds','title'=>'三星组六单式'],
					['playid'=>'pl3q2zxfs','title'=>'前二组选复式'],
					['playid'=>'pl3q2zxds','title'=>'前二组选单式'],
					['playid'=>'pl3q2zxbd','title'=>'前二组选包胆'],
					['playid'=>'pl3h2zxfs','title'=>'后二组选复式'],
					['playid'=>'pl3h2zxds','title'=>'后二组选单式'],
					['playid'=>'pl3h2zxbd','title'=>'后二组选包胆'],
				],
			],
			'x2'=>[
				'title'=>'二星',
				'list'=>[
					['playid'=>'pl3qx2fs','title'=>'前二直选复式'],
					['playid'=>'pl3qx2ds','title'=>'前二直选单式'],
					['playid'=>'pl3hx2fs','title'=>'后二直选复式'],
					['playid'=>'pl3hx2ds','title'=>'后二直选单式'],
				],
			],
			'bdw'=>[
				'title'=>'不定位',
				'list'=>[
					['playid'=>'pl3ymbdw','title'=>'三星一码不定位'],

					['playid'=>'pl3rmbdw','title'=>'三星二码不定位'],
					['playid'=>'pl3kd','title'=>'三星跨度'],
					['playid'=>'pl3q2kd','title'=>'前二跨度'],
					['playid'=>'pl3h2kd','title'=>'后二跨度'],
				],
			],
			'dw'=>[
				'title'=>'定位胆',
				'list'=>[
					['playid'=>'pl3dwdfs','title'=>'复式'],
					/*					['playid'=>'pl3dwd1q','title'=>'前一'],
                                        ['playid'=>'pl3dwd1z','title'=>'中一'],
                                        ['playid'=>'pl3dwd1h','title'=>'后一'],*/
				],
			],
			'hz'=>[
				'title'=>'和值',
				'list'=>[
					['playid'=>'pl3hzzx','title'=>'三星直选和值'],
					/*				['playid'=>'pl3hzzux3','title'=>'和值组三'],
                                    ['playid'=>'pl3hzzux6','title'=>'和值组六'],
					['playid'=>'pl3hzdx','title'=>'和值大小'],*/
					['playid'=>'pl3zuxhz','title'=>'三星组选和值'],
					['playid'=>'pl3q2zxhz','title'=>'前二直选和值'],
					['playid'=>'pl3q2zuxhz','title'=>'前二组选和值'],
					['playid'=>'pl3h2zxhz','title'=>'后二直选和值'],
					['playid'=>'pl3h2zuxhz','title'=>'后二组选和值'],
				],
			],
			'dxds'=>[
				'title'=>'大小单双',
				'list'=>[
					['playid'=>'dxdsq2','title'=>'前二大小单双'],
					['playid'=>'dxdsh2','title'=>'后二大小单双'],
				],
			],
			/*			'quw'=>[
                            'title'=>'趣味',
                            'list'=>[
                                ['playid'=>'pl3qwjo','title'=>'趣味奇偶'],
                                ['playid'=>'pl3qwtlj','title'=>'趣味拖拉机'],
                            ],
                        ],*/
		];
		return $dp3;
	}
	function pk10(){
		$pk10 = [
			'qian1'=>[
				'title'=>'前一',
				'list'=>[
					['playid'=>'bjpk10qian1','title'=>'前一复式'],
				],
			],
			'qian2'=>[
				'title'=>'前二',
				'list'=>[
					['playid'=>'bjpk10qian2','title'=>'前二复式'],
					['playid'=>'bjpk10qian2ds','title'=>'前二单式'],
				],
			],
			'qian3'=>[
				'title'=>'前三',
				'list'=>[
					['playid'=>'bjpk10qian3','title'=>'前三复式'],
					['playid'=>'bjpk10qian3ds','title'=>'前三单式'],
				],
			],
			'qian4'=>[
				'title'=>'前四',
				'list'=>[
					['playid'=>'bjpk10qian4','title'=>'前四复式'],
					['playid'=>'bjpk10qian4ds','title'=>'前四单式'],
				],
			],
			'qian5'=>[
				'title'=>'前五',
				'list'=>[
					['playid'=>'bjpk10qian5','title'=>'前五复式'],
					['playid'=>'bjpk10qian5ds','title'=>'前五单式'],
				],
			],
			'dwd'=>[
				'title'=>'定位胆',
				'list'=>[
					['playid'=>'bjpk10dwd','title'=>'定位胆'],
				],
			],
						'dx'=>[
                            'title'=>'大小',
                            'list'=>[
                                ['playid'=>'bjpk10dxdy','title'=>'第一名'],
                                ['playid'=>'bjpk10dxde','title'=>'第二名'],
                                ['playid'=>'bjpk10dxds','title'=>'第三名'],
                            ],
                        ],
                        'ds'=>[
                            'title'=>'单双',
                            'list'=>[
                                ['playid'=>'bjpk10dsdy','title'=>'第一名'],
                                ['playid'=>'bjpk10dsde','title'=>'第二名'],
                                ['playid'=>'bjpk10dsds','title'=>'第三名'],
                            ],
                        ],
                        'lh'=>[
                            'title'=>'龙虎',
                            'list'=>[
                                ['playid'=>'bjpk10lhdy','title'=>'第一名'],
                                ['playid'=>'bjpk10lhde','title'=>'第二名'],
                                ['playid'=>'bjpk10lhds','title'=>'第三名'],
                            ],
                        ],
		];
		return $pk10;
	}
	function k3(){
		$k3 = [
			'ethfx'=>[
				'title'=>'二同号复选',
				'list'=>[
					['playid'=>'k3ethfx','rate'=>'60','title'=>'二同号复选'],
				],
			],
			'ethdx'=>[
				'title'=>'二同号单选',
				'list'=>[
					['playid'=>'k3ethdx','rate'=>'60','title'=>'二同号单选'],
				],
			],
			'ebth'=>[
				'title'=>'二不同号',
				'list'=>[
					['playid'=>'k3ebthbz','rate'=>'6.5','title'=>'二不同号'],
				],
			],
			'sthdx'=>[
				'title'=>'三同号单选',
				'list'=>[
					['playid'=>'k3sthdx','rate'=>'180','title'=>'三同号单选'],
				],
			],
			'sthtx'=>[
				'title'=>'三同号通选',
				'list'=>[
					['playid'=>'k3sthtx','rate'=>'36.5','title'=>'三同号通选'],
				],
			],
			'sbth'=>[
				'title'=>'三不同号',
				'list'=>[
					['playid'=>'k3sbthbz','rate'=>'32.5','title'=>'三不同号'],
				],
			],
			'slhtx'=>[
				'title'=>'三连号通选',
				'list'=>[
					['playid'=>'k3slhtx','rate'=>'8.5','title'=>'三连号通选'],
				],
			],
			'slhdx'=>[
				'title'=>'三连号单选',
				'list'=>[
					['playid'=>'k3slhdx','rate'=>'8.5','title'=>'三连号单选'],
				],
			],
			'k3hzzx'=>[
				'title'=>'和值',
				'list'=>[

					['playid'=>'k3hz3','rate'=>'165','title'=>'3'],
					['playid'=>'k3hz4','rate'=>'60','title'=>'4'],
					['playid'=>'k3hz5','rate'=>'32.5','title'=>'5'],
					['playid'=>'k3hz6','rate'=>'20.5','title'=>'6'],
					['playid'=>'k3hz7','rate'=>'12.5','title'=>'7'],
					['playid'=>'k3hz8','rate'=>'9.5','title'=>'8'],
					['playid'=>'k3hz9','rate'=>'8.5','title'=>'9'],
					['playid'=>'k3hz10','rate'=>'7.5','title'=>'10'],
					['playid'=>'k3hz11','rate'=>'7.5','title'=>'11'],
					['playid'=>'k3hz12','rate'=>'8.5','title'=>'12'],
					['playid'=>'k3hz13','rate'=>'9.5','title'=>'13'],
					['playid'=>'k3hz14','rate'=>'12.5','title'=>'14'],
					['playid'=>'k3hz15','rate'=>'20.5','title'=>'15'],
					['playid'=>'k3hz16','rate'=>'32.5','title'=>'16'],
					['playid'=>'k3hz17','rate'=>'60','title'=>'17'],
					['playid'=>'k3hz18','rate'=>'165','title'=>'18'],
					['playid'=>'k3hzbig','rate'=>'1.95','title'=>'大'],
					['playid'=>'k3hzsmall','rate'=>'1.95','title'=>'小'],
					['playid'=>'k3hzodd','rate'=>'1.95','title'=>'单'],
					['playid'=>'k3hzeven','rate'=>'1.95','title'=>'双'],
				],
			],
		];
		return $k3;
	}
	function x5(){
		$x5 = [
			'sx'=>[
				'title'=>'三星',
				'list'=>[
					['playid'=>'x5qsfs','title'=>'前三直选复式'],
					['playid'=>'x5qsds','title'=>'前三直选单式'],
					['playid'=>'x5zsfs','title'=>'中三直选复式'],
					['playid'=>'x5zsds','title'=>'中三直选单式'],
					['playid'=>'x5hsfs','title'=>'后三直选复式'],
					['playid'=>'x5hsds','title'=>'后三直选单式'],

					['playid'=>'x5qszx','title'=>'前三组选复式'],
					['playid'=>'x5qszxds','title'=>'前三组选单式'],
					['playid'=>'x5qsdt','title'=>'前三组选胆拖'],
					['playid'=>'x5zszx','title'=>'中三组选复式'],
					['playid'=>'x5zsdt','title'=>'中三组选胆拖'],
					['playid'=>'x5hszx','title'=>'后三组选复式'],
					['playid'=>'x5hsdt','title'=>'后三组选胆拖'],

				],
			],
			'ex'=>[
				'title'=>'二星',
				'list'=>[
					['playid'=>'x5qefs','title'=>'前二直选复式'],
					['playid'=>'x5qeds','title'=>'前二直选单式'],
					['playid'=>'x5hefs','title'=>'后二直选复式'],
					['playid'=>'x5heds','title'=>'后二直选单式'],
					['playid'=>'x5qezx','title'=>'前二组选复式'],
					['playid'=>'x5qezxds','title'=>'前二组选单式'],
					['playid'=>'x5qedt','title'=>'前二组选胆拖'],
					['playid'=>'x5hezx','title'=>'后二组选复式'],
					['playid'=>'x5hedt','title'=>'后二组选胆拖'],
				],
			],
			'bdw'=>[
				'title'=>'不定位',
				'list'=>[
					['playid'=>'x5bdwqs','title'=>'前三不定位'],
					['playid'=>'x5bdwzs','title'=>'中三不定位'],
					['playid'=>'x5bdwhs','title'=>'后三不定位'],
				],
			],
			'dw'=>[
				'title'=>'定位胆',
				'list'=>[
					['playid'=>'x5dwd','title'=>'定位胆'],
				],
			],

			'rx'=>[
				'title'=>'任选',
				'list'=>[
					['playid'=>'x5rx1z1','title'=>'任选复式一中一'],
					['playid'=>'x5rx2z2','title'=>'任选复式二中二'],
					['playid'=>'x5rx3z3','title'=>'任选复式三中三'],
					['playid'=>'x5rx4z4','title'=>'任选复式四中四'],
					['playid'=>'x5rx5z5','title'=>'任选复式五中五'],
					['playid'=>'x5rx6z5','title'=>'任选复式六中五'],
					['playid'=>'x5rx7z5','title'=>'任选复式七中五'],
					['playid'=>'x5rx8z5','title'=>'任选复式八中五'],

					['playid'=>'x5rxds1z1','title'=>'任选单式一中一'],
					['playid'=>'x5rxds2z2','title'=>'任选单式二中二'],
					['playid'=>'x5rxds3z3','title'=>'任选单式三中三'],
					['playid'=>'x5rxds4z4','title'=>'任选单式四中四'],
					['playid'=>'x5rxds5z5','title'=>'任选单式五中五'],
					['playid'=>'x5rxds6z5','title'=>'任选单式六中五'],
					['playid'=>'x5rxds7z5','title'=>'任选单式七中五'],
					['playid'=>'x5rxds8z5','title'=>'任选单式八中五'],
				],
			],

			'dt'=>[
				'title'=>'胆拖',
				'list'=>[
					['playid'=>'x5dt2z2','title'=>'胆拖二中二'],
					['playid'=>'x5dt3z3','title'=>'胆拖三中三'],
					['playid'=>'x5dt4z4','title'=>'胆拖四中四'],
					['playid'=>'x5dt5z5','title'=>'胆拖五中五'],
					['playid'=>'x5dt6z5','title'=>'胆拖六中五'],
					['playid'=>'x5dt7z5','title'=>'胆拖七中五'],
					['playid'=>'x5dt8z5','title'=>'胆拖八中五'],
				],
			],
			'quw'=>[
				'title'=>'趣味型',
				'list'=>[
					['playid'=>'x5dds','title'=>'定单双'],
					['playid'=>'x5czw','title'=>'猜中位'],
				],
			],
		];
		return $x5;
	}
	function ssc(){
		$ssc = [
			'5x'=>[
				'title'=>'五星',
				'list'=>[
					['playid'=>'wxzhixfs','title'=>'五星复式'],
					['playid'=>'wxzhixds','title'=>'五星单式'],
					['playid'=>'wxzxyel','title'=>'组选120'],
					['playid'=>'wxzxls','title'=>'组选60'],
					['playid'=>'wxzxsl','title'=>'组选30'],
					['playid'=>'wxzxel','title'=>'组选20'],
					['playid'=>'wxzxyl','title'=>'组选10'],
					['playid'=>'wxzxw','title'=>'组选5'],
				],
			],
			/*			'q4x'=>[
                            'title'=>'前四',
                            'list'=>[
                                ['playid'=>'sixzhixfsq','title'=>'前四复式'],
                                ['playid'=>'sixzhixdsq','title'=>'前四单式'],
                                ['playid'=>'qsizxes','title'=>'前四组选24'],
                                ['playid'=>'qsizxye','title'=>'前四组选12'],
                                ['playid'=>'qsizxl','title'=>'前四组选6'],
                                ['playid'=>'qsizxs','title'=>'前四组选4'],
                            ],
                        ],*/
			'4x'=>[
				'title'=>'后四',
				'list'=>[
					['playid'=>'sixzhixfsh','title'=>'后四复式'],
					['playid'=>'sixzhixdsh','title'=>'后四单式'],
					['playid'=>'hsizxes','title'=>'后四组选24'],
					['playid'=>'hsizxye','title'=>'后四组选12'],
					['playid'=>'hsizxl','title'=>'后四组选6'],
					['playid'=>'hsizxs','title'=>'后四组选4'],
				],
			],
			'q3x'=>[
				'title'=>'前三',
				'list'=>[
					['playid'=>'sxzhixfsq','title'=>'前三复式'],
					['playid'=>'sxzhixdsq','title'=>'前三单式'],
					['playid'=>'sxzuxzsq','title'=>'组三'],
					['playid'=>'sxzuxzlq','title'=>'组六'],
					/*					['playid'=>'sxzuxzsdtq','title'=>'组三胆拖'],
                                        ['playid'=>'sxzuxzldtq','title'=>'组六胆拖'],*/
					['playid'=>'sxhhzxq','title'=>'混合组选'],
					['playid'=>'qszsds','title'=>'前三组三单式'],
					['playid'=>'qszlds','title'=>'前三组六单式'],
				],
			],
			'z3x'=>[
				'title'=>'中三',
				'list'=>[
					['playid'=>'sxzhixfsz','title'=>'中三复式'],
					['playid'=>'sxzhixdsz','title'=>'中三单式'],
					['playid'=>'sxzuxzsz','title'=>'组三'],
					['playid'=>'sxzuxzlz','title'=>'组六'],
					/*					['playid'=>'sxzuxzsdtz','title'=>'组三胆拖'],
                                        ['playid'=>'sxzuxzldtz','title'=>'组六胆拖'],*/
					['playid'=>'sxhhzxz','title'=>'混合组选'],
					['playid'=>'zszsds','title'=>'中三组三单式'],
					['playid'=>'zszlds','title'=>'中三组六单式'],
				],
			],
			'h3x'=>[
				'title'=>'后三',
				'list'=>[
					['playid'=>'sxzhixfsh','title'=>'后三复式'],
					['playid'=>'sxzhixdsh','title'=>'后三单式'],
					['playid'=>'sxzuxzsh','title'=>'组三'],
					['playid'=>'sxzuxzlh','title'=>'组六'],
					/*					['playid'=>'sxzuxzldth','title'=>'组六胆拖'],
                                        ['playid'=>'sxzuxzsdth','title'=>'组三胆拖'],*/
					['playid'=>'sxhhzxh','title'=>'混合组选'],
					['playid'=>'hszsds','title'=>'后三组三单式'],
					['playid'=>'hszlds','title'=>'后三组六单式'],
				],
			],
			'2x'=>[
				'title'=>'二星',
				'list'=>[
					['playid'=>'exzhixfsq','title'=>'前二直选复式'],
					['playid'=>'exzhixdsq','title'=>'前二直选单式'],
					['playid'=>'exzhixfsh','title'=>'后二直选复式'],
					['playid'=>'exzhixdsh','title'=>'后二直选单式'],
					['playid'=>'exzuxfsq','title'=>'前二组选复式'],
					['playid'=>'exzuxdsq','title'=>'前二组选单式'],
					['playid'=>'exzuxfsh','title'=>'后二组选复式'],
					['playid'=>'exzuxdsh','title'=>'后二组选单式'],
				],
			],
			'dw'=>[
				'title'=>'定位胆',
				'list'=>[
					['playid'=>'dweid','title'=>'一星复式'],
					['playid'=>'zuxcsbd','title'=>'前三组选包胆'],
					['playid'=>'zuxzsbd','title'=>'中三组选包胆'],
					['playid'=>'zuxhsbd','title'=>'后三组选包胆'],
					['playid'=>'zuxcebd','title'=>'前二组选包胆'],
					['playid'=>'zuxhebd','title'=>'后二组选包胆'],
				],
			],
			'bdw'=>[
				'title'=>'不定位',
				'list'=>[
					['playid'=>'bdwqs','title'=>'前三不定位'],
					['playid'=>'bdwzs','title'=>'中三不定位'],
					['playid'=>'bdwhs','title'=>'后三不定位'],
					['playid'=>'bdw5x1m','title'=>'五星一码不定位'],
					['playid'=>'bdw5x2m','title'=>'五星二码不定位'],
					['playid'=>'bdw5x3m','title'=>'五星三码不定位'],
					['playid'=>'bdw4x1m','title'=>'四星一码不定位'],
					['playid'=>'bdw4x2m','title'=>'四星二码不定位'],
					['playid'=>'bdwqs2m','title'=>'前三二码不定位'],
					['playid'=>'bdwzs2m','title'=>'中三二码不定位'],
					['playid'=>'bdwhs2m','title'=>'后三二码不定位'],
					/*					['playid'=>'bdw2mjc','title'=>'二码计重'],
                                        ['playid'=>'bdw3mjc','title'=>'三码计重'],*/
				],
			],
			'kadu'=>[
				'title'=>'跨度',
				'list'=>[
					['playid'=>'kuaduqs','title'=>'前三跨度'],
					['playid'=>'kuaduzs','title'=>'中三跨度'],
					['playid'=>'kuaduhs','title'=>'后三跨度'],
					['playid'=>'kuaduqe','title'=>'前二跨度'],
					['playid'=>'kuaduhe','title'=>'后二跨度'],
				],
			],
			'rx'=>[
				'title'=>'任选',
				'list'=>[
					/*['playid'=>'rx4fs','title'=>'任四复式'],
					['playid'=>'rx4ds','title'=>'任四单式'],
					['playid'=>'rx3fs','title'=>'任三复式'],
					['playid'=>'rx3ds','title'=>'任三单式'],
					['playid'=>'rx3z3','title'=>'任三组三'],
					['playid'=>'rx3z6','title'=>'任三组六'],
					['playid'=>'rx3zxhh','title'=>'任三混合'],
					['playid'=>'rx2fs','title'=>'任二复式'],
					['playid'=>'rx2ds','title'=>'任二单式'],
					['playid'=>'rx2zx','title'=>'任二组选'],*/
				],
			],
			'dxds'=>[
				'title'=>'大小单双',
				'list'=>[
					['playid'=>'dxdsqs','title'=>'前三'],
					['playid'=>'dxdshs','title'=>'后三'],
					['playid'=>'dxdsqe','title'=>'前二'],
					['playid'=>'dxdshe','title'=>'后二'],
				],
			],
			'hz'=>[
				'title'=>'和值',
				'list'=>[
					['playid'=>'zhixhzqs','title'=>'前三直选和值'],
					['playid'=>'zhixhzzs','title'=>'中三直选和值'],
					['playid'=>'zhixhzhs','title'=>'后三直选和值'],
					['playid'=>'zhixhzqe','title'=>'前二直选和值'],
					['playid'=>'zhixhzhe','title'=>'后二直选和值'],
					['playid'=>'zuxhzqs','title'=>'前三组选和值'],
					['playid'=>'zuxhzzs','title'=>'中三组选和值'],
					['playid'=>'zuxhzhs','title'=>'后三组选和值'],
					['playid'=>'zuxhzqe','title'=>'前二组选和值'],
					['playid'=>'zuxhzhe','title'=>'后二组选和值'],
					/*					['playid'=>'hzwsqs','title'=>'前三和尾'],
                                        ['playid'=>'hzwszs','title'=>'中三和尾'],
                                        ['playid'=>'hzwshs','title'=>'后三和尾'],
                                        ['playid'=>'hzwsqe','title'=>'前二和尾'],
                                        ['playid'=>'hzwshe','title'=>'后二和尾'],*/
				],
			],
			'quw'=>[
				'title'=>'趣味',
				'list'=>[
					['playid'=>'qwyffs','title'=>'一帆风顺'],
					['playid'=>'qwhscs','title'=>'好事成双'],
					['playid'=>'qwsxbx','title'=>'三星报喜'],
					['playid'=>'qwsjfc','title'=>'四季发财'],
					/*					['playid'=>'lhwq','title'=>'龙虎万千'],
                                        ['playid'=>'lhwb','title'=>'龙虎万百'],
                                        ['playid'=>'lhws','title'=>'龙虎万十'],
                                        ['playid'=>'lhwg','title'=>'龙虎万个'],
                                        ['playid'=>'lhqb','title'=>'龙虎千百'],
                                        ['playid'=>'lhqs','title'=>'龙虎千十'],
                                        ['playid'=>'lhqg','title'=>'龙虎千个'],
                                        ['playid'=>'lhbs','title'=>'龙虎百十'],
                                        ['playid'=>'lhbg','title'=>'龙虎百个'],
                                        ['playid'=>'lhsg','title'=>'龙虎十个'],*/
				],
			],
			/*			'lhwq'=>[
                            'title'=>'龙虎（趣味龙虎玩法以下面赔率为准）',
                            'list'=>[
                                ['playid'=>'lhwql','title'=>'龙'],
                                ['playid'=>'lhwqhu','title'=>'虎'],
                                ['playid'=>'lhwqhe','title'=>'和'],


                            ],
                        ],*/
		];
		return $ssc;
	}
	function kl10f(){
		$sf = [
			'dwd'=>[
				'title'=>'定位胆',
				'list'=>[
					['playid'=>'kl10dwd1','title'=>'第一位'],
					['playid'=>'kl10dwd2','title'=>'第二位'],
					['playid'=>'kl10dwd3','title'=>'第三位'],
					['playid'=>'kl10dwd4','title'=>'第四位'],
					['playid'=>'kl10dwd5','title'=>'第五位'],
					['playid'=>'kl10dwd6','title'=>'第六位'],
					['playid'=>'kl10dwd7','title'=>'第七位'],
					['playid'=>'kl10dwd8','title'=>'第八位'],
				],
			],
			'rx'=>[
				'title'=>'任选',
				'list'=>[
					['playid'=>'kl10rx1z1','title'=>'一中一'],
					['playid'=>'kl10rx2z2','title'=>'二中二'],
					['playid'=>'kl10rx3z3','title'=>'三中三'],
					['playid'=>'kl10rx4z4','title'=>'四中四'],
					['playid'=>'kl10rx5z5','title'=>'五中五'],
				],
			],
			'dt'=>[
				'title'=>'胆拖',
				'list'=>[
					['playid'=>'kl10dt2z2','title'=>'二中二'],
					['playid'=>'kl10dt3z3','title'=>'三中三'],
					['playid'=>'kl10dt4z4','title'=>'四中四'],
					['playid'=>'kl10dt5z5','title'=>'五中五'],
				],
			],
			'x3'=>[
				'title'=>'三星',
				'list'=>[
					['playid'=>'kl10qszxfs','title'=>'前三直选'],
					['playid'=>'kl10hszxfs','title'=>'后三直选'],
					['playid'=>'kl10qszux','title'=>'前三组选'],
					['playid'=>'kl10hszux','title'=>'后三组选'],
				],
			],
			'x2'=>[
				'title'=>'二星',
				'list'=>[
					['playid'=>'kl10elzx','title'=>'二连直选'],
					['playid'=>'kl10elzux','title'=>'二连组选'],
				],
			],
		];
		return $sf;
	}
}
?>