<?php

namespace Admin\Controller;

//use Think\Controller;

class EmailController extends CommonController{
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
        $data = M('User') ->field('id,truename,username')-> select();
        //dump($data); die;
        $this -> assign('data',$data);
        $this ->  display();
     }

   }

   //发件箱
   public function sendBox(){
       //查询出当前用户已经发送的邮件
       $sql = "select t1.*,t2.truename as truename from sp_email as t1 left join sp_user as t2 on t1.to_id = t2.id where t1.from_id =".session('id')."";
       //dump($sql);die;
       $data = M('Email') -> query($sql);
       $this -> assign('data',$data);
       $this ->  display();
   }


    public function recBox(){
        $sql = "select t1.*,t2.truename as truename 
                  from sp_email as t1 left join sp_user as t2 on t1.from_id = t2.id 
                  where t1.to_id =".session('id')."";
        //dump($sql);die;
        $data = M('Email') -> query($sql);
        //dump($data);die;
        $this -> assign('data',$data);
        $this -> display();

    }


    //下载
    public  function  download(){
        //接受id
        $id = I('get.id');
        //查询数据
        $data =  M('Email')  -> find($id);

        //下载代码
        $file = WORKING_PATH.$data['file'];

        //调用thinkphp自带库里面的HTTPS类里面的静态方法
        \Org\Net\Http::download($file,$data['filename']);

       /* //输出文件
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($data['filename']) . '"');
        header("Content-Length: ". filesize($file));

        //输出缓冲区*/
        readfile($file);
    }

   /* function _empty(){
        $this ->display('Empty/error');
    }*/




}
