<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/14
 * Time: 11:35
 */

namespace Admincenter\Controller;


class BackwaterController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->_db = D('backwater');
        $this->_pk = $this->_db->getPk();
    }

    public function rule()
    {
        $map = [];
        $count = $this->_db->where($map)->count();
        $Page = new \Think\Page($count, 15);
        $show = $Page->show();
        $list = $this->_db->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->order('level asc')->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('totalcount', $count);
        $this->display();
    }

    public function rule_add()
    {
        if (IS_POST) {
            $_POST['create_time'] = time();
            $_POST['update_time'] = time();
            parent::_adddosimp();
        }
        $this->display();
    }

    public function rule_edit()
    {
        $id = I('id');
        if (IS_POST) {
            parent::_editdosimp();
        } else {
            $this->_pk = $this->_db->getPk();
            $info = $this->_db->where([$this->_pk => $id])->find();
            if (!$info) {
                $this->error('您修改的数据不存在！');
            } else {
                $this->assign('info', $info);
            }
        }
        $this->display('Backwater_rule_add');
    }

    public function auto_back_water(){
        $map = [];
        $count = M('water')->where($map)->count();
        $Page = new \Think\Page($count, 15);
        $show = $Page->show();
        $list =  M('water as w')
            ->field('w.*,m.username')
            ->join('LEFT JOIN  __MEMBER__ as m ON w.user_id = m.id')
            ->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->order('create_time asc')->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('totalcount', $count);
        $this->display();

    }

}