<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/11/6
 * Time: 11:06
 * @Last Modified time: @CreatedDate
 */

namespace  Admin\Model;

use Think\Model;

class DocModel extends  Model{
    //saveData
    public function saveData($post,$file){
        //dump($file);die;
        //判断是否有文件要处理
        if(!$file['error']){
            //上传类配置项
            $cfg = array(
                'rootPath'      => WORKING_PATH.UPLOAD_ROOT_PATH
            );

            //处理上传
            $upload = new \Think\Upload($cfg);

            //开始上传
            $info = $upload -> uploadOne($file);

            //dump($info);die;
            if($info){
                //补全上传的三个字段
                $post['filepath'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
                $post['filename'] = $info['name'];
                $post['hasfile'] = 1;
            }

        }

        $post['addtime'] = time();

        //dump($post);die;

        return $this -> add($post);
    }

    //updateData
    public function updateData($post,$file){
        //如果有文件则处理文件
        if($file['error'] == '0'){//有文件
            $cfg = array(
                'rootPath'      => WORKING_PATH.UPLOAD_ROOT_PATH
            );
            //实例化上传类
            $upload = new\Think\Upload($cfg);

            //上传
            $info = $upload -> uploadOne($file);
            //dump($info);die;
            if($info){
                $post['filepath'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
                $post['filename'] = $info['name'];
                $post['hasfile'] = 1;
            }
        }
        //dump($post);die;
        //没文件  写入数据
        return $this -> save($post);

    }
}