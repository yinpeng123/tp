<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/27
 * Time: 11:33
 */

function Page($count){
    $Page       = new \Think\Page($count,10);
    $Page->setConfig('prev','上一页');
    $Page->setConfig('next','下一页');
    $Page->setConfig('last','末页');
    $Page->setConfig('first','首页');
    return $Page;
}