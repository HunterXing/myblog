<?php

namespace Admin\Controller;

use Think\Controller;

class EmailController extends Controller{
   //私信
   public function send(){
     if(IS_POST){
        //处理数据

        //1.接收数据
        $post = I('post.');
        //2.实例化自定义模型
        $model = D('Email');
        //3.调用具体类中方法实现数据的保存
        $result = $model -> addData($post,$_FILES['file']);
        //4.判断是否保存成功
        if($result){
            $this -> success('邮件发送成功！',U('sendBox'),3);
        }else{
            $this -> error('邮件发送失败！');
        }

     }else{
         //查询收件人的信息
        $data = M('User') ->field('id,truename')-> select();
        //dump($data); die;
        $this -> assign('data',$data);
        $this ->  display();
     }

   }

   //发件箱
   public function sendBox(){
      $this ->  display();
   }
}
