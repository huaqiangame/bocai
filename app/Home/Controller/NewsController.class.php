<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	function lists(){
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$catid = I('catid'); 
		$showid = I('showid'); 
		if(!$catid){
			redirect('/');exit;
		}
		$cachefile = DATA_PATH . 'catelist.php';
		$_t = time();
		if(!is_file($cachefile) || $_t-filemtime($cachefile)>600){
			$apiparam=array();
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/News/lists',$apiparam);
			if($Result['sign']==true && $Result['catelist']){
				F('catelist',$Result['catelist']);
			}
			$catelist = $Result['catelist'];
		}else{
			$catelist = F('catelist');
		}
		if($catelist[$catid]){
			$arclistsfile = DATA_PATH . 'arclists'.$catid.'.php';
			if(!is_file($arclistsfile) || $_t-filemtime($arclistsfile)>600){
				$apiparam=array();
				$apiparam['catid'] = $catid;
				$_api = new \Lib\api;
				$Result = $_api->sendHttpClient('Api/News/arclists',$apiparam);
				if($Result['sign']==true && $Result['arclists']){
					F('arclists'.$catid,$Result['arclists']);
				}
				$arclists = $Result['arclists'];
			}else{
				$arclists = F('arclists'.$catid);
			}
		}
		$_oldcatelist = $catelist;
		$_Tree      = new \Lib\Tree($catelist,['id'=>'id','parentid'=>'parentid']);
		$catelist   = $_Tree->get_tree_arr($catelist);
		$this->assign('catelist',$catelist[$catid]['subcat']?$catelist[$catid]['subcat']:$_oldcatelist);
		$this->assign('cateinfo',$_oldcatelist[$catid]);
		$this->assign('catid',$catid);
		$this->assign('arclists',$arclists);
		$this->assign('showid',$showid);
		if($catid == '46'){
			$this->display('News_hezuo');
		}else{
			$this->display();
		}
	}
    //回调
    public function notify(){

        $codepay_key = C('MZFPAY.mzfkey'); //这是您的密钥
        $isPost = true; //默认为POST传入
        if(IS_GET){
            $_POST = $_GET;  //POST访问 为服务器或软件异步通知  不需要返回HTML
            $isPost = false; //标记为GET访问  需要返回HTML给用户
        }
        ksort($_POST); //排序post参数
        reset($_POST); //内部指针指向数组中的第一个元素

        $sign = ''; //加密字符串初始化

        foreach ($_POST AS $key => $val) {
            if ($val == '' || $key == 'sign') continue; //跳过这些不签名
            if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
            $sign .= "$key=$val"; //拼接为url参数形式
        }
        $pay_id = $_POST['pay_id']; //需要充值的ID 或订单号 或用户名
        $money = (float)$_POST['money']; //实际付款金额
        $price = (float)$_POST['price']; //订单的原价
        $param = $_POST['param']; //自定义参数
        $type = (int)$_POST['type']; //支付方式
        $pay_time = (int)$_POST['pay_time']; //支付时间
        $this->assign('pay_time',$pay_time);
        $this->assign('type',$type);
        $this->assign('money',$money);
        $pay_no = $_POST['pay_no'];//流水号
        if (!$_POST['pay_no'] || md5($sign . $codepay_key) != $_POST['sign']) { //不合法的数据
            if ($isPost) exit('fail');  //返回失败 继续补单
            $result = '支付失败';
            $pay_id = "支付失败";
            $pay_no = "支付失败";
            if ($type < 1) $type = 1;
            $this->assign('result',$result);
            $this->assign('pay_id',$pay_id);
            $this->assign('pay_no',$pay_no);
            $this->assign('type)',$type);
        } else { //合法的数据
            $recharge = M("recharge");
            $member = M("member");
            $member->startTrans();
            $is_res=$recharge->where(['trano'=>$pay_id])->save(['amount'=>$money,'threetrano'=>$pay_no]);
            $recharge_info  = $recharge->where(['trano'=>$pay_id])->find();
            $re =$member->where(['id'=>$recharge_info['uid']])->setInc('balance',$money); // 保存用户信息

            if ($recharge_info && $re &&$is_res){
                $member->commit();
                $result = '支付成功';
                exit('ok');
            }else{ logs(2);
                // 事务回滚
                $result = '支付失败';
                $member->rollback();
                exit('fail');
            }
        }

    }

    public function help(){
        $catid = I('catid');
        $showid = I('showid');
        $apiparam=array();
        $apiparam['catid'] = $catid;
        $_api = new \Lib\api;
        $Result = $_api->sendHttpClient('Api/News/arclists',$apiparam);
        $this->assign('about_us',$Result['arclists']);
        $this->assign('showid',$showid);
        $this->display();
    }
}
?>