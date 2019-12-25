<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/8
 * Time: 14:54
 */


namespace  Home\Controller;
use Think\Controller;
class IndexController extends Controller{

    public  function  index(){
        return $this->display();
    }

}