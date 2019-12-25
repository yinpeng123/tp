<?php if (!defined('THINK_PATH')) exit();?>
<!-- 头部公共文件 -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理系统</title>
  <link rel="stylesheet" href="/Public/layui/css/layui.css" media="all" />
</head>
<body class="kit-theme">
<div class="layui-layout layui-layout-admin kit-layout-admin">
  <div class="layui-header">
    <div class="layui-logo" id="logo"><span>后台管理系统</span></div>
    <ul class="layui-nav layui-layout-right kit-nav">
    </ul>
  </div>
  <!-- 左侧公共菜单文件 -->
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
            <li class="layui-nav-item ">
                <a href="/index.php/Admin/article/index"><i class="fa fa-clone" aria-hidden="true"></i><span>文章管理</span></a>
            </li>
        </ul>
    </div>
</div>
  <div class="layui-body" id="container" style="padding:0 2px;">
    <div class="tplay-body-div">
      <div class="layui-tab">
        <ul class="layui-tab-title">
          <li class="layui-this">挑战赛管理</li>

        </ul>
      </div>
      <form class="layui-form serch" action="/index.php/Admin/Challenge/index" method="post">

        <div class="layui-form-item" style="float: left;">

          <div class="layui-input-inline">
            <div class="layui-inline">
              <select name="status" style="width: 190px;height: 38px;border-color: #e6e6e6;display: block">
                <option value="">挑战状态</option>
                <option value="1">进行中</option>
                <option value="2">已成功</option>
                <option value="3">已失败</option>
                <option value="4">已取消</option>
                <option value="5">组队中</option>
              </select>
            </div>
          </div>

          <div class="layui-input-inline">
            <div class="layui-inline">
              <select name="type" style="width: 190px;height: 38px;border-color: #e6e6e6;display: block">
                <option value="">挑战类型</option>
                <option value="1">7日挑战</option>
                <option value="2">21日挑战</option>
               </select>
            </div>
          </div>

          <div class="layui-input-inline">
            <div class="layui-inline">
              <select name="time" style="width: 190px;height: 38px;border-color: #e6e6e6;display: block">
                <option value="">时间排序</option>
                <option value="DESC">倒叙</option>
                <option value="ASC">升序</option>
              </select>
            </div>
          </div>

          <div class="layui-input-inline">
            <div class="layui-inline">
              <select name="user" style="width: 190px;height: 38px;border-color: #e6e6e6;display: block">
                <option value="">按条件查询</option>
                <option value="uid">用户ID</option>
                <option value="telephone">用户手机号</option>
                <option value="nickname">用户姓名</option>
              </select>
            </div>
          </div>

          <div class="layui-input-inline">
            <input type="text" name="keywords" lay-verify="title" autocomplete="off" placeholder="请输入关键词" class="layui-input layui-btn-sm">
          </div>

          <button class="layui-btn layui-btn-danger layui-btn-sm" lay-submit="" lay-filter="serch">立即提交</button>
        </div>
      </form>
      <table class="layui-table" lay-size="sm">
        <colgroup>
          <col width="100">
          <col width="150">
          <col width="100">
          <col width="100">
          <col width="100">
          <col width="100">
        </colgroup>
        <thead>
          <tr>
            <th>桌号</th>
            <th>参与人</th>
            <th>时间</th>
            <th>类型</th>
            <th>状态</th>
            <th>原因</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($room_info)): $i = 0; $__LIST__ = $room_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["id"]); ?></td>

            <td>
              <?php if(is_array($vo['nickname'])): $i = 0; $__LIST__ = $vo['nickname'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vw): $mod = ($i % 2 );++$i; echo ($vw); ?><br/><?php endforeach; endif; else: echo "" ;endif; ?>
            </td>

            <td>
                <?php echo ($vo["create_time"]); ?>
            </td>
            <td>
              <?php if($vo["type"] == 1 ): ?>7日挑战赛
              <?php else: ?>
                21日挑战赛<?php endif; ?>
            </td>
            <td>
              <?php if($vo["status"] == 1): ?>进行中
                <?php elseif($vo["status"] == 2): ?>已成功
                <?php elseif($vo["status"] == 3): ?>已失败
                <?php elseif($vo["status"] == 4): ?>已取消
                <?php elseif($vo["status"] == 5): ?>组队中<?php endif; ?>
            </td>
            <td>
                <?php echo ($vo["failcause"]); ?>
            </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      <div style="padding:0 20px;"></div>
      <script src="/static/public/layui/layui.js" charset="utf-8"></script>
      <script src="/static/public/jquery/jquery.min.js"></script>
      <script>
          var message;
          layui.config({
              base: '/static/admin/js/',
              version: '1.0.1'
          }).use(['app', 'message'], function() {
              var app = layui.app,
                  $ = layui.jquery,
                  layer = layui.layer;
              //将message设置为全局以便子页面调用
              message = layui.message;
              //主入口
              app.set({
                  type: 'iframe'
              }).init();
          });
      </script>
      <script type="text/javascript">
          $(function(){
              var x = 10;
              var y = 20;
              $(".tooltip").mouseover(function(e){
                  var tooltip = "<div id='tooltip'><img src='"+ this.href +"' alt='产品预览图' height='200'/>"+"<\/div>"; //创建 div 元素
                  $("body").append(tooltip);  //把它追加到文档中
                  $("#tooltip")
                      .css({
                          "top": (e.pageY+y) + "px",
                          "left":  (e.pageX+x)  + "px"
                      }).show("fast");    //设置x坐标和y坐标，并且显示
              }).mouseout(function(){
                  $("#tooltip").remove();  //移除
              }).mousemove(function(e){
                  $("#tooltip")
                      .css({
                          "top": (e.pageY+y) + "px",
                          "left":  (e.pageX+x)  + "px"
                      });
              });
          })
      </script>
      <script type="text/javascript">
          $('.a_menu').click(function(){
              var url = $(this).attr('href');
              var id = $(this).attr('id');
              var a = true;
              if(id) {
                  $.ajax({
                      url:url
                      ,async:false
                      ,data:{id:id}
                      ,success:function(res){
                          if(res.code == 0) {
                              layer.msg(res.msg);
                              a = false;
                          }
                      }
                  })
              } else {
                  $.ajax({
                      url:url
                      ,async:false
                      ,success:function(res){
                          if(res.code == 0) {
                              layer.msg(res.msg);
                              a = false;
                          }
                      }
                  })
              }
              return a;
          })
      </script>
      <script>
          layui.use('laydate', function(){
              var laydate = layui.laydate;

              //常规用法
              laydate.render({
                  elem: '#create_time'
              });
          });
      </script>
      <script type="text/javascript">

          $('.delete').click(function(){
              var id = $(this).attr('id');
              layer.confirm('确定要删除?', function(index) {
                  $.ajax({
                      url:"/admin/picture/delete.html",
                      data:{id:id},
                      success:function(res) {
                          layer.msg(res.msg);
                          if(res.code == 1) {
                              setTimeout(function(){
                                  location.href = res.url;
                              },1500)
                          }
                      }
                  })
              })
          })
      </script>
  </div>
  <!-- 底部固定区域 -->

</div>
<script src="/Public/layui/layui.js"></script>

</body>
</html>