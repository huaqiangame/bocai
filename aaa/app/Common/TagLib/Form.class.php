<?php
namespace Common\TagLib;
use Think\Template\TagLib;
/**
 * Form标签库解析类
 */
class Form extends TagLib {

    // 标签定义
    protected $tags =  array(
		'input'     => array('attr'=>'id,name,value,style,class,type,placeholder','close'=>0),
		'password'  => array('attr'=>'id,name,value,style,class,type,placeholder','close'=>0),
		'number'    => array('attr'=>'id,name,value,style,class,type,placeholder','close'=>0),
		'textarea'  => array('attr'=>'id,name,value,style,placeholder,class,cols,rows','close'=>0),
        'image'     => array('attr'=>'id,name,value,allowext,size,allowpath,style,class','close'=>0),
        'images'    => array('attr'=>'id,name,value,class','close'=>0),
        'downfile'  => array('attr'=>'id,name,value,class','close'=>0),
        'downfiles' => array('attr'=>'id,name,value,class','close'=>0),
        'map'       => array('attr'=>'id,name,style,width,height,type,value','close'=>0),
        'datetime'  => array('attr'=>'id,name,value,class,format','close'=>0),
		'editor'    => array('attr'=>'id,name,style,width,height,type,items,toolbar,allowext,size,allowpath,value','close'=>0),
        'color'     => array('attr'=>'id,name,value,style,class','close'=>0),
        'select'    => array('attr'=>'name,options,values,output,multiple,id,size,first,change,selected,dblclick','close'=>0),
        'checkbox'  => array('attr'=>'name,checkboxes,checked,separator','close'=>0),
        'radio'     => array('attr'=>'name,radios,checked,separator','close'=>0),
        'grid'      => array('attr'=>'id,pk,style,action,actionlist,show,datasource','close'=>0),
        'list'      => array('attr'=>'id,pk,style,action,actionlist,show,datasource,checkbox','close'=>0),
    );
    public function _textarea($tag) {
        $name       = $tag['name']; 
        $value      = $tag['value'];
        $id         = !empty($tag['id'])?$tag['id']: $tag['name'];
        $style      = !empty($tag['style'])?$tag['style']:'';
        $class      = !empty($tag['class'])?$tag['class']:''; 
        $cols       = !empty($tag['cols'])?$tag['cols']:'';
        $rows       = !empty($tag['rows'])?$tag['rows']:'';
        $placeholder       = !empty($tag['placeholder'])?$tag['placeholder']:'';
		$parseStr   = '<textarea id="'.$id.'"  name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">'.$value.'</textarea>';
        return $parseStr;
    }
    public function _number($tag) {
        $name       = $tag['name']; 
        $value      = $tag['value'];
        $id         = !empty($tag['id'])?$tag['id']: $tag['name'];
        $style      = !empty($tag['style'])?$tag['style']:'';
        $class      = !empty($tag['class'])?$tag['class']:''; 
        $type       = !empty($tag['type'])?$tag['type']:'text';
        $placeholder       = !empty($tag['placeholder'])?$tag['placeholder']:'';
		$parseStr   = '<input type="number" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
        return $parseStr;
    }
    public function _input($tag) {
        $name       = $tag['name']; 
        $value      = $tag['value'];
        $id         = !empty($tag['id'])?$tag['id']: $tag['name'];
        $style      = !empty($tag['style'])?$tag['style']:'';
        $class      = !empty($tag['class'])?$tag['class']:''; 
        $type       = !empty($tag['type'])?$tag['type']:'text';
        $placeholder       = !empty($tag['placeholder'])?$tag['placeholder']:'';
		$parseStr   = '<input type="'.$type.'" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
        return $parseStr;
    }
    public function _password($tag) {
        $name       = $tag['name']; 
        $value      = $tag['value'];
        $id         = !empty($tag['id'])?$tag['id']: $tag['name'];
        $style      = !empty($tag['style'])?$tag['style']:'';
        $class      = !empty($tag['class'])?$tag['class']:''; 
        $type       = !empty($tag['type'])?$tag['type']:'text';
        $placeholder       = !empty($tag['placeholder'])?$tag['placeholder']:'';
		$parseStr   = '<input type="password" id="'.$id.'"  name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" style="'.$style.'">';
        return $parseStr;
    }
    /**
     * select标签解析
     * 格式： <html:select options="name" selected="value" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _select($tag) {
        $name       = $tag['name'];
        $options    = $tag['options'];
        $values     = $tag['values'];
        $output     = $tag['output'];
        $multiple   = $tag['multiple'];
        $id         = $tag['id'];
        $size       = $tag['size'];
        $first      = $tag['first'];
        $selected   = $tag['selected'];
        $style      = $tag['style'];
        $ondblclick = $tag['dblclick'];
		$onchange	= $tag['change'];

        if(!empty($multiple)) {
            $parseStr = '<select id="'.$id.'" name="'.$name.'" ondblclick="'.$ondblclick.'" onchange="'.$onchange.'" multiple="multiple" class="'.$style.'" size="'.$size.'" >';
        }else {
        	$parseStr = '<select id="'.$id.'" name="'.$name.'" onchange="'.$onchange.'" ondblclick="'.$ondblclick.'" class="'.$style.'" >';
        }
        if(!empty($first)) {
            $parseStr .= '<option value="" >'.$first.'</option>';
        }
        if(!empty($options)) {
            $parseStr   .= '<?php  foreach($'.$options.' as $key=>$val) { ?>';
            if(!empty($selected)) {
                $parseStr   .= '<?php if(!empty($'.$selected.') && ($'.$selected.' == $key || in_array($key,$'.$selected.'))) { ?>';
                $parseStr   .= '<option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option>';
                $parseStr   .= '<?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option>';
                $parseStr   .= '<?php } ?>';
            }else {
                $parseStr   .= '<option value="<?php echo $key ?>"><?php echo $val ?></option>';
            }
            $parseStr   .= '<?php } ?>';
        }else if(!empty($values)) {
            $parseStr   .= '<?php  for($i=0;$i<count($'.$values.');$i++) { ?>';
            if(!empty($selected)) {
                $parseStr   .= '<?php if(isset($'.$selected.') && ((is_string($'.$selected.') && $'.$selected.' == $'.$values.'[$i]) || (is_array($'.$selected.') && in_array($'.$values.'[$i],$'.$selected.')))) { ?>';
                $parseStr   .= '<option selected="selected" value="<?php echo $'.$values.'[$i] ?>"><?php echo $'.$output.'[$i] ?></option>';
                $parseStr   .= '<?php }else { ?><option value="<?php echo $'.$values.'[$i] ?>"><?php echo $'.$output.'[$i] ?></option>';
                $parseStr   .= '<?php } ?>';
            }else {
                $parseStr   .= '<option value="<?php echo $'.$values.'[$i] ?>"><?php echo $'.$output.'[$i] ?></option>';
            }
            $parseStr   .= '<?php } ?>';
        }
        $parseStr   .= '</select>';
        return $parseStr;
    }

    /**
     * checkbox标签解析
     * 格式： <html:checkbox checkboxes="" checked="" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _checkbox($tag) {
        $name       = $tag['name'];
        $checkboxes = $tag['checkboxes'];
        $checked    = $tag['checked'];
        $separator  = $tag['separator'];
        $checkboxes = $this->tpl->get($checkboxes);
        $checked    = $this->tpl->get($checked)?$this->tpl->get($checked):$checked;
        $parseStr   = '';
        foreach($checkboxes as $key=>$val) {
            if($checked == $key  || in_array($key,$checked) ) {
                $parseStr .= '<input type="checkbox" checked="checked" name="'.$name.'[]" value="'.$key.'">'.$val.$separator;
            }else {
                $parseStr .= '<input type="checkbox" name="'.$name.'[]" value="'.$key.'">'.$val.$separator;
            }
        }
        return $parseStr;
    }

    /**
     * radio标签解析
     * 格式： <html:radio radios="name" checked="value" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _radio($tag) {
        $name       = $tag['name'];
        $radios     = $tag['radios'];
        $checked    = $tag['checked'];
        $separator  = $tag['separator'];
        $radios     = $this->tpl->get($radios);
        $checked    = $this->tpl->get($checked)?$this->tpl->get($checked):$checked;
        $parseStr   = '';
        foreach($radios as $key=>$val) {
            if($checked == $key ) {
                $parseStr .= '<input type="radio" checked="checked" name="'.$name.'[]" value="'.$key.'">'.$val.$separator;
            }else {
                $parseStr .= '<input type="radio" name="'.$name.'[]" value="'.$key.'">'.$val.$separator;
            }

        }
        return $parseStr;
    }

    /**
     * list标签解析
     * 格式： <html:grid datasource="" show="vo" />
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function _grid($tag) {
        $id         = $tag['id'];                       //表格ID
        $datasource = $tag['datasource'];               //列表显示的数据源VoList名称
        $pk         = empty($tag['pk'])?'id':$tag['pk'];//主键名，默认为id
        $style      = $tag['style'];                    //样式名
        $name       = !empty($tag['name'])?$tag['name']:'vo';                 //Vo对象名
        $action     = !empty($tag['action'])?$tag['action']:false;                   //是否显示功能操作
        $key         =  !empty($tag['key'])?true:false;
        if(isset($tag['actionlist'])) {
            $actionlist = explode(',',trim($tag['actionlist']));    //指定功能列表
        }

        if(substr($tag['show'],0,1)=='$') {
            $show   = $this->tpl->get(substr($tag['show'],1));
        }else {
            $show   = $tag['show'];
        }
        $show       = explode(',',$show);                //列表显示字段列表

        //计算表格的列数
        $colNum     = count($show);
        if(!empty($action))     $colNum++;
        if(!empty($key))  $colNum++;

        //显示开始
		$parseStr	= "<!-- Think 系统列表组件开始 -->\n";
        $parseStr  .= '<table id="'.$id.'" class="'.$style.'" cellpadding=0 cellspacing=0 >';
        $parseStr  .= '<tr><td height="5" colspan="'.$colNum.'" class="topTd" ></td></tr>';
        $parseStr  .= '<tr class="row" >';
        //列表需要显示的字段
        $fields = array();
        foreach($show as $val) {
        	$fields[] = explode(':',$val);
        }

        if(!empty($key)) {
            $parseStr .= '<th width="12">No</th>';
        }
        foreach($fields as $field) {//显示指定的字段
            $property = explode('|',$field[0]);
            $showname = explode('|',$field[1]);
            if(isset($showname[1])) {
                $parseStr .= '<th width="'.$showname[1].'">';
            }else {
                $parseStr .= '<th>';
            }
            $parseStr .= $showname[0].'</th>';
        }
        if(!empty($action)) {//如果指定显示操作功能列
            $parseStr .= '<th >操作</th>';
        }
        $parseStr .= '</tr>';
        $parseStr .= '<volist name="'.$datasource.'" id="'.$name.'" ><tr class="row" >';	//支持鼠标移动单元行颜色变化 具体方法在js中定义

        if(!empty($key)) {
            $parseStr .= '<td>{$i}</td>';
        }
        foreach($fields as $field) {
            //显示定义的列表字段
            $parseStr   .=  '<td>';
            if(!empty($field[2])) {
                // 支持列表字段链接功能 具体方法由JS函数实现
                $href = explode('|',$field[2]);
                if(count($href)>1) {
                    //指定链接传的字段值
                    // 支持多个字段传递
                    $array = explode('^',$href[1]);
                    if(count($array)>1) {
                        foreach ($array as $a){
                            $temp[] =  '\'{$'.$name.'.'.$a.'|addslashes}\'';
                        }
                        $parseStr .= '<a href="javascript:'.$href[0].'('.implode(',',$temp).')">';
                    }else{
                        $parseStr .= '<a href="javascript:'.$href[0].'(\'{$'.$name.'.'.$href[1].'|addslashes}\')">';
                    }
                }else {
                    //如果没有指定默认传编号值
                    $parseStr .= '<a href="javascript:'.$field[2].'(\'{$'.$name.'.'.$pk.'|addslashes}\')">';
                }
            }
            if(strpos($field[0],'^')) {
                $property = explode('^',$field[0]);
                foreach ($property as $p){
                    $unit = explode('|',$p);
                    if(count($unit)>1) {
                        $parseStr .= '{$'.$name.'.'.$unit[0].'|'.$unit[1].'} ';
                    }else {
                        $parseStr .= '{$'.$name.'.'.$p.'} ';
                    }
                }
            }else{
                $property = explode('|',$field[0]);
                if(count($property)>1) {
                    $parseStr .= '{$'.$name.'.'.$property[0].'|'.$property[1].'}';
                }else {
                    $parseStr .= '{$'.$name.'.'.$field[0].'}';
                }
            }
            if(!empty($field[2])) {
                $parseStr .= '</a>';
            }
            $parseStr .= '</td>';

        }
        if(!empty($action)) {//显示功能操作
            if(!empty($actionlist[0])) {//显示指定的功能项
                $parseStr .= '<td>';
                foreach($actionlist as $val) {
					if(strpos($val,':')) {
						$a = explode(':',$val);
						if(count($a)>2) {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$a[2].'}\')">'.$a[1].'</a>&nbsp;';
						}else {
							$parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$pk.'}\')">'.$a[1].'</a>&nbsp;';
						}
					}else{
						$array	=	explode('|',$val);
						if(count($array)>2) {
							$parseStr	.= ' <a href="javascript:'.$array[1].'(\'{$'.$name.'.'.$array[0].'}\')">'.$array[2].'</a>&nbsp;';
						}else{
							$parseStr .= ' {$'.$name.'.'.$val.'}&nbsp;';
						}
					}
                }
                $parseStr .= '</td>';
            }
        }
        $parseStr	.= '</tr></volist><tr><td height="5" colspan="'.$colNum.'" class="bottomTd"></td></tr></table>';
        $parseStr	.= "\n<!-- Think 系统列表组件结束 -->\n";
        return $parseStr;
    }

    /**
     * list标签解析
     * 格式： <html:list datasource="" show="" />
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function _list($tag) {
        $id         = $tag['id'];                       //表格ID
        $datasource = $tag['datasource'];               //列表显示的数据源VoList名称
        $pk         = empty($tag['pk'])?'id':$tag['pk'];//主键名，默认为id
        $style      = $tag['style'];                    //样式名
        $name       = !empty($tag['name'])?$tag['name']:'vo';                 //Vo对象名
        $action     = $tag['action']=='true'?true:false;                   //是否显示功能操作
        $key         =  !empty($tag['key'])?true:false;
        $sort      = $tag['sort']=='false'?false:true;
        $checkbox   = $tag['checkbox'];                 //是否显示Checkbox
        if(isset($tag['actionlist'])) {
            if(substr($tag['actionlist'],0,1)=='$') {
                $actionlist   = $this->tpl->get(substr($tag['actionlist'],1));
            }else {
                $actionlist   = $tag['actionlist'];
            }
            $actionlist = explode(',',trim($actionlist));    //指定功能列表
        }

        if(substr($tag['show'],0,1)=='$') {
            $show   = $this->tpl->get(substr($tag['show'],1));
        }else {
            $show   = $tag['show'];
        }
        $show       = explode(',',$show);                //列表显示字段列表

        //计算表格的列数
        $colNum     = count($show);
        if(!empty($checkbox))   $colNum++;
        if(!empty($action))     $colNum++;
        if(!empty($key))  $colNum++;

        //显示开始
		$parseStr	= "<!-- Think 系统列表组件开始 -->\n";
        $parseStr  .= '<table id="'.$id.'" class="'.$style.'" cellpadding=0 cellspacing=0 >';
        $parseStr  .= '<tr><td height="5" colspan="'.$colNum.'" class="topTd" ></td></tr>';
        $parseStr  .= '<tr class="row" >';
        //列表需要显示的字段
        $fields = array();
        foreach($show as $val) {
        	$fields[] = explode(':',$val);
        }
        if(!empty($checkbox) && 'true'==strtolower($checkbox)) {//如果指定需要显示checkbox列
            $parseStr .='<th width="8"><input type="checkbox" id="check" onclick="CheckAll(\''.$id.'\')"></th>';
        }
        if(!empty($key)) {
            $parseStr .= '<th width="12">No</th>';
        }
        foreach($fields as $field) {//显示指定的字段
            $property = explode('|',$field[0]);
            $showname = explode('|',$field[1]);
            if(isset($showname[1])) {
                $parseStr .= '<th width="'.$showname[1].'">';
            }else {
                $parseStr .= '<th>';
            }
            $showname[2] = isset($showname[2])?$showname[2]:$showname[0];
            if($sort) {
                $parseStr .= '<a href="javascript:sortBy(\''.$property[0].'\',\'{$sort}\',\''.ACTION_NAME.'\')" title="按照'.$showname[2].'{$sortType} ">'.$showname[0].'<eq name="order" value="'.$property[0].'" ><img src="__PUBLIC__/images/{$sortImg}.gif" width="12" height="17" border="0" align="absmiddle"></eq></a></th>';
            }else{
                $parseStr .= $showname[0].'</th>';
            }

        }
        if(!empty($action)) {//如果指定显示操作功能列
            $parseStr .= '<th >操作</th>';
        }

        $parseStr .= '</tr>';
        $parseStr .= '<volist name="'.$datasource.'" id="'.$name.'" ><tr class="row" ';	//支持鼠标移动单元行颜色变化 具体方法在js中定义
        if(!empty($checkbox)) {
        //    $parseStr .= 'onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ';
        }
        $parseStr .= '>';
        if(!empty($checkbox)) {//如果需要显示checkbox 则在每行开头显示checkbox
            $parseStr .= '<td><input type="checkbox" name="key"	value="{$'.$name.'.'.$pk.'}"></td>';
        }
        if(!empty($key)) {
            $parseStr .= '<td>{$i}</td>';
        }
        foreach($fields as $field) {
            //显示定义的列表字段
            $parseStr   .=  '<td>';
            if(!empty($field[2])) {
                // 支持列表字段链接功能 具体方法由JS函数实现
                $href = explode('|',$field[2]);
                if(count($href)>1) {
                    //指定链接传的字段值
                    // 支持多个字段传递
                    $array = explode('^',$href[1]);
                    if(count($array)>1) {
                        foreach ($array as $a){
                            $temp[] =  '\'{$'.$name.'.'.$a.'|addslashes}\'';
                        }
                        $parseStr .= '<a href="javascript:'.$href[0].'('.implode(',',$temp).')">';
                    }else{
                        $parseStr .= '<a href="javascript:'.$href[0].'(\'{$'.$name.'.'.$href[1].'|addslashes}\')">';
                    }
                }else {
                    //如果没有指定默认传编号值
                    $parseStr .= '<a href="javascript:'.$field[2].'(\'{$'.$name.'.'.$pk.'|addslashes}\')">';
                }
            }
            if(strpos($field[0],'^')) {
                $property = explode('^',$field[0]);
                foreach ($property as $p){
                    $unit = explode('|',$p);
                    if(count($unit)>1) {
                        $parseStr .= '{$'.$name.'.'.$unit[0].'|'.$unit[1].'} ';
                    }else {
                        $parseStr .= '{$'.$name.'.'.$p.'} ';
                    }
                }
            }else{
                $property = explode('|',$field[0]);
                if(count($property)>1) {
                    $parseStr .= '{$'.$name.'.'.$property[0].'|'.$property[1].'}';
                }else {
                    $parseStr .= '{$'.$name.'.'.$field[0].'}';
                }
            }
            if(!empty($field[2])) {
                $parseStr .= '</a>';
            }
            $parseStr .= '</td>';

        }
        if(!empty($action)) {//显示功能操作
            if(!empty($actionlist[0])) {//显示指定的功能项
                $parseStr .= '<td>';
                foreach($actionlist as $val) {
                    if(strpos($val,':')) {
                        $a = explode(':',$val);
                        if(count($a)>2) {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$a[2].'}\')">'.$a[1].'</a>&nbsp;';
                        }else {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$pk.'}\')">'.$a[1].'</a>&nbsp;';
                        }
                    }else{
                        $array	=	explode('|',$val);
                        if(count($array)>2) {
                            $parseStr	.= ' <a href="javascript:'.$array[1].'(\'{$'.$name.'.'.$array[0].'}\')">'.$array[2].'</a>&nbsp;';
                        }else{
                            $parseStr .= ' {$'.$name.'.'.$val.'}&nbsp;';
                        }
                    }
                }
                $parseStr .= '</td>';
            }
        }
        $parseStr	.= '</tr></volist><tr><td height="5" colspan="'.$colNum.'" class="bottomTd"></td></tr></table>';
        $parseStr	.= "\n<!-- Think 系统列表组件结束 -->\n";
        return $parseStr;
    }
    public function _images($tag) {
        $name       = $tag['name'];
        $value      = $tag['value'];
        $id         = isset($tag['id'])?$tag['id']:$name;
        $class      = isset($tag['class'])?$tag['class']:'';
		//$uploadJson = 'http://'.$_SERVER["HTTP_HOST"].U('Uploads/upload');
		$URL_PREFIX =  is_ssl()?'https://':'http://';
		$uploadJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/upload',array('allowpath'=>'1','allowext'=>'gif|jpg|jpeg|png|bmp'));
		$fileManagerJson = U('Uploads/file_manager');
$parseStr = <<<UPLOADIMG
<script type="text/javascript">
if (typeof KindEditor=='undefined'){
document.write('<link rel="stylesheet" href="/public/ui/lib/KindEditor/themes/default/default.css" />');
document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/kindeditor-min.js"></sc'+'ript>');
document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/lang/zh_CN.js"></sc'+'ript>');
}
</script>
<script>
	KindEditor.ready(function(K) {
		var editor = K.editor({
	uploadJson: "{$uploadJson}",
	fileManagerJson : "{$fileManagerJson}",
	allowFileManager : false
		});
		K("#btn_{$id}").click(function() {
			editor.loadPlugin('multiimage', function() {
				editor.plugin.multiImageDialog({
					clickFn : function(urlList) {
						var div = K('#imageView_{$id}');
						div.html('');
						K.each(urlList, function(i, data) {
							div.append('<input type="text" value="' + data.url + '">');
						});
						editor.hideDialog();
					}
				});
			});
		});
	});
</script>
<input type="button" id="btn_{$id}" class="btn btn-default uk-button" value="批量上传图片" />
<div id="imageView_{$id}"></div>
UPLOADIMG;
        return $parseStr;
    }
    public function _image($tag) {
        $name       = $tag['name'];
        $value      = $tag['value'];
        $id         = isset($tag['id'])?$tag['id']:$name;
        $class      = isset($tag['class'])?$tag['class']:'';
        $style      = isset($tag['style'])?$tag['style']:'';
        $allowext   = !empty($tag['allowext'])?$tag['allowext']:'gif|jpg|jpeg|png|bmp';
        $size       = isset($tag['size'])?$tag['size']:'2';
        $allowpath  = isset($tag['allowpath'])?$tag['allowpath']:0;
		$URL_PREFIX =  is_ssl()?'https://':'http://';
		$uploadJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/upload',array('allowpath'=>$allowpath,'allowext'=>$allowext,'size'=>$size));
		$fileManagerJson = U('Uploads/file_manager');
$parseStr = <<<UPLOADIMG
<script type="text/javascript">
if (typeof KindEditor=='undefined'){
document.write('<link rel="stylesheet" href="/public/ui/lib/KindEditor/themes/default/default.css" />');
document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/kindeditor-min.js"></sc'+'ript>');
document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/lang/zh_CN.js"></sc'+'ript>');
}
</script>
<script>
	KindEditor.ready(function(K) {
		var editor = K.editor({
	uploadJson: "{$uploadJson}",
	fileManagerJson : "{$fileManagerJson}",
	allowFileManager : false
		});
		K("#btn_{$id}").click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					imageUrl : K("#{$id}").val(),
					clickFn : function(url, title, width, height, border, align) {
						K("#{$id}").val(url);
						editor.hideDialog();
					}
				});
			});
		});
	});
</script>
<input type="text" id="{$id}" class="form-control {$class}" name="{$name}" value="{$value}" style="{$style}" />
<input id="btn_{$id}"  class="btn btn-default uk-button" type="button" value="选择文件">
UPLOADIMG;
        return $parseStr;
    }

    public function _color($tag) {
        $name       = $tag['name'];
        $value      = $tag['value'];
        $id         = isset($tag['id'])?$tag['id']:$name;
        $class      = isset($tag['class'])?$tag['class']:'';
        $style      = isset($tag['style'])?$tag['style']:'';
        $type       = isset($tag['type'])?$tag['type']:'text';
$parseStr = <<<HTMLS
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
HTMLS;
        	$parseStr .= '<input class="form-control '.$class.'" type="'.$type.'" id="'.$id.'" style="'.$style.' color:'.$value.';" placeholder="颜色"  name="'.$name.'" value="'.$value.'" onclick="'.$click.'" />';
        return $parseStr;
    }

    public function _datetime($tag) {
        $name       = $tag['name'];
        $value      = $tag['value'];
        $id         = isset($tag['id'])?$tag['id']:$name;
        $class      = isset($tag['class'])?$tag['class']:'';
        $type       = isset($tag['type'])?$tag['type']:'text';
        $format     = isset($tag['format'])?$tag['format']:'yyyy-MM-dd';//format="yyyy-MM-dd HH:mm:ss"
$parseStr .= <<<HTMLS
<script type="text/javascript">
document.write('<scr'+'ipt src="/public/ui/lib/My97DatePicker/WdatePicker.js"></sc'+'ript>');
  </script>
  <input type="{$type}" id="{$id}" class="Wdate {$class}" name="{$name}" onClick="WdatePicker({dateFmt:'{$format}'})" value="{$value}" />
HTMLS;
        return $parseStr;
    }


    public function _map($tag) {
        $id			=	!empty($tag['id'])?$tag['id']: '_editor';
        $name   	=	$tag['name'];
        $style   	    =	!empty($tag['style'])?$tag['style']:'';
        $width		=	!empty($tag['width'])?$tag['width']: '100%';
        $height     =	!empty($tag['height'])?$tag['height'] :'320px';
     	$content    =   $tag['value'];
		$uploadJson = 'http://'.$_SERVER["HTTP_HOST"].U('Uploads/upload');
		$fileManagerJson = U('Uploads/file_manager');
$parseStr = <<<HTMLS
<script type="text/javascript">
if (typeof KindEditor=='undefined'){

document.write('<link rel="stylesheet" href="/public/ui/lib/KindEditor/themes/default/default.css" />');
document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/kindeditor-min.js"></sc'+'ript>');
document.write('<scr'+'ipt src="/public/ui/lib/KindEditor/lang/zh_CN.js"></sc'+'ript>');
}
</script>
<textarea id="{$id}" style="{$style}" name="{$name}" >{$content}</textarea>
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
HTMLS;
        return $parseStr;
    }
    /**
     * editor标签解析 插入可视化编辑器
     * 格式： <html:editor id="editor" name="remark" type="FCKeditor" style="" >{$vo.remark}</html:editor>
     * @access public
     * @param string $attr 标签属性
     * @return string|void
     */
    public function _editor($tag) {
        $id			=	!empty($tag['id'])?$tag['id']: '_editor';
        $name   	=	$tag['name'];
        $style   	=	!empty($tag['style'])?$tag['style']:'';
        $width		=	!empty($tag['width'])?$tag['width']: '100%';
        $height     =	!empty($tag['height'])?$tag['height'] :'80px';
        $toolbar    =	!empty($tag['toolbar'])?$tag['toolbar'] :'full';
        $content    =   !empty($tag['value'])?$tag['value'] :'';
        $items      =   !empty($tag['items'])?$tag['items'] :"'source','|','undo','redo','|','preview','print','template','code','cut','copy','paste','plainpaste','wordpaste','|','justifyleft','justifycenter','justifyright','justifyfull','insertorderedlist','insertunorderedlist','indent','outdent','subscript','superscript','clearhtml','quickformat','selectall','|','fullscreen','/','formatblock','fontname','fontsize','|','forecolor','hilitecolor','bold','italic','underline','strikethrough','lineheight','removeformat','|','image','multiimage','flash','media','insertfile','table','hr','emoticons','baidumap','pagebreak','anchor','link','unlink'";
     	$content    =   $tag['value'];
        $type       =   !empty($tag['type'])?$tag['type']:'KINDEDITOR' ;
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
		<textarea id="{$id}" style="{$style}" name="{$name}" >{$content}</textarea>
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

}
