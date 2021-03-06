<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <title>首页</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <link rel="stylesheet" href="/Public/index/css/common.css">

</head>
<style>
    /* p { 
        text-indent: 2em;
    } */
</style>

<body>
<div class="weui-panel weui-panel_access">
    <div class="weui-panel__hd">我已完成<span class="article_num"></span>篇文章</div>
    <div class="weui-panel__ft">
        <a href="articleList.html" class="weui-cell weui-cell_access weui-cell_link">
            <div class="weui-cell__bd">朗读更多文章</div>
            <span class="weui-cell__ft"></span>
        </a>
    </div>
    <div class="weui-panel__bd">

    </div>

</div>

<div class="weui-footer weui-footer_fixed-bottom">
    <p class="weui-footer__text">Copyright © 2018-2019 yp</p>
</div>

<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script>
<script>
    $('body').infinite(100);
    var num = 0;
    var uid = 12;
    var loading1 = false;  //状态标记
    $(document.body).infinite().on("infinite", function () {
        if (loading1) return;
        loading1 = true;
        num += 10;
        $.ajax({
            url: '/index.php/home/article/my_article',
            type: 'POST',
            data: {
                uid: uid,
                num: num
            },
            success: function (data) {
                data.article.forEach(element => {
                    $('.weui-panel__bd').append('<a href="articleContent.html?id=' + element.id + '&uid=' + data.uid +
                        '" class="weui-media-box weui-media-box_appmsg"><div class="weui-media-box__hd">' +
                        '<img class="weui-media-box__thumb" src="http://mensan.xyz/' + element.list_thumb + '"></div><div class' +
                        '="weui-media-box__bd"><h4 class="weui-media-box__title">' + element.title + '</h4><p ' +
                        'class="weui-media-box__desc">阅读量：' + element.reading + '</p></div></a>');

                });
                loading1 = false;
            }
        });
    });


    $.ajax({
        url: '/index.php/home/article/my_article',
        type: 'POST',
        data: {
            uid: uid
        },
        success: function (data) {
            $('.article_num').text(data.count);
            data.article.forEach(element => {
                $('.weui-panel__bd').append('<a href="articleContent.html?id=' + element.id + '&uid=' + data.uid +
                    '" class="weui-media-box weui-media-box_appmsg"><div class="weui-media-box__hd">' +
                    '<img class="weui-media-box__thumb" src="http://mensan.xyz/' + element.list_thumb + '"></div><div class' +
                    '="weui-media-box__bd"><h4 class="weui-media-box__title">' + element.title + '</h4><p ' +
                    'class="weui-media-box__desc">阅读量：' + element.reading + '</p></div></a>');

            })
        }
    });

</script>
</body>

</html>