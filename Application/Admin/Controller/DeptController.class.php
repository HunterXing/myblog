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
             $post =  I('post.');
          //写入数据
             $model = M('Dept');
             $result = $model -> add($post);
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
 }