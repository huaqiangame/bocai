<?php
namespace Lib;
/**
 * Form标签库解析类
 */
class Form{
	static function input($tag,$value){
        $name       = $tag['name']; 
        $value      = $value!=''?$value:$tag['defaultvalue'];
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $type       = !empty($tag['type'])?$tag['type']:'text';
        $placeholder= !empty($tag['placeholder'])?$tag['placeholder']:'';
		$parseStr   = '<input type="'.$type.'" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
        return $parseStr;
	}
	
	static function keywords($tag,$value){
        $name       = $tag['name']; 
        $value      = $value!=''?$value:$tag['defaultvalue'];
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $type       = !empty($tag['type'])?$tag['type']:'text';
        $placeholder= !empty($tag['placeholder'])?$tag['placeholder']:'';
		$parseStr   = '<input type="'.$type.'" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
        return $parseStr;
	}
	static function password($tag,$value){
        $name       = $tag['name']; 
        $value      = $value!=''?$value:$tag['defaultvalue'];
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $type       = !empty($tag['type'])?$tag['type']:'text';
        $placeholder       = !empty($tag['placeholder'])?$tag['placeholder']:'';
		$setting    =   $tag['setting'];
		$mitype     = $setting['mitype'];
		//$parseStr   = '<input type="password" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
		$parseStr   = '<input type="password" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
        return $parseStr;
	}
	static function number($tag,$value){
        $name       = $tag['name']; 
        $value      = $value!=''?$value:$tag['defaultvalue'];
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $placeholder       = !empty($tag['placeholder'])?$tag['placeholder']:'';
		$parseStr   = '<input type="number" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
        return $parseStr;
	}
	function textarea($tag,$value){
        $name       = $tag['name']; 
        $value      = $value!=''?$value:$tag['defaultvalue'];
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $cols       = !empty($tag['cols'])?$tag['cols']:'';
        $rows       = !empty($tag['rows'])?$tag['rows']:'';
        $placeholder= !empty($tag['placeholder'])?$tag['placeholder']:'';
		$parseStr   = '<textarea id="'.$id.'"  name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">'.$value.'</textarea>';
        return $parseStr;
	}
	static function downfile($tag,$value){
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $name   	=	$tag['name'];
        $value      =   $value!=''?$value:$tag['defaultvalue'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $setting    =   $tag['setting'];
		$parseStr   = '<input type="file" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
        return $parseStr;
	}
	function linkage($tag,$value){
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $name   	=	$tag['name'];
        $value      =   $value!=''?$value:$tag['defaultvalue'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $setting    =   $tag['setting'];
		$keyid      = $setting['keyid'];
		$topid      = $setting['topid']?$setting['topid']:$keyid;
		
		
		$values = !empty($value)?unserialize($value):0;
		$poslinkagestr = $savelinkage = '';
		if(is_array($values)){
			$slist = M('linkage')->where(array('linkageid'=>array('in',$values)))->select();
			foreach($slist as $k=>$v){
				$poslinkage[] = $v['name'];
				$savelinkageids[] = $v['linkageid'];
			}
			$poslinkagestr = implode(' > ',$poslinkage);
		}
		
		$linkageurl = U('GetLinkage/get_linkage');
		$firstlist  = get_linkage($keyid,$topid);
		$firstoption = '';
		foreach($firstlist as $k=>$v){
			$selected = '';
			if(is_array($values) && in_array($v['linkageid'],$savelinkageids)){
				unset($savelinkageids[array_search($v['linkageid'],$savelinkageids)]);
				$selected = ' selected ';
			}
			$firstoption .= '<OPTION value="'.$v['linkageid'].'" '.$selected.'>'.$v['name'].'</OPTION>';
		}
		if(is_array($values))foreach($savelinkageids as $k=>$v){
			$sublist = array();
			$db = M('linkage');
			$parentid = $db->where(array('keyid'=>array('eq',$keyid),'linkageid'=>array('eq',$v)))->getField('parentid');
			$sublist = M('linkage')->where(array('keyid'=>array('eq',$keyid),'parentid'=>array('eq',$parentid)))->select();
			//dump($sublist);exit;
			if($sublist){
				$subselectstr .= '<SELECT ID="'.$id.'_'.rand(1000,9999).'" NAME="'.$name.'[]" class="'.$class.'" style="display:inline; width:auto;'.$style.'" onchange="'.$id.'_ajax_select('.$keyid.',this.value);$(this).nextAll().remove();">';
				$subselectstr .= '<OPTION value="">请选择</OPTION>';
				foreach($sublist as $vo){
					$selected = '';
					if(in_array($vo['linkageid'],$savelinkageids)){
						$selected = ' selected ';
					}
					$subselectstr .= '<OPTION value="'.$vo['linkageid'].'" '.$selected.'>'.$vo['name'].'</OPTION>';
				}
				$subselectstr .= '</SELECT>';
				
			}
			//dump($sublist);
		}
		//dump($savelinkageids);exit;
$parseStr = <<<Linkage
        <script type="text/javascript">
        if (typeof jQuery != 'function'){
        
        document.write('<scr'+'ipt src="/public/ui/lib/jquery/jquery.js"></sc'+'ript>');
        }
        </script>
        <div id="view_{$id}" style="display:inline">
        
        <SELECT ID="{$id}_s1" NAME="{$name}[]" class="{$class}" style="display:inline; width:auto;{$style}" onchange="{$id}_ajax_select({$keyid},this.value);$(this).nextAll().remove();">
            <OPTION value="">请选择</OPTION>
            {$firstoption}
        </SELECT>{$subselectstr}
        </div><!--{$poslinkagestr}-->
        <script>
       function {$id}_ajax_select(keyid,topid){
		   if(topid=='')return false;
		   $("#{$id}_value").val(topid);
			$.getJSON("{$linkageurl}",{'keyid':keyid,'topid':topid}, function(json){
				var ids = parseInt(Math.random() * 10000);
				 var OPT = '';
				 OPT += '<SELECT ID="{$id}_'+ids+'" NAME="{$name}[]" class="{$class}" style="display:inline; width:auto;{$style}" onchange="{$id}_ajax_select({$keyid},this.value);$(this).nextAll().remove();">';
				 OPT += '<OPTION value="">请选择</OPTION>';
				 for(var o in json){ 
					 OPT += '<OPTION value="'+json[o]['topid']+'">'+json[o]['name']+'</OPTION>';
				 }
				 OPT += "</SELECT>\\n";
				 $("#view_{$id}").append(OPT);
			}); 
	   }
        </script>
Linkage;
        return $parseStr;
	}
	static function downfiles($tag,$value){
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $name   	=	$tag['name'];
        $value      =   $value!=''?$value:$tag['defaultvalue'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $setting    =   $tag['setting'];
		//$upload_allowext = str_replace('|','_',$setting['upload_allowext']);
		$upload_allowext = $setting['upload_allowext'];
		$upload_size     = $setting['upload_size'];
		$upload_number   = $setting['upload_number'];
		$downloadtype    = $setting['downloadtype'];
		
		$URL_PREFIX =  is_ssl()?'https://':'http://';
		$uploadJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/upload',array('allowext'=>$upload_allowext,'size'=>$upload_size));
		$fileManagerJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/file_manager');
		$delurl = U('Uploads/deletefile');
		$values = unserialize($value);
		//dump($value);exit;
		$line = '';
		if($values)foreach($values as $k=>$v){
			if($v['filetype']=='c'){

				$str0 = '';
				$str0 .= "<script>";
				$str0 .= 'KindEditor.ready(function(K) {';
				$str0 .= 'var uploadbutton = K.uploadbutton({';
				$str0 .= "button : K(\"#{$id}btn{$k}\")[0],";
				$str0 .= 'fieldName : "imgFile",';
				$str0 .= "url : '{$uploadJson}',";
				$str0 .= 'afterUpload : function(data) {';
				$str0 .= 'if (data.error === 0) {';
				$str0 .= 'var url = K.formatUrl(data.url, "absolute");';
				$str0 .= "var file1 = K(\"#{$id}{$k}\").val();";
				$str0 .= "if(file1){deletefile_{$id}(file1);}";
				$str0 .= "K(\"#{$id}{$k}\").val(url);";
				$str0 .= '} else {';
				$str0 .= 'alert(data.message);';
				$str0 .= '}';
				$str0 .= '},';
				$str0 .= 'afterError : function(str) {';
				$str0 .= 'alert("自定义错误信息: " + str);';
				$str0 .= '}';
				$str0 .= '});';
				$str0 .= 'uploadbutton.fileBox.change(function(e) {';
				$str0 .= 'uploadbutton.submit();';
				$str0 .= '});});';
				$str0 .= '</script>';

				$line .= '<tr id="multifile'.$k.'"><td><input type="hidden" value="c" name="'.$id.'['.$k.'][filetype]"><input type="text" class="'.$class.'" name="'.$id.'['.$k.'][fileurl]" id="'.$id.''.$k.'" placeholder="本地文件" value="'.$v['fileurl'].'"><input type="button" id="'.$id.'btn'.$k.'" value="Upload" />'.$str0.'</td><td><input type="text" name="'.$id.'['.$k.'][filename]" value="'.$v['filename'].'" placeholder="附件说明" class="'.$class.'"></td><td width="50"><button onclick="remove_div_'.$id.'(\'multifile'.$k.'\',\''.$id.''.$k.'\')" type="button" class="button">移除</button></td></tr>';
			}else if($v['filetype']=='y'){
				$line .= '<tr id="multifile'.$k.'"><td><input type="hidden" value="y" name="'.$id.'['.$k.'][filetype]"><input type="text" class="'.$class.'" name="'.$id.'['.$k.'][fileurl]" placeholder="远程地址" value="'.$v['fileurl'].'"></td><td><input type="text" name="'.$id.'['.$k.'][filename]" value="'.$v['filename'].'" placeholder="附件说明" class="'.$class.'"></td><td width="50"><button onclick="remove_div_'.$id.'(\'multifile'.$k.'\')" type="button" class="button">移除</button></td></tr>';
			}
		}
$parseStr = <<<DOWNFILES
<style type="text/css">
fieldset.FieldList{border:1px solid #dce3ed;padding: 10px;}
fieldset.FieldList > legend{padding:0px; margin:0;display:block; width:auto; font-size:12px; font-weight:700; border:none; border-style:none; color:#347add; padding:3px 8px;}
fieldset.FieldList > .FileList{padding:0; margin:0;}
fieldset.FieldList .button{border-width:0 1px 1px 0;line-height:24px;background:#ddd;}
fieldset.FieldList > .FileList td{padding:5px;}
fieldset.FieldList > .FileList td input{width: auto; display: inline;}
</style>
<script type="text/javascript">
if (typeof KindEditor=='undefined'){
document.write('<link rel="stylesheet" href="/public/ui/lib/KindEditor/themes/default/default.css" />');
document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/kindeditor-min.js"></sc'+'ript>');
}
</script>
<fieldset class="FieldList">
<legend>文件列表</legend>
<table class="FileList table table-border table-bg" id="{$id}">{$line}</table>
<script>
KindEditor.ready(function(K) {});
</script>



<div style="width:100%;height:10px;"></div>
<input class="button" type="button" onclick="add_multifile_y_{$id}('{$id}')" value="添加远程">
<input class="button" type="button" onclick="add_multifile_c_{$id}('{$id}')" value="添加本地">
</fieldset>
<script>
function remove_div_{$id}(id,putid) {
	var file = $('#'+putid).val();
	if(putid && file){
		deletefile_{$id}(file);
	}
$('#'+id).remove();
}
function deletefile_{$id}(file){
	$.getJSON("{$delurl}",{file,file}, function(json){
		if(json.status==1){
			
		}
	}); 
}
function add_multifile_c_{$id}(returnid) {
var uploadnum = "{$upload_number}";
var hasnum    = $('#'+returnid).find("tr").length;
if(hasnum>=uploadnum){
	alert('允许上传数量为：'+uploadnum);
	return false;
}
var ids = parseInt(Math.random() * 10000); 

var str0 = '';
str0 += "<scr"+"ipt>";
str0 += 'KindEditor.ready(function(K) {';
str0 += 'var uploadbutton = K.uploadbutton({';
str0 += 'button : K("#'+returnid+"btn"+ids+'")[0],';
str0 += 'fieldName : "imgFile",';
str0 += "url : '{$uploadJson}',";
str0 += 'afterUpload : function(data) {';
str0 += 'if (data.error === 0) {';

str0 += 'var url = K.formatUrl(data.url, "absolute");';
str0 += 'var file1 = K("#'+returnid+ids+'").val();';
str0 += 'if(file1){deletefile_'+returnid+'(file1);}';
str0 += 'K("#'+returnid+ids+'").val(url);';
str0 += '} else {';
str0 += 'alert(data.message);';
str0 += '}';
str0 += '},';
str0 += 'afterError : function(str) {';
str0 += 'alert("自定义错误信息: " + str);';
str0 += '}';
str0 += '});';
str0 += 'uploadbutton.fileBox.change(function(e) {';
str0 += 'uploadbutton.submit();';
str0 += '});});';
str0 += '</scr'+'ipt>';

var str = "<tr id='multifile"+ids+"'><td><input type='hidden' name='"+returnid+"["+ids+"][filetype]' value='c'><input type='text' placeholder='本地文件' id='"+returnid+ids+"' name='"+returnid+"["+ids+"][fileurl]' class='{$class}'><input type='button' id='"+returnid+"btn"+ids+"' value='Upload' />"+str0+"</td><td><input class='{$class}' type='text' placeholder='附件说明' value='附件说明' name='"+returnid+"["+ids+"][filename]'></td><td width='50'><button class='button' type='button' onClick=\"remove_div_"+returnid+"('multifile"+ids+"','"+returnid+ids+"')\">移除</button></td></tr>";	
$('#'+returnid).append(str);
}
function add_multifile_y_{$id}(returnid) {
var uploadnum = "{$upload_number}";
var hasnum    = $('#'+returnid).find("tr").length;
if(hasnum>=uploadnum){
	alert('允许上传数量为：'+uploadnum);
	return false;
}
var ids = parseInt(Math.random() * 10000); 
var str = "<tr id='multifile"+ids+"'><td><input type='hidden' name='"+returnid+"["+ids+"][filetype]' value='y'><input type='text' placeholder='远程地址' name='"+returnid+"["+ids+"][fileurl]' class='{$class}'></td><td><input class='{$class}' type='text' placeholder='附件说明' value='附件说明' name='"+returnid+"["+ids+"][filename]'></td><td width='50'><button class='button' type='button' onClick=\"remove_div_"+returnid+"('multifile"+ids+"')\">移除</button></td></tr>";	
$('#'+returnid).append(str);
}

</script>

DOWNFILES;
        return $parseStr;
	}
	static function map($tag,$value){
        $id			=	!empty($tag['id'])?$tag['id']: '_editor';
        $name   	=	$tag['name'];
        $value      =   $value!=''?$value:$tag['defaultvalue'];
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $width		=	!empty($tag['width'])?$tag['width']: '100%';
        $height     =	!empty($tag['height'])?$tag['height'] :'320px';
		$URL_PREFIX =  is_ssl()?'https://':'http://';
		$uploadJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/upload');
		$fileManagerJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/file_manager');
$parseStr = <<<MAP
        <script type="text/javascript">
        if (typeof KindEditor=='undefined'){
        
        document.write('<link rel="stylesheet" href="/public/ui/lib/KindEditor/themes/default/default.css" />');
        document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/kindeditor-min.js"></sc'+'ript>');
        document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/lang/zh_CN.js"></sc'+'ript>');
        }
        </script>
        <textarea id="{$id}" style="{$style}" name="{$name}" >{$value}</textarea>
        <script>
        var editor;
        KindEditor.ready(function(K) {
        editor = K.create("#{$id}", {
        width : "{$width}",
        height : "{$height}",
        uploadJson: "{$uploadJson}",
        fileManagerJson : "{$fileManagerJson}",
        items : [ 'baidumap' ]
        });
        });
        </script>
MAP;
        return $parseStr;
	}
	static function datetime($tag,$value){
        $name       = $tag['name'];
        $value      =   $value!=''?date('Y-m-d H:i:s',$value):$tag['defaultvalue'];
        $id         = isset($tag['id'])?$tag['id']:$name;
        $style      = $tag['style']!=''?$tag['style']:'';
        $class      = $tag['class']!=''?$tag['class']:'form-control'; 
        $type       = isset($tag['type'])?$tag['type']:'text';
        $placeholder= !empty($tag['placeholder'])?$tag['placeholder']:'';
        $setting    =   $tag[setting];
        $format     = isset($setting['format'])?$setting['format']:'yyyy-MM-dd';//format="yyyy-MM-dd HH:mm:ss"
$parseStr .= <<<DATETIME
        <script type="text/javascript">
        document.write('<scr'+'ipt src="/public/ui/lib/My97DatePicker/WdatePicker.js"></sc'+'ript>');
        </script>
        <input type="{$type}" style="{$style}" id="{$id}" class="{$class}" name="{$name}" onClick="WdatePicker({dateFmt:'{$format}'})" value="{$value}" placeholder="{$placeholder}" />
DATETIME;
        return $parseStr;
	}
	static function editor($tag,$value){
        $id			=	!empty($tag['id'])?(is_numeric($tag['id'])?'editer_'.$tag['id']:$tag['id']): '_editor';
        $name   	=	$tag['name'];
        $value      =   $value!=''?$value:$tag['defaultvalue'];
        $style   	=	$tag['style']!=''?$tag['style']:'';
        $width		=	!empty($tag['width'])?$tag['width']: '100%';
        $height     =	!empty($tag['height'])?$tag['height'] :'80px';
        $setting    =   $tag[setting];
		$toolbar    =   $setting[toolbar];
        $toolbar    =	!empty($setting[toolbar])?$setting[toolbar] :'full';
        if($toolbar=='full'){
        	$setting['items']="'source','|','undo','redo','|','preview','print','template','code','cut','copy','paste','plainpaste','wordpaste','|','justifyleft','justifycenter','justifyright','justifyfull','insertorderedlist','insertunorderedlist','indent','outdent','subscript','superscript','clearhtml','quickformat','selectall','|','fullscreen','/','formatblock','fontname','fontsize','|','forecolor','hilitecolor','bold','italic','underline','strikethrough','lineheight','removeformat','|','image','multiimage','flash','media','insertfile','table','hr','emoticons','baidumap','pagebreak','anchor','link','unlink'";
        }
        $items      =   $setting['items']!=''?$setting['items'] :"'fontname','fontsize','|','forecolor','hilitecolor','bold','italic','underline','removeformat','|','justifyleft','justifycenter','justifyright','insertorderedlist','insertunorderedlist','|','emoticons','image','link'";
		$URL_PREFIX =  is_ssl()?'https://':'http://';
		$uploadJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/upload',array('allowpath'=>'1','allowext'=>'gif|jpg|jpeg|png|bmp'));
		$fileManagerJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/file_manager');
		
		$parseStr = '';
$parseStr .= <<<HTMLS
		<script type="text/javascript">
		if (typeof KindEditor=='undefined'){
		document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/kindeditor-min.js"></sc'+'ript>');
		}
		</script>
		<textarea id="{$id}" style="{$style}" name="{$name}" >{$value}</textarea>
		<script>
		var editor;
		KindEditor.ready(function(K) {
		/*var lang = K.lang({
		multiimage: "批量上传"
		});*/
		editor = K.create("#{$id}", {
		allowFileManager : false,
		pagebreakHtml : '[page]',
		imageSizeLimit:"{$FileSize}",
		imageUploadLimit:"{$FileLimit}",
		pluginsPath:"/public/ui/lib/KindEditor/plugins/",
		width : "{$width}",
		height : "{$height}",
		uploadJson: "{$uploadJson}",
		fileManagerJson : "{$fileManagerJson}",
		items : [ {$items} ]
		});
		});
		</script>
HTMLS;
        return $parseStr;
	}
	static function color($tag,$value){
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $name   	=	$tag['name'];
        $value      =   $value!=''?$value:$tag['defaultvalue'];
        $class      = $tag['class']!=''?$tag['class']:'form-control';
        $style      = $tag['style']!=''?$tag['style']:'';
        $type       = isset($tag['type'])?$tag['type']:'text';
        $placeholder= !empty($tag['placeholder'])?$tag['placeholder']:'';
$parseStr = <<<COLOR
        <script type="text/javascript">
        if (typeof KindEditor=='undefined'){
        document.write('<link rel="stylesheet" href="/public/ui/lib/KindEditor/themes/default/default.css" />');
        document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/kindeditor-min.js"></sc'+'ript>');
        }
        </script>
        <script>
        KindEditor.ready(function(K) {
        var colorpicker;
        K("#{$id}").bind('click', function(e) {
        e.stopPropagation();
        if (colorpicker) {
        colorpicker.remove();
        colorpicker = null;
        return;
        }
        var colorpickerPos = K("#{$id}").pos();
        colorpicker = K.colorpicker({
        x : colorpickerPos.x,
        y : colorpickerPos.y + K("#{$id}").height(),
        z : 19811214,
        selectedColor : 'default',
        noColor : '无颜色',
        click : function(color) {
        K("#{$id}").css('color',color).val(color);
        colorpicker.remove();
        colorpicker = null;
        }
        });
        });
        K(document).click(function() {
        if (colorpicker) {
        colorpicker.remove();
        colorpicker = null;
        }
        });
        });
        </script>
COLOR;
        	$parseStr .= '<input class="'.$class.'" type="'.$type.'" id="'.$id.'" style="'.$style.' color:'.$value.';" placeholder="'.$placeholder.'"  name="'.$name.'" value="'.$value.'" onclick="'.$click.'" />';
        return $parseStr;
	}
	static function select($tag,$value){
        $name       = $tag['name']; 
        $value      = $value!=''?$value:$tag['defaultvalue'];
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $class      = $tag['class']!=''?$tag['class']:'form-control';
        $style      = $tag['style']!=''?$tag['style']:'';
		$setting = $tag[setting];
		$options = array_filter(explode(PHP_EOL,$setting[options]));
		foreach($options as $k=>$v){
			$_opts = array();
			$_opts = explode('|',$v);
			$_opts['selected'] = ' ';
			if($value==$_opts[1]){
				$_opts['selected'] = ' selected';
			}
			$options[$k] = $_opts;
		}
		$parseStr = '';
		$parseStr .= '<select id="'.$id.'"  name="'.$name.'" class="'.$class.'">';
		foreach($options as $k=>$v){
			$parseStr .= '<option value="'.$v[1].'" ' .$v[selected].'>'.$v[0].'</option>';
		}
		$parseStr .= '</select>';
        return $parseStr;
	}
	static function checkbox($tag,$value){
        $name       = $tag['name']; 
        $value      = $value!=''?$value:$tag['defaultvalue'];
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $class      = $tag['class']!=''?$tag['class']:'';
        $style      = $tag['style']!=''?$tag['style']:'';
		$setting = $tag[setting];
		$options = array_filter(explode(PHP_EOL,$setting[options]));
		foreach($options as $k=>$v){
			$_opts = array();
			$_opts = explode('|',$v);
			$_opts['checked'] = ' ';
			if($value==$_opts[1]){
				$_opts['checked'] = ' checked';
			}
			$options[$k] = $_opts;
		}
		$parseStr = '';
		foreach($options as $k=>$v){
			$parseStr .= '<label><input name="'.$name.'" type="checkbox" value="'.$v[1].'" class="'.$class.'" ' .$v[checked].' />'.$v[0]."&nbsp;</label>\n";
		}
        return $parseStr;
	}
	static function radio($tag,$value){
        $name       = $tag['name']; 
        $value      = $value!=''?$value:$tag['defaultvalue'];
        $id         = !is_numeric($tag['id'])?$tag['id']: $tag['name'];
        $class      = $tag['class']!=''?$tag['class']:'';
        $style      = $tag['style']!=''?$tag['style']:'';
		$setting = $tag[setting];
		$options = array_filter(explode(PHP_EOL,$setting[options]));
		foreach($options as $k=>$v){
			$_opts = array();
			$_opts = explode('|',$v);
			$_opts['checked'] = ' ';
			if($value==$_opts[1]){
				$_opts['checked'] = ' checked';
			}
			$options[$k] = $_opts;
		}
		$parseStr = '';
		foreach($options as $k=>$v){
			$parseStr .= '<label><input name="'.$name.'" type="radio" value="'.$v[1].'" class="'.$class.'" ' .$v[checked].' />'.$v[0]."&nbsp;</label>\n";
		}
        return $parseStr;
	}

}
