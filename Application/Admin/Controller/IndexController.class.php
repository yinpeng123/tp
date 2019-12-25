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
class IndexController extends  Controller{

    public function  index(){
        return $this->display();
    }


    public function create(){
        $insert['topic_name'] = $_POST['topic_name'];
        $insert['topic_time'] = date("Y-m-d H:i:s");
        $insert = M("topic")->add($insert);
        if($insert){
            $id = M("topic")->getLastInsID();
            foreach ($_POST['title'] as $k=>$v){
                $data['topic_id'] = $id;
                $data['title'] = $v;
                $data['answer'] = $_POST[$k]['answer'];
                $data['create_time'] = date("Y-m-d H:i:s",time());
                $data = M("topic_content")->add($data);
                if($data){
                    print_R("添加成功");
                }
            }

        }
    }

    public function edit(){
        $id = $_GET['id'];
        $post = I("post");
        if($id){
            if($post){
                $data['topic_name'] = $_POST['topic_name'];
                $update = M("topic")->where("id = $id")->update($data);
                if($update){
                    foreach ($_POST['title'] as $k=>$v){
                        $topic['title'] = $v;
                        $topic['answer'] = $_POST[$k]['answer'];
                        $update = M("topic_content")->where("topic = $id")->update();
                        if($update){
                            print_R("更新成功");
                        }
                    }
                }
            }else{
                    $info = M("topic")->alias("t")->field("t.*,tc.title,tc.answer")->join("left join topic_content as tc on t.id = tc.topic_id")->select();
                    $this->assign("info",$info);
                    return $this->display();
            }
        }

    }

    public function delete(){
        $id = $_POST['id'];
        if($id){
            $topic = M("topic")->where("id = $id")->delete();
            $topic_content = M("topic_content")->where("topic_id = $id")->delete();
            if($topic && $topic_content){
                print_R("删除成功");
            }
        }
    }

}