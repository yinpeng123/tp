<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
	<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
	<title>Document</title>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
		}

		body {
			min-height: 100vh;
			background: #eff3f6;
		}

		.header {
			position: fixed;
			top: 0;
			height: 2.5rem;
			width: 100%;
			line-height: 2.5rem;
			background: white;
			padding-left: 0.8rem;
			font-size: 1.5rem;
		}

		.back-icon {
			background: url('/Public/index/img/back_black.svg') no-repeat center;
			background-size: cover;
			width: 1rem;
			height: 1rem;
			display: inline-block;
			vertical-align: middle;
		}

		.title {
			font-size: 1rem;
			vertical-align: middle;
		}

		#topic_con {
			margin-top: 2.5rem;
			overflow: hidden;
		}

		.topic {
			font-size: .8rem;
			margin-top: 1rem;
		}

		.btn {
			display: block;
			width: 73%;
			margin: .5rem auto 0;
			border: thin solid #c4c4c4;
			border-radius: 1rem;
			text-align: center;
			line-height: 1.6;
			background: white;
			padding: .2rem;
		}

		.active {
			color: white;
			background: #26c68a;
		}

		.topic_text {
			padding-left: 2rem;
			font-weight: bold;
		}

		#footer {
			text-align: center;
		}

		#btn {
			background: #24c68a;
			border-radius: .5rem;
			width: 70%;
			height: 2rem;
			border: none;
			font-size: 1rem;
			color: white;
			margin: 1.3rem auto;
			outline: none;
		}
	</style>
</head>

<body>
	<div class="header">
		<span class="back-icon"></span>
		<span class="title" id="title">营养条件测试</span>
	</div>
	<div id="topic_con">
	</div>
	<div id="footer">
		<button id="btn">继续</button>
	</div>
	<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script>
	<script src="/Public/index/js/cal.js"></script>
	<script>
		var types = ['food', 'humor', 'spirit'];
		var typeCount = 0;
		getData(types[typeCount]);

		$('.back-icon').click(function () {
			if (typeCount == 0) {
				history.back();
			}
			typeCount--;
			getData(types[typeCount]);

		})
		// 点击一次继续获取一次题目
		function getData(type) {
			switch (type) {
				case 'food':
					$('#title').text('营养水平测试')
					break;
				case 'humor':
					$('#title').text('心情水平测试')
					break;
				case 'spirit':
					$('#title').text('压力水平测试')
					break;
				default:
					break;
			}


			$.ajax({
				url: '/index.php/Home/topic/topic',
				type: 'POST',
				data: {
					type: type
				},
				success: function (data) {
					console.log(data)
					var i = 1;
					for (var topic of data) {
						var html = '<div class="topic" weight="' + topic.weight + '" title="' + topic.title + '" id="topic' + topic.id + '"><div class="topic_text">' + i + '. ' + topic.title + '</div></div>';
						$('#topic_con').append(html);
						i++;
						var j = 0;
						for (var answer of topic.result.answer) {
							if (answer == '') {
								continue;
							}
							var html = '<div class="btn" score="' + topic.result.score[j] + '">' + answer + '</div>'
							$('#topic' + topic.id).append(html);
							j++;
						}
					}
					$('.btn').click(function () {
						$(this).addClass('active');
						$(this).siblings('.btn').removeClass('active')
						// var data = {
						// 	"id": $(this).parent().attr('id'),
						// 	"score": $(this).attr('score'),
						// 	"weight": $(this).parent().attr('weight'),
						// };
						// sessionStorage.setItem($(this).parent().attr('title'), data);
					})
				}
			})

		}


		$('button').click(function () {
			if ($('.btn.active').length < $('.topic').length) {
				$.toast("不可以有为空的选项", 'text');
				return false;
			}
			var nutritions = [];
			for (var i = 0; i < $('.topic').length; i++) {
				var weight = $($('.topic')[i]).attr('weight');
				var score = $($('.btn.active')[i]).attr('score');
				nutritions.push({
					fraction: score,
					weight: weight
				})
			}
			var nutrition = cal.nutrition(nutritions, 4);
			switch (types[typeCount]) {
				case 'food':
					sessionStorage.setItem('nutrition', nutrition);
					break;
				case 'humor':
					sessionStorage.setItem('humor', nutrition);
					break;
				case 'spirit':
					sessionStorage.setItem('spirit', nutrition);
					break;
				default:
					break;
			}
			$('#topic_con').empty();
			typeCount++;
			function getItem(name) {
				if (!Math.round(sessionStorage.getItem(name))) {
					return sessionStorage.getItem(name);
				} else {
					return Math.round(sessionStorage.getItem(name));
				};
			}
			// 填题结束，计算结果
			if (typeCount > 2) {
				var time = new Date().toLocaleDateString().replace(/\//g, '-');
				sessionStorage.setItem('time', time);
				var nutrition = getItem('nutrition');
				var genetic = getItem('genetic');
				var quality = getItem('quality');
				var gobed = getItem('gobed');
				var getup = getItem('getup');
				var heartBeat = getItem('heartBeat');
				var bmi = getItem('bmi');
				var bmiScore = getItem('bmiScore');
				var humor = getItem('humor');
				var spirit = getItem('spirit');
				var height = getItem('height');
				var weight = getItem('weight');
                var sport = getItem('sport');
				var father = Math.round(getItem('father').slice(0, -2));
				var mother = Math.round(getItem('mother').slice(0, -2));
				var sex = getItem('sex');
				var health = (nutrition + quality + gobed + getup + heartBeat + bmiScore + humor + sport + 100 - spirit) / 9;
				sessionStorage.setItem('health', health);
				var exp;
				if (sex == '男') {
					pre = (father + mother + 13) / 2;
				} else {
					pre = (father + mother - 13) / 2;
				}
				var expHeight = pre + (health - 50) * 0.16;
				sessionStorage.setItem('expHeight', expHeight);
				// 将测试结果发送到服务器
				$.ajax({
					url: '/index.php/Home/topic/result',
					type: 'POST',
					data: {
						'openid': 123456,
						'time': time,
						'nutrition': nutrition,
						'genetic': genetic,
						'quality': quality,
						'gobed': gobed,
						'getup': getup,
						'heartBeat': heartBeat,
						'bmi': bmi,
						'humor': humor,
						'spirit': spirit,
						'health': health,
						'expHeight': expHeight
					},
					success: function () {
						location.href = "result.html";
					}
				})
				return;
			}
			getData(types[typeCount]);
		})

	</script>
</body>

</html>