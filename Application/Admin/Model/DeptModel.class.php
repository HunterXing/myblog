<?php
//声明命名空间
namespace Admin\Model;

//引入父类模型
use Think\Model;

//声明模型斌且继承父类模型
class DeptModel extends Model{
	//字段映射
	// protected $_map = array(
	//
	// 	 'name' =>'username', // 把表单中name映射到数据表的username字段
	// 	 'mail' =>'email',  // 把表单中的mail映射到数据表的email字段
	//  );


	//开启批量验证
	//protected $patchValidate = true;
    //自动验证定义
	protected $_validate        =   array(
	   array('name','require','部门名称不能为空'),
	   array('name','','部门已经存在',0,'unique'),
	   //验证字段是数字
	   array('sort','number','排序必须是数字'),
	 );

}
