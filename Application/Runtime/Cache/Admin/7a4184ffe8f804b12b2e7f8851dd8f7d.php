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
                    <li  class="layui-this"><a href="/index.php/Admin/article/index" class="a_menu">文章管理</a></li>
                    <li><a href="/index.php/Admin/article/publish" class="a_menu">新增文章</a></li>
                </ul>
            </div>

            <table class="layui-table" lay-size="sm">
                <colgroup>
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="100">
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>文章标题</th>
                    <th>文章简介</th>
                    <th>文章作者</th>
                    <th>阅读量</th>
                    <th>点赞量</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($article)): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo ($vo["desc"]); ?></td>
                        <td><?php echo ($vo["author"]); ?></td>
                        <td><?php echo ($vo["reading"]); ?></td>
                        <td><?php echo ($vo["like"]); ?></td>
                        <td><?php echo ($vo["create_time"]); ?></td>
                        <td>
                            <a href="<?php echo U('admin/article/publish');?>?id=<?php echo ($vo["id"]); ?>" style="color: #ffffff" class="layui-btn">编辑</a>
                            <a href="javascript:" style="color: #ffffff" class="layui-btn delete" id="<?php echo ($vo["id"]); ?>">删除</a>
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
                            url:"<?php echo U('admin/article/del');?>",
                            type:'POST',
                            data:{id:id},
                            success:function(res) {
                                layer.msg("删除成功");
                                if(res == 1) {
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
    </div>
</body>
</html>