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
  .file{
    float: left;
    margin-right: 10px;
  }
  .para{
    width: 800px;
    margin-left: 20px;
    padding-top: 20px;
    padding-bottom: 40px;
    border: 1px solid #fff9ec;
    background: #e6e6e6;
  }
    .add{
      margin-top: -70px;
      margin-left: 60px;
    }
    .del{
      margin-top: -70px;
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
        <li><a href="/index.php/Admin/article/index" class="a_menu">文章管理</a></li>
        <li class="layui-this">新增文章</li>
      </ul>
    </div> 
    <div style="margin-top: 20px;">
    </div>
    <form class="layui-form" id="admin">
      
      <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-block" style="max-width:600px;">
          <input name="title" autocomplete="off" placeholder="请输入类别" class="layui-input" type="text" <?php if($article["title"] != null): ?>value="<?php echo ($article["title"]); ?>"<?php endif; ?>>
        </div>
      </div>

      <div class="layui-upload" id="upload-thumb">
        <label class="layui-form-label" >文章图片</label>
        <button type="button" class="layui-btn" id="thumb">文章图片</button>
        <div class="layui-upload-list">
          <label class="layui-form-label"></label>
          <img class="layui-upload-img" id="demo1" width="150" height="150" <?php if($article["thumb"] != null): ?>src="<?php echo ($article["thumb"]); ?>"<if>
          <if condition="$article.thumb neq null"><input type="hidden" class="picval" name="thumb" value="<?php echo ($article["thumb"]); ?>"><?php endif; ?>
        </div>
      </div>


      <div class="layui-upload" id="list-thumb">
        <label class="layui-form-label" id="suo">缩略图</label>
        <button type="button" class="layui-btn" id="list_thumb">缩略图</button>

        <div class="layui-upload-list">
          <label class="layui-form-label"></label>
          <img class="layui-upload-img" id="demo2" width="150" height="150" <?php if($article["list_thumb"] != null): ?>src="<?php echo ($article["list_thumb"]); ?>"<if>
          <if condition="$article.thumb neq null"><input type="hidden" class="picva2" name="list_thumb" value="<?php echo ($article["thumb"]); ?>"><?php endif; ?>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">文章简介</label>
        <div class="layui-input-block" style="max-width:600px;">
          <textarea placeholder="请输入文章简介" class="layui-textarea" name="desc"><?php if($article["desc"] != null): echo ($article["desc"]); endif; ?></textarea>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">作者</label>
        <div class="layui-input-block" style="max-width:600px;">
          <input name="author" autocomplete="off" placeholder="请输入作者" class="layui-input" type="text" <?php if($article["title"] != author): ?>value="<?php echo ($article["author"]); ?>"<?php endif; ?>>
        </div>
      </div>


      <div class="layui-form-item">
        <label class="layui-form-label">阅读量</label>
        <div class="layui-input-block" style="max-width:600px;">
          <input name="reading" autocomplete="off" placeholder="请输入阅读量" class="layui-input" type="text" <?php if($article["reading"] != reading): ?>value="<?php echo ($article["reading"]); ?>"<?php endif; ?>>
        </div>
      </div>
      <?php if($article["content"] != null): if(is_array($article["content"])): $k = 0; $__LIST__ = $article["content"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="para">
              <label class="layui-form-label" style="color: red;margin-left: -13px">段落<?php echo ($key+1); ?></label>
              <div class="layui-form-item">
                <label class="layui-form-label">段落内容</label>
                <div class="layui-input-block" style="max-width:600px;">
                  <textarea placeholder="请输入文章简介" class="layui-textarea" name="content[]"><?php echo ($vo); ?></textarea>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">段落音频</label>
                <div class="layui-input-block" style="max-width:600px;">
                  <button type="button" class="layui-btn" id="voice<?php echo ($key+1); ?>">上传音频</button>
                </div>
              </div>
              <div class="layui-form-item upload-voice<?php echo ($key+1); ?>">
                <?php if($article.voice.$key != null): ?><div class="layui-input-block" style="max-width:600px;">
                    <input type="text"class="layui-input" name="voice[]" value="<?php echo ($article["voice"]["$key"]); ?>">
                  </div><?php endif; ?>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
          <div class="para">
            <label class="layui-form-label" style="color: red;margin-left: -13px">段落1</label>

            <div class="layui-form-item">
              <label class="layui-form-label">段落内容</label>
              <div class="layui-input-block" style="max-width:600px;">
                <textarea placeholder="请输入文章简介" class="layui-textarea" name="content[]"></textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">段落音频</label>
              <div class="layui-input-block" style="max-width:600px;">
                <button type="button" class="layui-btn" id="voice1">上传音频</button>
              </div>
            </div>
            <div class="layui-form-item upload-voice1">
              <div class="layui-input-block" style="max-width:600px;">
                <input type="text"class="layui-input" name="voice[]" value="">
              </div>
            </div>
          </div><?php endif; ?>

      <div class="add layui-btn">添加</div> <div class="del layui-btn">删除</div>
        <?php if($article["id"] != null): ?><input name="id" type="hidden" value="<?php echo ($article["id"]); ?>"><?php endif; ?>
      <div class="layui-form-item" style="margin-top:20px">
        <div class="layui-input-block">
          <button type="button" class="layui-btn sub" lay-submit lay-filter="admin">立即提交</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </div>
    </form>

    <script src="/Public/layui/layui.js"></script>
    <script src="/Public/layui/jquery.min.js"></script>

    <script>


        var para = $(".para").length;

        for(let i=1; i<=para; i++){
            layui.use('upload', function() {
                var val = $(".upload-voice"+i+" input").val();
                if(!val){
                    $(".upload-voice"+i+"  input").css("display","none");
                }
                var upload = layui.upload;
                var uploadInst = upload.render({
                    elem: '#voice' + i //绑定元素
                    , url: "<?php echo U('admin/article/upload');?>" //上传接口
                    , data: {use: 'picture_thumb'}
                    ,accept:"audio"
                    , done: function (res) {
                        //上传完毕回调
                        if (res.code == 1) {
                            $('.upload-voice'+i +" input").css("display",'block');

                            $('.upload-voice'+i +" input").attr("value",res.src);
                        } else {
                            layer.msg("上传失败");
                        }
                    }
                    , error: function () {
                        //请求异常回调
                        //演示失败状态，并实现重传
                        var demoText = $('#demoText');
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                        demoText.find('.demo-reload').on('click', function () {
                            uploadInst.upload();
                        });
                    }
                });

            });
        }
        var num = para;
       $(".add").click(function () {
            num ++;
            $('.add').before("<div class=\"para\">\n" +
                "    <label class=\"layui-form-label\" style=\"color: red;margin-left: -13px\">段落"+num+"</label>\n" +
                "    <div class=\"layui-form-item\">\n" +
                "      <label class=\"layui-form-label\">段落内容</label>\n" +
                "      <div class=\"layui-input-block\" style=\"max-width:600px;\">\n" +
                "        <textarea placeholder=\"请输入文章简介\" class=\"layui-textarea\" name=\"content[]\"></textarea>\n" +
                "      </div>\n" +
                "    </div>\n" +
                "\n" +
                "      <div class=\"layui-form-item\">\n" +
                "        <label class=\"layui-form-label\">段落音频</label>\n" +
                "        <div class=\"layui-input-block\" style=\"max-width:600px;\">\n" +
                "          <button type=\"button\" class=\"layui-btn\" id='voice"+num+"'>上传音频</button>\n" +
                "\n" +
                "        </div>\n" +
                "      </div>\n" +
                "<div class='layui-form-item upload-voice"+num+"'>\n" +
                "              <div class=\"layui-input-block\" style=\"max-width:600px;\">\n" +
                "                <input type=\"text\"class=\"layui-input\" name=\"voice[]\" value=\"\"  style='display: none'>\n" +
                "          </div>\n" +
                "</div>\n" +
                "  </div>")
           layui.use('upload', function() {

               var upload = layui.upload;
               var uploadInst = upload.render({
                   elem: '#voice' + num //绑定元素
                   , url: "<?php echo U('admin/article/upload');?>" //上传接口
                   ,accept:"audio"
                   , data: {use: 'picture_thumb'}
                   , done: function (res) {
                       //上传完毕回调
                       if (res.code == 1) {
                           $('.upload-voice'+num +" input").css("display",'block');

                           $('.upload-voice'+num +" input").attr("value",res.src);
                       } else {
                           layer.msg("上传失败");
                       }
                   }
                   , error: function () {
                       //请求异常回调
                       //演示失败状态，并实现重传
                       var demoText = $('#demoText');
                       demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                       demoText.find('.demo-reload').on('click', function () {
                           uploadInst.upload();
                       });
                   }
               });

           });


       })
        // $("#thumb").change(function () {
        //      $("#demo1").attr("src",URL.createObjectURL($(this)[0].files[0]))
        // })
        //
        // $("#list_thumb").change(function () {
        //     $("#demo2").attr("src",URL.createObjectURL($(this)[0].files[0]))
        // })
        $(".del").click(function () {

            if(num>1){
                num -- ;
                $('.para ').eq(-1).remove();
            }
        })


       $(".sub").click(function () {

           var formdata = new FormData($("#admin")[0]);
            // for(var i=0;i< $(".para").length;i++){
            //     if($('.para input[type="file"]').eq(i)[0].files[0]){
            //           formdata.append('voice['+i+']',$('.para input[type="file"]').eq(i)[0].files[0]);
            //     }
            // }
           $.ajax({
               url:"<?php echo U('admin/article/publish');?>",
               type:'post',
               data:formdata,
               processData: false,
               contentType: false,
               cache: false,
               success: function(data){
                  if(data == 1){
                      layer.msg("提交成功");
                      setTimeout(function(){
                          history.go(-1);
                      },2000)

                  }
               }
           })
       })



    </script>

    <script>
      var vid = "voice1";



      var picval = $('.picval').val()
      console.log(picval);
      if(picval){
          $('#demo1').css('display','block');
      }else{
          $('#demo1').css('display','none');
      }
      var picva2 = $('.picval').val()

      if(picva2){
          $('#demo2').css('display','block');
      }else{
          $("#suo").css("margin-left",'-111px');
          $('#demo2').css('display','none');
      }

        layui.use('upload', function(){
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: "#thumb" //绑定元素
                ,url: "<?php echo U('admin/article/upload');?>" //上传接口
                ,data:{use:'picture_thumb'}
                ,done: function(res){
                    //上传完毕回调
                    if(res.code == 1) {
                        $("#suo").css("margin-left",'0px');
                        $('#demo1').css('display','block');
                        $('#demo1').attr('src',res.src);
                        $('#upload-thumb').append('<input type="hidden" name="thumb" value="'+ res.src +'">');
                    } else {
                        layer.msg("上传失败");
                    }
                }
                ,error: function(){
                    //请求异常回调
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });
            var uploadInst = upload.render({
                elem: '#list_thumb' //绑定元素
                ,url: "<?php echo U('admin/article/upload');?>" //上传接口
                ,data:{use:'picture_thumb'}
                ,done: function(res){
                    //上传完毕回调
                    if(res.code == 1) {
                        $('#demo2').css('display','block');
                        $('#demo2').attr('src',res.src);
                        $('#list-thumb').append('<input type="hidden" name="list_thumb" value="'+ res.src +'">');
                    } else {
                        layer.msg("上传失败");
                    }
                }
                ,error: function(){
                    //请求异常回调
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });




        });
    </script>

  </div>
</body>
</html>