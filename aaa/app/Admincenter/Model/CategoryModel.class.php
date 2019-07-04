<?php
namespace Admincenter\Model;
use Think\Model;
class CategoryModel extends BaseModel {
	protected $_validate = [
		['catname','require','栏目名称必须！'],
	];
}
