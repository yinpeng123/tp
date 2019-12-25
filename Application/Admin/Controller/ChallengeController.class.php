<?php
namespace Admin\Controller;
use Think\Controller;
class ChallengeController extends Controller {

    # 房间信息
    public function index(){
        if(!empty($_POST['status'])){
            $where['status'] = $_POST['status'];
        }
        if(!empty($_POST['type'])){
            $where['type'] = $_POST['type'];
        }
        if(!empty($_POST['time'])){
            $order['create_time'] = $_POST['time'];
        }
        if(!empty($_POST['user']) && !empty($_POST['keywords'])){
            if($_POST['user'] =="nickname"){
                $where['nickname'] = $_POST['keywords'];
            }else{
                $where['telephone'] = $_POST['keywords'];
            }
        }
        $count = M("Room")
                ->alias("r")
                ->join("left join room_user as ru on r.id = ru.room_id")
                ->join("left join u_user as us on ru.openid = us.openid")
                ->where($where)
                ->order($order)
                ->count();
        $Page = Page($count);
        $order['r.id'] = 'desc';
        $field = "r.id,r.create_time,r.status,r.type,r.status,r.failcause,us.nickname";
        $result = M("Room")
                ->alias("r")
                ->field($field)
                ->join("left join room_user as ru on r.id = ru.room_id")
                ->join("left join u_user as us on ru.openid = us.openid")
                ->where($where)
                ->order($order)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        $arr= array();
        foreach ($result as $key => $info) {
            $arr[$info['id']][] = $info;
        }
        $room = array_values($arr);
        $newdata = array();
        foreach ($room as $v){
            $nickname = array();
            foreach ($v as $item){
                $nickname[] = $item['nickname'];
            }
            $nickname = implode(',',$nickname);
            $newdata[] = array(
                'id' => $item['id'],
                'create_time' => $item['create_time'],
                'type' => $item['create_time'],
                'status' => $item['create_time'],
                'create_time' => $item['create_time'],
                'failcause' =>$item['failcause'],
                'nickname'=>explode(',',$nickname),
            );
        }
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('room_info',$newdata);
        return $this->display();
    }

    # 投诉列表
    public function complain(){
        if(isset($_POST['status'])){
            if($_POST['status'] == 0){
                $where['status'] = 0;
            }elseif ($_POST['status'] == 1){
                $where['status'] = 1;
            }else{
                $where['status'] = 2;
            }
        }
        if(!empty($_POST['params']) && isset($_POST['keywords'])){
            if($_POST['parmas'] == 1){
                $where['telephone'] = $_POST['keywords'];
            }else{
                $where['nickname'] = $_POST['keywords'];
            }
        }
        if(isset($where)){
            $count = M("complain")->alias("c")->join("left join u_user as u on c.openid = u.openid")->where($where)->count();
            $Page = Page($count);
            $info = M("complain")->alias("c")->join("left join u_user as u on c.openid = u.openid")->where($where)->order("c.complain_time desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        }else{
            $count = M("complain")->count();
            $Page = Page($count);
            $info = M("complain")->order("complain_time desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        }
        foreach ($info as $k=>$v){
            $info[$k]['pic'] = explode(',',$v['pic']);
        }
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign("info",$info);
        return $this->display();
    }

    # 投诉审核
    public function audit(){
        $post = I("post.");
        if($post){
            $status['status'] = $_POST['status'];
            $id = $_POST['id'];
            $room_id = $_POST['room_id'];
            $update = M("complain")->where("id=$id")->save($status);
            if($update){
                if($status['status'] != 2){
                    $room_info = M("room")->where("id = $room_id")->find();
                    if($room_info['status'] != 3){
                        $data['status'] = 3;
                        $data['failcause'] = "因队员发言被投诉,挑战组取消";
                        $data['last_update_time'] = date("Y-m-d H:i:s",time());
                        $room_update = M("room")->where("id = $room_id")->save($data);
                        if($room_update){
                            return $this->success("审核成功");
                        }else{
                            return $this->error("审核失败");
                        }
                    }else{
                        return $this->error("挑战已取消,不需要重复操作");
                    }
                }else{
                    return $this->success("拒绝审核成功");
                }
            }else{
                return $this->error("已审核成功,不需要重复操作");
            }
        }else{
            return $this->error("缺少参数");
        }
    }


}