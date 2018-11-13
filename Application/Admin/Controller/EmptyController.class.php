<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/11/13
 * Time: 16:09
 * @Last Modified time: @CreatedDate
 */


namespace Admin\Controller;

use Think\Controller;

class EmptyController extends Controller{
    public function _empty(){
        $this ->display('Empty/error');
    }
}