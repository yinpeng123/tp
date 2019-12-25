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
    #tooltip{
      position:absolute;
      border:1px solid #ccc;
      background:#333;
      padding:2px;
      display:none;
      color:#fff;
      z-index: 999;
    }
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
          <li class="layui-this">投诉管理</li>

        </ul>
      </div>
      <form class="layui-form serch" action="/index.php/Admin/Challenge/complain" method="post">
        <div class="layui-form-item" style="float: left;">
          <div class="layui-input-inline">
            <div class="layui-inline">
              <select name="params" style="width: 190px;height: 38px;border-color: #e6e6e6;display: block">
                <option value="">按条件查询</option>
                <option value="1">用户手机号</option>
                <option value="2">用户姓名</option>
              </select>
            </div>
          </div>
          <div class="layui-input-inline">
            <input type="text" name="keywords" lay-verify="title" autocomplete="off" placeholder="请输入关键词" class="layui-input layui-btn-sm">
          </div>
          <button class="layui-btn layui-btn-danger layui-btn-sm" lay-submit="" lay-filter="serch" style="height:37px;line-height:37px ">立即提交</button>
        </div>
      </form>

      <form class="layui-form serch" action="/index.php/Admin/Challenge/complain" method="post" style="float: left;margin-left: 20px">
        <input  name="status" type="hidden" value="0">
        <button class="layui-btn layui-btn-danger layui-btn-sm" lay-submit="" lay-filter="serch" style="height:37px;line-height:37px ">审核中</button>
      </form>
      <form class="layui-form serch" action="/index.php/Admin/Challenge/complain" method="post" style="float: left;margin-left: 20px">
        <input  name="status" type="hidden" value="1">
        <button class="layui-btn layui-btn-danger layui-btn-sm" lay-submit="" lay-filter="serch" style="height:37px;line-height:37px ">已审核</button>
      </form>
      <form class="layui-form serch" action="/index.php/Admin/Challenge/complain" method="post" style="float: left;margin-left: 20px">
        <input  name="status" type="hidden" value="2">
        <button class="layui-btn layui-btn-danger layui-btn-sm" lay-submit="" lay-filter="serch" style="height:37px;line-height:37px ">审核拒绝</button>
      </form>

      <table class="layui-table" lay-size="sm">
        <colgroup>
          <col width="100">
          <col width="150">
          <col width="100">
          <col width="100">
          <col width="100">
          <col width="100">
          <col width="100">
          <col width="100">
        </colgroup>
        <thead>
          <tr>
            <th>桌号</th>
            <th>投诉人</th>
            <th>被投诉人</th>
            <th>日期</th>
            <th>原因</th>
            <th>截图</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["room_id"]); ?></td>
            <td><?php echo ($vo["complainant"]); ?></td>
            <td><?php echo ($vo["by_complainant"]); ?></td>
            <td><?php echo ($vo["complain_time"]); ?></td>
            <td><?php echo ($vo["complainant_cause"]); ?></td>
            <td>
                <?php if(is_array($vo["pic"])): $i = 0; $__LIST__ = $vo["pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vc): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vc); ?>" class="tooltip"><img src="<?php echo ($vc); ?>"></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </td>
            <td>
                <?php if($vo["status"] == 0): ?>审核中<?php endif; ?>
                <?php if($vo["status"] == 1): ?>已审核<?php endif; ?>
                <?php if($vo["status"] == 2): ?>审核拒绝<?php endif; ?>
            </td>
            <td>
              <a href="javascript:" style="color: #ffffff" class="layui-btn audit" id="<?php echo ($vo["id"]); ?>" status="1" room_id="<?php echo ($vo["room_id"]); ?>">同意</a>
              <a href="javascript:" style="color: #ffffff" class="layui-btn audit" id="<?php echo ($vo["id"]); ?>" status="2" room_id="<?php echo ($vo["room_id"]); ?>">拒绝</a>
            </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      <div class="pages">
        <?php echo ($page); ?>
      </div>
      <div style="padding:0 20px;"></div>
      <script src="/Public/layui/jquery.min.js"></script>
      <script src="/Public/layui/layui.js"></script>
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
          layui.use('layer', function(){
              var layer = layui.layer;
          });

          $('.audit').click(function(){
              var id = $(this).attr('id');
              var status = $(this).attr('status');
              var room_id = $(this).attr('room_id');
              layer.confirm('确定要审核?', function(index) {
                  $.ajax({
                      type:'POST',
                      url:"<?php echo U('admin/challenge/audit');?>",
                      data:{id:id,status:status,room_id:room_id},
                      success:function(res) {
                          layer.msg(res.info);
                          if(res.status == 1) {
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