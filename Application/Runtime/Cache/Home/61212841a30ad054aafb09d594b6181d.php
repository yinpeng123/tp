<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <title> 文章内容</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <link rel="stylesheet" href="/Public/index/css/common.css">
</head>
<style>
    /* p { 
        text-indent: 2em;
    } */
    body {
        background: #f5f5f5;
    }

    .article {
        margin: 1rem .5rem;
        margin-bottom: 3.5rem;
    }

    .source, .read, .like {
        color: gray;
    }

    .content > p {
        font-family: cursive;
        text-indent: 2em;
    }

    .btn-area {
        display: flex;
        position: fixed;
        bottom: 0;
        height: 2.8rem;
        left: 0;
        right: 0;
        background: white;
        justify-content: space-around;
        text-align: center;
        align-items: center;
        color: gray;
        font-weight: 600;
        font-size: .5rem
    }

    .listen,
    .play,
    .record {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
    }

    .listen {

        background: url('/Public/index/img/listen.svg') no-repeat center / cover;
    }

    .play {
        width: 1.5rem;
        height: 1.5rem;
        background: url('/Public/index/img/play.svg') no-repeat center / cover;
    }

    .end {
        display: none;
        width: 1.5rem;
        height: 1.5rem;
        background: url('/Public/index/img/end.svg') no-repeat center / cover;
    }

    .record {

        background: url('/Public/index/img/record.svg') no-repeat center / cover;
    }

    audio {
        display: none;
    }
</style>

<body>
<div class="article">
    <h1 class="title" style="font-size:20px">

    </h1>
    <p class="source">作者: <span class="source_name"></span></p>
    <p class="read">阅读量: <span class="read_num"></span></p>
    <img width=100%>
    <div class="content">

    </div>
</div>
<div class="btn-area">
    <div><a href="players.html" class="listen"></a><br></span><span>谁便听听</span></div>
    <div><a class="play"></a><a class="end"></a><br><span class="play_text">原声</span></div>
    <div><a href="record.html" class="record"></a><br><span>我要朗读</span></div>
</div>

<audio preload="auto" src="http://demo.mimvp.com/html5/take_you_fly.mp3">
    你的浏览器版本太低，不支持audio标签
</audio>

<script src="/Public/index/js/common.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script>
<script>
    var time = [];
    var id = getQueryString('id');
    var uid = getQueryString('uid');
    if(uid){
       $('.play_text').text('播放');
        $('.listen').parent().toggle();
        $('.record').parent().toggle();
    }
    var audio = $('audio')[0];
    $.ajax({
        url: '/index.php/home/article/article_detail',
        type: 'POST',
        data: {
            id: id,
            uid: uid
        },
        success: function (data) {
            $('.title').text(data.title);
            $('.source_name').text(data.author);
            $('.read_num').text(data.reading);
            $('.like_num').text(data.like);
            $('.record').attr('href', 'record.html?id=' + data.id);
            $('.listen').attr('href', 'players.html?id=' + data.id + '&title=' + escape(data.title));
            if(uid){
                $('audio').attr('src', 'http://mensan.xyz/' + data.voice);
            }else{
                $('audio').attr('src', 'http://mensan.xyz/' + data.mp3);
            }

            $('img').attr('src', 'http://mensan.xyz/' + data.thumb);

            for (let i = 0; i < data.content.length; i++) {
                $('.content').append('<p id="content' + i + '">' + data.content[i] + '</p>');
            }

            data.time.forEach(element => {
                time.push(element);
            });
        }
    });

    var intver;
    $('.play').click(function () {
        var timesum = 0;
        var timesumlist = [];
        var timecur = 0;
        audio.currentTime = 0;
        audio.play();
        time.forEach(element => {
            timesum += parseFloat(element);
            timesumlist.push(timesum);
        });
        intver = setInterval(function () {
            timecur += .01;
            for (let i = 0; i < timesumlist.length; i++) {
                if (timecur < timesumlist[i] && i == 0) {
                    $('.content>p').eq(0).css('color', 'blue');
                    window.location.href = "#content" + 0;
                } else {
                    if (timecur < timesumlist[i] && timecur > timesumlist[i - 1]) {
                        window.location.href = "#content" + i;
                        $('.content>p').css('color', 'black');
                        $('.content>p').eq(i).css('color', 'blue');
                    }
                }
            }
         
            if (timecur > timesum) {
                clearInterval(intver);
                window.location.href = "#content" + 0;
                $('.content>p').css('color', 'black');
               	$('.end').css('display', 'none');
              	$('.play').css('display', 'inline-block');
            }

        }, 10);

        $(this).toggle();
        $('.end').css('display', 'inline-block');
    });

    $('.end').click(function () {
        audio.currentTime = 0;
        audio.pause();
        clearInterval(intver);
        window.location.href = "#content" + 0;
        $('.content>p').css('color', 'black');
        $(this).css('display', 'none');
        $('.play').toggle();
    })
</script>
</body>

</html>