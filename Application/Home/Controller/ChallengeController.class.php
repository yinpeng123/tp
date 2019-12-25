<?php
namespace Home\Controller;
use Home\Model\RoomUserModel;
use Think\Controller;
use Home\Model\NumModel as Num;
use Home\Model\RoomModel as Room;
use Home\Model\UserModel as User;
class ChallengeController extends Controller {


    # 挑战赛入口页面
    public function index(){
        $openid = 2;  // $_GET['openid'];
        $field="u.is_member,r.room_id,u.openid";
        $user = M("user")
            ->alias('u')
            ->field($field)
            ->join("left join room_user as r on u.openid = r.openid")
            ->where("u.openid = $openid and r.is_end = 0")
            ->find();
         $this->assign("user",$user);
         $this->assign("openid",$openid);
        return $this->display();
    }

    # 挑战赛
    public function challenge(){
        $openid =$_POST['openid'];
        $telephone = $_POST['telephone']; // 手机号 查询手机号后6位 匹配的数据
        $type = $_POST['type']; // 1.7日挑战赛  2.21日挑战赛
        if($openid){
            $user_info = M("room_user")->where("openid = $openid and is_end=0")->find();
            # 是否被举报
            $complant = M("complain")->where("status = 1 and openid=$openid")->find();
            $complant_time = (strtotime($complant['complain_time'])+(86400*7));
            if($complant && time()<$complant_time){
                $complant = 1;
            }else{
                $complant = 0;
            }
        }
        if($user_info){
            //我的房间
            $room_id = $user_info['room_id'];
            $result = M('room_user')
                ->alias("ru")
                ->field("u.pic,r.start_time,r.room_name,r.num,r.type")
                ->join("left join user as u on u.openid =ru.openid")
                ->join("left join room as r on ru.room_id = r.id")
                ->where("ru.room_id = $room_id and ru.is_end = 0")
                ->order('ru.create_time asc')
                ->select();
            foreach ($result as $k=>$v){
                $pic[] = $v['pic'];
                $room_name = $v['room_name'];
                $room_people_num = $v['num'];
            }
            $start_time = M("room")->field("start_time")->where("id=$room_id")->find();
            $pic = implode(',',$pic);
            $myroom['room_id']  = $room_id;
            $myroom['type'] = $v['type'];
            $myroom['room_name'] = $room_name;
            $myroom['room_people_num'] = $room_people_num;
            $myroom['headimg'] =  explode(',',$pic);
            $myroom['start_time'] = date("Y-m-d",strtotime($start_time['start_time']));
            if($user_info['is_captain'] == 1){
                $status = 1; //队长
            }else{
                $status = 2; // 队员
            }
        }else{
            $status = 3; // 没加入队伍
        }

        // 查找踢出队伍表中的数据 查询今天是否被踢出队伍  踢出队伍后今天他将看不见被踢出的房间
        if($openid) {
            $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
            $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
            $data['openid'] = $openid;
            $data['create_time'] = array(array('egt', date("Y-m-d H:i:s",$beginToday)), array('elt', date("Y-m-d H:i:s",$endToday)));
            $out_team = M("out_team")->where($data)->select();
            $room_id = array();
            foreach ($out_team as $v){
                $room_id[] = $v['room_id'];
            }
            $room_id = implode(',',$room_id);
        }

        // 正常显示
        if(!isset($telephone) && $type){
            $where['r.is_end'] = 0;
            $where['r.type'] = $type;
            $where['r.is_display'] = 1;
            $where['r.id'] = array('not in',$room_id);
            $where['r.status'] = 4;
            $room_user = M("room")
                        ->alias('r')
                        ->field("ru.room_id,u.nickname,r.start_time,r.room_name,u.pic,u.telephone,r.num")
                        ->join("left join room_user as ru on r.id = ru.room_id")
                        ->join("left join user as u on ru.openid=u.openid")
                        ->where($where)
                        ->order("r.create_time desc,ru.create_time asc")
                        ->select();
            if($room_user){
                $newdata = array();
                $room_info = array();
                foreach ($room_user as $k=>$v){
                    $room_info[$v['room_id']][] = $v;
                }
                $room_info = array_values($room_info);
                foreach ($room_info as $v){
                    $pic = array();
                    foreach ($v as $item){
                        $pic[] = $item['pic'];
                    }
                    $pic = implode(',',$pic);
                    $newdata[] = array(
                        'room_id' =>$item['room_id'],
                        'room_name'=>$item['room_name'],
                        'headimg'=>explode(',',$pic),
                        'start_time' =>date("Y-m-d",strtotime($item['start_time'])),
                        'room_people_num'=>$item['num']
                    );
                }
            }
            $array = array("status"=>$status,'info'=>$newdata,'myroom'=>$myroom,'complaint'=>$complant);
            $this->ajaxReturn($array);
        }elseif($telephone && $type){
            // 通过手机号后6位搜索
            $user_result = M("User")->query("select openid from user  where substring(telephone,6,11)=$telephone");

            foreach ($user_result as $k=>$v){
                 $openid[] = $v['openid'];
            }
            $openid = implode(',',$openid);
            $room_where['ru.openid'] = array('in',$openid);
            $room_where['r.type'] = $type;
            $room_where['r.is_display'] = 2;
            $room_where['r.status'] = 4;
            $room_where['r.is_end'] = 0;
            $room_result = M("room")->alias("r")->field("ru.room_id")->where($room_where)->join("left join room_user as ru on r.id = ru.room_id")->select();
            $room_id = array();
            foreach ($room_result as $v){
                $room_id[] = $v['room_id'];
            }
            $room_user_where['ru.room_id'] = array("in",implode(",",$room_id));
            $room_user = M("room")
                ->alias('r')
                ->field("ru.room_id,u.nickname,r.start_time,r.room_name,u.pic,r.num")
                ->join("left join room_user as ru on r.id = ru.room_id")
                ->join("left join user as u on ru.openid=u.openid")
                ->where($room_user_where)
                ->order("r.create_time desc,ru.create_time asc")
                ->select();
            foreach ($room_user as $k=>$v){
                $room_info[$v['room_id']][] = $v;
            }
            $room_info = array_values($room_info);

            if($room_info){
                    $newdata = array();
                    foreach ($room_info as $v){
                        $nickname = array();
                        $pic= array();
                        foreach ($v as $item){
                            $pic[] =  $item['pic'];
                        }
                        $pic =implode(',',$pic);
                        $newdata[] = array(
                            'room_id' =>$item['room_id'],
                            'room_name'=>$item['name'],
                            'headimg'=>explode(',',$pic),
                            'start_time' =>date("Y-m-d",strtotime($item['start_time'])),
                            'room_people_num'=>$item['num']
                        );
                    }
                $array = array('info'=>$newdata,'complaint'=>$complant);
                $this->ajaxReturn($array);
            }
        }
        return $this->display();
    }

    public function createteam(){
        return $this->display();
    }

    #创建队伍
    public function create_team(){
        $insert['name'] = $_POST['room_name'];
        $insert['num'] = $_POST['people_num'];
        $insert['start_time'] = $_POST['start_time'];
        $insert['status'] = 4;
        $insert['type'] = $_POST['type'];
        $insert['is_display'] = $_POST['is_display'];
        $insert['create_time'] = date("Y-m-d H:i:s",time());
        $insert['is_end'] = 0;
        $id = M("room")->add($insert);
        if($id){
            $data['room_id'] = $id;
            $data['openid'] = $_POST['openid'];
            $data['is_end'] = 0;
            $data['create_time'] = date("Y-m-d H:i:s",time());
            $data['is_captain'] = 1;
            $data['status'] = 1;
            $add=M("room_user")->add($data);
            if($add){
                $this->ajaxReturn(array("room_id"=>$id));
            }
        }
    }


    # 房间信息
    public function room_info(){
        $room_id = $_POST['room_id'];
        if($room_id){
            $room = M("room")->where("id = $room_id")->find();
            $room_info['start_time'] = date("Y-m-d",strtotime($room['start_time']));
            if($room['type'] == 1){
                $room_info['end_time'] = date("Y-m-d",strtotime($room['start_time'])+(7*86400));
            }else{
                $room_info['end_time'] = date("Y-m-d",strtotime($room['start_time'])+(21*86400));
            }
            $arr = array("room_info"=>$room_info);
            $this->ajaxReturn($arr);
        }
    }

    public function makingplan(){
        return $this->display();
    }


    # 加入队伍
    public function join_team(){
        $rid = $_POST['room_id'];
        $type = $_POST['type'];
        if($rid) {
            $where['id'] = $rid;
            $room = M("room")->where("type=$type and id=$rid")->find();
            $room_info['start_time'] = date("Y-m-d",strtotime($room['start_time']));
            if($room['type'] == 1){
                $room_info['end_time'] = date("Y-m-d",strtotime($room['start_time']) + (7*86400));
            }else{
                $room_info['end_time'] = date("Y-m-d",strtotime($room['start_time']) + (21*86400));
            }
            $room_user_count = M("room_user")->where("room_id=$rid")->count();
            if ($room_user_count < $room['num']) {
                $data['room_id'] = $rid;
                $data['openid'] = $_POST['openid'];
                $data['create_time'] = date("Y-m-d H:i:s",time());
                $data['status'] = 1;
                $data['is_end'] = 0;
                $data['is_captain'] = 2;
                $result = M("room_user")->add($data);
                if ($result) {
                    $arr = array("room_info"=>$room_info,"msg"=>'队伍加入成功');
                    $this->ajaxReturn($arr);
                }
            } else {
                $arr = array("room_info"=>$room_info,"msg"=>'加入队伍失败，队伍已满');
                $this->ajaxReturn($arr);
            }
        }
    }

    # 上传图片
    public function upload(){
        header("Access-Control-Allow-Origin: *");
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     200000000 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      'Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =      ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());

        }else{// 上传成功
            $this->success('上传成功！');
        }
        return $info;
    }


    #投诉
    public function complain(){
        $upload = $this->upload();
        foreach($upload as $k=>$v){
             $insert[$k] = 'public/Uploads/'.$v['savepath'].$v['savename'];
        }
        $insert['openid'] = $_POST['openid'];
        $insert['pic'] = implode(',',$insert);
        $insert['room_id'] = $_POST['room_id'];
        $insert['complainant'] = $_POST['complainant'];
        $insert['by_complainant'] = $_POST['by_complainant'];
        $insert['complain_time'] = date("Y-m-d H:i:s",time());
        $insert['complainant_cause'] = $_POST['complainant_cause'];
        $insert['status'] = 0;
         $insert = M('complain')->add($insert);
         if($insert){
             echo '投诉成功';
         }
    }


    # 我的挑战
    public function mychallenge(){
        $openid = $_POST['openid'];
        if($openid){
            $user = M("room_user")->where("openid = $openid and is_end=0")->find();
            if($user){
                $rid = $user['room_id'];
                $result = M('room_user')
                    ->alias("r")
                    ->join("left join user as u on u.openid =r.openid")
                    ->where("room_id = $rid and is_end = 0")
                    ->order('r.create_time asc')
                    ->select();
                foreach ($result as $k=>$v){
                    $nickname[] = $v['nickname'];
                    $pic[] = $v['pic'];
                }
                $nickname = implode(',',$nickname);
                $pic = implode(',',$pic);
                $room_info = M("Room")
                    ->field("id,start_time,type")
                    ->where("id = $rid and is_end = 0")
                    ->find();
                if($room_info['type'] == 1){
                    $endtime = strtotime($room_info['start_time']) + (86400*7);
                    $type = 7; //  7天挑战赛
                }else{
                    $endtime = strtotime($room_info['start_time']) + (86400*21);
                    $type = 21; // 21天挑战赛
                }
                $time = floor(($endtime-time()) /86400);
                $room['room_id']  = $rid;
                $room['type'] = $type;
                $room['days'] = $time;
                $room['pic'] =  explode(',',$pic);
                $room['nickname'] = explode(',',$nickname);
                $this->ajaxReturn($room, 'json');
            }
        }
        $this->display();
    }

    # 聊天记录
    public function msgall(){
        $room_id = $_POST['room_id'];
        $openid  =$_POST['openid'];
        $type = $_POST['type'];  // 1.聊天 2打卡 3 官方提示
        if($room_id && $openid){
            if($type){
                $where['type'] = $type;
            }
            $where['m.room_id'] = $room_id;
            $field = "m.room_id,m.msg,m.create_time,u.pic,u.nickname,u.openid,m.type";
            $msg = M("room_msg")
                ->alias('m')
                ->join("left join user as u on m.openid = u.openid")
                ->where($where)
                ->field($field)
                ->order("m.create_time asc")
                ->select();
            $room  = M("room")->where("id = $room_id")->find();
            $room_info['status'] = $room['status'];
            $time = ceil(((strtotime($room['last_update_time'])+86400)-time())/3600);
            $room_info['failcause'] = $room['failcause'] .'距离群组解散还有'.$time.'小时';
            $arr = array("msg"=>$msg,"room"=>$room_info);
            $this->ajaxReturn($arr);
        }
    }

    # 发送消息
    public function entermsg(){
            $insert['room_id'] = $_POST['room_id'];
            $insert['openid'] = $_POST['openid'];
            $insert['msg'] = $_POST['msg'];
            $insert['create_time'] = date("Y-m-d H:i:s");
            $insert['type'] = 1; //1:聊天 2:打卡
            $insert = M("room_msg")->add($insert);
            if($insert){
                $openid = $_POST['openid'];
                $user = M("user")->field("nickname,pic")->where("openid =$openid ")->find();
                $this->ajaxReturn($user);
            }
    }

    # 挑战记录
    public function challenge_record(){
            $openid =2;
            $room = M("room_user")
                ->where("openid=$openid")
                ->group("room_id")
                ->order("create_time desc")
                ->select();
            foreach ($room as $k=>$v){
                $rid = $v['room_id'];
                $room_user[$k] = M("room")
                    ->alias('r')
                    ->field("ru.room_id,u.nickname,r.start_time,r.room_name,u.pic,r.num,r.type,r.status")
                    ->join("left join room_user as ru on r.id = ru.room_id")
                    ->join("left join user as u on ru.openid=u.openid")
                    ->where("ru.room_id = $rid and r.is_end =0")
                    ->order("r.create_time desc,ru.create_time asc")
                    ->select();
            }

            $newdata = array();
            foreach ($room_user as $v){
                $pic= array();
                $nickname = array();
                foreach ($v as $item){
                    $pic[] =  $item['pic'];
                    $nickname[] = $item['nickname'];
                }
                $pic =implode(',',$pic);
                $nickname = implode(',',$nickname);
                $newdata[] = array(
                    'room_id' =>$item['room_id'],
                    'nickname'=>explode(',',$nickname),
                    'headimg'=>explode(',',$pic),
                    'start_time' =>date("Y.m.d",strtotime($item['start_time'])),
                    'type'=>$item['type'],
                    'status'=>$item['status'],
                    'num'=>$item['num'],
                );
            }
        $this->ajaxReturn($newdata);

    }


    #  退出队伍
    public function exit_team(){
        $room_id = $_POST['room_id'];
        $openid = $_POST['openid'];
        $user = M("user")->where("openid = $openid")->find();
        $nickname = $user['nickname'];
        $room_user['status'] =2;
        $update_room_user = M("room_user")->where("openid = $openid and room_id = $room_id")->save($room_user);
        $room['status'] = 3;
        $room['failcause'] = $nickname.'退出队伍,组队失败';
        $room['last_update_time'] = date("Y-m-d H:i:s",time());
        $update = M("room")->where("id = $room_id")->save($room);
    }



    # 挑战完成显示信息
    public function challenge_complete(){
        $openid = $_POST['openid'];
        $user = M("user")->where("openid = $openid")->find();
        $info['nickname'] = $user['nickname'];
        $info['headimg'] = $user['pic'];
        $arr = array('user_info'=>$info);
        $this->ajaxReturn($arr);
    }

    # 点赞 点踩
    public function like(){
        $openid = $_POST['openid'];
        $user =  M("user")->field('nickname')->where("openid = $openid")->find();
        $insert['room_id'] = $_POST['room_id'];
        $insert['openid'] = $_POST['openid'];
        $insert['msg'] = $user['nickname'].'给'.$_POST['msg'].'点了一个'.$_POST['givedis'];
        $insert['type'] =3; // 官方提示
        $insert['create_time'] = date("Y-m-d H:i:s");
        $insert = M("room_msg")->add($insert);
        if($insert){
            $arr = array('msg'=>'成功');
            $this->ajaxReturn($arr);
        }
    }


    # 制定计划
    public function formulate_plan(){
        $openid = $_POST['openid'];
        $palan = $_POST['plan'];
        if($palan){
            foreach ($palan as $k=>$v){
                $insert['plan_time'] = $v['planTime']; // 每个计划的时间
                $insert['plan'] = $v['planText'];
                $insert['openid'] = $openid;
                $insert['status'] = 0;
                $insert['create_time'] = date("Y-m-d H:i:s",time());
                $insert = M("plan")->add($insert);
                if($insert){
                    $arr = array("msg"=>"制定计划完成","status"=>1);
                    $this->ajaxReturn($arr);
                }
             }
        }
    }






    # 打卡记录上传图片
    public function clock_record(){
        $upload = $this->upload();
        $insert['pic'] = 'public/Uploads/'.$upload['savepath'].$upload['savename'];
        $insert['openid'] = $_POST['openid'];
        $insert['create_time'] = date("Y-m-d H:i:s",time());
        $insert = M("clock_record")->add($insert);
        if($insert){
            $arr = array('msg'=>'打卡完成');
            $this->ajaxReturn($arr);
        }
    }



}