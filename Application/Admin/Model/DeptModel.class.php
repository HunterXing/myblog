<?php
//声明命名空间
namespace Admin\Model;

//引入父类模型
use Think\Model;

//声明模型斌且继承父类模型
class DeptModel extends Model{
    // 自动验证定义
	protected $_validate        =   array(
	   array('name','require','部门名称不能为空'),
	   array('name','','部门已经存在',0,'unique'),
	   array('name','','部门已经存在'),
	 );  
    
}