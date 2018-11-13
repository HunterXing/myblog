<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/11/5
 * Time: 11:14
 * @Last Modified time: @CreatedDate
 */

namespace Admin\Controller;

//use Think\Controller;

class UserController extends  CommonController{
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

        //分页七步骤
            #1. 查询总的记录数
            $count = $model -> count();
            #2. 实例化分页类 传递参数
            $page = new \Think\Page($count,1);//每页显示一条数据
            #3.（可选步骤） 定制分页按钮提示文字
            $page -> rollPage = 5; //大于多少时展示收末页
            $page -> lastSuffix = false;//是否显示末页数字
            $page -> setConfig('prev','上一页');
            $page -> setConfig('next','下一页');
            $page -> setConfig('first','首页');
            $page -> setConfig('last','末页');
            #4. 通过show方法输出分页的url链接
            $show = $page -> show();
            #5. 使用limit方法查询数据
            $data = $model -> limit($page->firstRow,$page -> listRows) -> select();
            #6. 传递给模板
            $this -> assign('count',$count);
            $this -> assign('data',$data);
            $this -> assign('show',$show);
            #7. 展示模板
            $this -> display();

    }


    //charts
    public function  charts(){
        $model = M();
        $result = $model -> query('select t2.name as deptName,count(*) as count
                            from sp_user as t1 , sp_dept as t2 
                            where t1.dept_id = t2.id
                            group by deptName
                            ');
        //dump($data);die;
        //对数组格式进行处理
        $data = '[';
        foreach($result as $key => $value){
            $data .= "["."'".$value['deptname']."'".",".$value['count']."],";
        }
        $data =rtrim ($data,',').']';
        //echo $data;die;

        $this -> assign('data',$data);
        $this -> display();
    }


}