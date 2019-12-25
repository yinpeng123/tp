<?php

namespace Admin\Controller;

use Think\Controller;
use getID3;

class ArticleController extends Controller
{

    public function index()
    {
        $count = M("article")->count();
        $Page = Page($count);
        $show = $Page->show();// 分页显示输出
        $voice = M("article")->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('article', $voice);
        $this->assign('page', $show);
        return $this->display();
    }


    public function publish()
    {
        $id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
        if ($id > 0) {
            //修改
            $post = I("post.");
            if ($post) {
                $article = M("article")->where("id = $id")->find();
                $voice = I("post.voice");
                $voice_str = implode(',', $voice);
                $data['voice'] = $voice_str;
                if ($article['voice'] != $voice_str) {
                    $time = [];
                    foreach ($voice as $k => $v) {
                        require_once('./getid/getid3/getid3.php');
                        $getID3 = new getID3();
                        $str = (substr($v, 1, strlen($v)));
                        $ThisFileInfo = $getID3->analyze($str);
                        $fileduration = $ThisFileInfo['playtime_seconds'];
                        $time[] = round($fileduration, 2);
                    }
                    $arr = array_values($voice);
                    $count = count($arr);
                    $new = [];
                   $data['time'] = implode(',', $time);
                    if ($count > 1) {
                        foreach ($arr as $k => $v) {
                            $new[$k] = "-i " . substr($v, 1, strlen($v));
                        }
                        $new = implode(" ", $new);
                        $uniqid = uniqid();
                        $newfile = "Public/Uploads/mp3/$uniqid.mp3";
                        $exec = "ffmpeg $new  -filter_complex  '[0:0] [1:0] concat=n=$count:v=0:a=1 [a]' -map [a] $newfile";
                        exec($exec, $arr, $status);
                    	$data['voice'] = implode(',', $voice);
                        $data['mp3'] = $newfile;
                    }else{
                      	$data['voice'] = implode(',', $voice);
                        $data['mp3'] = implode(',', $voice);                   
                    }
                 }	
 
                $data['title'] = I("post.title");
                $data['thumb'] = I('post.thumb');
                $data['list_thumb'] = I('post.list_thumb');
                $data['desc'] = I("post.desc");
                $data['author'] = I("post.author");
                $data['like'] = I("post.like");
                $data['reading'] = I("post.reading");
                $data['content'] = implode(',', I("post.content"));
                $data['create_time'] = date("Y-m-d H:i:s", time());

               
                $result = M("article")->where("id=$id")->save($data);
                if ($result) {
                    echo 1;
                }
            } else {
                $article = M("article")->where("id = $id")->find();
                $article['content'] = explode(",", $article['content']);
                $article['voice'] = explode(",", $article['voice']);
                $this->assign("article", $article);
                return $this->display();
            }
        } else {

            //添加
            $post = I("post.");
            if ($post) {
                $time = [];
                $voice = $post['voice'];
                $add['mp3'] = implode(',', $voice);
                foreach ($voice as $k => $v) {
                    require_once('./getid/getid3/getid3.php');
                    $str = (substr($v, 1, strlen($v)));
                    $getID3 = new getID3();
                    $ThisFileInfo = $getID3->analyze($str);
                    $fileduration = $ThisFileInfo['playtime_seconds'];
                    $time[] = round($fileduration, 2);
                }
                $add['time'] = implode(',', $time);
                $arr = array_values($voice);
                $count = count($arr);
                if($count >1){
                    $new = [];
                    foreach ($arr as $k => $v) {
                        $new[$k] = "-i " . substr($v, 1, strlen($v));
                    }
                    $new = implode(" ", $new);
                    $uniqid = uniqid();
                    $newfile = "Public/Uploads/mp3/$uniqid.mp3";
                    $exec = "ffmpeg $new  -filter_complex  '[0:0] [1:0] concat=n=$count:v=0:a=1 [a]' -map [a] $newfile";
                    exec($exec, $arr, $status);
                  	if($stetus == 0){
                        $add['mp3'] = $newfile;
                    }
                   
                }else{
                        $add['mp3'] = implode(',', $voice);
                }
                    $add['title'] = I("post.title");
                    $add['thumb'] = I('post.thumb');
                    $add['list_thumb'] = I('post.list_thumb');
                    $add['desc'] = I("post.desc");
                    $add['author'] = I("post.author");
                    $add['like'] = I("post.like");
                    $add['reading'] = I("post.reading");
                    $add['content'] = implode(',', I("post.content"));
                    $add['voice'] = implode(',', $voice);
                    $add['create_time'] = date("Y-m-d H:i:s", time());
                  
                    $result = M("article")->add($add);
                    if ($result) {
                        echo 1;
                    }
            } else {
                return $this->display();
            }

        }

    }

    # 上传图片
    public function upload()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 200000000;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'mp3', 'mp4');// 设置附件上传类型
        $upload->rootPath = 'Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        $add['picture'] = '/Public/Uploads/' . $info['file']['savepath'] . $info['file']['savename'];
        $add['create_time'] = date("Y-m-d H:i:s", time());
        $res = M("picture")->add($add);
        if ($res) {
            $result['id'] = $res;
            $result['src'] = '/Public/Uploads/' . $info['file']['savepath'] . $info['file']['savename'];
            $result['code'] = '1';
        }
        $this->ajaxReturn($result);
    }



    public function del(){
         $id = I("post.id");

         $info = M("article")->where("id=$id")->find();
         $voice = explode(",",$info["voice"]);
         $thumb = $info['thumb'];
         unlink($thumb);
         $list_thumb = $info['list_thumb'];
         unlink($list_thumb);

         foreach ($voice as $v){
             unlink($v);
         }
         $mp3 = $info['mp3'];
         unlink($mp3);
         $del = M("article")->where("id = $id")->delete();
         if($del){
             echo 1;
         }
    }


}