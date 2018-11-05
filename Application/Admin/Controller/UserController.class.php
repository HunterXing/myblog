<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/11/5
 * Time: 11:14
 * @Last Modified time: @CreatedDate
 */

namespace Admin\Controller;

use Think\Controller;

class UserController extends  Controller{
    //add
    public function  add(){
        if(IS_POST){
            //post请求数据表单提交
            $model = M('User');
            //创建数据对象
            $data = $model -> create();
            //添加时间
            $data['addtime'] = time();
            dump($data);die;
            //添加入数据表
            $result = $model -> add($data);
            if($result){
                $this -> success('添加员工成功',U('showList'),3);
            }else{
                $this -> error('添加员工失败');
            }
        }else{
            //实例化模型
            $model = M('Dept');
            //查询部门信息
            $data = $model -> field('id,name') -> select();
            //分配到模板
            $this -> assign('data',$data);
            //dump($data);die;
            //展示模板
            $this -> display();
        }

    }

    //showList 展示数据
    public  function showList(){
        //实例化
        $model = M('User');
        //查询数据
        $data = $model -> select();
        //分配到模板
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }

}