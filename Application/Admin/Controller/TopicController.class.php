<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/23
 * Time: 17:41
 */
namespace Admin\Controller;
use think\Controller;
use Think\Db;
class TopicController extends  Controller{

    public function  index(){

        $count = M("topic")->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $show = $Page->show();// 分页显示输出
        $topic = M("topic")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign("topic",$topic);
        return $this->display();
    }

    # 新增 修改
    public function publish(){
        $id = $_GET['id']?$_GET['id']:$_POST['id'];
        if($id>0){
            # 修改操作
            $post = I("post.");
            if($post){
                $data['topic_name'] = $post['topic_name'];
                $updat = M("topic")->where("id = $id")->save($data);
                if($updat){
                    return $this->success("修改成功",U('admin/topic/index'));
                }else{
                    return $this->error("修改失败");
                }
            }else{
                $detail = M("topic")->where("id = $id")->find();
                $this->assign("detail",$detail);
                return $this->display();
            }
        }else{
            # 新增操作
            $post = I("post.");
            if($post){
                $insert['topic_name'] = $post['topic_name'];
                $insert['topic_time'] = date("Y-m-d H:i:s");
                $insert = M("topic")->add($insert);
                if($insert){
                    return $this->success("添加成功",U('admin/topic/index'));
                }else{
                    return $this->success("添加失败");
                }
            }else{
                return $this->display();
            }
        }
    }

    public function del(){
        $id = $_POST['id'];
        if($id){
            $topic_content = M("topic_content")->where("tid = $id")->select();
            if($topic_content){
                $data = json_encode(array('msg'=>"请先删除下级内容"));

                return $this->error("请先删除下级内容");
            }else{
                $topic = M("topic")->where("id = $id")->delete();
                if($topic){
                    $data = json_encode(array('msg'=>"删除成功"));
                    return $this->success("删除成功");
                }
            }
        }
    }
}








