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


//编写登陆验证代码
public function checkLogin(){
	//0.接受表单数据
	$post = I('post.');
	//dump($post);
	//1.进行数据验证
	//1.1实例化验证码类
	$verfiy = new Verify();
	//1.2验证验证码
	$result = $verfiy -> check($post['captcha']);
	//dump($result);
	if($result){
		//验证码正确
		unset($post['captcha']);
		$model = M('user');
		$data = $model -> where($post)->find();
		//dump($data);
		if($data){
			//存在，用户信息持久化（保存到session中），跳转到后台首页
			session('id',$data['id']);
			session('username',$data['username']);
			session('role_id',$data['role_id']);
			//跳转
			$this -> success('登陆成功',U('Index/index'),3);

		}else{
			//不存在
			$this ->error('用户名或密码不正确。。。');
		}
	}else{
		//验证码错误
		 $this -> error('您输入的验证码不正确。。。');
	}
}


//退出方法
public function logout(){
	//清楚session
	session(null);
	//调转到登录
	$this -> success('退出成功',U('login'),3);
}




}
