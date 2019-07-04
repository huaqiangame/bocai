<?php
namespace Mobile\Controller;
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
		$this->display();
	}
	
}
?>