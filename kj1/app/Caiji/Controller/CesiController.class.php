<?php
namespace Caiji\Controller;
use Think\Controller;
class CesiController extends Controller {
    public function _initialize(){
        header("Content-type: text/html; charset=utf-8");
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
    }
}