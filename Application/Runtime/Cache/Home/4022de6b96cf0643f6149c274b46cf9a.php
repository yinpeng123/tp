<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <script src="/Public/index/js/cal.js"></script>
</head>

<body>
<style>
    body {
        margin: 0;
        box-sizing: border-box;
        color: black;
        line-height: 1.3;
        min-height: 100vh;
        background-color: white;
    }

    .header {
        position: fixed;
        height: 2.5rem;
        width: 100%;
        line-height: 2.5rem;
        background: white;
        font-size: 1.5rem;
        padding-left: 0.8rem;
    }

    .content {
        overflow: hidden;
        min-height: 100vh;
        text-align: center;
    }

    .back-icon {
        background: url('/Public/index/img/back_black.svg') no-repeat center;
        background-size: cover;
        width: 1rem;
        height: 1rem;
        display: inline-block;
    }

    .title {
        font-size: 1rem;
    }

    .sologan {
        background: -o-linear-gradient(#473486, #5b40a9); /* Opera 11.1 - 12.0 */
        background: -moz-linear-gradient(#473486, #5b40a9); /* Firefox 3.6 - 15 */
        background: linear-gradient(#473486, #5b40a9); /* 标准的语法 */
        background: -webkit-linear-gradient(#473486, #5b40a9);
        height: 6rem;
        margin: 2rem auto;
        margin-bottom: 1.3rem;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #button {
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

    .content > p {
        padding: 0 10%;
        text-align: left;
    }

    label {
        display: block;
        width: 80%;
        text-align: left;
        margin: .7rem auto;
        font-size: .7rem;
        font-weight: bold;
    }

    input {
        display: inline-block;
        width: 73%;
        height: 2rem;
        outline: none;
        border-radius: .5rem;
        border-style: solid;
        border-color: lightgray;
        border-width: thin;
        font-size: .7rem;
        padding: 0 .5rem;
    }

</style>
<div class="header">
    <span class="back-icon"></span>
    <span class="title">先天条件测试</span>
</div>
<div class="content">
    <div class="sologan">
        <p style="margin-bottom: 0;font-size:1.4rem;">科学、精准</p>
        <p style="color:whitesmoke; font-size:.7rem;">全方位预测未来身高和当前身高</p>
    </div>
    <label>1.你的生日：</label>
    <input type="text" id="birthday" name="birthday" placeholder="请输入您的生日"/>
    <label>2.你的性别：</label>
    <input type="text" id="sex" name="sex" placeholder="请输入您的性别"/>
    <label>3.你的当前身高是：</label>
    <input type="text" id="height" name="height" placeholder="请输入您的当前身高"/>
    <label>4.你的当前体重是：</label>
    <input type="text" id="weight" name="weight" placeholder="请输入您的当前体重"/>
    <label>5.你的期望身高是：</label>
    <input type="text" id="expectation" name="expectation" placeholder="请输入您的期望身高"/>
    <label>6.你爸爸的身高是：</label>
    <input type="text" id="father" name="father" placeholder="请输入您父亲的身高"/>
    <label>7.你妈妈的身高是：</label>
    <input type="text" id="mother" name="mother" placeholder="请输入您母亲的身高"/>
    <label>8.你平时的心率是：</label>
    <input type="text" id="heart" name="heart" placeholder="请输入您平时的心率"/>
    <label>9.你一般几点睡觉：</label>
    <input type="text" id="sleep" name="sleep" placeholder="请输入您平时的入睡时间"/>
    <label>10.你一般几点起床：</label>
    <input type="text" id="getup" name="getup" placeholder="请输入您平时的起床时间"/>
    <button type="button" id="button">继续</button>
</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script>

<script>
    $('.back-icon').click(function () {
        history.go(-1);
    });
    var height = [];
    for (let i = 50; i <= 250; i++) {
        height.push(i + 'cm');
    }
    ;
    var weight = [];
    for (let i = 25; i <= 150; i++) {
        weight.push(i + 'kg');
    }
    ;
    var heart = [];
    for (let i = 30; i <= 160; i++) {
        heart.push(i + '次/分');
    }
    ;
    var current = new Date();
    var minDate = new Date(current);
    minDate.setFullYear(current.getFullYear() - 23);
    var minDateString = minDate.toLocaleDateString().replace(/\//g, '-');
    var maxDateString = current.toLocaleDateString().replace(/\//g, '-');
    $("#birthday").calendar({
        dateFormat: 'yyyy-mm-dd',
        minDate: minDateString,
        maxDate: maxDateString,
        onChange: function (p, values, displayValues) {
            // sessionStorage.setItem("birthday", values[0]);
        }
    });
    $("#sex").picker({
        title: "请选择您的性别",
        cols: [
            {
                textAlign: 'center',
                values: ['男', '女']
            }
        ],
        onChange: function (p, values, displayValues) {
            sessionStorage.setItem("sex", values[0]);
        }
    });

    $("#height").picker({
        title: "请选择您的当前身高",
        cols: [
            {
                textAlign: 'center',
                values: height
            }
        ],
        value: ['170cm'],
        onChange: function (p, values, displayValues) {
            sessionStorage.setItem("height", values[0]);
        }
    });
    $("#weight").picker({
        title: "请选择您的当前体重",
        cols: [
            {
                textAlign: 'center',
                values: weight
            }
        ],
        value: ['60kg'],
        onChange: function (p, values, displayValues) {
            sessionStorage.setItem("weight", values[0]);
        }
    });
    $("#expectation").picker({
        title: "请选择您的期望身高",
        cols: [
            {
                textAlign: 'center',
                values: height
            }
        ],
        value: ['175cm'],
        onChange: function (p, values, displayValues) {
            sessionStorage.setItem("expectation", values[0]);
        }
    });
    $("#father").picker({
        title: "请选择您父亲的身高",
        cols: [
            {
                textAlign: 'center',
                values: height
            }
        ],
        value: ['175cm'],
        onChange: function (p, values, displayValues) {
            sessionStorage.setItem("father", values[0]);
        }
    });
    $("#mother").picker({
        title: "请选择您母亲的身高",
        cols: [
            {
                textAlign: 'center',
                values: height
            }
        ],
        value: ['165cm'],
        onChange: function (p, values, displayValues) {
            sessionStorage.setItem("mother", values[0]);
        }
    });

    $("#heart").picker({
        title: "请选择您平时的心率",
        cols: [
            {
                textAlign: 'center',
                values: heart
            }
        ],
        value: ['70次/分'],
        onChange: function (p, values, displayValues) {
            // sessionStorage.setItem("heart", values[0]);
        }
    });
    $("#sleep").picker({
        title: "请选择您平时的睡觉时间",
        cols: [
            {
                textAlign: 'center',
                values: ['8点', '8点半', '9点', '9点半', '10点', '10点半', '11点', '11点半', '12点', '12点半', '1点', '1点半', '2点', '2点半']
            }
        ],
        value: ['10点半'],
        onChange: function (p, values, displayValues) {
            // sessionStorage.setItem("sleep", values[0]);
        }
    });
    $("#getup").picker({
        title: "请选择您平时的起床时间",
        cols: [
            {
                textAlign: 'center',
                values: ['4点', '4点半', '5点', '5点半', '6点', '6点半', '7点', '7点半', '8点', '8点半', '9点', '9点半', '10点', '10点半']
            }
        ],
        value: ['7点半'],
        onChange: function (p, values, displayValues) {
            //
        }
    });
    $('.back-icon').click(function () {
        history.back();
    });
    $.toast.prototype.defaults.duration = 1000;
    $('#button').click(function () {
        for (var i = 0; i < $('input[type="text"]').length; i++) {
            if ($($('input[type="text"]')[i]).val() == '') {
                $.toast("不可以有为空的选项", 'text');
                return false;
            }
        }
        var genetic = cal.genetic($('#father').val().slice(0, -2), $('#mother').val().slice(0, -2), 180, 170);
        var bmi = cal.getBMI($('#height').val().slice(0, -2), $('#weight').val().slice(0, -2)).bmi;
        var bmiScore = cal.getScore(bmi, 21, 21);
        var heartBeat = cal.heartBeat($('#sex').val(), $('#heart').val().slice(0, -3), 80, 85);
        var sleeptime;
        if ($('#sleep').val().slice(-2, -1) == '点') {
            sleeptime = Math.round($('#sleep').val().slice(0, -2)) + .5;
        } else {
            sleeptime = Math.round($('#sleep').val().slice(0, -1))
        }
        var getuptime;
        if ($('#getup').val().slice(-2, -1) == '点') {
            getuptime = Math.round($('#getup').val().slice(0, -2)) + .5;
        } else {
            getuptime = Math.round($('#getup').val().slice(0, -1));
        }
        var sleep = cal.sleep(sleeptime, 10);
        var getup = cal.sleep(getuptime, 7);
        sessionStorage.setItem("genetic", genetic);
        sessionStorage.setItem("bmi", bmi);
        sessionStorage.setItem("bmiScore", bmiScore);
        sessionStorage.setItem("heartBeat", heartBeat);
        sessionStorage.setItem("gobed", sleep);
        sessionStorage.setItem("getup", getup);
        sessionStorage.setItem("quality", (heartBeat + sleep + getup) / 3);
        location.href = "sport.html";
    })

</script>
</body>

</html>