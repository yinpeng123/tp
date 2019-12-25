<?php
namespace Home\Controller;
use Think\Controller;
class TopicController extends Controller {


    # 返回题目数据
    public function  topic()
    {
        header("Access-Control-Allow-Origin:*");
        if ($_POST['type'] == 'food') {
            $post = 1;
        } elseif ($_POST['type'] == 'humor') {
            $post = 2;
        } elseif ($_POST['type'] = 'spirit') {
            $post = 3;
        } elseif ($_POST['sport'] = 'sport'){
            $post = 4;
        }
        if($post){
            $topic = M("topic_content")->where("tid = $post")->select();
        }
        foreach($topic as $k=>$v){
                $topic[$k]['result'] = unserialize($v['result']);
        }
        $this->ajaxReturn($topic);
    }


    # 测评结果数据插入
    public function  result()
    {
        header("Access-Control-Allow-Origin:*");
        $post = I("post.");
        if ($post) {
            $insert['genetic'] = $post['genetic'];
            $insert['bmi'] = $post['bmi'];
            $insert['heartBeat'] = $post['heartBeat'];
            $insert['openid'] = $post['openid'];
            $insert['nutrition'] = $post['nutrition'];
            $insert['quality'] = $post['quality'];
            $insert['gobed'] = $post['gobed'];
            $insert['getup'] = $post['getup'];
            $insert['humor'] = $post['humor'];
            $insert['spirit'] = $post['spirit'];
            $insert['create_time'] = date("Y-m-d H:i:s");
            $insert['health'] = $post['health'];
            $insert['expHeight'] = $post['expHeight'];
            $result = M("answer_result")->add($insert);
            if ($result) {
                return $this->ajaxReturn("测评成功");
            }else{
                return $this->ajaxReturn("测评失败");
            }
        }
    }

    # 测评结果信息
    # 根据 openid 去查询
    public function result_info(){
        header("Access-Control-Allow-Origin:*");
        $openid = 123456;
        $info = M("answer_result")->where("openid = $openid")->order("create_time desc")->select();
        $bmi = array();
        $humor = array();
        $spirit = array();
        $create_time = array();
        $health = array();
        foreach ($info as $k=>$v){
            array_unshift($bmi,$v['bmi']);
            array_unshift($humor,$v['humor']);
            array_unshift($spirit,$v['spirit']);
            array_unshift($create_time,$v['create_time']);
            array_unshift($health,$v['health']);
            $result['nutrition'] = $v['nutrition'];
            $result['genetic'] = $v['genetic'];
            $result['quality'] = $v['quality'];
            $result['gobed'] = $v['gobed'];
            $result['getup'] = $v['getup'];
            $result['heartBeat'] = $v['heartbeat'];
            $result['health'] = $health;
            $result['expHeight'] = $v['expHeight'];
            $result['create_time'] = $create_time;
            $result['bmi'] = $bmi;
            $result['humor'] = $humor;
            $result['spirit'] = $spirit;
        }
        $this->ajaxReturn($result);
    }



}