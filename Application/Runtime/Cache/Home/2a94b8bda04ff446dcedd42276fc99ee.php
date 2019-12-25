<?php if (!defined('THINK_PATH')) exit();?><html style="height:100%">

<head>
    <style>
        html,body{
            margin:0px;
            padding:0px;
        }
        .menu{
            width:100%;
            height:100%;
            background-image: url("/Public/eyesight/images/bg.jpg");
            background-size: 100% 100%;
        }
        .menu ul{
            padding-top:40%;
        }
        .menu ul li{
            list-style-type:none;
            width:60%;
            height:100px;
            line-height:100px;
            font-size:30px;
            background-color:#ffffff;
            margin-left:19%;
            text-align:center;
            border-radius:10px;
        }
    </style>
</head>
<body style="height:100%">

<div class="menu">
    <ul>
        <li class="height">身高测试</li>
        <br/><br/><br/>
        <li class="eye">视力测试</li>
        <br/><br/><br/>
        <li class="game">游戏测试</li>
        <br/><br/><br/>
        <li class="study">阅读学习</li>
        <br/><br/><br/>
		<li class="cardStudy">卡片学习</li>
    </ul>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>

     $(".height").click(function () {
         window.location.href= "/index.php/Home/test/index.html"
     })
     $(".eye").click(function () {
         window.location.href= "/index.php/Home/eyesight/index.html"
     })
     $(".game").click(function () {
         window.location.href= "http://120.76.56.15/index.html"
     })
     $(".study").click(function () {
         window.location.href= "/index.php/home/article/articleList.html"
     })
     $(".cardStudy").click(function () {
         window.location.href= "/index.php/home/study/index.html"
     })
    
</script>



</html>