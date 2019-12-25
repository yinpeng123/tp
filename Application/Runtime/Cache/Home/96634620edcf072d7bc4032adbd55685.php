<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="初音未来版本的通过点击/触摸播放声音并出现变化图案的互动内容。">
  <title>减压游戏</title>
  <link rel="apple-touch-icon" href="icon.png">
  <link href="https://fonts.loli.net/css?family=Quicksand:400" rel="stylesheet">
  <link charset="UTF-8" href="/Public/index/shared/sp/css/common.css" rel="stylesheet">
  <link charset="utf-8" href="/Public/index/css/mikutap.css" rel="stylesheet">
  <script charset="utf-8" src="https://cdnjs.loli.net/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
  <script charset="utf-8" src="https://cdnjs.loli.net/ajax/libs/pixi.js/3.0.11/pixi.min.js" type="text/javascript"></script>
  <script charset="utf-8" src="https://cdnjs.loli.net/ajax/libs/gsap/1.19.1/TweenMax.min.js" type="text/javascript"></script>
  <script charset="UTF-8" src="/Public/index/shared/js/common-2.min.js" type="text/javascript"></script>
  <script charset="utf-8" src="/Public/index/js/mikutap.min.js" type="text/javascript"></script>
</head>

<body>
  <div id="view"></div>
  <div id="scene_top">
    <h1>请点击释放压力</h1>
    <div id="ng">
      <p class="atten">十分抱歉<br>您的浏览器并不支持本页面需要的特性</p>
    </div>
    <div class="ok">
      <p id="bt_start"><a href="" style="font-size: 2.5rem;">!开始!</a></p>
    </div>

    <div class="ok">
      <p class="attention">※开始尽情释放你的压力吧！！
        ！</p>
    </div>
  </div>
  <div id="scene_loading">
    <hr size="1" color="#fff"> </div>
  <div id="scene_main">
    <div class="set">
      <p class="attention">点击 &amp; 拖动或者按任意键!</p>
      <p id="bt_backtrack"><a href="">背景音乐: 开启</a></p>
    </div>
  </div>
  <div id="about_cover"></div>

</body>

</html>