<?php
/**
 * Created by PhpStorm.
 * User: Town
 * Date: 2018/12/28
 * Time: 10:48
 */

namespace Home\Controller;
use Think\Controller;
class TestController extends Controller
{

    public function index(){
        return $this->display();
    }

}