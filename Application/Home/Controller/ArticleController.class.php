<?php
namespace Home\Controller;
use Think\Controller;
use getID3;
class ArticleController extends Controller {


	# 文章列表
  	public function article_list(){
      	$type = $_POST['type'];
        $num = $_POST['num'];
        if(!$num){
            $num = 0;
        }else{
            $num;
        }
        if($type == "last"){
            $article = M("article")->field("id,title,author,list_thumb,like,reading")->order("create_time desc")->limit($num,10)->select();
        }elseif($type == "hot"){
            $article = M("article")->field("id,title,author,list_thumb,like,reading")->order("reading desc")->limit($num,10)->select();
        }
      	$this->ajaxReturn($article);
    }

    # 用户已读列表
    public function player_list(){
        $article_id = $_POST['id'];
        $type = $_POST['type'];
        $num = $_POST['num'];
        if(!$num){
            $num = 0;
        }else{
            $num;
        }
        if($type == "last"){
            $order = "ur.create_time desc";
        }else if($type  == "hot"){
            $order = "ur.reading desc";
        }
        $my_artilce = M("user_article_list")
            ->field("ur.create_time,ur.reading,ur.article_id,u.pic,u.nickname,ur.uid")
            ->alias('ur')
            ->where("ur.article_id = $article_id")
            ->join("left join user as u on ur.uid = u.uid")
            ->order($order)
            ->limit($num,10)
            ->select();
        $this->ajaxReturn($my_artilce);
    }

    # 文章详情
	public function article_detail(){
        $id = $_POST['id'];
        $uid = $_POST['uid'];
        if(!$uid){
            $article = M("article")->field("id,title,author,thumb,like,reading,content,mp3,time")->where("id=$id")->find();
            $article['content'] = explode(',',$article['content']);
            $article['time'] = explode(',',$article['time']);
            $data['reading'] = $article['reading'] + 1;
            M("article")->where("id=$id")->save($data);
            $this->ajaxReturn($article);
        }else{
            $this->player_article_detail($uid,$id);
        }

    }

    # 用户已读文章详情
    public function player_article_detail($uid,$id){
       $article = M("article")
            ->alias("a")
            ->field("a.id,a.title,a.author,a.thumb,a.like,ual.reading,a.content,ual.voice,ual.time")
            ->join("left join user_article_list as ual on a.id = ual.article_id")
            ->where("a.id=$id and ual.uid = $uid")
            ->order("ual.create_time desc")
            ->find();
        $article['content'] = explode(',',$article['content']);
        $article['time'] = explode(',',$article['time']);
        $article['mp3'] =$article['voice'];
        $data['reading'] = $article['reading'] + 1;
        M("user_article_list")->where("id=$id and uid=$uid")->save($data);
        $this->ajaxReturn($article);
    }

    # 我的文章
    public function my_article(){
  	    $uid = $_POST['uid'];
        $num = $_POST['num'];
        if(!$num){
            $num = 0;
        }else{
            $num;
        }
  	    $article = M("article")
            ->alias("a")
            ->field("a.id,a.title,a.list_thumb,ual.reading")
            ->join("left join user_article_list as ual on a.id = ual.article_id")
            ->where("ual.uid=$uid")
            ->limit($num,$num+10)
            ->select();
        $count = M("article")
            ->alias("a")
            ->field("a.title,a.list_thumb,ual.reading")
            ->join("left join user_article_list as ual on a.id = ual.article_id")
            ->where("ual.uid=$uid")
            ->count("ual.id");
        $arr['article']  = $article;
        $arr['count'] = $count;
        $arr['uid'] = $uid;
  	    $this->ajaxReturn($arr);
    }

    # 用户上传文章内容
    public function article_upload(){
  	     $voice = $_POST['voice_id'];
  	     $uid = 12;
  	     $voice = explode(";",$voice);
   	     $result = [];
   	     $del = [];
  	     foreach ($voice as $v){
  	         if($v){
                 $r = $this->get_voice($v);
                 $result[] = '-i Public/voice/'.$r['path'].'.mp3';
                 $del[] = 'Public/voice/'.$r['path'].'.mp3';
  	         }
  	     }
  	     $f = implode(" ",$result);
  	     $count = count($result);
         $uniqid = uniqid();
         // 使用ffmpeg 将多个MP3合成一个
         $newfile = "Public/voice/$uniqid.mp3";
         $exec = "ffmpeg  $f  -filter_complex  '[0:0] [1:0] concat=n=$count:v=0:a=1 [a]' -map [a] $newfile";
         exec($exec,$arr,$status);
         if($status == 0){
             foreach ($del as $k=>$v){
                 require_once( './getid/getid3/getid3.php');
                 $getID3 = new getID3();
                 $ThisFileInfo =$getID3->analyze($v);
                 $fileduration=$ThisFileInfo['playtime_seconds'];
                 $time[] = round($fileduration,2);
             }
             foreach ($del as $v){
                     unlink($v);
             }
             $add['uid'] = $uid;
             $add['article_id'] = $_POST['article_id'];
             $add['create_time'] = date("Y-m-d H:i:s",time());
             $add['voice'] = $newfile;
             $add['time'] = implode(",",$time);
             M("user_article_list")->add($add);
         }
  	}

    # 朗读文章
    public function article_record(){
        $id = $_POST['id'];
        $article = M("article")->field("title,content,thumb")->where("id=$id")->find();
        $article['content'] = explode(',',$article['content']);
        $this->ajaxReturn($article);
    }

    # 获取 access_token
    public function get_access_token(){
        $appid = "wxcc7faa18bb97c18f";
        $secret = "6eaa49432a48e0e55e464e10cfd0810d";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
        $access_token = json_decode(file_get_contents("$url"),true);
        return $access_token['access_token'];
    }

    # 获取上传到微信的音频 并且下载到本地
    public function get_voice($id){
        $path = "Public/voice";
        if(!is_dir($path)){
            mkdir($path);
        }
        $access_token = $this->get_access_token();
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$id";
        $filename = "wxupload_".time().rand(1111,9999);
        $this->downAndSaveFile($url,$path."/".$filename.".amr");
        $data["path"] = $filename;
        $data["msg"] = "download record audio success!";
        $this->transform($path.'/'.$filename.".amr",$filename);
        return $data;
    }

    # mar 转 MP3
    public function transform($path,$filename){
        echo exec("ffmpeg -i $path Public/voice/$filename.mp3",$arr,$status);
        if($status == 0){
            unlink($path);
        }
    }

    # 根据URL地址，下载文件
    public function downAndSaveFile($url,$savePath){
        ob_start();
        readfile($url);
        $img  = ob_get_contents();
        ob_end_clean();
        $size = strlen($img);
        $fp = fopen($savePath, 'a');
        fwrite($fp, $img);
        fclose($fp);

    }

    # 获取签名
    public function sign(){
  	    $id = $_GET['id'];
        $sign =  $this->get_signature($id);
        $this->ajaxReturn($sign);
    }

    public function get_signature($id){

        $appId = "wxcc7faa18bb97c18f";
        $secret ="6eaa49432a48e0e55e464e10cfd0810d";
        $access = json_decode($this->curl_get("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appId&secret=$secret"),true);
        $access_token = $access['access_token'];
        $jsapi_ticket = json_decode($this->curl_get("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$access_token&type=jsapi"),true);
        $ticket = $jsapi_ticket['ticket'];
        $url = $this->get_url($id);
        $noncestr = uniqid();
        $timestamp = time();
        $signature = "jsapi_ticket=$ticket&noncestr=$noncestr&timestamp=$timestamp&url=$url";
        $signature = sha1($signature);
        $sign = ['signature'=>$signature,'timestamp'=>$timestamp,'noncestr'=> $noncestr,'url'=>$url,'appId'=>$appId,'secret'=>$secret];
        return $sign;
    }

    public function curl_get($url){
        $curlobj = curl_init();
        curl_setopt($curlobj, CURLOPT_URL, $url);
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYHOST, FALSE);
        $output = curl_exec($curlobj);
        curl_close($curlobj);
        return $output;
    }

    function get_url($id){
        if($id){
            $geturl = 'https://'.$_SERVER["SERVER_NAME"]."/index.php/home/article/record.html?id=$id";
        }
        return $geturl;
    }

}