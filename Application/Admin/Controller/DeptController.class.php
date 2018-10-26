<?php
 namespace Admin\Controller;
 use Think\Controller;
 class DeptController extends Controller
 {

     public function add()
     {
         //判断请求的类型
         if (IS_POST) {
             //如果请求时post，则IS_POST的值时true，否则为false
             // $post =  I('post.');
             //写入数据 在自定义模型时MOdel的子类，所以使用D
             $model = D('Dept');
             $data = $model -> create();//不传递参数 则接受post数据
             if(!$data){
                //dump($model -> getError());die;
                $this -> error($model -> getError());exit;
             }
             //dump($data);die;
             $result = $model -> add($data);
             //判断返回值
             if($result){
                //成功
                 $this -> success('添加成功',U('showList'),3);
             }else{
                 //失败
                 $this -> error('添加失败');
             }
         } else {
             //查询出顶级部门
             $model = M('Dept');
             $data = $model->select();
             //展示数据
             $this->assign('data', $data);
             $this ->display();
         }
     }


     //展示列表
     public function showList(){
       $model = M('Dept');
       $data = $model -> select();
       //dump($data);die;
       foreach ($data as $key => $value) {
         //dump($value['pid']);die;
         //$value['pid'] 代表是上级部门的id 大于 0时才有意义
         if($value['pid'] > 0){
            $info = $model ->find($value['pid']) ;
            $data[$key]['deptname'] = $info['name'];
            //dump($info);die;
         }
       }
       //dump($data);die;
       $this -> assign('data',$data);
       $this -> display();
     }
 }
