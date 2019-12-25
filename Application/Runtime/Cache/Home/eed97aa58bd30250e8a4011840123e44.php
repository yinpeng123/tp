<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <title> 用户列表</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <link rel="stylesheet" href="/Public/index/css/common.css">
</head>
<style>
    /* p {
          text-indent: 2em;
      } */
    div {
        font-family: fantasy;
    }
</style>

<body>

<div class="weui-tab">
    <div class="weui-navbar">
        <a class="weui-navbar__item weui-bar__item--on" href="#tab1">
            最新
        </a>
        <a class="weui-navbar__item" href="#tab2">
            最热
        </a>

    </div>
    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <div class="weui-panel weui-panel_access">
                <div class="weui-panel__hd"></div>
                <div class="weui-panel__bd">

                </div>
            </div>
            <div class="weui-infinite-scroll" style="text-align: center;">
                <div class="infinite-preloader"></div>
                <p class="infinite-scroll-text1">正在加载...</p>
            </div>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
            <div class="weui-panel weui-panel_access">
                <div class="weui-panel__hd"></div>
                <div class="weui-panel__bd">

                </div>
            </div>
            <div class="weui-infinite-scroll" style="text-align: center;">
                <div class="infinite-preloader"></div>
                <p class="infinite-scroll-text2">正在加载...</p>
            </div>
        </div>

    </div>
</div>

<script src="/Public/index/js/common.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script>
<script>
    var id = getQueryString('id');
    var title = getQueryString('title');
    $('.weui-panel__hd').text(title);
    $('#tab1').infinite(100);
    $('#tab2').infinite(100);
    var num = 0, num2 = 0;
    var loading1 = false;  //状态标记
    $(document.body).infinite().on("infinite", function () {
        if (loading1) return;
        loading1 = true;
        num += 10;
        $.ajax({
            url: '/index.php/home/article/player_list',
            type: 'POST',
            data: {
                id: id,
                type: 'last',
                num: num
            },
            success: function (data) {
                if(!data.length){
                    $('.infinite-scroll-text1').text('我也是有底线的！');
                }
                data.forEach(element => {
                    $('.weui-panel__bd').eq(0).append('<a href="articleContent.html?id=' + id + '&uid=' + element.uid +
                        '" class="weui-media-box weui-media-box_appmsg"><div class="weui-media-box__hd">' +
                        '<img class="weui-media-box__thumb" src="' + element.pic + '"></div><div class' +
                        '="weui-media-box__bd"><h4 class="weui-media-box__title">' + element.nickname + '</h4><p ' +
                        'class="weui-media-box__desc">阅读量：' + element.reading + '</p></div></a>');

                });
                loading1 = false;
            }
        });
    });

    var loading2 = false;  //状态标记
    $(document.body).infinite().on("infinite", function () {
        if (loading2) return;
        loading2 = true;
        num2 += 10;
        $.ajax({
            url: '/index.php/home/article/player_list',
            type: 'POST',
            data: {
                id: id,
                type: 'hot',
                num: num2
            },
            success: function (data) {
                if(!data.length){
                    $('.infinite-scroll-text2').text('我也是有底线的！');
                }
                data.forEach(element => {
                    $('.weui-panel__bd').eq(1).append('<a href="articleContent.html?id=' + id + '&uid=' + element.uid +
                        '" class="weui-media-box weui-media-box_appmsg"><div class="weui-media-box__hd">' +
                        '<img class="weui-media-box__thumb" src="' + element.pic + '"></div><div class' +
                        '="weui-media-box__bd"><h4 class="weui-media-box__title">' + element.nickname + '</h4><p ' +
                        'class="weui-media-box__desc">阅读量：' + element.reading + '</p></div></a>');

                });
                loading2 = false;
            }
        });
    });

    $.ajax({
        url: '/index.php/home/article/player_list',
        type: 'POST',
        data: {
            id: id,
            type: 'last'
        },
        success: function (data) {
            data.forEach(element => {
                $('.weui-panel__bd').eq(0).append('<a href="articleContent.html?id=' + id + '&uid=' + element.uid +
                    '" class="weui-media-box weui-media-box_appmsg"><div class="weui-media-box__hd">' +
                    '<img class="weui-media-box__thumb" src="' + element.pic + '"></div><div class' +
                    '="weui-media-box__bd"><h4 class="weui-media-box__title">' + element.nickname + '</h4><p ' +
                    'class="weui-media-box__desc">阅读量：' + element.reading + '</p></div></a>');

            })
        }
    });

    $.ajax({
        url: '/index.php/home/article/player_list',
        type: 'POST',
        data: {
            id: id,
            type: 'hot'
        },
        success: function (data) {
            data.forEach(element => {
                $('.weui-panel__bd').eq(1).append('<a href="articleContent.html' + id + '&uid=' + element.uid +
                    '" class="weui-media-box weui-media-box_appmsg"><div class="weui-media-box__hd">' +
                    '<img class="weui-media-box__thumb" src="' + element.pic + '"></div><div class' +
                    '="weui-media-box__bd"><h4 class="weui-media-box__title">' + element.nickname + '</h4><p ' +
                    'class="weui-media-box__desc">阅读量：' + element.reading + '</p></div></a>');
            })
        }
    })
</script>
</body>

</html>