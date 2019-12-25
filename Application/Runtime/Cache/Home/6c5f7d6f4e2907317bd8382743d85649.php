<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
        <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    </head>
    <body>
        <style>
            body{
                margin: 0;
                box-sizing: border-box;
                color: white;
                line-height: 1.3;
                min-height: 100vh;
                background-color: #4a484b;
            }
            .header{
                position: fixed;
                height: 2.5rem;
                width: 100%;
                line-height: 2.5rem;
                font-size: 1.5rem;
                padding-left: 0.8rem;
            }
            .content{
                overflow: hidden;
                min-height: 100vh;
                text-align: center;
            }
            .back-icon{
                background: url('/Public/index/img/back.svg') no-repeat center;
                background-size: cover;
                width: 1rem;
                height: 1rem;
                display: inline-block;
            }
            .title{
                font-size: 1rem;
            }
            .smile-icon{
                background: url('/Public/index/img/smile.svg') no-repeat center;
                background-size: cover;
                width: 5rem;
                height: 5rem;
                display: block;
                margin: 5rem 10%;
                margin-bottom: 3rem;
            }
            button{
                background: #24c68a;
                border-radius: .5rem;
                width: 73%;
                height: 2rem;
                border: none;
                font-size: 1rem;
                color: white;
                margin-top: 1rem;
            }
            p{
                padding: 0 10%;
                text-align: left;
                margin: 5% auto;
            }

        </style>
        <div class="header">
            <span class="back-icon"></span>
            <span class="title">欢迎</span>
        </div>
        <div class="content">
            <div class="smile-icon"></div>
            <p style="font-weight: bold;">身高体重管理</p>
            <p>欢迎来到身高体重小助手</p>
            <p>——</p>
            <p style="font-size: 20px;">接下来希望通过几个小问题，了解您的孩子更多</p>
            <p style="font-size: 15px;">越了解您孩子，越能为他(她)找出准确身高体重数据，祝您孩子收获理想身高</p>
            <button type="button">GO</button>
        </div>
        <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    </body>
    <script>
        $('.back-icon').click(function(){
            history.back();
        })
        $('button').click(function(){
            location.href="congenital.html"
        })
    </script>
</html>