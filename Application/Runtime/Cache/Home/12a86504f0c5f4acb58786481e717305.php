<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>挑战页面</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="/Public/index/css/MyChallenge.css"/>
	<link rel="stylesheet" href="/Public/index/css/footer.css" />
	<link rel="stylesheet" href="/Public/index/css/anyOtherBusiness.css" />
	<script type="text/javascript" src="/Public/index/js/vconsole.min.js"></script>
	<script type="text/javascript">
        var vConsole = new VConsole();
	</script>
</head>
<script>
    /(iPhone|iPad|iPhone OS|Phone|iPod|iOS)/i.test(navigator.userAgent)&&(head=document.getElementsByTagName('head'),viewport=document.createElement('meta'),viewport.name='viewport',viewport.content='target-densitydpi=device-dpi, width=480px, user-scalable=no',head.length>0&&head[head.length-1].appendChild(viewport));
</script>
<body  id="body" style="visibility: hidden;">
<div class="header">
	<div class="arrow_con">
		<div class=""></div>
	</div>
	<div>
		<div class="mychallenge">我的挑战</div>
		<div>
			<div class="header_left">
				<span>今日</span><br />
				<span id="time" class="font">2018.12.12</span>
			</div>
			<div class="header_right">
				<span>桌号</span><br />
				<span id="room" class="font"></span>
			</div>
		</div>
	</div>
	<div class="header_content">
		<div class="ball"><img src="/Public/index/img/logo9.svg"/></div>
		<div></div>
		<div>
			挑战剩余<span class="remaining">20</span>天
		</div>
		<div class="bar">
			<div>
				<div class="bar_left">

				</div>
				<div class="bar_right">
					<div class="bar_ball"></div>
					<div class="bar_inform"><div class="triangle"></div>已经完成<span id="residue">1</span>天</div>
				</div>
			</div>
		</div>
		<div class="member">
			<div>
				<div class="member_infor">
					<div class="member_portrait">
						<img src="/Public/index/img/logo9.svg"/>
					</div>
					<div class="member_name">
						成员名字多长
					</div>
				</div>
				<div class="member_infor le_two">
					<div class="member_portrait">
						<img src="/Public/index/img/logo9.svg"/>
					</div>
					<div class="member_name">
						成员名字多长
					</div>
				</div>
				<div class="member_infor le_two">
					<div class="member_portrait">
						<img src="/Public/index/img/logo9.svg"/>
					</div>
					<div class="member_name">
						成员名字多长
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="nav">
	<div>
		<div class="nav_lsit">
			<span  class='active'>全部</span>
		</div>
		<div class="nav_lsit">
			<span>聊天</span>
		</div>
		<div class="nav_lsit">
			<span>打卡记录</span>
		</div>
	</div>
</div>
<div class="main">
	<div class="main_time">
		<span>2018.11.29</span>
	</div>
	<div class="chat_content">
		<div class="main_plan">
			<div class="plan">
				<div class="user_photo photo_l user_photo_other">
					<img src="/Public/index/img/jointeam.svg" name="'+msg[i].nickname+'"/>
				</div>
				<ul class="click_box">
					<div class="trian"></div>
					<li class="givelike">给他个<i class="icones praoseone"></i></li>
					<li class="givedis">给他个<i class="icones praosetwo "></i></li>
					<li class="givecomp">投诉TA<i class="icones compsu "></i></li>
				</ul>
				<div class="plan_con">
					<div>今日计划<span class="plan_font">跑步</span></div>
					<div>事件<span class="plan_font">60</span>分钟</div>
				</div>
				<div class="plan_img">
					<img src="/Public/index/img/jointeam.svg"/>
				</div>
			</div>
		</div>
	</div>
	<div class="char_set">
		<input type="text" name="char_box" id="char_box" value="" />
		<button class="btn">发送</button>
	</div>
</div>




<div class="main_failure">
	<div class="main_failure_header"></div>
	<div class="main_con">
		<div class="goUnder">FAlL</div>
		<p class="main_defeated">糟糕</p>
		<p class="main_defeated last">本次挑战失败了</p>
		<p class="main_defeatedtwo">失败原因：<span id="">由于队友中途退出</span></p>
		<p class="main_defeatedtwo lasttwo">不要灰心呦，再接再厉。加油！</p>
		<button id="affirm">好吧，我接受现实</button>
		<p class="main_defeatedtwo top">如果你觉得队友很Nice的话，</p>
		<p class="main_defeatedtwo">就和他要<span class="iphone">手机后六位</span>吧，</p>
		<p class="main_defeatedtwo">一起挑战一起飞。</p>
	</div>
</div>
</body>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://g.tbcdn.cn/mtb/lib-flexible/0.3.2/??flexible_css.js,flexible.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.3.0.js"></script>
<script type="text/javascript" src="/Public/index/js/MyChallenge.js"></script>

<script type="text/javascript">
    document.getElementById('body').style.visibility = "visible";
</script>
</html>