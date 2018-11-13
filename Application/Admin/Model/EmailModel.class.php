<?php
namespace Admin\Model;

use Think\Model;

class EmailModel extends Model{
   //发邮件，添加数据
    public function addData($post,$file){
        if($file['error'] == '0'){//说明有文件需要处理
          //配置文件
          $cfg = array(
            'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH
          );
          //实例化上传类
          $upload = new \Think\Upload($cfg);
          //开始上传
            $info = $upload -> uploadOne($file);
            //dump($info);die;
            if($info){
                //补全字段  file  hasfile   filename
                $post['file'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
                $post['hasfile'] = 1;
                $post['filename'] = $info['name'];
            }
        }
        $post['from_id'] = session('id'); //发件人id
        $post['addtime'] = time();        //发送时间

        //数据的保存
        dump($post);die;
        return $this -> add($post);

    }
}
