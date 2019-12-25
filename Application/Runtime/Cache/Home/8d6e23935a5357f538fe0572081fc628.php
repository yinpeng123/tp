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
        min-height: 100vh;
        background-color: white;
        line-height: 1.3;
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
    .content>div{
        position: relative;
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

    label {
        display: block;
        width: 80%;
        text-align: left;
        margin: .7rem auto;
        margin-top: 4.5rem;
        font-size: .7rem;
        font-weight: bold;
    }

    input, #add {
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
        margin: .3rem 0;
    }

    #add {
        background: whitesmoke;
        width: 73%;
        margin: .5rem;
        box-sizing: content-box;
        font-size: 1.5rem;
        color: gray;
    }

    .colse{
        background: url(/Public/index/images/close.svg) no-repeat center;
        width: 10%;
        height: 50%;
        background-size: contain;
        position: absolute;
        top: 25%;
        right: 11%;
    }

</style>
<div class="header">
    <span class="back-icon"></span>
    <span class="title">运动条件测试</span>
</div>
<div class="content">
    <label>请选择您日常的运动类型，以及相应的每周运动次数和每次运动时间(分钟)</label>
    <div>
        <input type="text" id="sport0" name="sport0" placeholder="请选择您的运动类型"/>
        <span class="colse"></span>
    </div>

    <button type="button" id="add">+</button>
    <button type="button" id="button">继续</button>
</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script>
<script src="/Public/index/js/cal.js"></script>
<script>
    var count = 1;
    $('.back-icon').click(function () {
        history.go(-1);
    });
    var types = ['慢跑', '快跑', '跑上楼', '自由泳', '蛙泳', '蝶泳', '足球', '篮球', '兵乓球', '羽毛球', '网球', '单车慢', '单车快', '健身', '跳绳', '登山', '舞蹈'];
    var mets = [19.0, 27.0, 42.0, 21.0, 27.0, 30.0, 22.0, 16.5, 9.0, 15.0, 15.0, 9.0, 15.0, 10.5, 27, 15.0, 10.5];
    var time = [];
    for (let i = 1; i <= 140; i += 10) {
        time.push(i + '分钟/次');
    }

    var freq = [];
    for (let i = 1; i <= 30; i++) {
        freq.push(i + '次');
    }

    $("#sport0").picker({
        title: "请选择您的运动详情",
        cols: [
            {
                textAlign: 'left',
                values: types
            },
            {
                textAlign: 'center',
                values: time
            },
            {
                textAlign: 'right',
                values: freq
            }
        ],
        value: [types[0], '11分钟/次', '5次']
    });

    $('.back-icon').click(function () {
        history.back();
    });

    $('#add').click(function () {
        $(this).before('<div><input type="text" id="sport' + count + '" name="sport' + count + '" placeholder="请选择您的运动类型"/><span class="colse"></span></div>');
        $('.colse').unbind();
        $('.colse').click(function(){
            $(this).parent().remove();
        })
        $("#sport" + count).picker({
            title: "请选择您的运动详情",
            cols: [
                {
                    textAlign: 'left',
                    values: types
                },
                {
                    textAlign: 'center',
                    values: time
                },
                {
                    textAlign: 'right',
                    values: freq
                }
            ],
            value: [types[count], '11分钟/次', '5次'],
        });
        count++;
    })

    $('.colse').click(function(){
        $(this).parent().remove();
    })

    $.toast.prototype.defaults.duration = 1000;
    $('#button').click(function () {
        var sum = 0;
        for (var i = 0; i < $('input[type="text"]').length; i++) {
            if ($($('input[type="text"]')[i]).val() == '') {
                $.toast("不可以有为空的选项", 'text');
                return false;
            } else {
                let sportValues = $($('input[type="text"]')[i]).val().split(" ");
                let ty = sportValues[0];
                let freq = sportValues[2].slice(0, -1);
                let time = sportValues[1].slice(0, -4);
                sum += time * freq * mets[types.indexOf(ty)];
            }
        }
        var sport = cal.getScore(sum/60,100, 100);
        sessionStorage.setItem('sport',sport);
        location.href = "nutritional.html";
    })

</script>
</body>

</html>