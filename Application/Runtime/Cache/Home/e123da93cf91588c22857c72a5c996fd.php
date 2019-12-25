<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title></title>
	</head>
	<style>
		*{
			margin: 0;
			padding: 0;
		}
		#app{
			width: 100vw;
			margin: auto;
		}
		#header{
			width: 100vw;
			height: 17.3vw;
			background: #4891e0;
			color: white;
			text-align: center;
			line-height: 17.3vw;
			font-size: 5vw;
		}
		#content{
			background: #f1f1f1;
		}
		#main{
			position: relative;
			margin: auto;
			width: 90vw;
			height:161.4vw;
			background: white;
		}
		#main_header{
			position: absolute;
			left: -4vw;
			top: 5.3vw;
			width: 98vw;
			height: 16vw;
			background: url(../images/263a17e5e17eab4376dded6d1e3cc9d_03.png) no-repeat center;
			background-size:100% 100%;
		}
		#main_result{
			position: relative;
			margin: auto;
			padding-top: 21.6vw;
			width: 90vw;
			height: 57vw;
			border-bottom: 1vw solid #efefef;
			box-sizing: border-box;
		}
		#log{
			position: absolute;
			top: 27.4vw;
			width: 6.4vw;
			height: 3.2vw;
			background: url(../images/263a17e5e17eab4376dded6d1e3cc9d_07.png) no-repeat center;
			background-size:100% 100%;
		}
		#result{
			margin-top:8.2vw;
			padding-left: 13.3vw;
			font-size: 3.8vw;
		}
		#result_num{
			font-size: 4.5vw;
			color: #e22d00;
		}
		.text_result{
			margin:9.3vw auto 0;
			width: 60vw;
			height: 4vw;
			font-size: 4vw;
		}
		.text_l{
			float: left;
		}
		.text_r{
			float: right;
			color: #E22D00;
		}
		#btn{
			display: block;
			margin:11.7vw auto 0;
			width: 72vw;
			height: 10.6vw;
			background: #1c80fd;
			color: white;
			font-size: 3.7vw;
			border-radius: 4.5vw;
			outline: none;
		}
		#result_num{
			margin-left: 6vw;
		}
		.color{
			color: #4ec046;
		}
	</style>
	<body>
	<div id="app">
		<div id="header">
			查视力
		</div>
		<div id="content">
			<div id="main">
				<div id="main_header"></div>
				<div id="main_result">
					<div id="log">
						
					</div>
					<div id="result">
						<div>
							<span id="result_text">色盲：</span>
							<span id="result_num">80%</span>
						</div>
						<div style="margin-top:5.3vw;" id="result_slogan">
							你有很大的几率是色盲症患者
						</div>
					</div>
				</div>
				<div>
					<div class="text_result">
						<div class="text_l">视力检测</div>
						<div class="text_r" id="text_r_one">未检测</div>
					</div>
					<div class="text_result">
						<div class="text_l">色盲测试</div>
						<div class="text_r" id="text_r_two">未检测</div>
					</div>
					<div class="text_result">
						<div class="text_l">散光测试</div>
						<div class="text_r" id="text_r_three">未检测</div>
					</div>
				</div>
				<button id="btn">确定</button>
			</div>
		</div>
	</div>
	</body>
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript">
		$('#btn').click(function(){
			window.location.href ='../index.html' 
		})
		var astigmatism = getQueryString('astigmatism');
		var color_percent = getQueryString('color_percent');
		var vision_see = getQueryString('vision_see');
		
		if (astigmatism != null) {
			$('#result_text').text('散光检测');
			$('#text_r_three').addClass('color');
			if (astigmatism==1) {
				$('#result_num').text('疑似');
				$('#result_slogan').text('您有散光的症状');
				$('#text_r_three').text('疑似');
			} else{
				$('#result_num').text('正常');
				$('#result_slogan').text('恭喜你没有散光的症状');
				$('#text_r_three').text('正常');
			}
			sessionStorage.setItem("astigmatism", astigmatism);
		}else{
			var value = sessionStorage.getItem("astigmatism");
			if(value != null){
				$('#text_r_three').addClass('color');
				if(value == 1){
					$('#text_r_three').text('疑似');
				}else{
					$('#text_r_three').text('正常');
				}
			}
		}
		
		if (color_percent != null) {
			$('#result_text').text('色盲');
			$('#text_r_two').addClass('color');
			$('#result_num').text(color_percent+'%');
			$('#text_r_two').text(color_percent+'%');
			if (color_percent>50) {
				$('#result_slogan').text('您有很大的几率是色盲症患者');
			}else if(color_percent == 0){
				$('#result_slogan').text('恭喜你没有色盲症状');
			}else{
				$('#result_slogan').text('刚才状态不好，再试一次');
			}
			sessionStorage.setItem("color_percent", color_percent);
		} else {
			var value1 = sessionStorage.getItem("color_percent");
			if(value1 != null){
				$('#text_r_two').text(value1+'%');
				$('#text_r_two').addClass('color');
			}
			
		}
		
		if (vision_see != null) {
			$('#text_r_one').text(vision_see);
			$('#text_r_one').addClass('color');
			$('#result_text').text('您的视力为');
			$('#result_num').text(vision_see);
			if(vision_see<4){
				$('#result_slogan').text('您的度数600+，请及时佩戴眼镜。');
			}else if(4.3>vision_see){
				$('#result_slogan').text('您的度数450,您的视力已经严重近视');
			}else if(vision_see==4.4){
				$('#result_slogan').text('您的度数400,您的视力已经严重近视');
			}else if(vision_see==4.5){
				$('#result_slogan').text('您的度数350,您的视力已经比较近视');
			}else if(vision_see==4.6){
				$('#result_slogan').text('您的度数300,您的视力已经比较近视');
			}else if(vision_see==4.7){
				$('#result_slogan').text('您的度数250,您的视力已经比较近视');
			}else if(vision_see==4.8){
				$('#result_slogan').text('您的度数200,您的视力已经轻微近视');
			}else if(vision_see==4.9){
				$('#result_slogan').text('您的度数150,您的视力已经轻微近视');
			}else if(vision_see==5){
				$('#result_slogan').text('您的度数100,您的视力已经轻微近视');
			}else{
				$('#result_slogan').text('您的视力良好');
			}
			sessionStorage.setItem("vision_see", vision_see);
		} else {
			var value2 = sessionStorage.getItem("vision_see");
			if(value2!=null){
				$('#text_r_one').text(value2);
				$('#text_r_one').addClass('color');
			}
			
		}
		// 获取地址栏参数
		function getQueryString(name) {
			var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
			var r = window.location.search.substr(1).match(reg);
			if (r != null) {
			return unescape(r[2]);
			}
			return null;
		}
	</script>
</html>