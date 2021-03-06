<?php if (!defined('THINK_PATH')) exit();?>
<!-- 头部公共文件 -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理系统</title>
  <link rel="stylesheet" href="/Public/layui/css/layui.css" media="all" />

  <style>

    .pages a,
    .pages span {
      display: inline-block;
      padding: 2px 5px;
      margin: 0 1px;
      border: 1px solid #f0f0f0;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
    }

    .pages a,
    .pages li {
      display: inline-block;
      list-style: none;
      text-decoration: none;
      color: #58A0D3;
    }

    .pages a.first,
    .pages a.prev,
    .pages a.next,
    .pages a.end {
      margin: 0;
    }

    .pages a:hover {
      border-color: #50A8E6;
    }

    .pages span.current {
      background: #50A8E6;
      color: #FFF;
      font-weight: 700;
      border-color: #50A8E6;
    }
  </style>
</head>
<body class="kit-theme">
<div class="layui-layout layui-layout-admin kit-layout-admin">

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
                <option value="telephone">用户手机号</option>
                <option value="nickname">用户昵称</option>
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
      <div class="pages">
        <?php echo ($page); ?>
      </div>
      <div style="padding:0 20px;"></div>

      <script src="/Public/layui/layui.js"></script>
      <script src="/Public/layui/jquery.min.js"></script>


      <script type="text/javascript">
          layui.use('layer', function(){
              var layer = layui.layer;
          });

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


</body>
</html>