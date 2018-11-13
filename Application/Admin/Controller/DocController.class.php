<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/11/6
 * Time: 8:20
 * @Last Modified time: @CreatedDate
 */

namespace  Admin\Controller;

use Think\Controller;

class DocController extends  Controller{
    //添加
    public function  add(){
        if(IS_POST){
          $post = I('post.');
          $model = D('Doc');
          $result = $model -> saveData($post,$_FILES['file']);
          if($result){
              $this -> success('添加公文成功',U('showList'),3);
          }else{
              $this -> error('添加失败');
          }
        }else{
            $this -> display();
        }
    }

    //展示
    public function showList(){
        $model = M('Doc');
        $data = $model -> select();

        //dump($data);die;
        $this -> assign('data',$data);

        $this -> display();
    }

    //下载
    public  function  download(){
        //接受id
        $id = I('get.id');
        //查询数据
        $data =  M('Doc')  -> find($id);

        //下载代码
        $file = WORKING_PATH.$data['filepath'];
        //输出文件
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($data['filename']) . '"');
        header("Content-Length: ". filesize($file));
        //输出缓冲区
        readfile($file);
    }

    //编辑
    public function  edit(){
        if(IS_POST){
            //处理数据的提交
            $post = I('post.');
            //实例化自定义模型
            $model = D('Doc');
            //调用updateData()方法实现数据的保存更新
            $result = $model ->updateData($post,$_FILES['file']);
            //判断返回值
            if($result){
                //成功
                $this -> success('修改成功',U('showList'),3);
            }else{
                //失败
                $this -> error('保存失败！');
            }
        }else{
            //接受id
            $id = I('get.id');
            //查询数据
            $data = M('Doc') -> find($id);
            //dump($data);die;
            $this -> assign('data',$data);

            $this -> display();
        }


    }
}