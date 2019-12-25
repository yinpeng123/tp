<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<title></title>
	<link rel="stylesheet" href="/Public/index/css/height.css" />
	<link rel="stylesheet" type="text/css" href="/Public/index/css/footer.css" />
	<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
	<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
</head>

<body>
<div id="header">

</div>
<div id="content">
	<!-- <div class="nav_con clearfix">
        <div class="nav active">身高管理</div>
        <div class="nav">大脑数据</div>
        <div class="nav">视力数据</div>
    </div> -->
	<div class="slogan_con clearfix">
		<div class="slogan_left">
			<div>
				<span class="font_blod">HEIGHT</span><br />
				Detection Manager
			</div>
		</div>
		<div class="slogan_right">
			今日数据
		</div>
	</div>
	<div class="tag_con">
		<div class="tag">
			<div class="tagone">营养</div>
			<div class="tagtwo font_blod time">2019.12.25<br />17:00</div>
			<div class="tagthree" id="nutrition">28</div>
		</div>
		<div class="tag">
			<div class="tagone">遗传</div>
			<div class="tagtwo font_blod time">2019.12.25<br />17:00</div>
			<div class="tagthree" id="genetic">68</div>
		</div>
		<div class="tag">
			<div class="tagone">锻炼</div>
			<div class="tagtwo font_blod time">2019.12.25<br />17:00</div>
			<div class="tagthree" id="sport">98</div>
		</div>
		<div class="tag">
			<div class="tagone">预测身高</div>
			<div class="tagtwo font_blod time">2019.12.25<br />17:00</div>
			<div class="tagthree" id="expHeight">98</div>
		</div>

	</div>
</div>
<div id="article">
	<div class="report">
		<div class="report_one">
			<div class="report_header">
				<div class="report_icon"></div>
				<div class="report_text">睡眠报告</div>
			</div>
			<div class="report_arile">
				<div class="report_arile_left"><span id="quality">65</span>分</div>
				<div class="report_arile_right">
					<div class="report_arile_con clearfix">
						<img src="/Public/index/images/heart.png" class="report_arile_img" />
						<div class="report_arile_text" id="heartBeat">75%</div>
					</div>
					<div class="report_arile_con clearfix">
						<img src="/Public/index/images/sleep.png" class="report_arile_img" />
						<div class="report_arile_text" id="gobed">75%</div>
					</div>
					<div class="report_arile_con clearfix">
						<img src="/Public/index/images/getup.png" class="report_arile_img" />
						<div class="report_arile_text" id="getup">75%</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mood bmi" id="healths">
		<div class="bmi_nav clearfix">
			<div class="mood_nav_icon"></div>
			<div class="bmi_nav_text">健康值</div>
			<div class="fernand_right" id="healthsnumber">88%</div>
		</div>
		<div class="health_img" id="health_img">

		</div>
	</div>
	<div class="bmi" id="bmi">
		<div class="bmi_nav clearfix">
			<div class="bmi_nav_icon"></div>
			<div class="bmi_nav_text">BMI值</div>
			<div class="fernand_right" id="Bmi">20</div>
		</div>
		<div class="bmi_img" id="bmi_img">

		</div>
	</div>
	<div class="mood bmi" id="mood">
		<div class="bmi_nav clearfix">
			<div class="mood_nav_icon"></div>
			<div class="bmi_nav_text">心情</div>
			<div class="fernand_right" id="humor">88%</div>
		</div>
		<div class="mood_img" id="mood_img">

		</div>
	</div>
	<div class="mental bmi" id="mental">
		<div class="bmi_nav clearfix">
			<div class="mental_nav_icon"></div>
			<div class="bmi_nav_text">精神压力</div>
			<div class="fernand_right" id="spirit">100%</div>
		</div>
		<div class="mental_img" id="mental_img">

		</div>
	</div>
</div>
<div id="footer">
	<div>
		<div class="footer_img footer_home"></div>
		<div>首页</div>
	</div>
	<div>
		<div class="footer_img footer_com"></div>
		<div>社区</div>
	</div>
	<div>
		<div class="footer_img footer_mine"></div>
		<div>我的</div>
	</div>
</div>
</body>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script>
<script type="text/javascript" src=" http://cdn.bootcss.com/jquery-resize/1.1/jquery.ba-resize.js"></script>
<script type="text/javascript" src="/Public/index/js/echarts.min.js"></script>
<script type="text/javascript" src="/Public/index/js/height.js"></script>
<script>
    myChart.showLoading();
    myChart1.showLoading();
    myChart2.showLoading();
    myChart3.showLoading();
    function getItem(name) {
        if (!Math.round(sessionStorage.getItem(name))) {
            return sessionStorage.getItem(name);
        } else {
            return Math.floor(sessionStorage.getItem(name) * 10) / 10;
        };
    }
    //从session中取出数据并渲染到页面
    var time = sessionStorage.getItem('time');
    $('.time').text(time);
    var nutrition = getItem('nutrition');
    $('#nutrition').text(nutrition);
    var genetic = getItem('genetic');
    $('#genetic').text(genetic);
    var sport = getItem('sport');
    $('#sport').text(sport);
    var quality = getItem('quality');
    $('#quality').text(quality);
    var gobed = getItem('gobed');
    $('#gobed').text(gobed + '%');
    var getup = getItem('getup');
    $('#getup').text(getup + '%');
    var heartBeat = getItem('heartBeat');
    $('#heartBeat').text(heartBeat + '%');
    var bmi = getItem('bmi');
    var bmiScore = getItem('bmiScore');
    $('#Bmi').text(bmi);
    var humor = getItem('humor');
    $('#humor').text(humor + '%');
    var spirit = getItem('spirit');
    $('#spirit').text(spirit + '%');
    var health = getItem('health');
    $('#health').text(health);
    $('#healthsnumber').text(health + '%');
    var expHeight = getItem('expHeight');
    $('#expHeight').text(expHeight);
    $.ajax({
        url: '/index.php/Home/topic/result_info',
        type: 'POST',
        data: {
            openid: '123456'
        }, success: function (data) {
            // 调整最后一个数据的样式
            function getEffectScatterData(name) {
                var effectScatterData = [];
                for (var i = 0; i < data[name].length; i++) {
                    if (i == data[name].length - 1) {
                        effectScatterData.push({ value: data[name][i], symbolSize: 8 });
                        continue;
                    }
                    effectScatterData.push(data[name][i]);
                }
                return effectScatterData
            }

            // 更新图表数据
            var eScaData = getEffectScatterData('bmi');
            myChart.hideLoading();
            myChart.setOption({
                xAxis: {
                    data: data.create_time
                },
                series: [
                    {
                        name: 'line',
                        data: data.bmi
                    }, {

                        name: 'scat',
                        data: eScaData

                    }
                ]
            });

            var eScaData1 = getEffectScatterData('humor');
            myChart1.hideLoading();
            myChart1.setOption({
                xAxis: {
                    data: data.create_time
                },
                series: [
                    {
                        name: 'line',
                        data: data.humor
                    }, {

                        name: 'scat',
                        data: eScaData1

                    }
                ]
            });

            var eScaData2 = getEffectScatterData('spirit');
            myChart2.hideLoading();
            myChart2.setOption({
                xAxis: {
                    data: data.create_time
                },
                series: [
                    {
                        name: 'line',
                        data: data.spirit
                    }, {

                        name: 'scat',
                        data: eScaData2

                    }
                ]
            });

            var eScaData3 = getEffectScatterData('health');
            myChart3.hideLoading();
            myChart3.setOption({
                xAxis: {
                    data: data.create_time
                },
                series: [
                    {
                        name: 'line',
                        data: data.health
                    }, {

                        name: 'scat',
                        data: eScaData3

                    }
                ]
            });
        }

    })
</script>

</html>