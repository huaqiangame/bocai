<?php
namespace Payer\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//		dump(U('Payer/Pay/onlinebank'));
 //	       $this->redirect(U('Home/Account/dealRecord'));
        dump(U('Payer/Pay/onlinebank'));
    }
}