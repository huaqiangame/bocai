<?php
namespace Admincenter\Controller;
use Think\Controller;
class UploadsController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	function index(){
		dump(dirname('../Uploads/'));
	}
	public function upload(){
		if(!IS_POST){
			echo json_encode(array('error' => 1, 'message' => '非法操作'));
			exit;
		}
		$allowext = explode('|',$_REQUEST['allowext']);
		if(count($allowext)){
            $allowext = ['jpg','png','gif'];
        }
        $page_type = isset($_REQUEST['allowpath'])?$_REQUEST['allowpath']:'';
        $uploadtype = trim($_REQUEST['uploadtype']);
		$allowpath = trim($_REQUEST['allowpath']);
		$size     = intval($_REQUEST['size'])?intval($_REQUEST['size']):1;
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     $size*1024*1024 ;// 设置附件上传大小
		$upload->exts      =     $allowext;// 设置附件上传类型
		if($allowpath){
			$upload->rootPath  =     './Uploads/'; // 临时目录
		}else{
			$upload->rootPath  =     RUNTIME_PATH.'Uploads/'; // 临时目录
		}
		$upload->rootPath  =     '../Uploads/';
		$upload->savePath  =     ''; // 设置附件上传（子）目录
		if(!is_dir($upload->rootPath))mkdir($upload->rootPath,0755,true);
		// 上传文件 
		$info   =   $upload->upload();
		if(!$info) {
				echo json_encode(array('error' => 1, 'message' => $upload->getError()));
				exit;
		}else{
				//$file_url=trim($upload->rootPath.$info["imgFile"]['savepath'].$info["imgFile"]['savename'],'.');
				$file_url="/Uploads/".$info["imgFile"]['savepath'].$info["imgFile"]['savename'];
				if(empty($page_type)){////edit图片上传
                    if(empty($uploadtype)){
                        echo json_encode(array('error' => 0, 'url' => $file_url,'message'=>$file_url,'id'=>'list_'.rand(0,9999)));
                    }else{
                        echo json_encode(array('success' => $file_url, 'url' => $file_url,'message'=>$file_url,'id'=>'list_'.rand(0,9999)));
                    }
                }else{
                    echo json_encode(array('error'=>0, 'url'=>$file_url));
                }

				exit;
		}
	}

	public function delete_file(){
        $url = trim($_REQUEST['url']);
        if(empty($url)){
            echo json_encode(array('error' => 1, 'msg' => '无效的路径'));
        }else{
            $file_url =__ROOT__.$url;
           if(unlink($file_url)){
               echo json_encode(array('success' => 0, 'msg' => '删除成功！'));
           }else{
               echo json_encode(array('error' => 1, 'msg' => '删除失败！'));
           }


        }
        exit();
    }
}