<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-09
 * Time: 17:55
 */

namespace Home\Controller;

use Think\Controller;

class OldGameController extends CommonController
{
    public function __construct(){
        parent::__construct();
        if(!$this->userinfo){
            redirect(U("Public/login"));
        };
    }

//公用
    public function gameHeader(){
        $gamecplist = S('gamecplist');
        if(!$gamecplist){
            $_allcp = M('Caipiao')->cache('gamecplist',300)->field('id,title,typeid,name')->where("isopen='1' AND iswh='0'")->order('listorder ASC')->select();
        }else{
            $_allcp = $gamecplist;
        }
        $this->assign('Allcp',$_allcp);
    }

    public function ssc(){
        $this->gameHeader();
        $lotteryname = I('code');
        $this->assign('lotteryname',$lotteryname);
        $_ssclist = C('cplist.ssc');
        foreach($_ssclist as $k=>$v){
            if($v['isopen']==0)unset($_ssclist[$k]);
        }
        $this->assign('ssclist',$_ssclist);
        $this->assign('nowcpinfo',$_ssclist[$lotteryname]);
        $this->userkjmsg();
        $this->display();
    }

    public function pk10(){
        $this->gameHeader();
        $lotteryname = I('code');
        $this->assign('lotteryname',$lotteryname);
        $_ssclist = C('cplist.pk10');
        foreach($_ssclist as $k=>$v){
            if($v['isopen']==0)unset($_ssclist[$k]);
        }
        $this->assign('ssclist',$_ssclist);
        $this->assign('nowcpinfo',$_ssclist[$lotteryname]);
        $this->userkjmsg();
        $this->display();
    }


    function userkjmsg(){
        $_usergrouplist = M('membergroup')->cache(60)->select();
        foreach($_usergrouplist as $k=>$v){
            $usergrouplist[$v['groupid']] = $v;
        }
        $testuids = [];
        $testusers = M('member')->where(['isnb'=>1])->field('id')->select();
        foreach($testusers as $k=>$v){
            $testuids[] = $v['id'];
        }
        $map = [];
        $map['oddtime'][]=array('egt',strtotime($StartTime));
        $map['oddtime'][]=array('elt',strtotime($EndTime));
        $map['isdraw']=array('eq',1);
        //$map['uid']=array('not in',$testuids);
        $list = M('touzhu')->field("cpname as k3name,uid,username,sum(okamount) as okamount")->where($map)->group("uid")->limit(30)->order("okamount desc")->select();
        foreach($list as $k=>$v){
            $userinfo  = [];
            $userinfo  = M('member')->where(['id'=>$v['uid']])->field('groupid,sex,face')->cache(300)->find();
            $v['sex']  = $userinfo['sex'];
            $v['face'] = is_file($userinfo['face'])?$userinfo['face']:'/resources/images/face/'.rand(1,25).'.jpg';
            $v['groupname'] = $usergrouplist[$userinfo['groupid']]['groupname'];
            $v['touhan'] = $usergrouplist[$userinfo['groupid']]['touhan'];
            $v['amountcount'] = $v['okamount'];
            $v['okamountcount'] = M('touzhu')->where("isdraw=1 AND uid='{$v['uid']}'")->SUM('okamount');
            $v["k3names"] = M('touzhu')->distinct ( true )->where ("uid='{$v['uid']}'")->field ( 'cpname as name,cptitle as title' )->cache(300)->limit(8)->select();
            $list[$k]    = $v;
        }
        $group = M('Membergroup')->field('groupid,groupname,touhan')->where('isagent <> 1')->order('groupid ASC')->select();
        if(count($list)<3){
            $list = $this->randking(1,$group);
        }
        $list=list_sort_by($list,'amountcount','desc');
        $this->assign('list',$list);
        $this->assign('list2',$list);
    }
    //随机资金榜
    public function randking($nocookie=null,$group){
        $nocookie?$no = 50 : $no =10;
        $allk3 = M('caipiao')->field("name,title")->where("status=1")->select();
        for ($i=0;$i<$no;$i++) {
            $count = rand(1,6); $num = rand(4,6); $num2  = rand(2,3);$num3  = rand(1,2);
            $user[$i]['username']     =  rand_strings($num,$count);
            $user[$i]['okamount'] =  rand_strings(1,7).rand_strings($num3,0);
            $user[$i]['face'] = '/resources/images/face/'.rand(1,25).'.jpg';
            $user[$i]['sex'] =  rand(0,2);
            $user[$i]['groupname'] =  $group[rand(0,8)]["groupname"];
            $user[$i]['k3name'] =  $allk3[rand(0,14)]['title'];

            $user[$i]["amountcount"]     =    rand_strings(1,7).rand_strings($num2,0);
            $user[$i]["okamountcount"]     =  ceil($user[$i]['amountcount'] * (rand(6,9).'.'.rand(1,9)));
        }
        $sedcon = strtotime(date("Y-m-d ")."23:59:59")-time();
        $user = list_sort_by($user,'amountcount','desc');
        $list =json_encode($user);
        if($nocookie){
            foreach ($user as $key=> $value){
                $user[$key]['k3names']= M('caipiao')->field("name,title")->limit(rand(0,3),6)->select();
                switch ($user[$key]['groupname']){
                    case $group[0]['groupname']:
                        $user[$key]['touhan'] = $group[0]['touhan'];
                        break;
                    case $group[1]['groupname']:
                        $user[$key]['touhan'] = $group[1]['touhan'];
                        break;
                    case $group[2]['groupname']:
                        $user[$key]['touhan'] = $group[2]['touhan'];
                        break;
                    case $group[3]['groupname']:
                        $user[$key]['touhan'] = $group[3]['touhan'];
                        break;
                    case $group[4]['groupname']:
                        $user[$key]['touhan'] = $group[4]['touhan'];
                        break;
                    case $group[5]['groupname']:
                        $user[$key]['touhan'] = $group[5]['touhan'];
                        break;
                    case $group[6]['groupname']:
                        $user[$key]['touhan'] = $group[6]['touhan'];
                        break;
                    case $group[7]['groupname']:
                        $user[$key]['touhan'] = $group[7]['touhan'];
                        break;
                    case $group[8]['groupname']:
                        $user[$key]['touhan'] = $group[8]['touhan'];
                        break;
                    case $group[9]['groupname']:
                        $user[$key]['touhan'] = $group[9]['touhan'];
                        break;
                }
            }
            return $user;
            exit();
        }else{
            cookie('list',$list,$sedcon);
        }
    }
    // 计算用户奖金
}