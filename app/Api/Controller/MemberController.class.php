<?php

namespace Api\Controller;

use Think\Controller;
use Think\Exception;

class MemberController extends CommonController {

    public $_list = array();
    public $_ids = array();
    protected $allowMethodList = array(
        'checkislogin', 'checkuername', 'getuserinfo', 'register', 'qb_register', 'signin', 'getagentlink', 'chatrecelist', 'chatsentlist', 'chatcontext', 'chatsent', 'getdownuser',
        //代理相关
        'reportstatistics', 'downuserports', 'echarts', 'adduser', 'addsignup', 'signuplinklist', 'delsignuplink', 'memberList', 'downuserbetslist', 'downuserchangelist', 'downuserrechargeandwithdrawlist', 'downuseraccountreportlist',
    );

    function checkislogin($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        return $apiparam;
    }

    //代理链接获取
    function getagentlink($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $linkid = $apiparam['linkid'];
        if (!$linkid) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '非法获取代理推广链接';
            return $apiparam;
            exit;
        }
        $linkinfo = M('agentlink')->where(['id' => $linkid])->cache(3600, true)->find();
        if (!$linkinfo) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '代理推广链接不存在';
            return $apiparam;
            exit;
        }
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        $apiparam['linkinfo'] = $linkinfo;
        return $apiparam;
        exit;
    }

    function getuserinfo($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $where = ($apiparam['where'] && is_array($apiparam['where'])) ? array_filter($apiparam['where']) : [];
        if (!$where['uid'] && !$where['username']) {
            $apiparam['sign'] = true;
            $apiparam['message'] = '查询用户信息必须有uid或者username';
            return $apiparam;
        }
        if ($where['uid']) {
            $where['id'] = $where['uid'];
            unset($where['uid']);
        }
        $userinfo = M('member')->where($where)->find();
        if (!$userinfo) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户不存在';
        } else {
            $apiparam['sign'] = true;
            $apiparam['message'] = '操作成功';
            if ($userinfo['proxy'] == 1) {
                $userinfo['groupname'] = '普通代理';
            } else {
                if ($userinfo['groupid']) {
                    $userinfo['groupname'] = M('membergroup')->where(['groupid' => $userinfo['groupid']])->getField('groupname');
                } else {
                    $userinfo['groupname'] = '普通会员';
                }
            }
            $apiparam['data'] = $userinfo;
        }
        return $apiparam;
    }

    function checkuername($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $username = $apiparam['username'];
        if (!$username) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户名不能为空';
            return $apiparam;
        }
        $uid = M('member')->where(['username' => $username])->getField('id');
        if ($uid) {
            $apiparam['sign'] = true;
            $apiparam['message'] = '存在用户名';
            $apiparam['data'] = ['ishas' => 1];
        } else {
            $apiparam['sign'] = true;
            $apiparam['message'] = '不存在用户名';
            $apiparam['data'] = ['ishas' => 0];
        }
        return $apiparam;
    }

    //代理开户
    function adduser($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];

        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $username = $apiparam['username'];
        $isproxy = $apiparam['isproxy'];
        if (!in_array($isproxy, [0, 1])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '请选择开户类型';
            return $apiparam;
        }
        if (!$username) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户名不能为空';
            return $apiparam;
        }
        $uid = M('member')->where(['username' => $username])->getField('id');
        if ($uid) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '注册用户名已经存在';
            return $apiparam;
        }
        $data = [];
        $data['parentid'] = $userinfo['id'];
        $data['username'] = $username;
        $data['proxy'] = $isproxy;
        if ($isproxy == 1)
            $data['groupid'] = 10;
        $data['fandian'] = $apiparam['rebate'];
        $data['isnb'] = 0;
        $data['password'] = sys_md5('123456');
        $data['balance'] = 0;
        $data['point'] = 0;
        $data['face'] = "/resources/images/face/" . rand(1, 25) . ".jpg";
        $data['xima'] = 0;
        $data['islock'] = 0;
        $data['regtime'] = time();
        $data['regip'] = get_client_ip();
        $data['source'] = '代理开户';
        $username_live = 'usr_name_' . $apiparam['username'];
        $data['live_game_name'] = 'RBw10' . strtolower(substr(md5('p_!#%_' . $username_live), 0, 9));
        $int = M('member')->data($data)->add();
        $apiparam = [];
        if ($int) {
            $apiparam['sign'] = true;
            $apiparam['message'] = '开户成功';
            $apiparam['id'] = $int;
            return $apiparam;
        } else {
            $apiparam['sign'] = false;
            $apiparam['message'] = '开户失败';
            return $apiparam;
        }
        return $apiparam;
    }

    //添加开户链接
    function addsignup($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $times = $apiparam['times'];
        $isproxy = $apiparam['isproxy'];
        $rebate = $apiparam['fandian'];
        $tpltype = $apiparam['tpltype'];
        $tpltype = intval($tpltype) > 3 ? 0 : intval($tpltype);
        if ($times >= 1 && $times <= 100) {
            
        } else {
            $apiparam['sign'] = false;
            $apiparam['message'] = '使用次数只能为正整数1~100之间';
            return $apiparam;
        }
        if (!in_array($isproxy, [0, 1])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '请选择开户类型';
            return $apiparam;
        }
        $linkcount = M('agentlink')->where(['uid' => $userinfo['id']])->count();
        if ($linkcount >= 4) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '最多添加4条链接';
            return $apiparam;
            exit;
        }
        $data = [];
        $data['uid'] = $userinfo['id'];
        $data['username'] = $userinfo['username'];
        $data['proxy'] = $isproxy;
        $data['tpltype'] = $tpltype;
        $data['usenum'] = $times;
        $data['okusenum'] = 0;
        $data['fandian'] = empty($rebate) ? 0 : $rebate;
        $data['oddtime'] = time();
        $int = M('agentlink')->data($data)->add();
        $apiparam = [];
        if ($int) {
            $apiparam['sign'] = true;
            $apiparam['message'] = '链接添加成功';
            return $apiparam;
        } else {
            $apiparam['sign'] = false;
            $apiparam['message'] = '链接添加失败';
            return $apiparam;
        }
        return $apiparam;
    }

    function signuplinklist($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $page = intval($apiparam['page']) > 0 ? intval($apiparam['page']) : 1;
        $pagesize = (intval($apiparam['pagesize']) > 0 && intval($apiparam['pagesize']) <= 30) ? intval($apiparam['pagesize']) : 10;

        $map = [];
        $map['uid'] = ['eq', $userinfo['id']];
        $db = M('agentlink');
        $records = $db->where($map)->count();
        $GridPage = ($page - 1) * $pagesize;
        $list = $db->where($map)->order('id desc')->limit($GridPage . ',' . $pagesize)->select();
        foreach ($list as $k => $v) {
            $v['oddtime'] = date('Y-m-d H:i:s', $v['oddtime']);
            $list[$k] = $v;
        }
        $totalsize = ceil($records / $pagesize);
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        $apiparam['page'] = $page;
        $apiparam['pagestr'] = $GridPage . ',' . $pagesize;
        $apiparam['total'] = $totalsize;
        $apiparam['records'] = $records;
        $apiparam['root'] = $list;
        return $apiparam;
    }

    //删除开户链接
    function delsignuplink($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $id = abs(intval($apiparam['id']));
        if (!$id) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '开户链接不存在';
            return $apiparam;
        }
        $info = M('agentlink')->where(['id' => $id])->find();
        if ($info['uid'] != $userinfo['id']) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '严重非法操作，已记录您的IP';
            return $apiparam;
            exit;
        }
        $int = M('agentlink')->where(['id' => $id])->delete();
        $apiparam = [];
        if ($int) {
            $apiparam['sign'] = true;
            $apiparam['message'] = '删除成功';
            return $apiparam;
        } else {
            $apiparam['sign'] = false;
            $apiparam['message'] = '删除失败';
            return $apiparam;
        }
        return $apiparam;
    }

    function memberList($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $minmoney = intval($apiparam['minmoney']);
        $maxmoney = intval($apiparam['maxmoney']);
        $page = intval($apiparam['page']) > 0 ? intval($apiparam['page']) : 1;
        $pagesize = (intval($apiparam['pagesize']) > 0 && intval($apiparam['pagesize']) <= 30) ? intval($apiparam['pagesize']) : 10;
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $startime = $apiparam['startime']; //时间戳
        $endtime = $apiparam['endtime']; //时间戳
        $loginname = $apiparam['loginname'];
        $isonline = $apiparam['isonline'];

        $map = [];
        if (I('post.id')) {
            $map['parentid'] = ['eq', I('post.id')];
        } else {
            $map['parentid'] = ['eq', $userinfo['id']];
        }
        $map['isnb'] = ['eq', 0];
        if ($startime) {
            $map['oddtime'][] = ['egt', $startime];
        }
        if ($endtime) {
            $map['oddtime'][] = ['elt', strtotime(date('Y-m-d 23:59:59', $endtime))];
        }
        if ($minmoney > 0) {
            $map['balance'][] = ['egt', $minmoney];
        }
        if ($maxmoney > 0) {
            $map['balance'][] = ['elt', $maxmoney];
        }

        if ($loginname) {
            $map['username'] = ['eq', $loginname];
        }

        $tonline = 30;
        $_t = time();
        if ($isonline) {
            $map['onlinetime'] = ['EGT', time() - $tonline];
        }

        $db = M('member');
        $records = $db->where($map)->count();
        $GridPage = ($page - 1) * $pagesize;
        if ($isonline) {
            unset($map['onlinetime']);
            $this->getdlxx($map, $userinfo['id']);
            $records = count($this->_list);
            $obj = $this->_list;
        } else {
            $list = $db->where($map)->order('id desc')->field('id,username,parentid,nickname,userbankname,qq,proxy,balance,point,xima,onlinetime,logintime,regtime')->limit($GridPage . ',' . $pagesize)->select();
            $obj = $list;
        }

        if ($isonline) {
            foreach ($obj as $k => $v) {
                if ($v['onlinetime'] >= $_t - $tonline) {
                    $v['isonline'] = 1;
                    if (!empty($v['parentid'])) {
                        $parentname = $db->field('username')->where("id='{$v['parentid']}'")->find();
                        $v['parentname'] = $parentname['username'];
                    }
                    $Result[] = $v;
                }
            }
        } else {
            foreach ($obj as $k => $v) {
                if ($v['onlinetime'] >= $_t - $tonline) {
                    $v['isonline'] = 1;
                } else {
                    $v['isonline'] = 0;
                }
                if (!empty($v['parentid'])) {
                    $parentname = $db->field('username')->where("id='{$v['parentid']}'")->find();
                    $v['parentname'] = $parentname['username'];
                }
                $Result[] = $v;
            }
        }

        $totalsize = ceil($records / $pagesize);
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        $apiparam['page'] = $page;
        $apiparam['pagestr'] = $GridPage . ',' . $pagesize;
        $apiparam['total'] = $totalsize;
        $apiparam['records'] = $records;
        $apiparam['root'] = $Result;
        return $apiparam;
    }

    //查找代理所有下线
    /* 	function getdlxx($map,$id=0){
      $list = M('Member')->where($map)->field('id,username,nickname,userbankname,qq,proxy,balance,point,xima,onlinetime,logintime,regtime')->select();
      foreach ($list as $k=>$v){
      if($v['proxy']=='1'){
      $map['parentid'] = ['eq',$v['id']];
      $this->getdlxx($map,$v['id']);
      }
      }
      if(!empty($list)){
      $this->_list[$id] = $list;
      }
      } */
    function getdlxx($map, $id = 0) {
        $list = M('Member')->where($map)->field('id,username,parentid,nickname,userbankname,qq,proxy,balance,point,xima,onlinetime,logintime,regtime')->order('id ASC')->select();
        foreach ($list as $k => $v) {
            if ($v['proxy'] == '1') {
                $map['parentid'] = ['eq', $v['id']];
                $this->getdlxx($map, $v['id']);
            }
            if (!empty($v)) {
                $this->_list[] = $v;
            }
        }
    }

    function getdlxxid($map) {
        $list = M('Member')->where($map)->field('id,username')->order('id ASC')->select();
        foreach ($list as $k => $v) {
            $map['parentid'] = ['eq', $v['id']];
            $this->getdlxxid($map);
            $this->_ids[] = $v;
        }
    }

    /* 	function getids(){
      $map['parentid'] = I('id');
      $this->getdlxxid($map);
      $this->ajaxReturn($this->_ids);

      } */

    //代理获取下线游戏记录
    function downuserbetslist($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $map = [];
        $arr_id = [];
        $where['parentid'] = ['eq', $userinfo['id']];
        $this->getdlxxid($where);
//		foreach($this->_ids as $k=>$v){
//            $arr_id[$k]['id'] = $v['id'];
//		}
        foreach ($this->_ids as $k => $v) {
            $arr_id[] = $v['id'];
        }
        $map['id'] = array('in', $arr_id);
        //$map['isnb'] = array('in',[0,1]);
//		$map['_logic'] = 'OR';
//		$map['isnb'] = ['eq',1];

        $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
        if (!$downlist) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '获取成功';
            $apiparam['startime'] = date('Y-m-d H:i:s', $startime);
            $apiparam['endtime'] = date('Y-m-d H:i:s', $endtime);
            $apiparam['page'] = 0;
            $apiparam['total'] = 0;
            $apiparam['records'] = 0;
            $apiparam['root'] = [];
            $apiparam['bigamount'] = 0;
            $apiparam['smallamount'] = 0;
            $apiparam['oddamount'] = 0;
            $apiparam['evenamount'] = 0;
            return $apiparam;
            exit;
        }
        $chiduids = [];
        foreach ($downlist as $k => $v) {
            $chiduids[] = $v['id'];
        }
        $trano = $apiparam['trano'];
        $state = $apiparam['state'];
        $expect = $apiparam['expect'];
        $lotteryname = $apiparam['lotteryname'];
        $page = intval($apiparam['page']) > 0 ? intval($apiparam['page']) : 1;
        $pagesize = (intval($apiparam['pagesize']) > 0 && intval($apiparam['pagesize']) <= 30) ? intval($apiparam['pagesize']) : 10;
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $startime = $apiparam['startime']; //时间戳
        $endtime = $apiparam['endtime']; //时间戳
        $loginname = $apiparam['loginname'];

        $map = [];
        if ($chiduids)
            $map['uid'] = ['in', $chiduids];
        if ($startime) {
            $map['oddtime'][] = ['egt', $startime];
        }
        if ($endtime) {
            $map['oddtime'][] = ['elt', strtotime(date('Y-m-d 23:59:59', $endtime))];
        }
        if ($trano) {
            $map['trano'] = ['eq', $trano];
        }
        if ($lotteryname) {
            $map['cpname'] = ['eq', $lotteryname];
        }
        if ($expect) {
            $map['expect'] = ['eq', $expect];
        }
        if ($state != '' && in_array($state, [0, 1, -1, -2])) {
            $map['isdraw'] = ['eq', $state];
        }
        if ($loginname) {
            $map['username'] = ['eq', $loginname];
        }

        $db = M('touzhu');
        $records = $db->where($map)->count();
        $GridPage = ($page - 1) * $pagesize;
        $list = $db->where($map)->order('id desc')->limit($GridPage . ',' . $pagesize)->select();
        foreach ($list as $k => $v) {
            if ($v['oddtime']) {
                $v['oddtime'] = date('m-d H:i', $v['oddtime']);
            }
            $list[$k] = $v;
        }

        //统计大小单双的下注
        //大
        if ($chiduids) {
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($startime)
                $map['oddtime'][] = ['egt', $startime];
            if ($endtime)
                $map['oddtime'][] = ['elt', strtotime(date('Y-m-d 23:59:59', $endtime))];
            if ($trano)
                $map['trano'] = ['eq', $trano];
            if ($lotteryname)
                $map['cpname'] = ['eq', $lotteryname];
            if ($expect)
                $map['expect'] = ['eq', $expect];
            if ($state != '' && in_array($state, [0, 1, -1, -2]))
                $map['isdraw'] = ['eq', $state];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['playid'] = ['eq', 'k3hzbig'];
            $bigamount = $db->where($map)->sum('amount');
        } else {
            $bigamount = 0;
        }
        //小
        if ($chiduids) {
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($startime)
                $map['oddtime'][] = ['egt', $startime];
            if ($endtime)
                $map['oddtime'][] = ['elt', strtotime(date('Y-m-d 23:59:59', $endtime))];
            if ($trano)
                $map['trano'] = ['eq', $trano];
            if ($lotteryname)
                $map['cpname'] = ['eq', $lotteryname];
            if ($expect)
                $map['expect'] = ['eq', $expect];
            if ($state != '' && in_array($state, [0, 1, -1, -2]))
                $map['isdraw'] = ['eq', $state];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['playid'] = ['eq', 'k3hzsmall'];
            $smallamount = $db->where($map)->sum('amount');
        } else {
            $smallamount = 0;
        }
        //单
        if ($chiduids) {
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($startime)
                $map['oddtime'][] = ['egt', $startime];
            if ($endtime)
                $map['oddtime'][] = ['elt', strtotime(date('Y-m-d 23:59:59', $endtime))];
            if ($trano)
                $map['trano'] = ['eq', $trano];
            if ($lotteryname)
                $map['cpname'] = ['eq', $lotteryname];
            if ($expect)
                $map['expect'] = ['eq', $expect];
            if ($state != '' && in_array($state, [0, 1, -1, -2]))
                $map['isdraw'] = ['eq', $state];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['playid'] = ['eq', 'k3hzodd'];
            $oddamount = $db->where($map)->sum('amount');
        } else {
            $oddamount = 0;
        }
        //双
        if ($chiduids) {
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($startime)
                $map['oddtime'][] = ['egt', $startime];
            if ($endtime)
                $map['oddtime'][] = ['elt', strtotime(date('Y-m-d 23:59:59', $endtime))];
            if ($trano)
                $map['trano'] = ['eq', $trano];
            if ($lotteryname)
                $map['cpname'] = ['eq', $lotteryname];
            if ($expect)
                $map['expect'] = ['eq', $expect];
            if ($state != '' && in_array($state, [0, 1, -1, -2]))
                $map['isdraw'] = ['eq', $state];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['playid'] = ['eq', 'k3hzeven'];
            $evenamount = $db->where($map)->sum('amount');
        } else {
            $evenamount = 0;
        }

        $totalsize = ceil($records / $pagesize);
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        $apiparam['startime'] = date('Y-m-d H:i:s', $startime);
        $apiparam['endtime'] = date('Y-m-d H:i:s', $endtime);
        $apiparam['page'] = $page;
        $apiparam['pagestr'] = $GridPage . ',' . $pagesize;
        $apiparam['total'] = $totalsize;
        $apiparam['records'] = $records;
        $apiparam['root'] = $list;
        $apiparam['bigamount'] = $bigamount ? $bigamount : '0.00';
        $apiparam['smallamount'] = $smallamount ? $smallamount : '0.00';
        $apiparam['oddamount'] = $oddamount ? $oddamount : '0.00';
        $apiparam['evenamount'] = $evenamount ? $evenamount : '0.00';
        return $apiparam;
    }

    function downuserchangelist($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $map = [];
        $map['parentid'] = ['eq', $userinfo['id']];
        $map['isnb'] = ['eq', 0];
        $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
        $chiduids = [];
        foreach ($downlist as $k => $v) {
            $chiduids[] = $v['id'];
        }
        $type = $apiparam['type'];
        $page = intval($apiparam['page']) > 0 ? intval($apiparam['page']) : 1;
        $pagesize = (intval($apiparam['pagesize']) > 0 && intval($apiparam['pagesize']) <= 30) ? intval($apiparam['pagesize']) : 10;
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $startime = $apiparam['startime']; //时间戳
        $endtime = $apiparam['endtime']; //时间戳
        $loginname = $apiparam['loginname'];

        $map = [];
        $map['uid'] = ['in', $chiduids];
        if ($startime) {
            $map['oddtime'][] = ['egt', $startime];
        }
        if ($endtime) {
            $map['oddtime'][] = ['elt', strtotime(date('Y-m-d 23:59:59', $endtime))];
        }
        if ($type) {
            $map['type'] = ['eq', $type];
        }
        if ($loginname) {
            $map['username'] = ['eq', $loginname];
        }

        $db = M('fuddetail');
        $records = $db->where($map)->count();
        $GridPage = ($page - 1) * $pagesize;
        $list = $db->where($map)->order('id desc')->limit($GridPage . ',' . $pagesize)->select();
        foreach ($list as $k => $v) {
            if ($v['oddtime']) {
                $v['oddtime'] = date('m-d H:i', $v['oddtime']);
            }
            $list[$k] = $v;
        }
        $totalsize = ceil($records / $pagesize);
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        $apiparam['startime'] = date('Y-m-d H:i:s', $startime);
        $apiparam['endtime'] = date('Y-m-d H:i:s', $endtime);
        $apiparam['page'] = $page;
        $apiparam['pagestr'] = $GridPage . ',' . $pagesize;
        $apiparam['total'] = $totalsize;
        $apiparam['records'] = $records;
        $apiparam['root'] = $list;
        return $apiparam;
    }

    //团队存提款
    function downuserrechargeandwithdrawlist($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $map = [];
        $map['parentid'] = ['eq', $userinfo['id']];
        $map['isnb'] = ['eq', 0];
        $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
        $chiduids = [];
        foreach ($downlist as $k => $v) {
            $chiduids[] = $v['id'];
        }
        $type = $apiparam['type'];
        $trano = $apiparam['trano'];
        $state = $apiparam['state'];
        $page = intval($apiparam['page']) > 0 ? intval($apiparam['page']) : 1;
        $pagesize = (intval($apiparam['pagesize']) > 0 && intval($apiparam['pagesize']) <= 30) ? intval($apiparam['pagesize']) : 10;
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $startime = $apiparam['startime']; //时间戳
        $endtime = $apiparam['endtime']; //时间戳
        $loginname = $apiparam['loginname'];

        $map = [];
        $map['uid'] = ['in', $chiduids];
        if ($startime) {
            $map['oddtime'][] = ['egt', $startime];
        }
        if ($endtime) {
            $map['oddtime'][] = ['elt', strtotime(date('Y-m-d 23:59:59', $endtime))];
        }
        if ($state != '' && in_array($state, [0, 1, -1])) {
            $map['state'] = ['eq', $state];
        }
        if ($loginname) {
            $map['username'] = ['eq', $loginname];
        }
        if ($trano) {
            $map['trano'] = ['eq', $trano];
        }
        if ($type == 0) {
            $db = M('recharge');
        } else {
            $db = M('withdraw');
        }

        $records = $db->where($map)->count();
        $GridPage = ($page - 1) * $pagesize;
        $list = $db->where($map)->order('id desc')->limit($GridPage . ',' . $pagesize)->select();
        foreach ($list as $k => $v) {
            if ($v['oddtime']) {
                $v['oddtime'] = date('m-d H:i', $v['oddtime']);
            }
            if ($type == 0 && $v['isauto'] == 2 && $v['sdtype'] == -1) {
                $v['amount'] = -abs($v['amount']);
            }
            $list[$k] = $v;
        }



        $totalsize = ceil($records / $pagesize);
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        $apiparam['startime'] = date('Y-m-d H:i:s', $startime);
        $apiparam['endtime'] = date('Y-m-d H:i:s', $endtime);
        $apiparam['page'] = $page;
        $apiparam['pagestr'] = $GridPage . ',' . $pagesize;
        $apiparam['total'] = $totalsize;
        $apiparam['records'] = $records;
        $apiparam['root'] = $list;
        return $apiparam;
    }

    function downuseraccountreportlist($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        //$page        = intval($apiparam['page'])>0?intval($apiparam['page']):1;
        //$pagesize    = (intval($apiparam['pagesize'])>0 && intval($apiparam['pagesize'])<=30)?intval($apiparam['pagesize']):10;
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $startime = $apiparam['startime']; //时间戳
        $endtime = strtotime(date('Y-m-d 23:59:59', $apiparam['endtime'])); //时间戳
        $loginname = $apiparam['loginname'];

        $map = [];
        $map['parentid'] = ['eq', $userinfo['id']];
        $map['isnb'] = ['eq', 0];
        $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
        $chiduids = [];
        foreach ($downlist as $k => $v) {
            $chiduids[] = $v['id'];
        }
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $_endDate = date("Y-m-d", $endtime);
        $days = ceil(($endtime - $startime) / 86400);
        $days = floor(($endtime - $startime) / 86400);
        if ($days > 60) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '只能查询60天内的数据';
            return $apiparam;
        }
        for ($i = 0; $i <= $days; $i++) {
            $date[] = $_tt = date("Y-m-d", strtotime($_endDate) - 86400 * $i);
            //自动充值
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['state'] = ['eq', 1];
            $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
            $map['oddtime'][] = ['egt', strtotime($_tt)];
            $map['isauto'] = ['eq', 1];
            $zdchongzhiall = 0;
            $zdchongzhiall = M('recharge')->where($map)->sum('amount');
            //手动充值加
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['state'] = ['eq', 1];
            $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
            $map['oddtime'][] = ['egt', strtotime($_tt)];
            $map['isauto'] = ['eq', 2];
            $map['sdtype'] = ['eq', 1];
            $sdjiachongzhiall = 0;
            $sdjiachongzhiall = M('recharge')->where($map)->sum('amount');
            //手动充值减
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['state'] = ['eq', 1];
            $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
            $map['oddtime'][] = ['egt', strtotime($_tt)];
            $map['isauto'] = ['eq', 2];
            $map['sdtype'] = ['eq', -1];
            $sdjianchongzhiall = 0;
            $sdjianchongzhiall = M('recharge')->where($map)->sum('amount');
            //充值
            $dayRechargeMoney = $zdchongzhiall + $sdjiachongzhiall - $sdjianchongzhiall;

            //提款
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['state'] = ['eq', 1];
            $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
            $map['oddtime'][] = ['egt', strtotime($_tt)];
            $dayDrawRechargeMoney = 0;
            $dayDrawRechargeMoney = M('withdraw')->where($map)->sum('amount');
            //消费（投注）
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['isdraw'] = ['in', [1, -1]];
            $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
            $map['oddtime'][] = ['egt', strtotime($_tt)];
            $dayConsumptionMoney = 0;
            $dayConsumptionMoney = M('touzhu')->where($map)->sum('amount');
            //返点
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['type'] = ['eq', 'commission'];
            $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
            $map['oddtime'][] = ['egt', strtotime($_tt)];
            $dayCommissionMoney = 0;
            $dayCommissionMoney = M('fuddetail')->where($map)->sum('amount');
            //中奖
            /* $map = [];
              $map['uid'] = ['in',$chiduids];
              if($loginname)$map['username'] = ['eq',$loginname];
              $map['isdraw'] = ['eq',1];
              $map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
              $map['oddtime'][] = ['egt',strtotime($_tt)];
              $dayIncomeMoney = 0;
              $dayIncomeMoney = M('touzhu')->where($map)->sum('amount'); */
            //活动
            $map = [];
            $map['uid'] = ['in', $chiduids];
            if ($loginname)
                $map['username'] = ['eq', $loginname];
            $map['type'] = ['in', ['pointexchange', 'activity_bindcard', 'activity_czzs', 'activity_rxf', 'activity_rks', 'activity_yxf', 'activity_yks']];
            $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
            $map['oddtime'][] = ['egt', strtotime($_tt)];
            $dayActivitiesMoney = 0;
            $dayActivitiesMoney = M('fuddetail')->where($map)->sum('amount');
            //盈利
            $dayDividendMoney = 0;
            $dayDividendMoney = $dayIncomeMoney - $dayConsumptionMoney + $dayCommissionMoney + $dayActivitiesMoney;
            $list[$i]['statDate'] = $_tt;
            $list[$i]['dayRechargeMoney'] = $dayRechargeMoney ? $dayRechargeMoney : 0;
            $list[$i]['dayDrawRechargeMoney'] = $dayDrawRechargeMoney ? $dayDrawRechargeMoney : 0;
            $list[$i]['dayConsumptionMoney'] = $dayConsumptionMoney ? $dayConsumptionMoney : 0;
            $list[$i]['dayCommissionMoney'] = $dayCommissionMoney ? $dayCommissionMoney : 0;
            $list[$i]['dayIncomeMoney'] = $dayIncomeMoney ? $dayIncomeMoney : 0;
            $list[$i]['dayActivitiesMoney'] = $dayActivitiesMoney ? $dayActivitiesMoney : 0;
            $list[$i]['dayDividendMoney'] = $dayDividendMoney ? $dayDividendMoney : 0;
        }
        $list1 = array_slice($list, ($page - 1) * $pagesize, $pagesize);
        if ($list) {
            foreach ($list as $k => $v) {
                $totaldata['dayRechargeMoney'] += $v['dayRechargeMoney'];
                $totaldata['dayDrawRechargeMoney'] += $v['dayDrawRechargeMoney'];
                $totaldata['dayConsumptionMoney'] += $v['dayConsumptionMoney'];
                $totaldata['dayCommissionMoney'] += $v['dayCommissionMoney'];
                $totaldata['dayIncomeMoney'] += $v['dayIncomeMoney'];
                $totaldata['dayActivitiesMoney'] += $v['dayActivitiesMoney'];
                $totaldata['dayDividendMoney'] += $v['dayDividendMoney'];
            }
        }
        $records = $days;
        $totalsize = ceil($records / $pagesize);
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        $apiparam['startime'] = date('Y-m-d H:i:s', $startime);
        $apiparam['endtime'] = date('Y-m-d H:i:s', $endtime);
        $apiparam['page'] = $page;
        $apiparam['total'] = $totalsize;
        $apiparam['records'] = $records;
        $apiparam['root'] = $list;
        $apiparam['totaldata'] = $totaldata;

        return $apiparam;
    }

    //注册
    function register($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $data = $apiparam['data'];
        if (!is_array($data)) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '注册数据不存在';
            return $apiparam;
        }
        if (!$data['username']) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '注册会员用户名必须';
            return $apiparam;
        }
        if (!$data['password']) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '注册会员密码必须';
            return $apiparam;
        }
        if (!$data['tradepassword']) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '注册会员提款密码必须';
            return $apiparam;
        }
        //验证用户名
        //验证用户名
        $_paten = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
        if (!$data['username'] || preg_match($_paten, $data['username']) || mb_strlen($data['username']) < 2 || mb_strlen($data['username']) > 12) {
            $Result = [];
            $Result['sign'] = false;
            $Result['message'] = '用户名为2-12字母与数字组或中文的字符!';
            $this->ajaxReturn($Result);
            exit;
        }
        if (!preg_match("/^[\w\W]{6,16}$/", $data['password'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '密码为6-16位';
            return $apiparam;
        }

        if (!preg_match("/^[\w\W]{4,16}$/", $data['tradepassword'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '提款密码为4-16位';
            return $apiparam;
        }
        if (!$data['regip'] || !preg_match("/\d+\.\d+\.\d+\.\d+/", $data['regip'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '缺少注册IP';
            return $apiparam;
        }
        //检测用户名是否存在
        if (M('member')->where(['username' => $data['username']])->getField('id')) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户名已经被注册';
            return $apiparam;
        }
        //判断是否注册链接
        $linkid = intval($data['linkid']);
        if ($linkid) {
            $linkinfo = M('agentlink')->where(['id' => $linkid])->find();
            if (!$linkinfo) {
                $apiparam['sign'] = false;
                $apiparam['message'] = '推广链接不存在';
                return $apiparam;
            }
            if ($linkinfo['uid'] != $data['parentid']) {
                $apiparam['sign'] = false;
                $apiparam['message'] = '推广链接注册推荐码不得修改';
                return $apiparam;
            }
            if ($linkinfo['okusenum'] >= $linkinfo['usenum']) {
                $apiparam['sign'] = false;
                $apiparam['message'] = '推广链接次数已使用完';
                return $apiparam;
            }
            if ($linkinfo['proxy'] == 1) {
                $data['proxy'] = 1;
                $data['groupid'] = 10;
                $data['fandian'] = $linkinfo['fandian'];
            } else {
                $data['proxy'] = 0;
                $data['groupid'] = 1;
            }
        }
//		else{
//			$tjuinfo = M('member')->where(['id'=>$data['parentid']])->find();
//			if(!$tjuinfo){
//				$apiparam['sign']    = false;
//				$apiparam['message'] = '推荐会员不存在';
//				return $apiparam;
//			}
//			if($tjuinfo['proxy']!=1){
//				$apiparam['sign']    = false;
//				$apiparam['message'] = '推荐码会员不是代理';
//				return $apiparam;
//			}
//
//		}
        $data['parentid'] = $data['parentid'] ? $data['parentid'] : 9001;
        $data['qq'] = $data['qq'] ? $data['qq'] : '';
        $data['password'] = sys_md5($data['password']);
        $data['tradepassword'] = sys_md5($data['tradepassword']);
        $data['logintime'] = $data['regtime'] ? $data['regtime'] : time();
        $data['userbankname'] = '';
        $data['balance'] = 0;
        $data['point'] = 0;
        $data['xima'] = 0;
        $data['face'] = "/resources/images/face/" . rand(1, 25) . ".jpg";
        $data['islock'] = 0;
        $data['source'] = strtolower($data['source']);
        $data['loginsource'] = strtolower($data['loginsource']);
        $username = 'usr_name_' . $data['username'];
        $data['live_game_name'] = 'RBw10' . strtolower(substr(md5('p_!#%_' . $username), 0, 9));
        $addint = M('member')->add($data);
        if ($addint) {
            //注册成功后做登陆操作
            $userid = $addint;
            $sessionid = md5($data['regip'] . '-' . $data['regtime']);
            $sessiondata = [];
            $sessiondata['userid'] = $userid;
            $sessiondata['username'] = $data['username'];
            $sessiondata['sessionid'] = $sessionid;
            $sessiondata['ip'] = $data['regip'];
            $sessiondata['time'] = $data['regtime'];
            $sid = M('membersession')->data($sessiondata)->add();
            //添加日志
            $memberlogdata = [];
            $memberlogdata['userid'] = $userid;
            $memberlogdata['username'] = $data['username'];
            $memberlogdata['type'] = 'login';
            $memberlogdata['info'] = '注册/登陆';
            $memberlogdata['ip'] = $data['regip'];
            $memberlogdata['iparea'] = IParea($data['regip']);
            $memberlogdata['time'] = $data['regtime'];
            M('memberlog')->data($memberlogdata)->add();

            $onlineint = M('member')->where(['id' => $userid])->setField(['onlinetime' => time()]);

            //判断是推广链接来的则修改使用次数
            if ($linkinfo) {
                M('agentlink')->where(['id' => $linkinfo['id']])->setInc('okusenum', 1);
            }
            $apiparam['sign'] = true;
            $apiparam['message'] = '注册成功';
            $apiparam['data']['regisok'] = 1;
            $apiparam['auth']['member_auth_id'] = $userid;
            $apiparam['auth']['member_sessionid'] = $sessionid;
        } else {
            $apiparam['sign'] = false;
            $apiparam['message'] = '注册失败';
        }
        return $apiparam;
    }

    function signin($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $data = $apiparam['data'];
        $nocode = $apiparam['data']['nocode'];
        unset($apiparam['data']['nocode']);
        //F('login_'.$data['username'],$data);
        //验证用户名
        /* if(!$data['username'] || !preg_match("/^[a-zA-Z][a-zA-Z\d]{4,11}$/",$data['username'])){
          $apiparam['sign']    = false;
          $apiparam['message'] = '用户名为5-12字母与数字组合的字符,必须以字母开头!';
          return $apiparam;
          } */
        if (!in_array(strtolower($data["source"]), ['pc', 'mobile'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '非法来源';
            return $apiparam;
        }
        if (!$data['username'] || strlen($data['username']) < 3) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '请输入正确用户名!';
            return $apiparam;
        }
        if (!$data['password'] && !preg_match("/^[\w\W]{6,16}$/", $data['password'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '密码为6-16位';
            return $apiparam;
        }
        if (!$data['loginip'] || !preg_match("/\d+\.\d+\.\d+\.\d+/", $data['loginip'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '缺少登陆IP';
            return $apiparam;
        }
        //检测用户名是否存在
        $userinfo = M('member')->where(['username' => $data['username']])->find();
        if (!$userinfo) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户不存在';
            return $apiparam;
        }
        $cpassword = sys_md5($data['password']);
        if ($userinfo['password'] != $cpassword) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户名或密码错误';
            return $apiparam;
        }
        if ($userinfo['islock'] == 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '账户不允许登入';
            return $apiparam;
        }
        $ip = $apiparam['data']['loginip'];
        $iparea = ''; //IParea($ip);
        $_t = NOW_TIME;
        $logdata = [];
        $logdata['userid'] = $userinfo['id'];
        $logdata['username'] = $userinfo['username'];
        $logdata['type'] = 'login';
        $logdata['info'] = '登录成功';
        $logdata['time'] = $_t;
        $logdata['ip'] = $ip;
        $logdata['iparea'] = $iparea;
        $logint = M('memberlog')->data($logdata)->add();

        $sessioninfo = M('membersession')->where(['userid' => $userinfo['id']])->find();
        $sessiontime = NOW_TIME;
        $sid = md5($ip . '-' . $_t);
        $overtime = 30 * 60;
        $timefag = $overtime - ($_t - $sessioninfo['time']);

        if ($sessioninfo) {  //如果已经存在别登录就修改
            /* 			if(!$nocode && $timefag>1){
              $apiparam['sign']    = false;
              $apiparam['message'] = "你的帐号已在别处登陆，是否重新登陆";
              //return $apiparam;
              $this->ajaxReturn($apiparam);exit;
              } */
            $sessionint = M('membersession')->where(['userid' => $userinfo['id']])->setField(['sessionid' => $sid, 'ip' => $ip, 'time' => $_t]);
        } else {//如果不存在别登录就添加
            $sessiondata = [];
            $sessiondata['userid'] = $userinfo['id'];
            $sessiondata['username'] = $userinfo['username'];
            $sessiondata['sessionid'] = $sid;
            $sessiondata['ip'] = $ip;
            $sessiondata['time'] = $_t;
            $sessionint = M('membersession')->data($sessiondata)->add();
        }
        $upd_set_member_arr = ['onlinetime' => $_t, 'logintime' => $_t, 'loginip' => $ip, 'iparea' => IParea($ip), 'loginsource' => strtolower($data["source"])];
        if (empty($userinfo['live_game_name'])) {///修改真人游戏的用户名
            $username = 'usr_name_' . $userinfo['username'];
            $upd_set_member_arr['live_game_name'] = 'RBw10' . strtolower(substr(md5('p_!#%_' . $username), 0, 9));
        }
        $onlineint = M('member')->where(['id' => $userinfo['id']])->setField($upd_set_member_arr);
        //$userinfo['groupname'] = $userinfo['proxy']==1?'代理':'普通会员';
        /* 		if($userinfo['proxy']==1){
          $userinfo['groupname'] = '普通代理';
          }else{
          if($userinfo['groupid']){
          $userinfo['groupname'] = M('membergroup')->where(['groupid'=>$userinfo['groupid']])->getField('groupname');
          }else{
          $userinfo['groupname'] = '普通会员';
          }
          } */
        $apiparam['sign'] = true;
        $apiparam['message'] = "登陆成功({$data['source']})";
        $apiparam['data']['islogin'] = 1;
        $apiparam['auth']['member_auth_id'] = $userinfo['id'];
        $apiparam['auth']['member_sessionid'] = $sid;
        return $apiparam;
    }
    
    function qb_signin($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $data = $apiparam['data'];
        $nocode = $apiparam['data']['nocode'];
        unset($apiparam['data']['nocode']);
        //F('login_'.$data['username'],$data);
        //验证用户名
        /* if(!$data['username'] || !preg_match("/^[a-zA-Z][a-zA-Z\d]{4,11}$/",$data['username'])){
          $apiparam['sign']    = false;
          $apiparam['message'] = '用户名为5-12字母与数字组合的字符,必须以字母开头!';
          return $apiparam;
          } */
        if (!in_array(strtolower($data["source"]), ['pc', 'mobile'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '非法来源';
            return $apiparam;
        }
        if (!$data['username'] || strlen($data['username']) < 3) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '请输入正确用户名!';
            return $apiparam;
        }
        if (!$data['password'] && !preg_match("/^[\w\W]{6,16}$/", $data['password'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '密码为6-16位';
            return $apiparam;
        }
        if (!$data['loginip'] || !preg_match("/\d+\.\d+\.\d+\.\d+/", $data['loginip'])) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '缺少登陆IP';
            return $apiparam;
        }
        //检测用户名是否存在
        $userinfo = M('member')->where(['username' => $data['username']])->find();
        if (!$userinfo) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户不存在';
            return $apiparam;
        }
//        echo $userinfo['password'];
//        echo '<br>';
//        echo $data['password'];
//        exit;
        if ($userinfo['password'] != $data['password']) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户名或密码错dssssss误';
            return $apiparam;
        }
        if ($userinfo['islock'] == 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '账户不允许登入';
            return $apiparam;
        }
        $ip = $apiparam['data']['loginip'];
        $iparea = ''; //IParea($ip);
        $_t = NOW_TIME;
        $logdata = [];
        $logdata['userid'] = $userinfo['id'];
        $logdata['username'] = $userinfo['username'];
        $logdata['type'] = 'login';
        $logdata['info'] = '登录成功';
        $logdata['time'] = $_t;
        $logdata['ip'] = $ip;
        $logdata['iparea'] = $iparea;
        $logint = M('memberlog')->data($logdata)->add();

        $sessioninfo = M('membersession')->where(['userid' => $userinfo['id']])->find();
        $sessiontime = NOW_TIME;
        $sid = md5($ip . '-' . $_t);
        $overtime = 30 * 60;
        $timefag = $overtime - ($_t - $sessioninfo['time']);

        if ($sessioninfo) {  //如果已经存在别登录就修改
            /* 			if(!$nocode && $timefag>1){
              $apiparam['sign']    = false;
              $apiparam['message'] = "你的帐号已在别处登陆，是否重新登陆";
              //return $apiparam;
              $this->ajaxReturn($apiparam);exit;
              } */
            $sessionint = M('membersession')->where(['userid' => $userinfo['id']])->setField(['sessionid' => $sid, 'ip' => $ip, 'time' => $_t]);
        } else {//如果不存在别登录就添加
            $sessiondata = [];
            $sessiondata['userid'] = $userinfo['id'];
            $sessiondata['username'] = $userinfo['username'];
            $sessiondata['sessionid'] = $sid;
            $sessiondata['ip'] = $ip;
            $sessiondata['time'] = $_t;
            $sessionint = M('membersession')->data($sessiondata)->add();
        }
        $upd_set_member_arr = ['onlinetime' => $_t, 'logintime' => $_t, 'loginip' => $ip, 'iparea' => IParea($ip), 'loginsource' => strtolower($data["source"])];
        if (empty($userinfo['live_game_name'])) {///修改真人游戏的用户名
            $username = 'usr_name_' . $userinfo['username'];
            $upd_set_member_arr['live_game_name'] = 'RBw10' . strtolower(substr(md5('p_!#%_' . $username), 0, 9));
        }
        $onlineint = M('member')->where(['id' => $userinfo['id']])->setField($upd_set_member_arr);
        //$userinfo['groupname'] = $userinfo['proxy']==1?'代理':'普通会员';
        /* 		if($userinfo['proxy']==1){
          $userinfo['groupname'] = '普通代理';
          }else{
          if($userinfo['groupid']){
          $userinfo['groupname'] = M('membergroup')->where(['groupid'=>$userinfo['groupid']])->getField('groupname');
          }else{
          $userinfo['groupname'] = '普通会员';
          }
          } */
        $apiparam['sign'] = true;
        $apiparam['message'] = "登陆成功({$data['source']})";
        $apiparam['data']['islogin'] = 1;
        $apiparam['auth']['member_auth_id'] = $userinfo['id'];
        $apiparam['auth']['member_sessionid'] = $sid;
        return $apiparam;
    }

    function getdownuser($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $map = [];
        $map['parentid'] = ['eq', $userinfo['id']];
        $map['isnb'] = ['eq', 0];
        $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
        $apiparam['records'] = count($downlist);
        $apiparam['data'] = $downlist;
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        return $apiparam;
    }

    /*     * 代理********************************************************************************** */

    //充值量 提现量 代购量 派奖量 返点 活动
    function reportstatistics($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        $map = [];
        $map['parentid'] = ['eq', $userinfo['id']];
        $map['isnb'] = ['eq', 0];
        $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
        $chiduids = [];
        foreach ($downlist as $k => $v) {
            $chiduids[] = $v['id'];
        }
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $startime = $apiparam['startime']; //时间戳
        $endtime = $apiparam['endtime']; //时间戳
        $startime = $startime ? strtotime(date('Y-m-d 00:00:00', $startime)) : $beginToday - 86400 * 30;
        $endtime = $endtime ? strtotime(date('Y-m-d 23:59:59', $endtime)) : $endToday;
        //充值量
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $map['state'] = ['eq', 1];
        $map['oddtime'][] = ['elt', $endtime];
        $map['oddtime'][] = ['egt', $startime];
        $map['isauto'] = ['eq', 1];
        $zdchongzhiall = M("recharge")->where($map)->sum('amount');
        //手动充值加
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $map['state'] = ['eq', 1];
        $map['oddtime'][] = ['elt', $endtime];
        $map['oddtime'][] = ['egt', $startime];
        $map['isauto'] = ['eq', 2];
        $map['sdtype'] = ['eq', 1];
        $sdjiachongzhiall = 0;
        $sdjiachongzhiall = M('recharge')->where($map)->sum('amount');
        //手动充值减
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $map['state'] = ['eq', 1];
        $map['oddtime'][] = ['elt', $endtime];
        $map['oddtime'][] = ['egt', $startime];
        $map['isauto'] = ['eq', 2];
        $map['sdtype'] = ['eq', -1];
        $sdjianchongzhiall = 0;
        $sdjianchongzhiall = M('recharge')->where($map)->sum('amount');
        //充值
        $transferIn = $zdchongzhiall + $sdjiachongzhiall - $sdjianchongzhiall;
        //提现量
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $map['state'] = ['eq', 1];
        $map['oddtime'][] = ['elt', $endtime];
        $map['oddtime'][] = ['egt', $startime];
        $transferOut = M("withdraw")->where($map)->sum('amount');
        //代购量
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $map['isdraw'] = ['in', [1, -1]];
        $map['oddtime'][] = ['elt', $endtime];
        $map['oddtime'][] = ['egt', $startime];
        $validAmount = M('touzhu')->where($map)->sum('amount');
        //派奖量
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $map['isdraw'] = ['in', [1]];
        $map['oddtime'][] = ['elt', $endtime];
        $map['oddtime'][] = ['egt', $startime];
        $payoutAmount = M('touzhu')->where($map)->sum('amount');
        //返水
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $map['type'] = ['eq', 'commission'];
        $map['oddtime'][] = ['elt', $endtime];
        $map['oddtime'][] = ['egt', $startime];
        $dayBackPoint = M('fuddetail')->where($map)->sum('amount');
        //活动
        $map = [];
        $map['uid'] = ['in', $chiduids];
        $map['type'] = ['in', ['pointexchange', 'activity_bindcard', 'activity_czzs', 'activity_rxf', 'activity_rks', 'activity_yxf', 'activity_yks']];
        $map['oddtime'][] = ['elt', $endtime];
        $map['oddtime'][] = ['egt', $startime];
        $activityAmount = M('fuddetail')->where($map)->sum('amount');

        $apiparam['data'] = [];
        $apiparam['data']['transferIn'] = $transferIn ? $transferIn : 0;
        $apiparam['data']['transferOut'] = $transferOut ? $transferOut : 0;
        $apiparam['data']['validAmount'] = $validAmount ? $validAmount : 0;
        $apiparam['data']['payoutAmount'] = $payoutAmount ? $payoutAmount : 0;
        $apiparam['data']['dayBackPoint'] = $dayBackPoint ? $dayBackPoint : 0;
        $apiparam['data']['activityAmount'] = $activityAmount ? $activityAmount : 0;
        $apiparam['startime'] = date('Y-m-d H:i:s', $startime);
        $apiparam['endtime'] = date('Y-m-d H:i:s', $endtime);
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        return $apiparam;
    }

    //代理团队人数 总金额
    function downuserports($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
        }
        /*
          $map = [];
          $map['parentid'] = ['eq',$userinfo['id']];
          $map['isnb'] = ['eq',0];
          $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
          $chiduids = [];
          foreach($downlist as $k=>$v){
          $chiduids[] = $v['id'];
          }
         */
        //获取所有的下线
        $chidusers = M('member')->where(['parentid' => $userinfo['id'], 'isnb' => 0])->field('id')->select();
        $chiduids = [];
        foreach ($chidusers as $k => $v) {
            $chiduids[] = $v['id'];
        }
        $totalnum = count($chiduids) ? count($chiduids) : 0; //总数

        $map = [];
        $map['isnb'] = ['eq', 0];
        $map['parentid'] = ['eq', $userinfo['id']];
        $map['proxy'] = ['eq', 1];
        $proxynum = M('member')->where($map)->count();
        $proxynum = $proxynum ? $proxynum : 0; //代理人数

        $noproxynum = $totalnum - $proxynum; //玩家人数

        $totalamount = M('member')->where(['parentid' => $userinfo['id'], 'isnb' => 0])->sum('balance'); //团队总余额
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取成功';
        $apiparam['data'] = [];
        $apiparam['data']['totalnum'] = $totalnum ? $totalnum : 0;
        $apiparam['data']['proxynum'] = $proxynum ? $proxynum : 0;
        $apiparam['data']['noproxynum'] = $noproxynum ? $noproxynum : 0;
        $apiparam['data']['totalamount'] = $totalamount ? $totalamount : '0.00';

        return $apiparam;
    }

    //团队图表
    function echarts($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        if ($userinfo['proxy'] != 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您不是代理';
            return $apiparam;
            exit;
        }
        $map = [];
        $map['parentid'] = ['eq', $userinfo['id']];
        $map['isnb'] = ['eq', 0];
        $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
        $chiduids = [];
        foreach ($downlist as $k => $v) {
            $chiduids[] = $v['id'];
        }
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $startime = $apiparam['startime']; //时间戳
        $endtime = $apiparam['endtime']; //时间戳
        $startime = $startime ? strtotime(date('Y-m-d 00:00:00', $startime)) : $beginToday - 86400 * 30;
        $endtime = $endtime ? strtotime(date('Y-m-d 23:59:59', $endtime)) : $endToday;
        $type = $apiparam['type'];
        $days = floor(($endtime - $startime) / 86400);
        if ($days > 31) {
            $apiparam['startime'] = date('Y-m-d H:i:s', $startime);
            $apiparam['endtime'] = date('Y-m-d H:i:s', $endtime);
            $apiparam['sign'] = false;
            $apiparam['message'] = '只能查询30天内的数据' . $days;
            return $apiparam;
            exit;
        }

        $_endDate = date("Y-m-d", $endtime);
        $text = '';
        $date = [];
        $data = [];
        switch ($type) {
            case'cz':
                for ($i = 0, $j = $days; $i <= $days; $i++, $j--) {
                    $date[] = $_tt = date("Y-m-d", strtotime($_endDate) - 86400 * $j);
                    $map = [];
                    $map['uid'] = ['in', $chiduids];
                    $map['state'] = ['eq', 1];
                    $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
                    $map['oddtime'][] = ['egt', strtotime($_tt)];
                    $amount = 0;
                    $amount = M('recharge')->where($map)->sum('amount');
                    $data[] = $amount ? $amount : 0;
                }
                $subtext = '单位(元)';
                break;
            case'tx':
                for ($i = 0, $j = $days; $i <= $days; $i++, $j--) {
                    $date[] = $_tt = date("Y-m-d", strtotime($_endDate) - 86400 * $j);
                    $map = [];
                    $map['uid'] = ['in', $chiduids];
                    $map['state'] = ['eq', 1];
                    $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
                    $map['oddtime'][] = ['egt', strtotime($_tt)];
                    $amount = 0;
                    $amount = M('withdraw')->where($map)->sum('amount');
                    $data[] = $amount ? $amount : 0;
                }
                $subtext = '单位(元)';
                break;
            case'tz':
                for ($i = 0, $j = $days; $i <= $days; $i++, $j--) {
                    $date[] = $_tt = date("Y-m-d", strtotime($_endDate) - 86400 * $j);
                    $map = [];
                    $map['uid'] = ['in', $chiduids];
                    $map['isdraw'] = ['in', [1, -1]];
                    $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
                    $map['oddtime'][] = ['egt', strtotime($_tt)];
                    $amount = 0;
                    $amount = M('touzhu')->where($map)->sum('amount');
                    $data[] = $amount ? $amount : 0;
                }
                $subtext = '单位(元)';
                break;
            case'fd':
                for ($i = 0, $j = $days; $i <= $days; $i++, $j--) {
                    $date[] = $_tt = date("Y-m-d", strtotime($_endDate) - 86400 * $j);
                    $map = [];
                    $map['uid'] = ['in', $chiduids];
                    $map['type'] = ['eq', 'commission'];
                    $map['oddtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
                    $map['oddtime'][] = ['egt', strtotime($_tt)];
                    $amount = 0;
                    $amount = M('fuddetail')->where($map)->sum('amount');
                    $data[] = $amount ? $amount : 0;
                }
                $subtext = '单位(元)';
                break;
            case'xz':
                for ($i = 0, $j = $days; $i <= $days; $i++, $j--) {
                    $date[] = $_tt = date("Y-m-d", strtotime($_endDate) - 86400 * $j);
                    $map = [];
                    $map['parentid'] = ['eq', $userinfo['id']];
                    $map['isnb'] = ['eq', 0];
                    $map['regtime'][] = ['elt', strtotime($_tt) + 86400 - 1];
                    $map['regtime'][] = ['egt', strtotime($_tt)];
                    $num = 0;
                    $num = M('member')->where($map)->count();
                    $data[] = $num ? $num : 0;
                }
                $subtext = '单位(人)';
                $text = '新增用户数量';
                break;
        }
        $apiparam['sign'] = true;
        $apiparam['message'] = '获取数据成功';
        $apiparam['startime'] = date('Y-m-d H:i:s', $startime);
        $apiparam['endtime'] = date('Y-m-d H:i:s', $endtime);
        $apiparam['date'] = $date;
        $apiparam['data'] = $data;
        $apiparam['subtext'] = $subtext;
        $apiparam['text'] = $text;
        return $apiparam;
    }

    //收件箱
    function chatrecelist($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        $map = [];
        $map['receid'] = ['eq', $userinfo['id']];
        //$map['receid'] = ['eq',$userinfo['id']];
        $list = M('message')->where($map)->field('sentcontext', true)->group('sentid')->order('id desc')->select();
        foreach ($list as $k => $v) {
            $v['senttime'] = date('Y-m-d H:i:s', $v['senttime']);
            if ($v['readtime'])
                $v['readtime'] = date('Y-m-d H:i:s', $v['readtime']);
            $v['senttype'] = 0;
            if ($userinfo['parentid'] && $v['sentid'] == $userinfo['parentid']) {
                $v['senttype'] = 1; //上级
                $v['sentname'] = '上级';
            }
            if ($v['sentid'] == 0) {
                $v['senttype'] = -1; //系统
                $v['sentname'] = 'system';
            }
            $list[$k] = $v;
        }
        $apiparam['records'] = count($list);
        $apiparam['root'] = $list;
        return $apiparam;
    }

    //发件箱
    function chatsentlist($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        $map = [];
        $map['sentid'] = ['eq', $userinfo['id']];
        $list = M('message')->where($map)->field('sentcontext', true)->group('receid')->order('id desc')->select();
        foreach ($list as $k => $v) {
            $v['senttime'] = date('Y-m-d H:i:s', $v['senttime']);
            if ($v['readtime'])
                $v['readtime'] = date('Y-m-d H:i:s', $v['readtime']);
            $list[$k] = $v;
        }
        $apiparam['records'] = count($list);
        $apiparam['root'] = $list;
        return $apiparam;
    }

    //信件内容
    function chatcontext($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        $id = intval($apiparam["id"]);
        $info = M('message')->where(['id' => $id])->find();
        if (!$info) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '信件不存在';
            return $apiparam;
            exit;
        }
        if ($userinfo['id'] != $info['sentid'] && $userinfo['id'] != $info['receid']) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '您无权查看';
            return $apiparam;
            exit;
        }
        $map = [];
        $userid = $userinfo['id'];
        $receid = $info['receid'];
        $sentid = $info['sentid'];
        $list = M('message')->where(" ( sentid='{$userid}' and receid='{$receid}' ) or (receid='{$userid}' and sentid='{$sentid}') ")->field("*,FROM_UNIXTIME( senttime,  '%m-%d %h:%i' ) as senttime")->order('senttime asc')->select();
        $apiparam['records'] = count($list);
        $apiparam['root'] = $list;
        return $apiparam;
    }

    function chatsent($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        $userids = array_unique(array_filter(explode(';', $apiparam["userids"])));
        $title = remove_xss(safe_replace(strip_tags($apiparam["title"])));
        $context = remove_xss(safe_replace(strip_tags($apiparam["context"])));
        if (count($userids) < 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '收件人不能空';
            return $apiparam;
            exit;
        }
        if (strlen($title) < 1 || strlen($context) < 1) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '主题和内容必须填写';
            return $apiparam;
            exit;
        }
        $map = [];
        $map['parentid'] = ['eq', $userinfo['id']];
        $map['isnb'] = ['eq', 0];
        $downlist = M('member')->where($map)->order('id desc')->field('id,username')->select();
        $downuids = [];
        foreach ($downlist as $k => $v) {
            $downuids[$v['id']] = $v;
        }
        $addints = [];
        $datas = [];
        foreach ($userids as $k => $v) {
            $data = [];
            $data['sentid'] = $userinfo['id'];
            $data['sentname'] = $userinfo['username'];
            $data['senttitle'] = $title;
            $data['sentcontext'] = $context;
            $data['receid'] = $downuids[$v]['id'];
            $data['recename'] = $downuids[$v]['username'];
            $data['senttime'] = time();
            if ($downuids[$v]) {
                $addints[] = M('message')->data($data)->add();
            }
            $datas[] = $data;
        }
        $okcount = count(array_unique(array_filter($addints)));
        if ($okcount > 0) {
            $apiparam['sign'] = true;
            $apiparam['message'] = '发送成功';
            return $apiparam;
            exit;
        } else {
            $apiparam['sign'] = false;
            $apiparam['message'] = '发送失败';
            $apiparam['data'] = $datas;
            return $apiparam;
            exit;
        }
    }

    function getZrBalance($apiparam = array()) {
        $apiparam = self::_cheacktoken($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $apiparam = checklogin($apiparam);
        if (!$apiparam['sign'])
            return $apiparam;
        $userinfo = $apiparam["data"];
        unset($apiparam["data"]);
        $username = $userinfo['username'];
        $CgcService = new \Org\Util\CgcService('AG');
        $ret = $CgcService->balance(substr(trim($username), 0, 8));
        $agBalance = $ret['balance'];
        $CgcService = new \Org\Util\CgcService('BBIN');
        $ret = $CgcService->balance(substr(trim($username), 0, 8));
        $bbBalance = $ret['balance'];
        $CgcService = new \Org\Util\CgcService('MG');
        $ret = $CgcService->balance(substr(trim($username), 0, 8));
        $mgBalance = $ret['balance'];
        $CgcService = new \Org\Util\CgcService('SS');
        $ret = $CgcService->balance(substr(trim($username), 0, 8));
        $ssBalance = $ret['balance'];
        $result['sign'] = true;
        $result['message'] = '获取数据成功';
        $result['agBalance'] = $agBalance;
        $result['bbBalance'] = $bbBalance;
        $result['mgBalance'] = $mgBalance;
        $result['ssBalance'] = $ssBalance;
        return $result;
    }

    //用户注册
    function qb_register() {
        $post = I('string');
        $d = decode($post, C('qb_key'));
        $d = json_decode($d, true);
       // dump($d);exit;
        $data['username'] = $d['username'];
        $data['password'] = $d['password'];
        $data['mobile'] = $d['mobile'];
        //检测用户名是否存在
        if (M('member')->where(['username' => $data['username']])->getField('id')) {
            $apiparam['sign'] = false;
            $apiparam['message'] = '用户名已经被注册';
            $apiparam['error'] = '-1';
            echo json_encode($apiparam);
            exit;
        }

        $data['parentid'] = $data['parentid'] ? $data['parentid'] : 9001;
        $data['qq'] = $data['qq'] ? $data['qq'] : '';
        $data['password'] = $data['password'];
        // $data['tradepassword'] = sys_md5($data['tradepassword']);
        $data['logintime'] = $data['regtime'] ? $data['regtime'] : time();
        $data['regtime'] = $data['regtime'] ? $data['regtime'] : time();
        $data['userbankname'] = '';
        $data['balance'] = 0;
        $data['point'] = 0;
        $data['xima'] = 0;
        $data['regip'] = '127.0.0.1';
        $data['face'] = "/resources/images/face/" . rand(1, 25) . ".jpg";
        $data['islock'] = 0;
        $data['source'] = '棋牌注册';
        $data['loginsource'] = 'qb';
        $username = 'usr_name_' . $data['username'];
        $data['live_game_name'] = 'RBw10' . strtolower(substr(md5('p_!#%_' . $username), 0, 9));
        $addint = M('member')->add($data);
        if ($addint) {
            //注册成功后做登陆操作
            $sessionid = md5($data['regip'] . '-' . $data['regtime']);
            $apiparam['sign'] = true;
            $apiparam['message'] = '注册成功';
            $apiparam['data']['regisok'] = 1;
            $apiparam['auth']['member_auth_id'] = $addint;
            $apiparam['auth']['member_sessionid'] = $sessionid;

            echo json_encode($apiparam);
            // redirect(U('mobile/index/index'));
        } else {
            $apiparam['sign'] = false;
            $apiparam['message'] = '注册失败';
        }
    }


}
