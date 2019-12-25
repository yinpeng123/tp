<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title></title>
	<link rel="prefetch" href="/Public/index/css/MyChallenge.css" />
	<link rel="stylesheet" href="/Public/index/css/index.css" />
	<link rel="stylesheet" type="text/css" href="/Public/index/css/footer.css"/>
</head>
<script>
    /(iPhone|iPad|iPhone OS|Phone|iPod|iOS)/i.test(navigator.userAgent)&&(head=document.getElementsByTagName('head'),viewport=document.createElement('meta'),viewport.name='viewport',viewport.content='target-densitydpi=device-dpi, width=480px, user-scalable=no',head.length>0&&head[head.length-1].appendChild(viewport));
</script>
<body  id="body" style="visibility: hidden;">
<div id="header">
	<div class="header">
		<div class="header_arrow">
			<div class="_arrow"></div>
		</div>
		<div class="toChallenge_con">
			<div class="toChallenge_box">

			</div>
			<div class="toChallenge">
				<a href="ChallengeTheRecord.html" class="toChallenge_rel"></a>
			</div>
		</div>
		<div class="toconquer_con">
			<div class="toconquer_conone">

			</div>
			<div class="toconquer_contwo">
				<div class="toconquer_21 conquer"><a href="challenge.html?type=2&openid=oOFIN5KLlAEwjUiuVC-nzogxE2hk" class="conquer"></a></div>
				<div class="toconquer_7 conquer"><a href="challenge.html?type=1&openid=<?php echo ($openid); ?>" class="conquer"></a></div>
				<div class="toconquer_my conquer"><a href="mychallenge.html?room_id=<?php echo ($openid); ?>" class="conquer"></a></div>
			</div>
		</div>
	</div>

	<div class="manifesto_con">
		<div class="keep"></div>
		<div class="manifesto_one">
			<div class="manifesto_box_one">
				<div class="box_one_left">

				</div>
				<div class="box_one_right">
					<p class="tagline">点击报名 创建队伍</p>
					<p class="tagline_one mid">报名挑战赛，组上小伙伴</p>
					<p class="tagline_one">一起赢积分，媷羊毛</p>
				</div>
			</div>
		</div>
		<div class="manifesto_two">
			<div class="manifesto_box_two">
				<div class="box_two_left">
					<p class="taglinetwo">制定计划 共同成长</p>
					<p class="tagline_two mid">当挑战赛开始后，计划将不</p>
					<p class="tagline_two">可进行更改，人满开车</p>
				</div>
				<div class="box_two_right">

				</div>
			</div>
		</div>
		<div class="manifesto_three">
			<div class="manifesto_box_three">
				<div class="box_three_left">

				</div>
				<div class="box_three_right">
					<p class="tagline">完成挑战，赢取双倍积分</p>
					<p class="tagline_three mid">挑战赛开始后，有队员</p>
					<p class="tagline_three">退出小组将视为挑战失败</p>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	#pop-up{
		display: none;
		z-index: 99;
		position: absolute;
		left: 50%;
		top: 50%;
		margin-left: -4rem;
		margin-top: -2.5rem;
		width: 8rem;
		height: 4.5rem;
		background: #F7F7F7;
	}
	.p_con{
		width: 100%;
		height: 1.6rem;
		background: #1b2434;
		overflow: hidden;
	}
	.p_con>p:nth-child(1){
		width: 100%;
		margin-top: 0.5rem;
		font-size:0.586666rem;
		color: #FACC16;
		text-align: left;
		padding-left: 0.8rem;
	}
	.warm{
		margin-top: 0.133333rem;
		font-size: 0.426666rem;
		color: #288597;
	}
	.warm_one{
		margin-top: 0.466666rem;
	}
	.tishi{
		 overflow: hidden;
	 }
	.tishi_r{
		margin-left: 0.573333rem;
		float: left;
	}
	.btn_cont>button:nth-child(1){
		background: #1e9fff;
		border: 1px solid #1e9fff;
		color: white;
	}
	.btn{
		font-size: 0.366666rem;
		width: 2.4rem;
		height: 0.826666rem;
		border: 1px solid #d9dcdf;
	}
	.btn_cont{
		float: right;
		margin-right: 0.186666rem;
		margin-top: 0.2rem;
	}
	.doi
</style>
<div id="pop-up">
	<div class="p_con">
		<p>开通会员</p >
	</div>
	<div class="tishi">

		<div class="tishi_r">

			<p class="warm warm_one">请前去开通会员</p >
			<p class="warm">开通会员才有权限参加挑战赛</p >
		</div>
	</div>
	<div class="btn_cont">
		<button class="btn">确定</button>
	</div>
</div>


<!--<div id="footer">-->
	<!--<div>-->
		<!--<div class="footer_img footer_home"></div>-->
		<!--<div>首页</div>-->
	<!--</div>-->
	<!--<div>-->
		<!--<div class="footer_img footer_com"></div>-->
		<!--<div>社区</div>-->
	<!--</div>-->
	<!--<div>-->
		<!--<div class="footer_img footer_mine"></div>-->
		<!--<div>我的</div>-->
	<!--</div>-->
<!--</div>-->
</body>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.3.0.js"></script>
<script src="http://g.tbcdn.cn/mtb/lib-flexible/0.3.2/??flexible_css.js,flexible.js"></script>
<script src="/Public/layui/jquery.min.js"></script>
<script type="text/javascript">
    document.getElementById('body').style.visibility = "visible";

    $(document).ready(function() {

        var member = "<?php echo ($user["is_member"]); ?>"
		if(member == "0") {
			$("#pop-up").css("display","block")
		}
    })

	$(".btn").click(function () {
		window.location.href="https://www.baidu.com"
    })



</script>
</html>