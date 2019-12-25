<?php
/*
 *  定时任务
 */
namespace Home\Controller;
use Think\Controller;
class TaskController extends Controller
{

    # 每天 12点 去执行
    public function index(){
        $room = M("room")->select();
        foreach ($room as $k=>$v){
            $id = $v['id'];
            $where['room_id'] = $v['id'];
            $room_user= M("RoomUser")->where($where)->count();
            $num =$v['num'];
            $create_time = strtotime($v['create_time']);
            if($room_user < $num && $create_time < time()){
                $data['status'] = 3;
                $data['failcause'] = '因队员在当日未进行组队成功，挑战组失败';
                $data['last_update_time'] = date("Y-m-d H:i:s",time());
                $update = M("room")->where("id =$id")->save($data);
            }
        }
    }

    # 每日计划  去查找当日完成情况
    public function everyday_plan(){
        # 去room_user 表中查询openid  根据openid 去计划表中查寻制定的计划
        $room_user = M("room")
                    ->alias('r')
                    ->field("r.id,ru.openid,r.create_time,r.start_time")
                    ->join("left join room_user as ru on r.id = ru.room_id")
                    ->where("r.status=1")
                    ->select();
        print_R($room_user);
        exit();
        foreach ($room_user as $k=>$v){
            $where['room_id'] = $v['id'];
            $time = floor((time()-$v['start_time'])/86400);
            if($time == $v['count']){
                $plan_info = M("plan")->where($where)->count();
                if($plan_info){
                    $plan_info1[$v['id']] = $plan_info;
                }
            }
        }
    }

    # floor(当前时间-开始时间/86400) 整数和count对比 必须是等于的情况下才是正确的 否则就是挑战失败

    # 定时脚本   */1 * * * * curl 域名/home/taks/team
    public function team(){
        $room_user = M("room")
            ->alias('r')
            ->field("ru.openid,ru.create_time,u.id")
            ->join("left join room_user as ru on r.id = ru.room_id")
            ->join("left join u_user as u on ru.openid = u.openid")
            ->where("r.status=4")
            ->select();
        print_R($room_user);
        exit();
        foreach ($room_user as $k=>$v){
            $where['uid'] = $v['id'];
            $where['status'] = 1;
            $where['create_time'] = array(array('egt', $v['create_time']), array('elt', date("Y-m-d H:i:s",strtotime($v['create_time'])+1800)));
            $plan_info = M("plan")->where($where)->select();

            if(!$plan_info){
                // 在规定时间内没有制订计划 踢出队伍
                $openid = $v['openid'];
                $r_where['openid'] = $openid;
                $update = M("room_user")->where($r_where)->delete();
                if($update){
                    $insert['cause'] = '未在规定时间内制订计划被系统踢出队伍';
                    $insert['create_time'] = date("Y-m-d H:i:s",time());
                    $insert['room_id'] = $v['id'];
                    $insert['openid'] = $openid;
                    M("out_team")->add($insert);
                }
            }
        }
    }






}