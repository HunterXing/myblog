<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/11/13
 * Time: 17:01
 * @Last Modified time: @CreatedDate
 */

namespace Admin\Controller;

use Think\Controller;


//中间控制器
class CommonController extends  Controller{
    //原生php提供的构造函数
    public function __construct()
    {
        //构造父类·
        parent::__construct();
        //echo "你好";
        $id = session('id');
        //判断是否登陆
        if(empty($id)){
            $this -> error('请先登录',U('Public/login'),3);
            exit;
        }
    }
   /* //thinkphp框架提供
    public function _initialize()
    {
       echo "你好";
    }*/
}
