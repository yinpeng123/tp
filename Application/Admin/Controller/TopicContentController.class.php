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
class TopicContentController extends  Controller{

    public function  index(){
        $tid = $_GET['id'];
        $count = M("topic_content")->where("tid = $tid")->count();
        $Page = Page($count);
        $show = $Page->show();// 分页显示输出
        $topic_content = M("topic_content")->where("tid = $tid")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($topic_content as $k=>$v){
            $topic_content[$k]['result'] = unserialize($v['result']);
        }
        $this->assign("topic_content",$topic_content);
        $this->assign('page',$show);
        $this->assign("tid",$tid);
        return $this->display();
    }

    # 新增 修改
    public function publish(){
        $post = I('post.');
        $id = $_GET['id']?$_GET['id']:$_POST['id'];

        if($id>0){
            # 修改操作
            $post = I("post.");
            $tid = $_GET['tid']?$_GET['tid']:$_POST['tid'];
            if($post){
                $data['answer'] = $post['answer'];
                $data['score'] = $post['score'];
                $save['result'] = serialize($data);
                $save['title'] = $post['title'];
                $save['weight'] = $post['weight'];
                $update = M("topic_content")->where("id = $id and tid =$tid")->save($save);
                if($update){
                    return $this->success("修改成功",U("admin/topicContent/index?id=$tid"));
                }else{
                    return $this->success("修改失败");
                }
            }else{

                $detail = M("topic_content")->where("id = $id and tid=$tid")->find();
                $detail['result'] = unserialize($detail['result']);
                $this->assign("detail",$detail);
                return $this->display();
            }
        }else{
            # 新增操作
            $post = I('post.');

            if($post){
                $tid = $post['tid'];
                $data['answer'] = $post['answer'];
                $data['score'] = $post['score'];
                $insert['title'] = $post['title'];
                $insert['tid'] = $tid;
                $insert['weight'] = $post['weight'];
                $insert['result'] = serialize($data);
                $insert['create_time'] = date("Y-m-d H:i:s");
                $insert = M("topic_content")->add($insert);
                if($insert){
                   return $this->success("添加成功",U("admin/topicContent/index?id=$tid"));
                }else{
                    return $this->success("添加失败");
                }
            }else{
                $tid = $_GET['tid'];
                $this->assign("tid",$tid);
                return $this->display();
            }
        }
    }


    public function del(){
        $get = I("get.");
        $id = $get['id'];
        $tid = $get['tid'];
        if($id && $tid){
            $del = M("topic_content")->where("id = $id and $tid")->delete();
            if($del){
                return $this->success("删除成功",U("admin/topicContent/index?id=$tid"));
            }else{
                return $this->success("删除失败");
            }
        }
    }

}