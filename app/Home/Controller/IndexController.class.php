<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function __construct(){
        cookie('addr_url',U(CONTROLLER_NAME/ACTION_NAME));
        parent::__construct();
    }
    function index(){
        $_t = time();
        //dump(intval(0.8));exit;
        /*首页banner下彩票展示
        $cplist = M('caipiao')->where("isopen=1")->order('allsort asc,id desc')->cache(600)->select();

        foreach($cplist as $k=>$v){
            $balls = array();
            $hz = 0;$daxiao = $danshuang = '';
            $cpinfo = Array();
            if($cpinfo['issys']==0){
                $kjinfo = M('kaijiang')->where(array('name'=>array('eq',$v['name'])))->limit(1)->order('id desc')->cache(600)->find();
            }else if($cpinfo['issys']==1){
                $kjinfo = M('kaijiang')->where(array('name'=>array('eq',$v['name']),'opentime'=>array('elt',$_t)))->order('id desc')->limit(1)->cache(600)->find();
            }
            $balls = explode(',',$kjinfo['opencode']);
            $hz    = array_sum($balls);
            if($hz>10){
                $daxiao = '大';
            }else{
                $daxiao = '小';
            }
            if($hz%2==0){
                $danshuang = '双';
            }else{
                $danshuang = '单';
            }
            $cplist[$k]['opencode'] = $balls;
            $cplist[$k]['daxiao'] = $daxiao;
            $cplist[$k]['danshuang'] = $danshuang;
            $cplist[$k]['expect'] = $kjinfo['expect'];
        }
        $this->assign('bncaipiao',$cplist);*/
        //昨日资金榜和中奖信息
        $time=time ()- ( 1  *  24  *  60  *  60 ); //昨天时间截
        $day = date("Y-m-d",$time);
        $StartTime = date($day.' 00:00:00');      //昨天开始时间
        $EndTime   = date($day.' 23:59:59') ;     //昨天开始结束
        $map['oddtime'][]=array('egt',strtotime($StartTime));
        $map['oddtime'][]=array('elt',strtotime($EndTime));
        //查找昨日投注
        //$list  = M('')->table('__TOUZHU__ t,__MEMBER__ m,__MEMBERGROUP__ p')->field('t.cpname as k3name,t.uid,t.okamount,t.cpname,m.username,m.sex,m.face,p.groupname,p.touhan')->distinct(true)->where('t.isdraw=1 AND m.id=t.uid AND m.groupid=p.groupid')->select();
        //$list2 = M('')->table('__TOUZHU__ t,__MEMBER__ m,__MEMBERGROUP__ p')->field('t.cpname as k3name,t.uid,t.okamount,t.cpname,m.username,m.sex,m.face,p.groupname,p.touhan')->distinct(true)->where('t.isdraw=1 AND m.id=t.uid AND m.groupid=p.groupid')->order('t.okamount DESC')->select();


        //昨日投注中奖榜
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
        $list = M('touzhu')->field("cptitle as k3name,uid,username,sum(okamount) as okamount")->where($map)->group("uid")->limit(600)->order("okamount desc")->select();
        foreach($list as $k=>$v){
            $userinfo  = [];
            $userinfo  = M('member')->where(['id'=>$v['uid']])->field('groupid,sex,face')->cache(600)->find();
            $v['sex']  = $userinfo['sex'];
            $v['face'] = is_file($userinfo['face'])?$userinfo['face']:'/resources/images/face/'.rand(1,25).'.jpg';
            $v['groupname'] = $usergrouplist[$userinfo['groupid']]['groupname'];
            $v['touhan'] = $usergrouplist[$userinfo['groupid']]['touhan'];
            $v['amountcount'] = $v['okamount'];
            $v['okamountcount'] = M('touzhu')->where("isdraw=1 AND uid='{$v['uid']}'")->SUM('okamount');
            $v["k3names"] = M('touzhu')->distinct ( true )->where ("uid='{$v['uid']}'")->field ( 'cpname as name,cptitle as title' )->cache(60)->limit(8)->select();
            $list[$k]    = $v;
        }
        $group = M('Membergroup')->field('groupid,groupname,touhan')->where('isagent <> 1')->order('groupid ASC')->select();
        if(count($list)<3){
            $list = $this->randking(1,$group);
        }
        $list=list_sort_by($list,'amountcount','desc');
        $this->assign('list',$list);
        $this->assign('list2',$list);
        $this->assign('active','index');
        //公告
        $gonggao = M('gonggao')->field('id,title,content')->order('id desc')->find();
        $this->assign('gonggao',$gonggao);
        $this->display();
        /*foreach ($list as $key=>$value){
            $list[$key]["okamountcount"] = M('touzhu')->distinct(true)->where("isdraw=1 AND uid='{$value['uid']}' AND username='{$value['username']}'")->SUM('okamount');
            $list[$key]["amountcount"] = M('touzhu')->distinct(true)->where("isdraw=1 AND uid='{$value['uid']}' AND username='{$value['username']}'")->where($map)->SUM('okamount');
            $list[$key]["k3names"] = M('touzhu')->distinct ( true )->where ("uid='{$value['uid']}' AND username='{$value['username']}'")->field ( 'cpname as name,cptitle as title' )->limit(8)->select();
         }
        foreach ($list2 as $key=>$value){
            $list2[$key]["okamountcount"] = M('touzhu')->distinct(true)->where("isdraw=1 AND uid='{$value['uid']}' AND username='{$value['username']}'")->SUM('okamount');
            $list2[$key]["k3names"] = M('touzhu')->distinct ( true )->where ("uid='{$value['uid']}' AND username='{$value['username']}'")->field ('cpname as name,cptitle as title')->limit(8)->select();
        }
        $list=list_sort_by($list,'amountcount','desc');
        $list2 = $list;

        $member = M('member')->field('id,username,face')->select();
        $list = list_sort_by($list,'amountcount','desc');
        foreach ($list as $key => $value) {
            foreach ($member as $k => $v){
                if($value['uid'] == $v['id']){
                    $arr[$value['uid']][] = $value;
                }
            }
        }
        foreach ($arr as $k => $v){
            $_list[] = $arr[$k][0];
        }

        $group = M('Membergroup')->field('groupid,groupname,touhan')->where('isagent <> 1')->order('groupid ASC')->select();

        if(C('ranking')==1 or empty($list[3]['amountcount']))
        {  //如果昨天没有奖金榜或开始了随机奖金榜
            if(!$_COOKIE['list']){              //如果cookie 不存在
                $this->assign('list' , $this->randking(null,$group));
                header( "Location: ".U('Index/index')."" );
            }else{                              //如果cookie存在
                $obj = object_to_array(json_decode($_COOKIE['list']));
                foreach ($obj as $key=>$value) {
                    $obj[$key]['k3names']= M('caipiao')->field("name,title")->limit(rand(0,3),6)->select();

                    switch ($obj[$key]['groupname']){
                        case $group[0]['groupname']:
                            $obj[$key]['touhan'] = $group[0]['touhan'];
                            break;
                        case $group[1]['groupname']:
                            $obj[$key]['touhan'] = $group[1]['touhan'];
                            break;
                        case $group[2]['groupname']:
                            $obj[$key]['touhan'] = $group[2]['touhan'];
                            break;
                        case $group[3]['groupname']:
                            $obj[$key]['touhan'] = $group[3]['touhan'];
                            break;
                        case $group[4]['groupname']:
                            $obj[$key]['touhan'] = $group[4]['touhan'];
                            break;
                        case $group[5]['groupname']:
                            $obj[$key]['touhan'] = $group[5]['touhan'];
                            break;
                        case $group[6]['groupname']:
                            $obj[$key]['touhan'] = $group[6]['touhan'];
                            break;
                        case $group[7]['groupname']:
                            $obj[$key]['touhan'] = $group[7]['touhan'];
                            break;
                        case $group[8]['groupname']:
                            $obj[$key]['touhan'] = $group[8]['touhan'];
                            break;
                        case $group[9]['groupname']:
                            $obj[$key]['touhan'] = $group[9]['touhan'];
                            break;
                    }
                }
                $this->assign('list', $obj);
                $this->assign('list2',$this->randking(1,$group)) ;
            }
            $this->display();
        }else{
            $this->assign('list',$list);
            $this->assign('list2',$list2);
            $this->display(T('Index/index'));
        }*/
    }
    //随机资金榜
    public function randking($nocookie=null,$group){
        $nocookie?$no = 50 : $no =10;
        $allk3 = M('caipiao')->field("name,title")->cache(300)->where("isopen=1")->select();
        for ($i=0;$i<$no;$i++) {
            $count = rand(1,6); $num = rand(4,6); $num2  = rand(2,3);$num3  = rand(1,2);
            $user[$i]['username']  = substr_replace(rand_strings($num,$count),'****','1','4');
            $user[$i]['okamount']  =  rand_strings(1,7).rand_strings($num3,0);
            $user[$i]['face']      = is_file($user[$i]['face'])?$user[$i]['face']:'/resources/images/face/'.rand(1,25).'.jpg';
            $user[$i]['sex']       =  rand(0,2);
            $user[$i]['groupname'] =  $group[rand(0,8)]['groupname'];
            $user[$i]['k3name']    =  $allk3[rand(0,14)]['title'];
            $user[$i]["amountcount"]     =    rand_strings(1,7).rand_strings($num2,0);
            $user[$i]["okamountcount"]     =  ceil($user[$i]['amountcount'] * (rand(6,9).'.'.rand(1,9)));
        }
        $sedcon = strtotime(date("Y-m-d ")."23:59:59")-time();
        $user = list_sort_by($user,'amountcount','desc');
        $list =json_encode($user);
        if($nocookie){
            foreach ($user as $key=> $value){
                $user[$key]['k3names']= M('caipiao')->field("name,title")->cache(300)->limit(rand(0,3),6)->select();
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
    //手机购彩
    public function Mobile(){
        $this->display();
    }
    public function winners(){
        $time=time ()- ( 1  *  24  *  60  *  60 );
        $day = date("Y-m-d",$time);
        $StartTime = date($day.' 00:00:00');
        $EndTime   = date('Y-m-d H:i:s') ;
        $map['oddtime'][]=array('egt',strtotime($StartTime));
        $map['oddtime'][]=array('elt',strtotime($EndTime)+86400-10);
        $list  = M('')->table('__TOUZHU__ t,__MEMBER__ m')->field('t.cpname,t.uid,t.okamount,m.username,m.face')->where('t.status=1 AND m.id=t.uid')->select();
        $list2 = M('')->table('__TOUZHU__ t,__MEMBER__ m')->field('t.cpname,t.uid,t.okamount,m.username,m.face')->where($map)->where('t.status=1 AND m.id=t.uid')->order('okamount DESC')->select();

        if(C('ranking')==1){
            $this->assign('randking',$this->randking()) ;
            $this->display();
        }else{
            $this->assign('list',$list);
            $this->assign('list2',$list2);
            $this->display();
        }
    }
    //捕鱼天堂
    /*function bylineage(){
        $game_tye = I('game_tye');
        $userInfo=$_SESSION['userinfo'];
        if(empty($userInfo)){
            echo '<script> alert("用户未登录");window.history.go(-1);</script> ';exit;
        }
        $username=$userInfo['username'];
        if($game_tye =='MW'){
            $MWService=new \Org\Api\MW();
            $rest = $MWService->login($username);
            if($rest&&$rest['code']==1){
                $url = $rest['data'];
                header('Location: '.$url.'');
            }else{
                $msg =$rest['msg'];
                echo "<script> alert('$msg');window.history.go(-1);</script>";exit;
            }
        }
        if($game_tye =='AG2'){
            $AgService=new \Org\Api\AgService();
            $rest = $AgService->login($username);
            if($rest&&$rest['code']==1){
                $url = $rest['data'];
                header('Location: '.$url.'');exit;
            }else{
                $msg =$rest['msg'];
                echo "<script> alert('$msg');window.history.go(-1);</script>";exit;
            }
        }
        if($game_tye =='CQ9'){
            $CQ9Service=new \Org\Api\CQ9();
            $rest = $CQ9Service->login($username);
            if($rest&&$rest['code']==1){
                $url = $rest['data'];
                header('Location: '.$url.'');
            }else{
                $msg =$rest['msg'];
                echo "<script> alert('$msg');window.history.go(-1);</script>";exit;
            }
        }
         echo "<script> alert('游戏暂未开放');window.history.go(-1);</script>";exit;
   //    $this->display();
    }*/
    //真人视讯
    function zrvideo(){
        $gonggao = M('gonggao')->field('id,title,content')->order('id desc')->find();
        $this->assign('gonggao',$gonggao);
        $this->assign('active','real_man');
        $this->display();
    }
    function egame(){
        $list =   C('game_list');

        $game_list = array();
        $egame = M('real_person')->where(['game_tye'=>['like','%egame%']])->order('id asc')->select();
        foreach ($egame as $value){
            $game_list[$value['name']] = $list[$value['name']];
        }
        $default_game =empty(I('game_type'))?'AG':I('game_type');
        $this->assign('game',$default_game);
        $this->assign('egame',$egame);
        $this->assign('list',$game_list[$default_game]);
        $this->assign('active','egame');
        $this->display();
    }
    function ajax_game(){
        $game_name =I('line');
        $list =   C('game_list');
        $this->ajaxReturn($list[$game_name]);
    }


    //热门彩票
    function lottery(){
        $group = M('Membergroup')->field('groupid,groupname,touhan')->cache(300)->where('isagent <> 1')->order('groupid ASC')->select();
        $other = $Allcp = $hotcaipiao = M("caipiao")->where("isopen = 1")->cache(300)->order('allsort ASC')->select();
        foreach ($hotcaipiao as $key => $value){
            $where['cpname'] = $value['name'];
            $count = M('touzhu')->where($where)->count();
            $hotcaipiao[$key]['count']= $count;
        }

        $sort = array(
            'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => 'count',       //排序字段
        );
        $arrSort = array();
        foreach($hotcaipiao AS $key => $value){
            foreach($value AS $k=>$v){
                $arrSort[$k][$key] = $v;
            }
        }
        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $hotcaipiao);
        }
// 单个彩种排序
        $sort2 = array(
            'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => 'listorder',       //排序字段
        );
        $arrsort2 = array();
        foreach($other AS $key => $value){
            foreach($value AS $k=>$v){
                $arrsort2[$k][$key] = $v;
            }
        }
        if($sort2['direction']){
            array_multisort($arrsort2[$sort2['field']], constant($sort2['direction']), $other);
        }
        $this->assign('hotcaipiao',$hotcaipiao);
        $this->assign('Allcp',$Allcp);
        $this->assign('other',$other);
        $this->assign('list',$this->randking(1,$group));
        $this->display();
    }
    function gonggao(){
        $id = I('id');
        $gglist = C('gglist');
        $info = $gglist[$id];
        if($info){
            $info['oddtime'] = date('Y-m-d H:i',$info['oddtime']);
            $return['sign'] = true;
            $return['message'] = '获取成功';
            $return['data'] = $info;
            echo jsonreturn($return);exit;
        }else{
            $return['sign'] = false;
            $return['message'] = '获取失败';
            echo jsonreturn($return);exit;
        }
    }

    public function chess(){
        $list =   C('game_list');
        $game_list = array();
        $egame = M('real_person')->where(['game_tye'=>['like','%chess%']])->order('id asc')->select();
        foreach ($egame as $value){
            $game_list[$value['name']] = $list[$value['name']];
        }
        //公告
        $gonggao = M('gonggao')->field('id,title,content')->order('id desc')->find();
        $this->assign('gonggao',$gonggao);
        $this->assign('game','KY');
        $this->assign('egame',$egame);
        $this->assign('list',$game_list['KY']);
        $this->assign('active','egame');
        $this->assign('active','chess');
        $this->display();
    }

    public function sport(){
        $sprot_data = M('real_person')->where(['game_tye'=>['like','%sport%']])->order('id asc')->select();
        foreach ($sprot_data  as $idx=>$v){
            if($v['name']=='BBIN'){
                $sprot_data[$idx]['code'] = 'ball';
            }

        }
        $gonggao = M('gonggao')->field('id,title,content')->order('id desc')->find();
        $this->assign('gonggao',$gonggao);
        $this->assign('sprot_data',$sprot_data);
        $this->display();
    }

    public function lotteryhall(){
        $gamecplist = S('gamecplist');
        if(!$gamecplist){
            $_allcp = M('Caipiao')->cache('gamecplist',300)->field('id,title,typeid,name')->where("isopen='1' AND iswh='0'")->order('listorder ASC')->select();
        }else{
            $_allcp = $gamecplist;
        }
        $gonggao = M('gonggao')->field('id,title,content')->order('id desc')->find();
        $this->assign('gonggao',$gonggao);
        $this->assign('Allcp',$_allcp);
        $this->display();
    }


}
?>