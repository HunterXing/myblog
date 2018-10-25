<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class PublicController extends Controller{
	//登录
	public function login(){
		$this -> display();
		// $str = $this -> fetch();
		// dump($str);
	}
	//验证码
	public function captcha(){
		//0.配置
		$cfg = array(
        'useImgBg'  =>  false,           // 使用背景图片 
        'fontSize'  =>  15,              // 验证码字体大小(px)
        'useCurve'  =>  false,            // 是否画混淆曲线
        'useNoise'  =>  false,            // 是否添加杂点	
        'imageH'    =>  40,               // 验证码图片高度
        'imageW'    =>  100,               // 验证码图片宽度
        'length'    =>  4,               // 验证码位数
        'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        'bg'        =>  array(243, 251, 254),  // 背景颜色
		);
		//1.实例化验证码类
		$verfiy = new Verify($cfg);

		//2.输出验证码
		$verfiy -> entry();
	}
}