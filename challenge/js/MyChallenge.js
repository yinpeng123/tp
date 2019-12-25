
(function(){ 
 	var a;//房间号
	var progress;
	var $url;
	var $user_name;
	var msgold;
	var complainant;
	var by_complainant;
	  $.ajax({
	  	type:"POST",
		url:"http://www.htown.xyz/home/index/mychallenge",
		data:{"openid":2},
		async:false,
		success:function(msg){
			console.log(msg);
			if(msg != undefined){
				a = msg.room_id;
				console.log(msg)
				progress = msg.days/msg.type;
				Progress(progress);
				renderer(msg)
			}
		}
	})
	 $.ajax({
		type:"POST",
		url:"http://www.htown.xyz/home/index/msgall",
		data:{"openid":2,"room_id":a},
		async:false,
		success:function(msg){
			if (msg != undefined) {
				$('.chat_content').empty();
				console.log(msg);
				renderertwo(msg.msg);
				if(msg.room.status=="3"){
					$('.main_failure').css('display','block');
					$('.main_time').prepend('<p class="faile">'+msg.room.failcause+'</p>');
				}
			}
		},
	})
	$('.btn').click(function(){
		var $text = $('#char_box').val();
		$('#char_box').val("");
		$.ajax({
			type:"post",
			url:"http://www.htown.xyz/Home/index/entermsg ",
			async:false,
			data:{"openid":2,"room_id":a,"msg":$text},
			success:function(msg){
			
			}
		});
	})
	
	$('.nav_lsit').click(function(){
		$(this).siblings().children().removeClass('active').children();
		$(this).children().attr('class','active');
		console.log($(this).children().text());
		//判断点击的是全部，聊天还是打卡记录。
		if ($(this).children().text() == "聊天") {
			$.ajax({
				type:"POST",
				url:"http://www.htown.xyz/home/index/msgall",
				data:{"openid":2,"room_id":a},
				async:false,
				success:function(msg){
					if(msg != undefined){
						$('.chat_content').empty();
						chat(msg.msg);
					}
				},
			})
		} else if ($(this).children().text() == "打卡记录") {
			$.ajax({
				type:"POST",
				url:"http://www.htown.xyz/home/index/msgall",
				data:{"openid":2,"room_id":a},
				async:false,
				success:function(msg){
					if(msg != undefined){
						$('.chat_content').empty();
						punching(msg.msg);
					}
				},
			})
		} else{
			$.ajax({
				type:"POST",
				url:"http://www.htown.xyz/home/index/msgall",
				data:{"openid":2,"room_id":a},
				async:false,
				success:function(msg){
					if (msg != undefined) {
						$('.chat_content').empty();
						renderertwo(msg.msg);
					}
				},
			})
		}
	})
	
	$(document).on('click','.givecomp',function(){
		complainant=$('.chat_r').children().attr('name')
		by_complainant=$(this).parent().prev().children().attr("name");
		window.location.href="complaint.html?room_id="+a+"&complainant="+complainant+"&by_complainant="+by_complainant+"";
	})
	
	setTimeout(function () {
            $.ajax({
				type:"POST",
				url:"http://www.htown.xyz/home/index/msgall",
				data:{"openid":2,"room_id":a},
				async:false,
				success:function(msg){
					if(msg != undefined){
						console.log(msg.msg)
						if(msgold != undefined){
							if(msgold.length<msg.msg.length){
								renderer_3(msgold,msg.msg);
								$(".chat_content").scrollTop($(".chat_content")[0].scrollHeight);
							}
						}
						msgold = msg.msg;
					}
					
				},
			})
         setTimeout(arguments.callee, 2000);
      }, 2000);
     console.log(a,by_complainant);
    
      
		$(document).on('click','.givelike',function(){
 			by_complainant=$(this).parent().prev().children().attr("name");
			$.ajax({
				type:'post',
				url:'http://www.htown.xyz/Home/index/like ',
				data:{'room_id':a,"openid":2,"msg":by_complainant,"givedis":"赞"},
				async:false,
				success:function(msg){
					console.log(msg)
				}
			})
			$('.click_box').css("display","none");
 		})
 		$(document).on('click','.givedis',function(){
 			by_complainant=$(this).parent().prev().children().attr("name");
			$.ajax({
				type:'post',
				url:'http://www.htown.xyz/Home/index/like ',
				data:{'room_id':a,"openid":2,"msg":by_complainant,"givedis":"踩"},
				async:false,
				success:function(msg){
					console.log(msg)
				}
			})
			$('.click_box').css("display","none");
 		})
})();

$('#affirm').click(function(){
	$('.main_failure').css("display","none");
})

//点赞
$(document).on('click','.user_photo_other',function(){
	$('.click_box').css("display",'none')
	if ($(this).next().css("display") == "none") {
		$(this).next().css("display","block")
	} else{
		$(this).next().css("display","none")
	}
})

//渲染页面
function renderer(msg){
	$('#room').text(msg.room_id);
	$('#room').attr('class',msg.room_id)
	$('.remaining').text(msg.days);
	$('.member').children().empty();
	$('#residue').text(msg.type - msg.days)
	for (var i=0;i<msg.pic.length;i++) {
		if(i>0){
			$('.member').children().append('<div class="member_infor le_two">\
							<div class="member_portrait">\
								<img src="'+msg.pic[i]+'"/>\
							</div>\
							<div class="member_name">\
								'+msg.nickname[i]+'\
							</div>\
						</div>')
		}else{
			$('.member').children().append('<div class="member_infor">\
							<div class="member_portrait">\
								<img src="'+msg.pic[i]+'"/>\
							</div>\
							<div class="member_name">\
								'+msg.nickname[i]+'\
							</div>\
						</div>')
		}
	}
}
//控制进度条
function Progress(progress){
	var plish = 8 * (1-progress);
	var newDate = new Date();
	$('.bar_left').css("width",(plish+0.26)+"rem");
	$('.bar_ball').css('left',plish+"rem");
	$('.bar_inform').css("left",(plish - 0.8)+"rem");
	$('#time').text(newDate.toJSON().substring(0,10).replace(/-/g, "."));
	$('.main_time').children().text(newDate.toJSON().substring(0,10).replace(/-/g, "."))
}

function renderertwo(msg){
			for (var i = 0;i<msg.length;i++) {
				if(msg[i].status == "left"){
					if (msg[i].type == "2") {
						$('.chat_content').append('<div class="main_plan">\
					<div class="plan">\
						<div class="user_photo photo_l user_photo_other">\
							<img src="'+msg[i].pic+'" name="'+msg[i].nickname+'"/>\
						</div>\
						<ul class="click_box">\
							<div class="trian"></div>\
							<li class="givelike">给他个<i class="icones praoseone"></i></li>\
							<li class="givedis">给他个<i class="icones praosetwo "></i></li>\
							<li class="givecomp"><a href="javascript:;">投诉TA</a><i class="icones compsu "></i></li>\
						</ul>\
						<div class="plan_con">\
							<div>今日计划<span class="plan_font">跑步</span></div>\
							<div>事件<span class="plan_font">60</span>分钟</div>\
						</div>\
						<div class="plan_img">\
							<img src="'+msg[i].msg+'"/>\
						</div>\
					</div>\
				</div>')
					}else if(msg[i].type == "3"){
						$('.chat_content').append('<div class="main_chat">\
					<div class="main_hint">\
						<span class="hint_font">官方提示</span>\
						'+msg[i].msg+'\
					</div>\
				</div>');
					}  else{
						$('.chat_content').append('<div class="main_chat">\
					<div class="chat">\
						<div class="user_photo chat_l user_photo_other">\
							<img src="'+msg[i].pic+'" name="'+msg[i].nickname+'" />\
						</div>\
						<ul class="click_box click_box_one">\
							<div class="trian"></div>\
							<li class="givelike">给他个<i class="icones praoseone"></i></li>\
							<li class="givedis">给他个<i class="icones praosetwo "></i></li>\
							<li class="givecomp"><a href="javascript:;">投诉TA</a><i class="icones compsu"></i></li>\
						</ul>\
						<div class="user_chat user_chat_l"><div class="san_l"></div>'+msg[i].msg+'</div>\
					</div>\
				</div>')
					}
				}else{
					if (msg[i].type == "2") {
						$('.chat_content').append('<div class="main_plan">\
					<div class="plan">\
						<div class="user_photo photo_r">\
							<img src="'+msg[i].pic+'" name="'+msg[i].nickname+'"/>\
						</div>\
						<div class="plan_con">\
							<div>今日计划<span class="plan_font">跑步</span></div>\
							<div>事件<span class="plan_font">60</span>分钟</div>\
						</div>\
						<div class="plan_img">\
							<img src="'+msg[i].msg+'"/>\
						</div>\
					</div>\
				</div>')
					}else if(msg[i].type == "3"){
						$('.chat_content').append('<div class="main_chat">\
					<div class="main_hint">\
						<span class="hint_font">官方提示</span>\
						'+msg[i].msg+'\
					</div>\
				</div>');
					}  else{
						$('.chat_content').append('<div class="main_chat">\
					<div class="chat">\
						<div class="user_photo chat_r">\
							<img src="'+msg[i].pic+'" name="'+msg[i].nickname+'"/>\
						</div>\
						<div class="user_chat user_chat_r"><div class="san_r"></div>'+msg[i].msg+'</div>\
					</div>\
				</div>')
					}
				}
			}
}

function renderer_3(msgold,msg){
	for (var i = msgold.length;i<msg.length;i++) {
			if(msg[i].status == "left"){
					if (msg[i].type == "2") {
						$('.chat_content').append('<div class="main_plan">\
					<div class="plan">\
						<div class="user_photo photo_l user_photo_other">\
							<img src="'+msg[i].pic+'" name="+msg[i].nickname+"/>\
						</div>\
						<ul class="click_box">\
							<div class="trian"></div>\
							<li class="givelike">给他个<i class="icones praoseone"></i></li>\
							<li class="givedis">给他个<i class="icones praosetwo "></i></li>\
							<li class="givecomp"><a href="javascript:;">投诉TA</a><i class="icones compsu "></i></li>\
						</ul>\
						<div class="plan_con">\
							<div>今日计划<span class="plan_font">跑步</span></div>\
							<div>事件<span class="plan_font">60</span>分钟</div>\
						</div>\
						<div class="plan_img">\
							<img src="'+msg[i].msg+'"/>\
						</div>\
					</div>\
				</div>')
					}else if(msg[i].type == "3"){
						$('.chat_content').append('<div class="main_chat">\
					<div class="main_hint">\
						<span class="hint_font">官方提示</span>\
						'+msg[i].msg+'\
					</div>\
				</div>');
					} else{
						$('.chat_content').append('<div class="main_chat">\
					<div class="chat">\
						<div class="user_photo chat_l user_photo_other">\
							<img src="'+msg[i].pic+'" name="+msg[i].nickname+" />\
						</div>\
						<ul class="click_box click_box_one">\
							<div class="trian"></div>\
							<li class="givelike">给他个<i class="icones praoseone"></i></li>\
							<li class="givedis">给他个<i class="icones praosetwo "></i></li>\
							<li class="givecomp"><a href="javascript:;">投诉TA</a><i class="icones compsu "></i></li>\
						</ul>\
						<div class="user_chat user_chat_l"><div class="san_l"></div>'+msg[i].msg+'</div>\
					</div>\
				</div>')
					}
				}else{
					if (msg[i].type == "2") {
						$('.chat_content').append('<div class="main_plan">\
					<div class="plan">\
						<div class="user_photo photo_r">\
							<img src="'+msg[i].pic+'" name="+msg[i].nickname+"/>\
						</div>\
						<div class="plan_con">\
							<div>今日计划<span class="plan_font">跑步</span></div>\
							<div>事件<span class="plan_font">60</span>分钟</div>\
						</div>\
						<div class="plan_img">\
							<img src="'+msg[i].msg+'"/>\
						</div>\
					</div>\
				</div>')
					}else if(msg[i].type == "3"){
						$('.chat_content').append('<div class="main_chat">\
					<div class="main_hint">\
						<span class="hint_font">官方提示</span>\
						'+msg[i].msg+'\
					</div>\
				</div>');
					}else{
						$('.chat_content').append('<div class="main_chat">\
					<div class="chat">\
						<div class="user_photo chat_r">\
							<img src="'+msg[i].pic+'" name="+msg[i].nickname+"/>\
						</div>\
						<div class="user_chat user_chat_r"><div class="san_r"></div>'+msg[i].msg+'</div>\
					</div>\
				</div>')
					}
					
				}
	}
}
//打卡记录
function punching(msg){
for (var i = 0;i<msg.length;i++) {
					if(msg[i].type=="2"){
						if(msg[i].status == "left"){
							$('.chat_content').append('<div class="main_plan">\
					<div class="plan">\
						<div class="user_photo photo_l user_photo_other">\
							<img src="'+msg[i].pic+'" name="'+msg[i].nickname+'"/>\
						</div>\
						<ul class="click_box">\
								<div class="trian"></div>\
								<li class="givelike">给他个<i class="icones praoseone"></i></li>\
								<li class="givedis">给他个<i class="icones praosetwo "></i></li>\
								<li class="givecomp"><a href="">投诉TA</a><i class="icones compsu "></i></li>\
						</ul>\
						<div class="plan_con">\
							<div>今日计划<span class="plan_font">跑步</span></div>\
							<div>事件<span class="plan_font">60</span>分钟</div>\
						</div>\
						<div class="plan_img">\
							<img src="'+msg[i].msg+'"/>\
						</div>\
					</div>\
				</div>')
						}else{
							$('.chat_content').append('<div class="main_plan">\
					<div class="plan">\
						<div class="user_photo photo_r">\
							<img src="'+msg[i].pic+'" name="'+msg[i].nickname+'"/>\
						</div>\
						<div class="plan_con">\
							<div>今日计划<span class="plan_font">跑步</span></div>\
							<div>事件<span class="plan_font">60</span>分钟</div>\
						</div>\
						<div class="plan_img">\
							<img src="'+msg[i].msg+'"/>\
						</div>\
					</div>\
				</div>')
						}
		}
	}	
}
//聊天记录
function chat(msg){
	for (var i = 0;i<msg.length;i++) {
				if (msg[i].type == "1") {
					if(msg[i].status == "left"){
						$('.chat_content').append('<div class="main_chat">\
					<div class="chat">\
						<div class="user_photo chat_l user_photo_other">\
							<img src="'+msg[i].pic+'" name="'+msg[i].nickname+'" />\
						</div>\
						<ul class="click_box click_box_one">\
							<div class="trian"></div>\
							<li class="givelike">给他个<i class="icones praoseone"></i></li>\
							<li class="givedis">给他个<i class="icones praosetwo "></i></li>\
							<li class="givecomp"><a href="../html/complaint.html">投诉TA</a><i class="icones compsu "></i></li>\
						</ul>\
						<div class="user_chat user_chat_l"><div class="san_l"></div>'+msg[i].msg+'</div>\
					</div>\
				</div>')
					}else{
						$('.chat_content').append('<div class="main_chat">\
					<div class="chat">\
						<div class="user_photo chat_r">\
							<img src="'+msg[i].pic+'" name="'+msg[i].nickname+'"/>\
						</div>\
						<div class="user_chat user_chat_r"><div class="san_r"></div>'+msg[i].msg+'</div>\
					</div>\
				</div>')
					}
				}
			}
}