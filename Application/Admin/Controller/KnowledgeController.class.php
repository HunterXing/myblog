<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/11/8
 * Time: 14:27
 * @Last Modified time: @CreatedDate
 */

namespace  Admin\Controller;

//use Think\Controller;

class KnowledgeController extends CommonController{
        public function showList(){
            //获取数据
            $model = M('Knowledge');
            $data = $model -> select();
            //dump($data);die;
            //展示模板
            $this -> assign('data',$data);
            $this -> display();


        }

        public function  add(){

            if(IS_POST){
                $post = I('post.');
                //实例化自定义模型
                $model  = D('Knowledge');
                //数据的保存
                $result = $model -> saveData($post,$_FILES['thumb']);
                //结果的校验
                if($result){
                    $this -> success('添加知识成功',U('showList'),3);
                }else{
                    $this -> error('添加知识失败');
                }
            }else{
                //展示模板
                $this -> display();
            }

        }

        //download方法
        public function download(){
            //获取id
            $id = I("get.id");
            //查询数据信息
            $data = M('Knowledge') -> find($id);
            //下载代码
            $file = WORKING_PATH . $data['picture'];
            //调用thinkphp自带库里面的HTTPS类里面的静态方法
            \Org\Net\Http::download($file,$data['filename']);

            readfile($file);
        }



}