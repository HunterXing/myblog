<?php
 namespace Admin\Controller;

 //use Think\Controller;
 class DeptController extends CommonController
 {

     public function add()
     {
         //判断请求的类型
         if (IS_POST) {
             //如果请求时post，则IS_POST的值时true，否则为false
             // $post =  I('post.');
             //写入数据 在自定义模型时Model的子类，所以使用D
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
       //使用load方法载入文件
       load('@/tree');
       $data = getTree($data);
       //dump($data);die;
       $this -> assign('data',$data);
       $this -> display();
     }


     //edit
    public function edit(){
      if(IS_POST){
          //处理post请求
          $post = I('post.');
          //实例化
          $model = M('Dept');
          //保存操作
          $result = $model -> save($post);
          //判断修改成功与否
          if($result !== false){
              //修改成功
              $this -> success('修改成功',U('showlist'),3);
          }else{
              //修改失败
              $this -> error('修改失败');
          }
      }else{
          //展示

          //接受id
          $id = I('get.id');
          //实例化模型
          $model = D('Dept');
          //查询当前点击的部门信息
          $data = $model -> find($id);
          //查询全部的部门信息，给下拉列表使用
          $info = $model -> where('id !='.$id) -> select();
          //变量分配
          $this -> assign('data',$data);
          $this -> assign('info',$info);
          //dump($info);die;
          //展示模板
          $this -> display();
      }
    }

   //del  删除 单个删除 批量删除（复选框）
     public  function  del(){
        //接收参数
         $id = I('get.id');
         $model = M('Dept');
         //删除
         $result = $model -> delete($id);
         //判断结果
         if($result){
             $this -> success('删除成功！');
         }else{
             $this -> error('删除失败！');
         }
     }
 }
