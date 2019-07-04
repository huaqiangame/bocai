<?php
namespace Common\TagLib;
use Think\Template\TagLib;
/**
 * Form标签库解析类
 */
class soft extends TagLib {

    // 标签定义
    protected $tags =  array(
        'list'      => array('attr'=>'table,limit,page,totalpage,field,where,order,key,id,empty,cache','close'=>1),
        'acticlelist'=> array('attr'=>'limit,catid,page,totalpage,nowpage,field,where,order,key,id,empty,cache','close'=>1),
    );
	function _acticlelist($tag,$content){
		$catid      = $tag['catid']; 
		$limit      = intval($tag['limit'])?intval($tag['limit']):10;
		$key        = !empty($tag['key'])?$tag['key']:'key';
		$id         = !empty($tag['id'])?$tag['id']:'vo';
		$empty      = !empty($tag['empty'])?$tag['empty']:'无数据';
		$field      = !empty($tag['field'])?$tag['field']:'*';
		$where      = !empty($tag['where'])?$tag['where']:'';
		$order      = $tag['order'];
		$cache      = (isset($tag['cache']) && $tag['cache'])?true:false;
		$cachet     = intval($tag['cachet'])>0?intval($tag['cachet']):3600;
		$page       = $tag['page'];
		$totalpage  = intval($tag['totalpage'])?intval($tag['totalpage']):50;
		//$nowpage  = intval($tag['nowpage'])?intval($tag['nowpage']):0;
		
		$parseStr .= '<?php if('.$catid.'){ ?>';
		$parseStr .= '<?php $map_category["catid"] = array("eq",'.$catid.');$map_category["catetype"] = array("eq",1);$map_category["model"] = array("neq","");$model = M("category")->where($map_category)->getField("model");$db = M($model); ?>';
		
		$parseStr .= '<?php if("'.$page.'"){ ?>';
			$parseStr .= '<?php $nowpage = isset($nowpage)?intval($nowpage):intval($_GET["p"]); ?>';
			$parseStr .= '<?php $_LIST = $db->where("'.$where.' and catid = '.$catid.'")->order("'.$order.'")->page("$nowpage,'.$limit.'")->field("'.$field.'")->select(); ?>';
			$parseStr .= '<?php $count = $db->where("'.$where.' and catid = '.$catid.'")->count(); ?>';
			$parseStr .= '<?php $count = $count>"'.$totalpage.'"*"'.$limit.'"?"'.$totalpage.'"*"'.$limit.'":$count; ?>';
			$parseStr .= '<?php $Page       = new \Think\Page($count,"'.$limit.'"); ?>';
			$parseStr .= '<?php $pageshow   = $Page->show(); ?>';

		$parseStr .= '<?php }else{ ?>';
			$parseStr .= '<?php $_LIST = $db->limit("'.$limit.'")->where("'.$where.' and catid = '.$catid.'")->cache(true,'.$cachet.')->order("'.$order.'")->field("'.$field.'")->select(); ?>';
		$parseStr .= '<?php } ?>';
		
		$parseStr .= '<?php $__LIST__ = array("list"=>$_LIST,"page"=>$pageshow); ?>';
		$parseStr .= '<?php } ?>';
		
		
		
		$parseStr .= '<?php $pageshow = $__LIST__[page]; ?>';
		
        $parseStr .= '<?php if( count($__LIST__["list"])==0 ) { echo "'.$empty.'" ;} ?>';
        $parseStr .= '<?php else{ ?>';
        $parseStr .= '<?php foreach($__LIST__["list"] as $'.$key.'=>$'.$id.'){ ?>';
        $parseStr .= '<?php ++$'.$key.';?>';
		$parseStr .= '<?php foreach($'.$id.' as $'.$key.'_vo=>$'.$id.'_vo){ ?>';
        $parseStr .= '<?php $'.$id.'_vo = $'.$id.'_vo?unserialize($'.$id.'_vo):""; ?>';
			$parseStr .= '<?php if($'.$id.'_vo){ ?>';
			$parseStr .= '<?php $'.$id.'[$'.$key.'_vo]= $'.$id.'_vo;sort($'.$id.'[$'.$key.'_vo]); ?>';
			$parseStr .= '<?php if(count($'.$id.'[$'.$key.'_vo])==1) $'.$id.'[$'.$key.'_vo] = current($'.$id.'[$'.$key.'_vo]);?>';
			$parseStr .= '<?php }; ?>';
        $parseStr .= '<?php }; ?>';
        $parseStr .= $this->tpl->parse($content);
        $parseStr .= '<?php };}; ?>';

        if(!empty($parseStr)) {
            return $parseStr;
        }
        return $parseStr;
	}
    public function _list($tag,$content) {
//		$Get_Lists = Get_Lists($tag);
//		dump($Get_Lists);
		$table      = $tag['table']; 
		$limit      = $tag['limit'];
		$key        = !empty($tag['key'])?$tag['key']:'key';
		$id         = !empty($tag['id'])?$tag['id']:'vo';
		$empty      = !empty($tag['empty'])?$tag['empty']:'无数据';
		$field      = !empty($tag['field'])?$tag['field']:'*';
		$where      = !empty($tag['where'])?$tag['where']:'';
		$order      = $tag['order'];
		$cache      = (isset($tag['cache']) && $tag['cache'])?true:false;
		$cachet     = intval($tag['cachet'])>0?intval($tag['cachet']):3600;
		
		
        if($cache){
			$parseStr .= '<?php $__LIST__ = M("'.$table.'")->where("'.$where.'")->order("'.$order.'")->limit("'.$limit.'")->field("'.$field.'")->cache(true,'.$cachet.')->select(); ?>';
		}else{
			$parseStr .= '<?php $__LIST__ = M("'.$table.'")->where("'.$where.'")->order("'.$order.'")->limit("'.$limit.'")->field("'.$field.'")->select(); ?>';
		}
        $parseStr .= '<?php if( count($__LIST__)==0 ) { echo "'.$empty.'" ;} ?>';
        $parseStr .= '<?php else{ ?>';
        $parseStr .= '<?php foreach($__LIST__ as $'.$key.'=>$'.$id.'){ ?>';
        $parseStr .= '<?php ++$'.$key.';?>';
		$parseStr .= '<?php foreach($'.$id.' as $'.$key.'_vo=>$'.$id.'_vo){ ?>';
        $parseStr .= '<?php $'.$id.'_vo = $'.$id.'_vo?unserialize($'.$id.'_vo):""; ?>';
			$parseStr .= '<?php if($'.$id.'_vo){ ?>';
			$parseStr .= '<?php $'.$id.'[$'.$key.'_vo]= $'.$id.'_vo;sort($'.$id.'[$'.$key.'_vo]); ?>';
			$parseStr .= '<?php if(count($'.$id.'[$'.$key.'_vo])==1) $'.$id.'[$'.$key.'_vo] = current($'.$id.'[$'.$key.'_vo]);?>';
			$parseStr .= '<?php }; ?>';
        $parseStr .= '<?php }; ?>';
        $parseStr .= $this->tpl->parse($content);
        $parseStr .= '<?php };}; ?>';
        return $parseStr;
    }
}
