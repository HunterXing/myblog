<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/11/8
 * Time: 14:50
 * @Last Modified time: @CreatedDate
 */

namespace Admin\Model;

use Think\Model;

class KnowledgeModel extends Model{
    public function saveData($post,$file){
        if($file['error'] == '0'){
            //有文件
            $config = array(
                'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH

            );
           /* $ftpConfig     =    array(
                'host'     => '212.64.25.152', //服务器
                'port'     => 22, //端口
                'timeout'  => 180, //超时时间
                'username' => 'ubuntu', //用户名
                'password' => 'xing15555@', //密码
                );*/

                $upload = new \Think\Upload($config/*,'Ftp',$ftpConfig*/);// 实例化上传类
            //$upload = new \Think\Upload($cfg);
            $info = $upload -> uploadOne($file);

            //dump($info);die;
            if($info){
                //补全字段
               $post['picture']  = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
               //制作缩略图   用到图像处理类
                #0.打开图片  #1.制作图片  #2.保存图片
                //1.实例化类
                $image = new \Think\Image();
                //2.打开图片，传递图片的路径
                $image->open(WORKING_PATH.$post['picture']);

                // 3.制作缩略图，等比缩放
                $image->thumb(100, 100);

                //4.保存图片，传递保存完整的路径（目录+文件名）
                $image -> save(WORKING_PATH.UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename']);

                //5.补全数据库字段
                $post['thumb'] = UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename'];

            }
        }


        $post['addtime'] = time();
        //dump($post);die;
        //添加操作
        return $this -> add($post);
    }


}