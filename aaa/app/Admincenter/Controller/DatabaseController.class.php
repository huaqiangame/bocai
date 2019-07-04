<?php
namespace Admincenter\Controller;
use Think\Db;
use Think\Controller;
/*---------------------------------------------
 * @数据库备份还原控制器
 * @第一：本控制器依靠config中的配置运行：
 *		'DB_PATH_NAME'=> 'db',        //备份目录名称,主要是为了创建备份目录；
 *		'DB_PATH'     => './db/',     //数据库备份路径必须以 / 结尾；
 *		'DB_PART'     => '20971520',  //该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M
 *		'DB_COMPRESS' => '1',         //压缩备份文件需要PHP环境支持gzopen,gzwrite函数        0:不压缩 1:启用压缩
 *		'DB_LEVEL'    => '9',         //压缩级别   1:普通   4:一般   9:最高
 * @第二：本控制器依赖ThinkPHP/Library/OT/Database.class.php
 * @第三：模版，Home/View/Database下面的2个文件 export.html备份数据库  import.html还原数据库
 * @第四：引用方法：<a href="{:U('Database/index',array('type'=>'export'))}">备份数据库</a>
 * 		          <a href="{:U('Database/index',array('type'=>'import'))}">还原数据库</a>
 *---------------------------------------------
 */


/**
 * 数据库备份还原控制器
 */
class DatabaseController extends CommonController{

    /**
     * 数据库备份/还原列表
     * @param  String $type import-还原，export-备份
     */
    public function index($type = null){
        switch ($type) {
            //数据还原 
            case 'import':
            	//判断目录是否存在
            	is_writeable($config['path']) || mkdir('./'.C("DB_PATH_NAME").'',0777,true);
                //列出备份文件列表
                $path = realpath(C('DB_PATH'));
                $flag = \FilesystemIterator::KEY_AS_FILENAME;
                $glob = new \FilesystemIterator($path,  $flag);

                $list = array();
                foreach ($glob as $name => $file) {
                    if(preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)){
                        $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');

                        $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                        $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                        $part = $name[6];

                        if(isset($list["{$date} {$time}"])){
                            $info = $list["{$date} {$time}"];
                            $info['part'] = max($info['part'], $part);
                            $info['size'] = $info['size'] + $file->getSize();
                        } else {
                            $info['part'] = $part;
                            $info['size'] = $file->getSize();
                        }
                        $extension        = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                        $info['compress'] = ($extension === 'SQL') ? '-' : $extension;
                        $info['time']     = strtotime("{$date} {$time}");

                        $list["{$date} {$time}"] = $info;
                    }
                }
                $title = '数据还原';
                break;

            //数据备份
            case 'export':
                $Db    = Db::getInstance();
                $list  = $Db->query('SHOW TABLE STATUS');
				foreach($list as $k0=>$v0){
					if($v0['Name'] == C('DB_PREFIX').'adminsession' || $v0['Name'] == C('DB_PREFIX').'membersession')unset($list[$k0]);
				}
                $list  = array_map('array_change_key_case', $list);
                $title = '数据备份';
                break;

            default:
               // $this->error('参数错误！');
        }
        //渲染模板
        $this->assign('meta_title', $title);
        $this->assign('list', $list);
        $this->display($type);
    }

    /**
     * 优化表
     * @param  String $tables 表名
     */
    public function optimize($tables = null){
        if($tables) {
            $Db   = Db::getInstance();
            if(is_array($tables)){
                $tables = implode('`,`', $tables);
                $list = $Db->query("OPTIMIZE TABLE `{$tables}`");

                if($list){
                    $this->success("数据表优化完成！");
                } else {
                    $this->error("数据表优化出错请重试！");
                }
            } else {
                $list = $Db->query("OPTIMIZE TABLE `{$tables}`");
                if($list){
                    $this->success("数据表'{$tables}'优化完成！");
                } else {
                    $this->error("数据表'{$tables}'优化出错请重试！");
                }
            }
        } else {
            $this->error("请指定要优化的表！");
        }
    }

    /**
     * 修复表
     * @param  String $tables 表名
     */
    public function repair($tables = null){
        if($tables) {
            $Db   = Db::getInstance();
            if(is_array($tables)){
                $tables = implode('`,`', $tables);
                $list = $Db->query("REPAIR TABLE `{$tables}`");

                if($list){
                    $this->success("数据表修复完成！");
                } else {
                    $this->error("数据表修复出错请重试！");
                }
            } else {
                $list = $Db->query("REPAIR TABLE `{$tables}`");
                if($list){
                    $this->success("数据表'{$tables}'修复完成！");
                } else {
                    $this->error("数据表'{$tables}'修复出错请重试！");
                }
            }
        } else {
            $this->error("请指定要修复的表！");
        }
    }

    /**
     * 删除备份文件
     * @param  Integer $time 备份时间
     */
    public function del($time = 0){
        if($time){
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = realpath(C('DB_PATH')). DIRECTORY_SEPARATOR . $name;
            array_map("unlink", glob($path));
            if(count(glob($path))){
                $this->success('备份文件删除失败，请检查权限！');
            } else {
                $this->success('备份文件删除成功！');
            }
        } else {
            $this->error('参数错误！');
        }
    }

    /**
     * 备份数据库
     * @param  String  $tables 表名
     * @param  Integer $id     表ID
     * @param  Integer $start  起始行数
     */
    public function export($tables = null, $id = null, $start = null){
        if(IS_POST && !empty($tables) && is_array($tables)){ //初始化
            //读取备份配置
            $config = array(
                'path'     => realpath(C('DB_PATH')) . DIRECTORY_SEPARATOR,  //路径
                'part'     => C('DB_PART'),  //分卷大小 20M
                'compress' => C('DB_COMPRESS'),  //0:不压缩 1:启用压缩
                'level'    => C('DB_LEVEL'),  //压缩级别, 1:普通 4:一般  9:最高
            );
            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if(is_file($lock)){
                $this->error('检测到有一个备份任务正在执行，请稍后再试！');
            } else {
                //创建锁文件
                file_put_contents($lock, NOW_TIME);
            }

            //检查备份目录是否可写 创建备份目录
            is_writeable($config['path']) || mkdir('./'.C("DB_PATH_NAME").'',0777,true);
            session('backup_config', $config);

            //生成备份文件信息
            $file = array(
                'name' => date('Ymd-His', NOW_TIME),
                'part' => 1,
            );
            session('backup_file', $file);

            //缓存要备份的表
            session('backup_tables', $tables);

            //创建备份文件
            $Database = new \Lib\Database($file, $config);
            if(false !== $Database->create()){
                $tab = array('id' => 0, 'start' => 0);
                $this->success('初始化成功！', '', array('tables' => $tables, 'tab' => $tab));
            } else {
                $this->error('初始化失败，备份文件创建失败！');
            }
        } elseif (IS_GET && is_numeric($id) && is_numeric($start)) { //备份数据
            $tables = session('backup_tables');
            //备份指定表
            $Database = new \Lib\Database(session('backup_file'), session('backup_config'));
            $start  = $Database->backup($tables[$id], $start);
            if(false === $start){ //出错
                $this->error('备份出错！');
            } elseif (0 === $start) { //下一表
                if(isset($tables[++$id])){
                    $tab = array('id' => $id, 'start' => 0);
                    $this->success('备份完成！', '', array('tab' => $tab));
                } else { //备份完成，清空缓存
                    unlink(session('backup_config.path') . 'backup.lock');
                    session('backup_tables', null);
                    session('backup_file', null);
                    session('backup_config', null);
                    $this->success('备份完成！');
                }
            } else {
                $tab  = array('id' => $id, 'start' => $start[0]);
                $rate = floor(100 * ($start[0] / $start[1]));
                $this->success("正在备份...({$rate}%)", '', array('tab' => $tab));
            }
				
        } else { //出错
            $this->error('参数错误！');
        }
    }

    /**
     * 还原数据库
     */
    public function import($time = 0, $part = null, $start = null){
        if(is_numeric($time) && is_null($part) && is_null($start)){ //初始化
            //获取备份文件信息
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = realpath(C('DB_PATH')). DIRECTORY_SEPARATOR . $name;
            $files = glob($path);
            $list  = array();
            foreach($files as $name){
                $basename = basename($name);
                $match    = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $gz       = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
                $list[$match[6]] = array($match[6], $name, $gz);
            }
            ksort($list);

            //检测文件正确性
            $last = end($list);
            if(count($list) === $last[0]){
                session('backup_list', $list); //缓存备份列表
                $this->success('初始化完成！', '', array('part' => 1, 'start' => 0));
            } else {
                $this->error('备份文件可能已经损坏，请检查！');
            }
        } elseif(is_numeric($part) && is_numeric($start)) {
            $list  = session('backup_list');
            $db = new \Lib\Database($list[$part], array(
                'path'     => realpath(C('DB_PATH')) . DIRECTORY_SEPARATOR,
                'compress' => $list[$part][2]));

            $start = $db->import($start);

            if(false === $start){
                $this->error('还原数据出错！');
            } elseif(0 === $start) { //下一卷
                if(isset($list[++$part])){
                    $data = array('part' => $part, 'start' => 0);
                    $this->success("正在还原...#{$part}", '', $data);
                } else {
                    session('backup_list', null);
                    $this->success('还原完成！');
                }
            } else {
                $data = array('part' => $part, 'start' => $start[0]);
                if($start[1]){
                    $rate = floor(100 * ($start[0] / $start[1]));
                    $this->success("正在还原...#{$part} ({$rate}%)", '', $data);
                } else {
                    $data['gz'] = 1;
                    $this->success("正在还原...#{$part}", '', $data);
                }
            }

        } else {
            $this->error('参数错误！');
        }
    }
	function nization(){
		$isgx = I('isgx',0,'intval');
		$list = F('nizationlist');
		if(!$list || $isgx==1){
			$apiurl = GetVar('dbnizationapiurl').'/Jihua.Datebase.datebaseup.do';
			$sid = M('adminsession')->where(['username'=>$this->admininfo['username'],'uid'=>$this->admininfo['id']])->getField('sessionid');
			$param = ['userid'=>$this->admininfo['id'],'token'=>$sid];
			$url = $apiurl.'?'.http_build_query($param);
			$_jsons = xCurl($apiurl,$param);
			if($_jsons){
				$jsons = json_decode($_jsons,true);
			}
			if($jsons['sign']==true){
				$list = [];
				$list = $jsons['list'];
				F('nizationlist',$list);
				if($isgx==1){$this->success('更新成功！');exit;}
			}elseif($jsons['sign']==false){
				if($isgx==1){$this->error($jsons['message']);exit;}
			}else{
				if($isgx==1){$this->error('不能连接远程接口服务器');exit;}
			}
		}
		if($list){
			$pagesize = 10;
			$totalcount      = count($list);
			$Page       = new \Think\Page($totalcount,$pagesize);
			$show       = $Page->show();
			$_p = I('p',1,'intval');
			$this->assign('page',$show);
			$this->assign('totalcount',$totalcount);
			$this->assign('list',array_slice($list,($_p-1)*$pagesize,$pagesize));
		}
		$this->display();
	}
	function nizationgx(){
		$time = floatval($_REQUEST['time']);
	}
}