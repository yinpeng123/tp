<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/Public/layui/css/layui.css"  media="all">

  <style>

    .delete{
      margin-right: 60px;
      margin-top: 10px;
      margin-left: 50px;
      width: 50px;
      height:30px;
      text-align: center;
      background-color: #00a2d4;
      color: #ffffff;
      float:left;
      display: block;
      line-height: 30px;
    }


  </style>
</head>
<body style="">
<div class="layui-layout layui-layout-admin kit-layout-admin">
<div class="layui-header">
    <div class="layui-logo" id="logo"><span>后台管理系统</span></div>
    <ul class="layui-nav layui-layout-right kit-nav">
    </ul>
</div>

<div class="layui-side layui-bg-black kit-side">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
            <li class="layui-nav-item ">
                <a href="/index.php/Admin/Challenge/index"><i class="fa fa-clone" aria-hidden="true"></i><span>挑战赛管理</span></a>
            </li>
            <li class="layui-nav-item ">
                <a href="/index.php/Admin/Challenge/complain"><i class="fa fa-clone" aria-hidden="true"></i><span>投诉管理</span></a>
            </li>
            <li class="layui-nav-item ">
                <a href="/index.php/Admin/Topic/index"><i class="fa fa-clone" aria-hidden="true"></i><span>题目管理</span></a>
            </li>
        </ul>
    </div>
</div>
<div class="layui-body" id="container" style="padding:0 2px;">
  <div class="tplay-body-div">
    <div class="layui-tab">
      <ul class="layui-tab-title">
        <li><a href="/index.php/Admin/Topic/index" class="a_menu">活动管理</a></li>
        <li class="layui-this">新增活动</li>
      </ul>
    </div> 
    <div style="margin-top: 20px;">
    </div>
    <form class="layui-form" id="admin">
      
      <div class="layui-form-item">
        <label class="layui-form-label">题目类别</label>
        <div class="layui-input-block" style="max-width:600px;">
          <input name="topic_name" autocomplete="off" placeholder="请输入类别" class="layui-input" type="text" <?php if($detail["topic_name"] != null): ?>value="<?php echo ($detail["topic_name"]); ?>"<?php endif; ?>>
        </div>
      </div>
        <?php if($detail["id"] != null): ?><input name="id" type="hidden" value="<?php echo ($detail["id"]); ?>"><?php endif; ?>
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" lay-submit lay-filter="admin">立即提交</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </div>
    </form>

    <script src="/Public/layui/layui.js"></script>
    <script src="/Public/layui/jquery.min.js"></script>

    <script>

      layui.use(['layer', 'form'], function() {
          var layer = layui.layer,
              $ = layui.jquery,
              form = layui.form;
          $(window).on('load', function() {
              form.on('submit(admin)', function(data) {
                  $.ajax({
                      type:'POST',
                      url:"<?php echo U('admin/topic/publish');?>",
                      data:$('#admin').serialize(),
                      success:function(res) {
                          if(res.status == 1) {
                              layer.alert(res.info, function(index){
                                location.href = res.url;
                              })
                          } else {
                              layer.msg(res.info);
                          }
                      }
                  })
                  return false;
              });
          });
      });
    </script>

  </div>
</body>
</html>